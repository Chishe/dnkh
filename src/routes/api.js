'use strict';

const { escapeHtml } = require('../lib/html');
const {
  latestConditions, chartData, alarmRows, heliumPercentage, heliumAdjust, passHeliumLeak,
  heliumLaneStock, updateLane, insertPatrol
} = require('../services/machine');
const {
  CorePackingInputError, checkCorePacking, confirmCorePacking
} = require('../services/core-packing');

const ISO_DATE = /^\d{4}-\d{2}-\d{2}$/;

function trendEndpointPaths(file) {
  return ['fin11_5d', 'flux_1', 'flux_4'].map((line) => `/trendcontrol/${line}/server/${file}`);
}

module.exports = async function apiRoutes(app) {
  app.get('/api/health', async () => ({ status: 'ok', runtime: 'fastify', timestamp: new Date().toISOString() }));

  const sendCorePacking = async (request, reply) => {
    try {
      return await checkCorePacking(request.body || {});
    } catch (error) {
      if (error instanceof CorePackingInputError) return reply.code(error.statusCode).send({ error: error.message });
      throw error;
    }
  };
  const confirmCorePackingResult = async (request, reply) => {
    try {
      return await confirmCorePacking(request.body || {});
    } catch (error) {
      if (error instanceof CorePackingInputError) return reply.code(error.statusCode).send({ error: error.message });
      throw error;
    }
  };

  app.post('/api/core-packing/check', sendCorePacking);
  app.post('/api/core-packing/confirm', confirmCorePackingResult);
  app.post('/data_send', sendCorePacking);
  app.post('/data_confirm', confirmCorePackingResult);

  for (const url of trendEndpointPaths('mc_condition_server.php')) app.get(url, latestConditions);
  for (const url of trendEndpointPaths('mc_chart_data.php')) app.get(url, chartData);
  for (const url of trendEndpointPaths('fin_mc_prob_server.php')) app.get(url, (request) => alarmRows('machine', request.query.selected_date));
  for (const url of trendEndpointPaths('fin_qr_prob_server.php')) app.get(url, (request) => alarmRows('quality', request.query.selected_date));

  app.get('/server/helium_percentage.php', async (_request, reply) => {
    const rows = await heliumPercentage();
    reply.type('text/html; charset=utf-8');
    return rows.map((row) => `<tr><td>${escapeHtml(row.nb_pd)}</td><td>${escapeHtml(row.core_part_no)}</td><td>${escapeHtml(row.count_all)}</td><td>${escapeHtml(row.count_ng)}</td><td>${escapeHtml(row.percent)}</td></tr>`).join('') || 'No results found';
  });

  app.post('/server/helium_adjust.php', async (request, reply) => {
    const date = request.body?.date;
    if (date && !ISO_DATE.test(date)) return reply.code(400).send({ error: 'Invalid date format' });
    return heliumAdjust(date);
  });

  app.post('/server/helium_update.php', async (request, reply) => {
    const coreCode = String(request.body?.core_code || '').trim();
    const selectedDate = request.body?.date;
    if (!coreCode || !ISO_DATE.test(selectedDate || '')) {
      return reply.code(400).send({ error: 'Core code and date are required' });
    }
    const result = await passHeliumLeak({ coreCode, selectedDate });
    if (!result.updated) return reply.code(404).send({ error: 'Pending record not found' });
    return { ok: true, updated: result.updated };
  });

  app.get('/server/helium_lane_stock.php', async (_request, reply) => {
    const lanes = await heliumLaneStock();
    reply.type('text/html; charset=utf-8');
    return lanes.map(({ lane, row }) => {
      if (!row) return `<tr><td>${escapeHtml(lane.replace('Lane', 'Lane '))}</td><td></td><td></td><td></td><td></td><td></td></tr>`;
      const color = row.judge === 'OK' ? 'limegreen' : row.judge === 'NG' ? 'firebrick' : 'inherit';
      const buttons = row.type !== '27D' && !row.judge
        ? `<button type="button" onclick="submitcode('OK','${escapeHtml(row.kanban_code)}','${escapeHtml(lane)}')">OK</button> <button type="button" onclick="submitcode('NG','${escapeHtml(row.kanban_code)}','${escapeHtml(lane)}')">NG</button>` : '';
      return `<tr style="color:${color}"><td>${escapeHtml(lane.replace('Lane', 'Lane '))}</td><td>${escapeHtml(row.kanban_code)}</td><td>${escapeHtml(row.core_code)}</td><td>${escapeHtml(row.judge)}</td><td>${escapeHtml(row.type)}</td><td>${buttons}</td></tr>`;
    }).join('');
  });

  app.post('/server/helium_lane_update.php', async (request, reply) => {
    const result = await updateLane(request.body || {});
    reply.code(result.ok ? 200 : 401).type('text/plain; charset=utf-8');
    return result.message;
  });

  for (const line of ['fin11_5d', 'flux_1', 'flux_4']) {
    app.post(`/trendcontrol/${line}/LL_patrol_insert.php`, async (request, reply) => {
      await insertPatrol(request.body || {});
      return reply.redirect(request.headers.referer || `/trendcontrol/${line}/LL%20patrol_record_form.php`);
    });
  }
};
