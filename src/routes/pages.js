'use strict';

const fs = require('node:fs');
const path = require('node:path');
const config = require('../config');
const { renderLegacyPage, renderRows, today } = require('../lib/html');
const { getDatedPage, searchTraceability, getTrendHistory } = require('../services/dashboard');
const { heliumRatio } = require('../services/machine');

function findPages(directory = config.rootDir) {
  const pages = [];
  for (const entry of fs.readdirSync(directory, { withFileTypes: true })) {
    if (['node_modules', 'Chart.js-master', 'server', 'src'].includes(entry.name)) continue;
    const fullPath = path.join(directory, entry.name);
    if (entry.isDirectory()) pages.push(...findPages(fullPath));
    else if (entry.name.endsWith('.php') && entry.name !== 'LL_patrol_insert.php') {
      const relative = path.relative(config.rootDir, fullPath).replaceAll('\\', '/');
      if (!relative.includes('/server/')) pages.push(relative);
    }
  }
  return pages;
}

function queryContext(query) {
  return {
    input_data: query.input_data || '', columns: query.columns || '', insert_box: query.insert_box || '',
    columns_2: query.columns_2 || '', insert_box_2: query.insert_box_2 || '',
    columns_3: query.columns_3 || '', insert_box_3: query.insert_box_3 || '',
    columns_4: query.columns_4 || '', insert_box_4: query.insert_box_4 || '',
    columns_5: query.columns_5 || '', insert_box_5: query.insert_box_5 || '',
    column: query.column || '', startDate: query.startDate || '', endDate: query.endDate || ''
  };
}

async function buildPage(app, relativePath, request) {
  const context = queryContext(request.query || {});
  try {
    if (relativePath === 'traceability/searching.php') {
      const rows = await searchTraceability(request.query || {});
      context.rowsHtml = renderRows(relativePath, rows);
    } else if (/^trendcontrol\/(fin11_5d|flux_1|flux_4)\/history_(mc|qr)\.php$/.test(relativePath)) {
      const result = await getTrendHistory(relativePath, request.query.selected_date || request.query.flux_pd);
      context.selected_date = result.selectedDate;
      context.rowsHtml = renderRows(relativePath, result.rows);
    } else if (relativePath === 'traceability/pokayoke_core_ratio.php') {
      const ratio = await heliumRatio(request.query.selected_date);
      Object.assign(context, {
        selected_date: ratio.selectedDate,
        time_intervals: ratio.intervals,
        cumulative_all_data: ratio.cumulativeAll,
        cumulative_ng_data: ratio.cumulativeNg,
        ratio_data: ratio.ratios
      });
    } else {
      const result = await getDatedPage(relativePath, request.query.selected_date);
      if (result) {
        context.selected_date = result.selectedDate;
        context.rowsHtml = renderRows(relativePath, result.rows);
      }
    }
  } catch (error) {
    app.log.error({ err: error, page: relativePath }, 'database query failed; rendering the page without rows');
    context.selected_date ||= request.query.selected_date || today();
  }
  return renderLegacyPage(relativePath, context);
}

module.exports = async function pageRoutes(app) {
  app.get('/', (_request, reply) => reply.redirect('/traceability/searching'));
  app.get('/index.php', (_request, reply) => reply.redirect('/traceability/searching.php'));
  for (const relativePath of findPages()) {
    if (relativePath === 'index.php') continue;
    const extensionless = `/${relativePath.slice(0, -4)}`;
    const legacy = `/${relativePath}`;
    const handler = async (request, reply) => {
      reply.type('text/html; charset=utf-8');
      return buildPage(app, relativePath, request);
    };
    app.get(extensionless, handler);
    app.get(legacy, handler);
    if (relativePath.endsWith('/document_record.php')) {
      app.post(extensionless, handler);
      app.post(legacy, handler);
    }
  }
};
