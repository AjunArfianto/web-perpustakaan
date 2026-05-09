# 📚 Dashboard Perpustakaan Digital

Dashboard modern untuk manajemen perpustakaan dengan fitur lengkap untuk mengelola koleksi buku, pengguna, dan sirkulasi peminjaman.

## 🚀 Cara Menjalankan Dashboard

### **Opsi 1: Menggunakan Batch Script (Direkomendasikan)**

1. **Klik dua kali file `start-dashboard.bat`**
   - File ini akan otomatis membuka 2 jendela command prompt
   - Satu untuk PHP server, satu untuk Tailwind CSS

2. **Atau jalankan via command prompt:**
   ```batch
   start-dashboard.bat
   ```

### **Opsi 2: Menggunakan PowerShell Script**

1. **Buka PowerShell sebagai Administrator**
2. **Jalankan command ini untuk mengizinkan script:**
   ```powershell
   Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
   ```

3. **Jalankan script:**
   ```powershell
   .\start-dashboard.ps1
   ```

### **Opsi 3: Manual (Jika script tidak berfungsi)**

1. **Terminal/Command Prompt 1 - PHP Server:**
   ```bash
   cd e:\coding-mandiri\web-perpustakaan
   php -S localhost:8000 -t public
   ```

2. **Terminal/Command Prompt 2 - Tailwind CSS:**
   ```bash
   cd e:\coding-mandiri\web-perpustakaan
   npm run dev
   ```

## 🌐 Mengakses Dashboard

Setelah server berjalan, buka browser dan kunjungi:

```
http://localhost:8000/dashboard.php
```

Atau halaman utama:
```
http://localhost:8000/
```

## 📋 Fitur Dashboard

### 🏠 **Overview Dashboard**
- **Statistik Real-time**: Peminjaman aktif, buku terlambat, denda terkumpul
- **Grafik Analytics**: Tren peminjaman, popularitas genre, user engagement
- **Notifikasi Sistem**: Alert buku terlambat, stok rendah, maintenance
- **Quick Actions**: Shortcut untuk tugas umum

### 📖 **Manajemen Buku**
- Daftar semua buku dalam koleksi
- Pencarian dan filter buku
- Pagination untuk data besar
- Informasi lengkap: judul, penulis, penerbit, kategori

### 👥 **Manajemen Pengguna**
- Daftar semua pengguna terdaftar
- Status aktif/tidak aktif
- Role admin/user
- Informasi kontak lengkap

### 🏷️ **Kategori Buku**
- Kelola kategori/subject buku
- Hitung jumlah buku per kategori
- Interface grid yang menarik

### 🔄 **Sirkulasi**
- **Panel Peminjaman Aktif**: Buku yang sedang dipinjam
- **Panel Buku Terlambat**: Tracking overdue dengan denda
- **Reservasi Pending**: Mengelola permintaan reservasi
- **Riwayat Lengkap**: Log semua transaksi peminjaman

### 📅 **Acara & Pengumuman**
- **Kalender Interaktif**: Full calendar dengan navigasi bulan
- **Upcoming Events**: Daftar acara mendatang
- **Sistem Pengumuman**: Broadcast pesan ke pengguna

## 🛠️ Requirements

- **PHP 8.1+**: Untuk server backend dan API
- **Node.js & npm**: Untuk Tailwind CSS
- **Browser Modern**: Chrome, Firefox, Edge, Safari

## 📁 Struktur Proyek

```
web-perpustakaan/
├── public/                 # File publik (HTML, CSS, JS)
│   ├── dashboard.php      # Halaman utama dashboard
│   ├── api/               # API endpoints
│   │   └── dashboard.php  # Backend API
│   ├── index.html         # Landing page
│   └── output.css         # CSS yang di-build
├── src/                   # Source files
│   ├── input.css         # Tailwind input
│   └── output.css        # CSS source
├── start-dashboard.bat   # Script otomatis (Windows)
├── start-dashboard.ps1   # PowerShell script
├── package.json          # Node.js dependencies
└── README.md             # Dokumentasi ini
```

## 🎨 Teknologi Digunakan

- **Frontend**: HTML5, Tailwind CSS, JavaScript (ES6+)
- **Backend**: PHP 8.1+ (Native, tanpa framework)
- **Database**: Mock data (bisa diganti dengan MySQL/PostgreSQL)
- **Charts**: Chart.js untuk visualisasi data
- **Icons**: Font Awesome 6
- **Build Tool**: Tailwind CLI

## 🔧 Troubleshooting

### **Server Tidak Bisa Dijalankan**
- Pastikan PHP sudah ditambahkan ke PATH
- Pastikan Node.js dan npm sudah terinstall
- Cek apakah port 8000 sudah digunakan aplikasi lain

### **CSS Tidak Dimuat**
- Pastikan `npm run dev` sedang berjalan
- Cek file `public/output.css` ada dan berukuran > 50KB

### **API Tidak Berfungsi**
- Pastikan PHP server berjalan di `localhost:8000`
- Cek console browser untuk error JavaScript

### **Menu Tidak Berfungsi**
- Pastikan semua file JavaScript dimuat dengan benar
- Cek console browser untuk error

## 📞 Support

Jika mengalami masalah, periksa:
1. Console browser (F12 → Console)
2. Terminal/command prompt yang menjalankan server
3. File log error PHP (jika ada)

## 📄 Lisensi

Proyek ini dibuat untuk keperluan edukasi dan demonstrasi.

---

**Selamat menggunakan Dashboard Perpustakaan Digital! 🎉📚**



