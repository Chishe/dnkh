'use strict';

module.exports = {
  apps: [
    {
      name: 'dnkh-dashboard',
      cwd: __dirname,
      script: './src/server.js',
      exec_mode: 'fork',
      instances: 1,
      autorestart: true,
      watch: false,
      max_memory_restart: '350M',
      restart_delay: 1_000,
      listen_timeout: 10_000,
      kill_timeout: 5_000,
      merge_logs: true,
      time: true,
      env: {
        NODE_ENV: 'production',
        HOST: '0.0.0.0',
        PORT: 8800,
        LOG_LEVEL: 'info'
      },
      env_production: {
        NODE_ENV: 'production'
      }
    }
  ]
};
