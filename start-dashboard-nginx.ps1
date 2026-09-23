$ErrorActionPreference = 'Stop'

$dashboardRoot = Split-Path -Parent $MyInvocation.MyCommand.Path
$nginxCandidates = @(
    (Get-Command nginx.exe -ErrorAction SilentlyContinue | Select-Object -ExpandProperty Source -First 1),
    'C:\nginx\nginx.exe',
    'C:\tools\nginx\nginx.exe'
) | Where-Object { $_ -and (Test-Path -LiteralPath $_) }

if (-not $nginxCandidates) {
    throw 'nginx.exe not found. Install Nginx in C:\nginx or add it to PATH.'
}

$nginxExe = $nginxCandidates[0]
$nginxRoot = Split-Path -Parent $nginxExe
$configPath = Join-Path $dashboardRoot 'nginx-dashboard.conf'

if (Get-NetTCPConnection -LocalPort 8800 -State Listen -ErrorAction SilentlyContinue) {
    throw 'Port 8800 is already in use. Stop the old PHP server before starting Nginx.'
}

if (-not (Get-NetTCPConnection -LocalPort 3000 -State Listen -ErrorAction SilentlyContinue)) {
    $nodeExe = (Get-Command node.exe -ErrorAction Stop).Source
    Start-Process -FilePath $nodeExe -ArgumentList 'src/server.js' -WorkingDirectory $dashboardRoot -WindowStyle Hidden
    Start-Sleep -Seconds 1
}

& $nginxExe -p "$nginxRoot/" -c $configPath
if ($LASTEXITCODE -ne 0) {
    throw "Nginx failed to start. Check $nginxRoot\logs\error.log."
}

Write-Host 'Dashboard Fastify + Nginx started at http://192.168.2.101:8800/' -ForegroundColor Green
