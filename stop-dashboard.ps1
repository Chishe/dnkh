$ErrorActionPreference = 'Stop'
$dashboardPort = if ($env:PORT) { [int]$env:PORT } else { 8800 }
$listener = Get-NetTCPConnection -LocalPort $dashboardPort -State Listen -ErrorAction SilentlyContinue

if ($listener) {
    $process = Get-CimInstance Win32_Process -Filter "ProcessId = $($listener.OwningProcess)"
    if ($process.Name -eq 'node.exe' -and $process.CommandLine -match 'src[\\/]server\.js') {
        Stop-Process -Id $process.ProcessId
    } else {
        throw "Port $dashboardPort is not owned by this dashboard. Nothing was stopped."
    }
}

Write-Host 'Dashboard Fastify server stopped.' -ForegroundColor Yellow
