'use strict';

const config = require('./config');
const { buildApp } = require('./app');

async function start() {
  const app = buildApp();
  try {
    await app.listen({ host: config.host, port: config.port });
  } catch (error) {
    app.log.error(error);
    process.exitCode = 1;
  }
}

start();
