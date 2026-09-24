'use strict';

const { test, after } = require('node:test');
const assert = require('node:assert/strict');
const { buildApp } = require('../src/app');

const app = buildApp({ logger: false });
after(() => app.close());

test('health endpoint identifies the Fastify runtime', async () => {
  const response = await app.inject({ method: 'GET', url: '/api/health' });
  assert.equal(response.statusCode, 200);
  assert.equal(response.json().runtime, 'fastify');
});

test('core packing API replaces immediate Node-RED branches', async () => {
  const response = await app.inject({
    method: 'POST',
    url: '/api/core-packing/check',
    payload: { kanban: 'KN233310-5080', mc: 1 }
  });
  assert.equal(response.statusCode, 200);
  assert.deepEqual(response.json().data, {
    kanban: 'KN233310-5080', judge: '', value: 'dg', mc: 1
  });
  assert.equal(app.hasRoute({ method: 'POST', url: '/data_send' }), true);
  assert.equal(app.hasRoute({ method: 'POST', url: '/data_confirm' }), true);
});

test('root and legacy index keep existing entry links working', async () => {
  const root = await app.inject({ method: 'GET', url: '/' });
  const legacy = await app.inject({ method: 'GET', url: '/index.php' });
  assert.equal(root.statusCode, 302);
  assert.equal(root.headers.location, '/traceability/searching');
  assert.equal(legacy.statusCode, 302);
  assert.equal(legacy.headers.location, '/traceability/searching.php');
});

test('legacy PHP page is rendered as HTML without PHP instructions', async () => {
  const response = await app.inject({ method: 'GET', url: '/traceability/searching.php' });
  assert.equal(response.statusCode, 200);
  assert.match(response.headers['content-type'], /text\/html/);
  assert.match(response.body, /SEARCH\s*:\s*RADIATOR/i);
  assert.doesNotMatch(response.body, /<\?(?:php|=)/i);
});

test('new helium adjustment page and its Fastify endpoints are registered', async () => {
  const response = await app.inject({ method: 'GET', url: '/traceability/pokayoke_core_leakrate_adjust.php' });
  assert.equal(response.statusCode, 200);
  assert.match(response.body, /POKAYOKE CORE LEAKRATE ADJUST/i);
  assert.match(response.body, /class="adjust-toolbar"/);
  assert.doesNotMatch(response.body, /<\?(?:php|=)/i);
  assert.equal(app.hasRoute({ method: 'POST', url: '/server/helium_adjust.php' }), true);
  assert.equal(app.hasRoute({ method: 'POST', url: '/server/helium_update.php' }), true);

  const invalidSearch = await app.inject({
    method: 'POST',
    url: '/server/helium_adjust.php',
    payload: 'date=not-a-date',
    headers: { 'content-type': 'application/x-www-form-urlencoded' }
  });
  const invalidUpdate = await app.inject({
    method: 'POST',
    url: '/server/helium_update.php',
    payload: '',
    headers: { 'content-type': 'application/x-www-form-urlencoded' }
  });
  assert.equal(invalidSearch.statusCode, 400);
  assert.equal(invalidUpdate.statusCode, 400);
});

test('private runtime files are not exposed as static assets', async () => {
  for (const url of ['/package.json', '/src/server.js', '/server/search_server.php', '/.env.example']) {
    const response = await app.inject({ method: 'GET', url });
    assert.equal(response.statusCode, 404, url);
  }
});

test('extensionless and legacy PHP routes render the same unchanged UI', async () => {
  const routes = [
    ['/layout', '/layout.php'],
    ['/traceability/packing', '/traceability/packing.php'],
    ['/traceability/search_part', '/traceability/search_part.php'],
    ['/trendcontrol/fin11_5d/machine_condition', '/trendcontrol/fin11_5d/machine_condition.php']
  ];

  for (const [modern, legacy] of routes) {
    const [modernResponse, legacyResponse] = await Promise.all([
      app.inject({ method: 'GET', url: modern }),
      app.inject({ method: 'GET', url: legacy })
    ]);
    assert.equal(modernResponse.statusCode, 200, modern);
    assert.equal(legacyResponse.statusCode, 200, legacy);
    assert.equal(modernResponse.body, legacyResponse.body, legacy);
    assert.doesNotMatch(modernResponse.body, /<\?(?:php|=)/i);
  }
});

test('static assets are cached while application source stays private', async () => {
  const response = await app.inject({ method: 'GET', url: '/style.css' });
  assert.equal(response.statusCode, 200);
  assert.match(response.headers['cache-control'], /max-age=3600/);
  assert.match(response.headers['content-type'], /text\/css/);
});

test('document record keeps its legacy POST behavior', async () => {
  const response = await app.inject({
    method: 'POST',
    url: '/trendcontrol/fin11_5d/document_record.php',
    payload: { dataType: 'KN222310_8750', data: '10.25' },
    headers: { 'content-type': 'application/x-www-form-urlencoded' }
  });
  assert.equal(response.statusCode, 200);
  assert.match(response.body, /DOCUMENT RECORD/i);
  assert.doesNotMatch(response.body, /<\?(?:php|=)/i);
});
