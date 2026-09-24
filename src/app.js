'use strict';

const Fastify = require('fastify');
const fastifyStatic = require('@fastify/static');
const formbody = require('@fastify/formbody');
const config = require('./config');
const { packing, machine, coreTest } = require('./db/pools');

function buildApp(options = {}) {
  const app = Fastify({
    logger: options.logger ?? { level: process.env.LOG_LEVEL || 'info' },
    trustProxy: true,
    requestTimeout: 15_000,
    keepAliveTimeout: 72_000
  });

  app.register(formbody);
  app.register(require('./routes/api'));
  app.register(require('./routes/pages'));
  app.register(fastifyStatic, {
    root: config.rootDir,
    prefix: '/',
    wildcard: true,
    decorateReply: false,
    maxAge: '1h',
    immutable: false,
    index: false,
    allowedPath: (filePath) => {
      const normalized = filePath.replaceAll('\\', '/').replace(/^\//, '');
      const first = normalized.split('/')[0];
      return !normalized.endsWith('.php') &&
        !['node_modules', 'src', 'server', '.vscode'].includes(first) &&
        !['package.json', 'package-lock.json', 'nginx-dashboard.conf'].includes(normalized) &&
        !normalized.endsWith('.ps1') && !normalized.startsWith('.');
    }
  });

  app.setErrorHandler((error, request, reply) => {
    request.log.error(error);
    const statusCode = error.statusCode && error.statusCode < 500 ? error.statusCode : 500;
    reply.code(statusCode).send({ error: statusCode === 500 ? 'Internal server error' : error.message });
  });

  app.addHook('onClose', async () => Promise.all([packing.end(), machine.end(), coreTest.end()]));
  return app;
}

module.exports = { buildApp };
