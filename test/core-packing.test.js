'use strict';

const test = require('node:test');
const assert = require('node:assert/strict');
const {
  classifyKanban, decodeCoreRunNumber, checkCorePacking, confirmCorePacking
} = require('../src/services/core-packing');

test('classifies the same part groups as the Node-RED flow', () => {
  assert.equal(classifyKanban('KN233310-5080'), 'data-gap');
  assert.equal(classifyKanban('BFU10730-9900'), 'traceability');
  assert.equal(classifyKanban('XXXXXXXX-9880'), 'water');
  assert.equal(classifyKanban('XXXXXXXX-9910'), 'bypass');
  assert.equal(classifyKanban('XXXXXXXX-9960', 'line-1'), 'unsupported');
  assert.equal(classifyKanban('XXXXXXXX-9960', 'line-2'), 'bypass');
  assert.equal(classifyKanban('KN422133-EXTRA'), 'spare');
  assert.equal(classifyKanban('XXXXXXXX-0001'), 'unsupported');
});

test('keeps line 2 rules separate from line 1', async () => {
  const line2 = await checkCorePacking({ kanban: 'XXXXXXXX-9960', mc: 2, line: 'line-2' });
  assert.equal(line2.line, 'line-2');
  assert.equal(line2.kind, 'bypass');
  assert.equal(line2.data.judge, 'OK');
  await assert.rejects(
    checkCorePacking({ kanban: 'XXXXXXXX-9960', mc: 2, line: 'line-1' }),
    /not configured/
  );
});

test('decodes the legacy core production code without the long function chain', () => {
  assert.equal(decodeCoreRunNumber('BFU10730-9900'), 'C1202406300730');
});

test('returns immediate results for non-database packing paths', async () => {
  const water = await checkCorePacking({ kanban: 'XXXXXXXXX9880', mc: 1 });
  const bypass = await checkCorePacking({ kanban: 'XXXXXXXXX9910', mc: 2 });
  assert.deepEqual(water.data, { kanban: 'XXXXXXXXX9880', judge: '', value: 'water', mc: 1 });
  assert.equal(water.channel, 'data_rcv1');
  assert.equal(bypass.data.judge, 'OK');
  assert.equal(bypass.data.value, 'bypass');
  assert.equal(bypass.channel, 'data_rcv2');
});

test('uses two parameterized MySQL queries for the traceability decision', async () => {
  const calls = [];
  const database = {
    async execute(sql, params) {
      calls.push({ sql, params });
      if (calls.length === 1) return [[{ nb_pd: '2026-09-23' }]];
      return [[{ percent: '1.5', count_all: 80 }]];
    }
  };
  const response = await checkCorePacking({ kanban: 'BFU10730-9900', mc: 3 }, database);
  assert.equal(response.data.judge, 'OK');
  assert.equal(response.limit, 2);
  assert.equal(calls.length, 2);
  assert.match(calls[0].sql, /core_run_no = \?/);
  assert.deepEqual(calls[0].params, ['C1202406300730']);
  assert.match(calls[1].sql, /nb_pd = \?/);
});

test('confirms water and data-gap results with parameterized PostgreSQL queries', async () => {
  const calls = [];
  const database = {
    async query(sql, params) {
      calls.push({ sql, params });
      return { rows: [{ judge: 'OK' }] };
    }
  };
  const response = await confirmCorePacking({
    kanban: 'KN233310-5080', mc: 1, nb_date: '2026-09-23', type: 'dg'
  }, database);
  assert.equal(response.data.judge, 'OK');
  assert.match(calls[0].sql, /FROM gap_data/);
  assert.match(calls[0].sql, /core_part_no = \$1/);
  assert.deepEqual(calls[0].params, ['5080', '2026-09-23']);
});
