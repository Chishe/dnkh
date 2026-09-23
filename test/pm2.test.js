'use strict';

const test = require('node:test');
const assert = require('node:assert/strict');
const fs = require('node:fs');
const path = require('node:path');

const root = path.resolve(__dirname, '..');
const ecosystem = require('../ecosystem.config.js');

test('PM2 ecosystem runs one production Fastify process on port 8800', () => {
  assert.equal(fs.existsSync(path.join(root, 'ecosystem.config.js')), true);
  assert.equal(ecosystem.apps.length, 1);
  const app = ecosystem.apps[0];
  assert.equal(app.name, 'dnkh-dashboard');
  assert.equal(app.cwd, root);
  assert.equal(app.script, './src/server.js');
  assert.equal(app.exec_mode, 'fork');
  assert.equal(app.instances, 1);
  assert.equal(app.autorestart, true);
  assert.equal(app.watch, false);
  assert.equal(app.env.PORT, 8800);
  assert.equal(app.env.NODE_ENV, 'production');
});

test('PM2 start batch changes to its own path and uses the local PM2 binary', () => {
  const batch = fs.readFileSync(path.join(root, 'start-dashboard-pm2.bat'), 'utf8');
  assert.match(batch, /cd \/d "%~dp0"/i);
  assert.match(batch, /node_modules\\\.bin\\pm2\.cmd/i);
  assert.match(batch, /startOrReload "ecosystem\.config\.js"/i);
  assert.match(batch, /pm2\.cmd" save/i);
});
