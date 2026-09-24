'use strict';

const mysql = require('mysql2/promise');
const { Pool } = require('pg');
const config = require('../config');

function createPool(database) {
  const size = Number(process.env.DB_POOL_SIZE || 10);
  return mysql.createPool({
    ...database,
    waitForConnections: true,
    connectionLimit: size,
    maxIdle: size,
    idleTimeout: 60_000,
    queueLimit: 0,
    enableKeepAlive: true,
    keepAliveInitialDelay: 0,
    dateStrings: true,
    charset: 'utf8mb4'
  });
}

module.exports = {
  packing: createPool(config.packingDb),
  machine: createPool(config.machineDb),
  coreTest: new Pool(config.postgresDb)
};
