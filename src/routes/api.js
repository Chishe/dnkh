'use strict';

const { escapeHtml } = require('../lib/html');
const { latestConditions, chartData, alarmRows, heliumPercentage, heliumLaneStock, updateLane, insertPatrol } = require('../services/machine');

function trendEndpointPaths(file) {
  return ['fin11_5d', 'flux_1', 'flux_4'].map((line) => `/trendcontrol/${line}/server/${file}`);
}

module.exports = async function apiRoutes(app) {
  app.get('/api/health', async () => ({ status: 'ok', runtime: 'fastify', timestamp: new Date().toISOString() }));

  for (const url of trendEndpointPaths('mc_condition_server.php')) app.get(url, latestConditions);
  for (const url of trendEndpointPaths('mc_chart_data.php')) app.get(url, chartData);
  for (const url of trendEndpointPaths('fin_mc_prob_server.php')) app.get(url, (request) => alarmRows('machine', request.query.selected_date));
  for (const url of trendEndpointPaths('fin_qr_prob_server.php')) app.get(url, (request) => alarmRows('quality', request.query.selected_date));

  app.get('/server/helium_percentage.php', async (_request, reply) => {
    const rows = await heliumPercentage();
    reply.type('text/html; charset=utf-8');
    return rows.map((row) => `<tr><td>${escapeHtml(row.nb_pd)}</td><td>${escapeHtml(row.core_part_no)}</td><td>${escapeHtml(row.count_all)}</td><td>${escapeHtml(row.count_ng)}</td><td>${escapeHtml(row.percent)}</td></tr>`).join('') || 'No results found';
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
