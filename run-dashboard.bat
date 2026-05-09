@echo off
REM Simple Script untuk Menjalankan Dashboard Perpustakaan
title Dashboard Perpustakaan - Server Runner

echo.
echo ========================================
echo 🚀 DASHBOARD PERPUSTAKAAN
echo ========================================
echo.
echo Script ini akan menjalankan:
echo • PHP Server di localhost:8000
echo • Tailwind CSS Watch
echo.
echo Tekan Ctrl+C untuk menghentikan
echo.

REM Jalankan PHP server dan Tailwind CSS secara paralel
php -S localhost:8000 -t public



