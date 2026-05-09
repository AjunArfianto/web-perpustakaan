@echo off
REM Batch Script untuk Menjalankan Dashboard Perpustakaan
REM Script ini akan menjalankan PHP server dan Tailwind CSS secara otomatis

echo.
echo =====================================
echo 🚀 Menjalankan Dashboard Perpustakaan
echo =====================================
echo.

REM Cek apakah PHP terinstall
php --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ PHP tidak terinstall atau tidak ada di PATH
    echo 💡 Silakan install PHP dari https://windows.php.net/
    echo.
    pause
    exit /b 1
)

REM Cek apakah Node.js terinstall
node --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ Node.js tidak terinstall
    echo 💡 Silakan install Node.js dari https://nodejs.org/
    echo.
    pause
    exit /b 1
)

REM Cek direktori
if not exist "public" (
    echo ❌ Folder public tidak ditemukan
    echo 💡 Pastikan Anda menjalankan script dari folder root proyek
    echo.
    pause
    exit /b 1
)

echo ✅ Semua dependencies terdeteksi
echo.
echo 🔧 Menjalankan server...
echo.

REM Buka command prompt baru untuk PHP server
echo 📡 Menjalankan PHP Server di tab baru...
start "PHP Server - Dashboard Perpustakaan" cmd /k "cd /d %~dp0 && echo Menjalankan PHP Server... && php -S localhost:8000 -t public"

REM Tunggu sebentar
timeout /t 3 /nobreak >nul

REM Buka command prompt baru untuk Tailwind CSS
echo 🎨 Menjalankan Tailwind CSS Watch di tab baru...
start "Tailwind CSS - Dashboard Perpustakaan" cmd /k "cd /d %~dp0 && echo Menjalankan Tailwind CSS Watch... && npm run dev"

REM Tunggu sebentar
timeout /t 2 /nobreak >nul

echo.
echo =====================================
echo 🎉 Dashboard berhasil dijalankan!
echo =====================================
echo.
echo 🌐 Akses dashboard di browser:
echo    http://localhost:8000/dashboard.php
echo    atau
echo    http://localhost:8000/
echo.
echo 📊 Fitur yang tersedia:
echo    • Overview Dashboard dengan statistik
echo    • Manajemen Buku, Pengguna, Kategori
echo    • Sistem Sirkulasi (peminjaman/pengembalian)
echo    • Kalender Acara dan Pengumuman
echo.
echo 🛑 Cara menghentikan server:
echo    • Tutup kedua jendela command prompt yang terbuka
echo    • Atau tekan Ctrl+C di masing-masing jendela
echo.
echo ⚡ Script telah selesai!
echo    Sekarang Anda bisa membuka browser dan mengakses dashboard
echo.

pause
