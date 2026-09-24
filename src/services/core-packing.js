'use strict';

const { packing, coreTest } = require('../db/pools');

const PART_GROUPS = Object.freeze({
  traceability: new Set(['9900', '8372']),
  water: new Set(['9880', '3910', '2580', '9870', '0621']),
  dataGap: new Set(['9350', '1880', '5080', '8750', '0090', '9320', '2490', '9290', '9380', '1690']),
  bypass: new Set([
    '9910', '2891', '2881', '8510', '5360', '5090', '0300', '0451', '1380', '3470',
    '5970', '7040', '7310', '8400', '9420', '0880', '1700', '1800', '1820', '2610',
    '2840', '2350', '5410'
  ]),
  spare: new Set(['KN422133', 'KN422134', 'KN422135', 'KN422136', 'KN422137', 'KN422173', 'KN422174'])
});

class CorePackingInputError extends Error {
  constructor(message, statusCode = 400) {
    super(message);
    this.name = 'CorePackingInputError';
    this.statusCode = statusCode;
  }
}

function normalizeInput(input = {}) {
  const kanban = String(input.kanban || '').trim();
  const mc = Number(input.mc);
  if (!kanban) throw new CorePackingInputError('kanban is required');
  if (![1, 2, 3].includes(mc)) throw new CorePackingInputError('mc must be 1, 2, or 3');
  return { kanban, mc };
}

function classifyKanban(kanban) {
  const partCode = kanban.slice(9, 13);
  if (kanban.length <= 13) {
    if (PART_GROUPS.water.has(partCode)) return 'water';
    if (PART_GROUPS.dataGap.has(partCode)) return 'data-gap';
    if (PART_GROUPS.bypass.has(partCode)) return 'bypass';
    if (PART_GROUPS.traceability.has(partCode)) return 'traceability';
    return 'unsupported';
  }
  return PART_GROUPS.spare.has(kanban.slice(0, 8)) ? 'spare' : 'unsupported';
}

function decodeCoreRunNumber(coreCode) {
  const yearIndex = 'ABCDEFGHIJKLMNOPQR'.indexOf(coreCode[0]);
  const monthIndex = 'ABCDEFGHIJKL'.indexOf(coreCode[1]);
  const dayIndex = '123456789ABCDEFGHIJKLMNOPQRSTUV'.indexOf(coreCode[2]);
  if (yearIndex < 0 || monthIndex < 0 || dayIndex < 0 || coreCode.length < 8) {
    throw new CorePackingInputError('kanban has an invalid production code');
  }
  const year = 2023 + yearIndex;
  const month = String(monthIndex + 1).padStart(2, '0');
  const day = String(dayIndex + 1).padStart(2, '0');
  return `C${coreCode[3]}${year}${month}${day}${coreCode.slice(4, 8)}`;
}

function result(kanban, mc, judge, value, extra = {}) {
  return {
    data: { kanban, judge, value, mc },
    resetAfterMs: 10_000,
    ...extra
  };
}

function outputChannel(mc) {
  if (mc === 1) return 'data_rcv1';
  if (mc === 2) return 'data_rcv2';
  return null;
}

async function checkCorePacking(input, database = packing) {
  const { kanban, mc } = normalizeInput(input);
  const kind = classifyKanban(kanban);
  const common = { kind, channel: outputChannel(mc) };

  if (kind === 'water') return result(kanban, mc, '', 'water', common);
  if (kind === 'data-gap') return result(kanban, mc, '', 'dg', common);
  if (kind === 'bypass') return result(kanban, mc, 'OK', 'bypass', common);
  if (kind === 'spare') return result(kanban, mc, 'OK', 'spare', common);
  if (kind === 'unsupported') throw new CorePackingInputError('kanban is not configured in the packing flow', 422);

  const coreRunNo = decodeCoreRunNumber(kanban);
  const [productionRows] = await database.execute(
    'SELECT nb_pd FROM nb_1 WHERE core_run_no = ? ORDER BY id DESC LIMIT 1',
    [coreRunNo]
  );
  if (!productionRows.length) return result(kanban, mc, 'NG', 'out-T', { ...common, coreRunNo });

  const [ratioRows] = await database.execute(
    'SELECT percent, count_all FROM helium_percentage WHERE nb_pd = ? ORDER BY id DESC LIMIT 1',
    [productionRows[0].nb_pd]
  );
  if (!ratioRows.length) return result(kanban, mc, 'NG', 'out-T', { ...common, coreRunNo });

  const ratio = Number(ratioRows[0].percent);
  const count = Number(ratioRows[0].count_all);
  const limit = count <= 50 ? 5 : 2;
  const judge = Number.isFinite(ratio) && ratio <= limit ? 'OK' : 'NG';
  return result(kanban, mc, judge, judge, { ...common, coreRunNo, ratio, count, limit });
}

async function confirmCorePacking(input, database = coreTest) {
  const { kanban, mc } = normalizeInput(input);
  const date = String(input.nb_date || '').trim();
  const type = String(input.type || '').trim().toLowerCase();
  if (!/^\d{4}-\d{2}-\d{2}$/.test(date)) throw new CorePackingInputError('nb_date must use YYYY-MM-DD');
  if (!['water', 'dg'].includes(type)) throw new CorePackingInputError('type must be water or dg');

  const table = type === 'water' ? 'water_leak' : 'gap_data';
  const missingValue = type === 'water' ? 'out-W' : 'out-D';
  const rows = await database.query(
    `SELECT judge FROM ${table} WHERE core_part_no = $1 AND nb_pd = $2 ORDER BY id DESC LIMIT 1`,
    [kanban.slice(9, 13), date]
  );
  if (!rows.rows.length) {
    return result(kanban, mc, 'NG', missingValue, { type, channel: outputChannel(mc) });
  }

  const sourceJudge = String(rows.rows[0].judge || '').trim();
  const judge = sourceJudge === 'OK' ? 'OK' : 'NG';
  return result(kanban, mc, judge, sourceJudge || 'NG', { type, channel: outputChannel(mc) });
}

module.exports = {
  CorePackingInputError,
  classifyKanban,
  decodeCoreRunNumber,
  checkCorePacking,
  confirmCorePacking
};
