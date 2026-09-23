@echo off
setlocal

cd /d "%~dp0"
if errorlevel 1 (
    echo [ERROR] Cannot open dashboard directory: %~dp0
    exit /b 1
)

if not exist "node_modules\.bin\pm2.cmd" (
    echo [INFO] PM2 is not installed. Installing project dependencies...
    call npm install
    if errorlevel 1 (
        echo [ERROR] npm install failed.
        exit /b 1
    )
)

echo [INFO] Starting DNKH Dashboard with PM2...
call "node_modules\.bin\pm2.cmd" startOrReload "ecosystem.config.js" --env production --update-env
if errorlevel 1 (
    echo [ERROR] PM2 could not start the dashboard.
    exit /b 1
)

call "node_modules\.bin\pm2.cmd" save
call "node_modules\.bin\pm2.cmd" status dnkh-dashboard

echo [OK] Dashboard is running at http://localhost:8800/
endlocal
