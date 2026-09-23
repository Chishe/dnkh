$ErrorActionPreference = 'Stop'
$dashboardRoot = Split-Path -Parent $MyInvocation.MyCommand.Path

if (Get-NetTCPConnection -LocalPort 8800 -State Listen -ErrorAction SilentlyContinue) {
    throw 'Port 8800 is already in use.'
}

$nodeExe = (Get-Command node.exe -ErrorAction Stop).Source
Start-Process -FilePath $nodeExe -ArgumentList 'src/server.js' -WorkingDirectory $dashboardRoot -WindowStyle Hidden
Start-Sleep -Seconds 1

try {
    $health = Invoke-RestMethod -Uri 'http://127.0.0.1:8800/api/health' -TimeoutSec 5
    if ($health.status -ne 'ok') { throw 'Health check did not return ok.' }
} catch {
    throw "Fastify failed to start: $($_.Exception.Message)"
}

Write-Host 'Dashboard started at http://localhost:8800/' -ForegroundColor Green
