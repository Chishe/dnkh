# DNKH Dashboard — Fastify

The dashboard now runs on Node.js and Fastify. PHP and PHP-CGI are not required at runtime. Existing `.php` URLs remain available as compatibility routes so bookmarked links and the unchanged UI continue to work.

## Start

Requirements: Node.js 20+ and MySQL.

```powershell
npm install
npm start
```

Open `http://localhost:8800`. The Fastify server listens directly on port 8800.

## Run with PM2 on Windows

Double-click `start-dashboard-pm2.bat`. The batch file changes to its own project directory, starts `ecosystem.config.js`, saves the PM2 process list, and displays the service status. It therefore continues to work if the whole Dashboard folder is moved. Running `pm2 start` directly from this directory also works because the ecosystem uses PM2's default filename.

The ecosystem runs one Fastify instance in fork mode and automatically restarts it if it fails. To stop it, double-click `stop-dashboard-pm2.bat`.

Useful commands:

```powershell
npm run pm2:status
npm run pm2:restart
npm run pm2:logs
npm run pm2:stop
```

Database settings are read from environment variables documented in `.env.example`. The defaults match the previous PHP configuration.

## Structure

- `src/routes/` — page and API routes
- `src/services/` — database queries and dashboard behavior
- `src/db/` — shared MySQL connection pools
- `src/lib/` — legacy-view renderer used to keep the original UI unchanged
- `traceability/`, `trendcontrol/`, `partial/` — existing UI markup and browser scripts

## Performance changes

- MySQL connections are reused through two connection pools.
- Queries use parameters instead of concatenating user input.
- Static files have one-hour browser caching.
- Search responses are bounded to prevent accidental unbounded table reads.
- Fastify keep-alive is enabled for dashboard polling.

Health check: `GET /api/health`.

## Core packing API (Node-RED replacement)

The former `data_send` and `data_confirm` flow is available directly from Fastify. The API returns the machine decision immediately; `resetAfterMs` tells the client when it may clear the displayed result without holding the HTTP request open.

Check a kanban:

```http
POST /api/core-packing/check
Content-Type: application/json

{"kanban":"KN233310-5080","mc":1}
```

Confirm a water-leak or data-gap result:

```http
POST /api/core-packing/confirm
Content-Type: application/json

{"kanban":"KN233310-5080","mc":1,"nb_date":"2026-09-23","type":"dg"}
```

Compatibility aliases `POST /data_send` and `POST /data_confirm` accept the same bodies. Point the scanner/client at Fastify port 8800, verify both machines, and only then disable the corresponding Node-RED input to avoid processing the same scan twice.

The confirm endpoint reads PostgreSQL settings from the `CORE_TEST_DB_*` environment variables in `.env.example`. Never copy a database password into source code or a Node-RED export.
