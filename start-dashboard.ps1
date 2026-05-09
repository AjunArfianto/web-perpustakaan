# PowerShell Script untuk Menjalankan Dashboard Perpustakaan
# Script ini akan menjalankan PHP server dan Tailwind CSS secara otomatis

Write-Host "🚀 Menjalankan Dashboard Perpustakaan..." -ForegroundColor Green
Write-Host "=====================================" -ForegroundColor Yellow

# Path ke direktori proyek
$projectPath = $PSScriptRoot
$publicPath = Join-Path $projectPath "public"

Write-Host "📁 Project Path: $projectPath" -ForegroundColor Cyan
Write-Host "🌐 Public Path: $publicPath" -ForegroundColor Cyan
Write-Host ""

# Cek apakah PHP terinstall
try {
    $phpVersion = php --version 2>$null
    if ($LASTEXITCODE -eq 0) {
        Write-Host "✅ PHP terdeteksi: $(php --version | Select-Object -First 1)" -ForegroundColor Green
    } else {
        Write-Host "❌ PHP tidak terinstall atau tidak ada di PATH" -ForegroundColor Red
        Write-Host "💡 Silakan install PHP dari https://windows.php.net/" -ForegroundColor Yellow
        exit 1
    }
} catch {
    Write-Host "❌ PHP tidak ditemukan" -ForegroundColor Red
    Write-Host "💡 Pastikan PHP sudah ditambahkan ke PATH environment variable" -ForegroundColor Yellow
    exit 1
}

# Cek apakah Node.js dan npm terinstall
try {
    $nodeVersion = node --version 2>$null
    $npmVersion = npm --version 2>$null
    if ($LASTEXITCODE -eq 0) {
        Write-Host "✅ Node.js terdeteksi: $nodeVersion" -ForegroundColor Green
        Write-Host "✅ npm terdeteksi: $npmVersion" -ForegroundColor Green
    } else {
        Write-Host "❌ Node.js/npm tidak terinstall" -ForegroundColor Red
        Write-Host "💡 Silakan install Node.js dari https://nodejs.org/" -ForegroundColor Yellow
        exit 1
    }
} catch {
    Write-Host "❌ Node.js/npm tidak ditemukan" -ForegroundColor Red
    exit 1
}

# Cek apakah direktori public ada
if (-not (Test-Path $publicPath)) {
    Write-Host "❌ Folder public tidak ditemukan di $publicPath" -ForegroundColor Red
    exit 1
}

Write-Host ""
Write-Host "🔧 Menjalankan server..." -ForegroundColor Yellow

# Jalankan PHP server di background
Write-Host "📡 Menjalankan PHP Server..." -ForegroundColor Cyan
$phpJob = Start-Job -ScriptBlock {
    param($projectPath, $publicPath)
    Set-Location $projectPath
    php -S localhost:8000 -t $publicPath
} -ArgumentList $projectPath, $publicPath

# Tunggu sebentar untuk PHP server start
Start-Sleep -Seconds 2

# Jalankan Tailwind CSS watch di background
Write-Host "🎨 Menjalankan Tailwind CSS Watch..." -ForegroundColor Cyan
$cssJob = Start-Job -ScriptBlock {
    param($projectPath)
    Set-Location $projectPath
    npm run dev
} -ArgumentList $projectPath

# Tunggu sebentar untuk CSS watch start
Start-Sleep -Seconds 3

Write-Host ""
Write-Host "🎉 Dashboard berhasil dijalankan!" -ForegroundColor Green
Write-Host "=====================================" -ForegroundColor Yellow
Write-Host ""
Write-Host "🌐 Akses dashboard di browser:" -ForegroundColor Cyan
Write-Host "   http://localhost:8000/dashboard.php" -ForegroundColor White
Write-Host "   atau" -ForegroundColor White
Write-Host "   http://localhost:8000/" -ForegroundColor White
Write-Host ""
Write-Host "📊 Fitur yang tersedia:" -ForegroundColor Cyan
Write-Host "   • Overview Dashboard" -ForegroundColor White
Write-Host "   • Manajemen Buku" -ForegroundColor White
Write-Host "   • Manajemen Pengguna" -ForegroundColor White
Write-Host "   • Sistem Sirkulasi" -ForegroundColor White
Write-Host "   • Kalender Acara" -ForegroundColor White
Write-Host ""
Write-Host "🛑 Untuk menghentikan server:" -ForegroundColor Yellow
Write-Host "   Tekan Ctrl+C di terminal ini" -ForegroundColor White
Write-Host "   atau tutup jendela command prompt" -ForegroundColor White
Write-Host ""
Write-Host "⚡ Script akan terus berjalan..." -ForegroundColor Green
Write-Host "   Jangan tutup jendela ini!" -ForegroundColor Red

# Monitor jobs dan tampilkan status
while ($true) {
    $phpJobStatus = Get-Job -Id $phpJob.Id
    $cssJobStatus = Get-Job -Id $cssJob.Id

    if ($phpJobStatus.State -eq "Failed") {
        Write-Host "❌ PHP Server gagal dijalankan!" -ForegroundColor Red
        Write-Host "Error: $($phpJobStatus.ChildJobs[0].JobStateInfo.Reason.Message)" -ForegroundColor Red
        break
    }

    if ($cssJobStatus.State -eq "Failed") {
        Write-Host "❌ Tailwind CSS gagal dijalankan!" -ForegroundColor Red
        Write-Host "Error: $($cssJobStatus.ChildJobs[0].JobStateInfo.Reason.Message)" -ForegroundColor Red
        break
    }

    # Tampilkan status setiap 10 detik
    Write-Host "$(Get-Date -Format 'HH:mm:ss') - PHP Server: $($phpJobStatus.State), CSS Watch: $($cssJobStatus.State)" -ForegroundColor Gray

    Start-Sleep -Seconds 10
}

# Cleanup jobs jika script dihentikan
Write-Host ""
Write-Host "🧹 Membersihkan proses..." -ForegroundColor Yellow
Stop-Job -Id $phpJob.Id -ErrorAction SilentlyContinue
Stop-Job -Id $cssJob.Id -ErrorAction SilentlyContinue
Remove-Job -Id $phpJob.Id -ErrorAction SilentlyContinue
Remove-Job -Id $cssJob.Id -ErrorAction SilentlyContinue

Write-Host "✅ Semua proses telah dihentikan" -ForegroundColor Green



