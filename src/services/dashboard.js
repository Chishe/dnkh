'use strict';

const { packing, machine } = require('../db/pools');
const { today } = require('../lib/html');

const datedPages = Object.freeze({
  'traceability/brazing_nb.php': ['nb_1', 'nb_pd'],
  'traceability/core_assy.php': ['core_1', 'core_pd_date'],
  'traceability/final_assy_4.php': ['assy_4', 'assy_pd_date'],
  'traceability/final_assy_6.php': ['assy_6', 'assy_pd_date'],
  'traceability/flux.php': ['flux_4', 'flux_pd'],
  'traceability/flux_1.php': ['flux_4', 'flux_pd'],
  'traceability/stock.php': ['stock_1', 'staging_date'],
  'traceability/total.php': ['assy_4', 'assy_pd_date']
});

async function getDatedPage(relativePath, selectedDate) {
  const pageConfig = datedPages[relativePath];
  if (!pageConfig) return null;
  const date = selectedDate || today();
  const [table, column] = pageConfig;
  const [rows] = await packing.execute(`SELECT * FROM \`${table}\` WHERE \`${column}\` = ? ORDER BY id ASC`, [date]);
  return { rows, selectedDate: date };
}

const allowedSearchColumns = new Set([
  'assy_part_no', 'assy_pd_date', 'assy_run_no', 'assy_packing_part_no', 'assy_packing_pd_date',
  'assy_packing_run_no', 'core_part_no', 'core_pd_date', 'core_run_no', 'coreplate_mat_date',
  'coreplate_mat_lot', 'coreplate_mat_no', 'coreplate_part_no', 'coreplate_pd', 'fin_mat_date',
  'fin_mat_lot', 'fin_mat_no', 'fin_part_no', 'fin_pd', 'flux_pd', 'insert_mat_date',
  'insert_mat_lot', 'insert_mat_no', 'insert_part_no', 'insert_pd', 'nb_pd', 'PTank_lwr_mat_date',
  'PTank_lwr_mat_lot', 'PTank_lwr_mat_no', 'PTank_lwr_part_no', 'PTank_lwr_pd_date',
  'PTank_upr_mat_date', 'PTank_upr_mat_lot', 'PTank_upr_mat_no', 'PTank_upr_part_no',
  'PTank_upr_pd_date', 'staging_casemark', 'stacking_packing_lane', 'staging_ship_location',
  'tube_mat_date', 'tube_mat_lot', 'tube_mat_no', 'tube_part_no', 'tube_pd'
]);

function decodeScan(input) {
  if (!input) return null;
  if (input.length > 20) {
    return {
      partColumn: 'assy_part_no', part: `${input.slice(0, 8)}-${input.slice(8, 12)}`,
      dateColumn: 'assy_pd_date', date: `20${input.slice(14, 16)}-${input.slice(16, 18)}-${input.slice(18, 20)}`,
      runColumn: 'assy_run_no', run: input.slice(26, 30), order: 'assy_run_no'
    };
  }
  const years = { A: '2023', B: '2024', C: '2025', D: '2026', E: '2027', F: '2028' };
  const monthIndex = 'ABCDEFGHIJKL'.indexOf(input[1]);
  const dayIndex = '123456789ABCDEFGHIJKLMNOPQRSTUV'.indexOf(input[2]);
  const year = years[input[0]];
  if (!year || monthIndex < 0 || dayIndex < 0) return null;
  const month = String(monthIndex + 1).padStart(2, '0');
  const day = String(dayIndex + 1).padStart(2, '0');
  return {
    partColumn: 'core_part_no', part: input.slice(9, 13),
    dateColumn: 'core_pd_date', date: `${year}-${month}-${day}`,
    runColumn: 'core_run_no', run: `C${input.slice(3, 4)}${year}${month}${day}${input.slice(4, 8)}`,
    order: 'core_run_no'
  };
}

async function searchTraceability(query) {
  const filters = [];
  for (let index = 1; index <= 5; index += 1) {
    const suffix = index === 1 ? '' : `_${index}`;
    const column = query[`columns${suffix}`];
    const value = query[`insert_box${suffix}`];
    if (value && allowedSearchColumns.has(column)) filters.push([column, value]);
  }
  let sql = 'SELECT * FROM traceability';
  let params = [];
  if (filters.length) {
    sql += ` WHERE ${filters.map(([column]) => `\`${column}\` = ?`).join(' AND ')} ORDER BY assy_run_no ASC LIMIT 1000`;
    params = filters.map(([, value]) => value);
  } else if (query.column && query.startDate && query.endDate && ['core', 'flux', 'nb', 'assy'].includes(query.column)) {
    const dateColumn = ['flux', 'nb'].includes(query.column) ? `${query.column}_pd` : `${query.column}_pd_date`;
    const timeColumn = `${query.column}_pd_time`;
    sql += ` WHERE CONCAT(\`${dateColumn}\`, 'T', \`${timeColumn}\`) BETWEEN ? AND ? ORDER BY \`${dateColumn}\` DESC LIMIT 1000`;
    params = [query.startDate, query.endDate];
  } else if (query.input_data === 'all') {
    sql += ' ORDER BY id DESC LIMIT 100';
  } else {
    const decoded = decodeScan(query.input_data || '');
    if (!decoded) return [];
    sql += ` WHERE \`${decoded.partColumn}\` = ? AND \`${decoded.dateColumn}\` = ? AND \`${decoded.runColumn}\` = ? ORDER BY \`${decoded.order}\` ASC LIMIT 1000`;
    params = [decoded.part, decoded.date, decoded.run];
  }
  const [rows] = await packing.execute(sql, params);
  return rows;
}

async function getTrendHistory(relativePath, selectedDate) {
  const date = selectedDate || today();
  const quality = relativePath.endsWith('/history_qr.php');
  const table = quality ? 'qr_fin_forming' : 'fin_forming';
  const orderColumn = quality ? '_id' : 'id';
  const [rows] = await machine.execute(`SELECT * FROM \`${table}\` WHERE Date = ? ORDER BY \`${orderColumn}\` ASC`, [date]);
  return { rows, selectedDate: date };
}

module.exports = { getDatedPage, searchTraceability, getTrendHistory };
