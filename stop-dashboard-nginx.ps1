$ErrorActionPreference = 'Stop'

$nginxCandidates = @(
    (Get-Command nginx.exe -ErrorAction SilentlyContinue | Select-Object -ExpandProperty Source -First 1),
    'C:\nginx\nginx.exe',
    'C:\tools\nginx\nginx.exe'
) | Where-Object { $_ -and (Test-Path -LiteralPath $_) }

if ($nginxCandidates) {
    $nginxExe = $nginxCandidates[0]
    $nginxRoot = Split-Path -Parent $nginxExe
    & $nginxExe -p "$nginxRoot/" -s quit
}

$listener = Get-NetTCPConnection -LocalPort 3000 -State Listen -ErrorAction SilentlyContinue
if ($listener) {
    $process = Get-CimInstance Win32_Process -Filter "ProcessId = $($listener.OwningProcess)"
    if ($process.Name -eq 'node.exe' -and $process.CommandLine -match 'src[\\/]server\.js') {
        Stop-Process -Id $process.ProcessId
    }
}

Write-Host 'Dashboard Nginx and Fastify stopped.' -ForegroundColor Yellow
