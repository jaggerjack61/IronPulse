# Start the GymSite (IronPulse) app locally (no Docker)
# Backend: Laravel 13 + Livewire + Reverb
# Frontend: Vite (built into Laravel)

$Root = Split-Path -Parent $MyInvocation.MyCommand.Definition

Write-Host "Installing dependencies and setting up ..." -ForegroundColor Green
Start-Process powershell -ArgumentList "-NoExit", "-Command", "cd `"$Root`"; composer install; npm install && npm run build; if (-not (Test-Path .env)) { copy .env.example .env; php artisan key:generate }; php artisan migrate:fresh --seed; php artisan serve"

Write-Host "Starting GymSite Reverb (WebSocket) ..." -ForegroundColor Green
Start-Process powershell -ArgumentList "-NoExit", "-Command", "cd `"$Root`"; php artisan reverb:start"

Write-Host "Starting GymSite Queue Listener ..." -ForegroundColor Green
Start-Process powershell -ArgumentList "-NoExit", "-Command", "cd `"$Root`"; php artisan queue:listen --tries=1"

Write-Host "Done. App: http://127.0.0.1:8000" -ForegroundColor Cyan
