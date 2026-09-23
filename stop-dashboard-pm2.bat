@echo off
setlocal

cd /d "%~dp0"
if errorlevel 1 exit /b 1

if not exist "node_modules\.bin\pm2.cmd" (
    echo [ERROR] PM2 is not installed in this project.
    exit /b 1
)

call "node_modules\.bin\pm2.cmd" stop dnkh-dashboard
if errorlevel 1 exit /b 1

echo [OK] DNKH Dashboard stopped.
endlocal
