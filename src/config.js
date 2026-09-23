'use strict';

const path = require('node:path');
const rootDir = path.resolve(__dirname, '..');

module.exports = Object.freeze({
  rootDir,
  host: process.env.HOST || '0.0.0.0',
  port: Number(process.env.PORT || 8800),
  packingDb: {
    host: process.env.PACKING_DB_HOST || '127.0.0.1',
    port: Number(process.env.PACKING_DB_PORT || 3306),
    user: process.env.PACKING_DB_USER || 'root',
    password: process.env.PACKING_DB_PASSWORD || '',
    database: process.env.PACKING_DB_NAME || 'packing_dnkh'
  },
  machineDb: {
    host: process.env.MACHINE_DB_HOST || '127.0.0.1',
    port: Number(process.env.MACHINE_DB_PORT || 3306),
    user: process.env.MACHINE_DB_USER || 'root',
    password: process.env.MACHINE_DB_PASSWORD || '',
    database: process.env.MACHINE_DB_NAME || 'dnkh'
  }
});
