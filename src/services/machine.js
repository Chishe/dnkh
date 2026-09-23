'use strict';

const { machine, packing } = require('../db/pools');
const { today } = require('../lib/html');

const machineNames = [
  ['AfterCutAirBlow1', 'After cut air blow 1'],
  ['TwistChutAirBlow1', 'Twist chut air blow 1'],
  ['AfterCutAirBlow2', 'After cut air blow 2'],
  ['TwistChutAirBlow2', 'Twist chut air blow 2'],
  ['TensionPressure', 'Tension pressure'],
  ['TensionAdjustPress', 'Tension adjust press'],
  ['Flow1', 'Flow 1'], ['Flow2', 'Flow 2'], ['Flow3', 'Flow 3'], ['Flow4', 'Flow 4']
];

async function latestConditions() {
  const results = await Promise.all(machineNames.map(async ([key, name]) => {
    const [rows] = await machine.execute('SELECT Date, Time, pressure_actual, status_state FROM fin_forming WHERE name_mc = ? ORDER BY id DESC LIMIT 1', [name]);
    return [key, rows[0]];
  }));
  const data = {};
  for (const [key, row] of results) {
    if (row) data[key] = { date: row.Date, time: row.Time, value: row.pressure_actual, status: row.status_state };
  }
  const [setup] = await machine.execute("SELECT * FROM mc_setup WHERE mc_name = 'After cut air blow 1' LIMIT 1");
  if (setup[0]) {
    const row = setup[0];
    data.SetupAC1 = {
      alarm_max: row.alarm_max, alarm_min: row.alarm_min,
      chart_max: row.chart_max, chart_min: row.chart_min, chart_color: row.chart_color,
      gauge_max: row.gauge_max, gauge_min: row.gauge_min, gauge_color: row.gauge_color
    };
  }
  return data;
}

async function chartData() {
  const tables = await Promise.all(machineNames.map(async ([, name]) => {
    const [rows] = await machine.execute("SELECT pressure_actual, CONCAT(Date, ' ', Time) AS datetime FROM fin_forming WHERE name_mc = ? ORDER BY id DESC LIMIT 10", [name]);
    return rows.reverse();
  }));
  const [setup] = await machine.execute("SELECT * FROM mc_setup WHERE mc_name = 'After cut air blow 1'");
  return Object.assign(Object.fromEntries(tables.map((rows, index) => [`table${index + 1}`, rows])), { setupac1: setup });
}

async function alarmRows(type, selectedDate) {
  const date = selectedDate || today();
  if (type === 'quality') {
    const [rows] = await machine.execute("SELECT * FROM qr_fin_forming WHERE status_part = 0 AND Date = ? ORDER BY _id DESC", [date]);
    return rows;
  }
  const [rows] = await machine.execute("SELECT * FROM fin_forming WHERE status_state = 'Alarm' AND Date = ? ORDER BY id DESC", [date]);
  return rows;
}

async function heliumPercentage() {
  const [rows] = await packing.query("SELECT nb_pd, core_part_no, count_all, count_ng, percent FROM helium_percentage WHERE nb_pd >= CURDATE() - INTERVAL 14 DAY AND nb_pd != ' ' ORDER BY nb_pd DESC");
  return rows;
}

async function heliumLaneStock() {
  const lanes = await Promise.all(['Lane1', 'Lane2'].map(async (lane) => {
    const [rows] = await packing.execute("SELECT * FROM core_export WHERE input_date != '' AND output_date = '' AND lane = ? ORDER BY id DESC LIMIT 1", [lane]);
    return { lane, row: rows[0] };
  }));
  return lanes;
}

async function heliumRatio(selectedDate) {
  const date = selectedDate || today();
  const intervals = ['07:30-09:30', '09:30-11:30', '11:30-13:30', '13:30-15:30', '15:30-17:30', '17:30-19:30', '19:30-21:30', '21:30-23:30', '23:30-01:30', '01:30-03:30', '03:30-05:30', '05:30-07:30'];
  const [rows] = await packing.execute(`
    SELECT CASE
      WHEN TIME(assy_time) >= '07:30:00' AND TIME(assy_time) < '09:30:00' THEN '07:30-09:30'
      WHEN TIME(assy_time) >= '09:30:00' AND TIME(assy_time) < '11:30:00' THEN '09:30-11:30'
      WHEN TIME(assy_time) >= '11:30:00' AND TIME(assy_time) < '13:30:00' THEN '11:30-13:30'
      WHEN TIME(assy_time) >= '13:30:00' AND TIME(assy_time) < '15:30:00' THEN '13:30-15:30'
      WHEN TIME(assy_time) >= '15:30:00' AND TIME(assy_time) < '17:30:00' THEN '15:30-17:30'
      WHEN TIME(assy_time) >= '17:30:00' AND TIME(assy_time) < '19:30:00' THEN '17:30-19:30'
      WHEN TIME(assy_time) >= '19:30:00' AND TIME(assy_time) < '21:30:00' THEN '19:30-21:30'
      WHEN TIME(assy_time) >= '21:30:00' AND TIME(assy_time) < '23:30:00' THEN '21:30-23:30'
      WHEN TIME(assy_time) >= '23:30:00' OR TIME(assy_time) < '01:30:00' THEN '23:30-01:30'
      WHEN TIME(assy_time) >= '01:30:00' AND TIME(assy_time) < '03:30:00' THEN '01:30-03:30'
      WHEN TIME(assy_time) >= '03:30:00' AND TIME(assy_time) < '05:30:00' THEN '03:30-05:30'
      WHEN TIME(assy_time) >= '05:30:00' AND TIME(assy_time) < '07:30:00' THEN '05:30-07:30' END AS time_range,
      COUNT(*) AS total_count, SUM(CASE WHEN he_judge != 'OK' THEN 1 ELSE 0 END) AS ng_count
    FROM helium_leak WHERE assy_date = ? GROUP BY time_range`, [date]);
  const byInterval = new Map(rows.map((row) => [row.time_range, row]));
  let total = 0;
  let ng = 0;
  const cumulativeAll = [];
  const cumulativeNg = [];
  const ratios = [];
  for (const interval of intervals) {
    total += Number(byInterval.get(interval)?.total_count || 0);
    ng += Number(byInterval.get(interval)?.ng_count || 0);
    cumulativeAll.push(total);
    cumulativeNg.push(ng);
    ratios.push(total ? (ng / total) * 100 : 0);
  }
  return { selectedDate: date, intervals, cumulativeAll, cumulativeNg, ratios };
}

async function updateLane({ judge, kanban_code: kanbanCode, lane, password }) {
  const lanePassword = process.env.LANE_PASSWORD;
  if (!lanePassword || password !== lanePassword) return { ok: false, message: 'รหัสผ่านไม่ถูกต้อง' };
  await packing.execute('UPDATE core_export SET judge = ? WHERE kanban_code = ? AND lane = ?', [judge, kanbanCode, lane]);
  fetch('http://192.168.2.101:1880/ws/openlane', {
    method: 'POST',
    headers: { 'content-type': 'application/x-www-form-urlencoded' },
    body: new URLSearchParams({ judge, kanban_code: kanbanCode, lane }),
    signal: AbortSignal.timeout(1000)
  }).catch(() => {});
  return { ok: true, message: 'Record updated successfully' };
}

const patrolFieldMap = [
  ['id_user', 'yourId'], ['recorder', 'recorder'], ['date_patrol', 'date_patrol'],
  ['time_start', 'timeStart'], ['time_stop', 'timeStop'], ['round', 'round'], ['shift', 'shift'],
  ['graph_quality', 'quality1Hidden'], ['history_quality', 'quality2Hidden'],
  ['recovered_quality', 'dropdownQuality'], ['problem_quality', 'textboxQuality'],
  ['graph_machine', 'Machine1Hidden'], ['history_machine', 'Machine2Hidden'],
  ['recovered_machine', 'dropdownMachine'], ['problem_machine', 'textboxMachine'],
  ...['b', 'c', 'd', 'e'].flatMap((suffix) => [
    [`graph_quality_${suffix}`, `quality1Hidden_${suffix}`],
    [`history_quality_${suffix}`, `quality2Hidden_${suffix}`],
    [`recovered_quality_${suffix}`, `dropdownQuality_${suffix}`],
    [`problem_quality_${suffix}`, `textboxQuality_${suffix}`],
    [`graph_machine_${suffix}`, `Machine1Hidden_${suffix}`],
    [`history_machine_${suffix}`, `Machine2Hidden_${suffix}`],
    [`recovered_machine_${suffix}`, `dropdownMachine_${suffix}`],
    [`problem_machine_${suffix}`, `textboxMachine_${suffix}`]
  ]),
  ['suggestion', 'suggestion']
];

async function insertPatrol(body) {
  const columns = patrolFieldMap.map(([column]) => `\`${column}\``).join(', ');
  const placeholders = patrolFieldMap.map(() => '?').join(', ');
  const values = patrolFieldMap.map(([, field]) => body[field] ?? '');
  await machine.execute(`INSERT INTO ll_patrol (${columns}) VALUES (${placeholders})`, values);
}

module.exports = { latestConditions, chartData, alarmRows, heliumPercentage, heliumLaneStock, heliumRatio, updateLane, insertPatrol };
