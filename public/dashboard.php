<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard - Ajun Digital Library</title>
  <link href="./output.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    html {
      scroll-behavior: smooth;
    }
    .sidebar {
      transition: transform 0.3s ease;
    }
    .sidebar-hidden {
      transform: translateX(-100%);
    }
    .sidebar-visible {
      transform: translateX(0);
    }
    @media (min-width: 768px) {
      .sidebar {
        position: relative !important;
        transform: translateX(0) !important;
        left: auto !important;
        z-index: 10;
      }
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased">

<!-- Sidebar -->
<aside id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-gradient-to-b from-blue-800 via-indigo-800 to-purple-800 text-white z-40 sidebar sidebar-hidden md:sidebar-visible">
  <div class="flex flex-col h-full">
    <!-- Logo -->
    <div class="p-6 border-b border-white/20">
      <div class="flex items-center gap-3">
        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center text-xl">
          <i class="fas fa-book-open"></i>
        </div>
        <div>
          <h1 class="text-lg font-bold">Ajun Digital Library</h1>
          <p class="text-xs opacity-80">Dashboard Admin</p>
        </div>
      </div>
    </div>

    <!-- Menu -->
    <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
      <a href="#overview" onclick="showSection('overview')" class="nav-item flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-all active">
        <i class="fas fa-chart-line w-5"></i>
        <span>Overview</span>
      </a>
      <a href="#books" onclick="showSection('books')" class="nav-item flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-all">
        <i class="fas fa-book w-5"></i>
        <span>Buku</span>
      </a>
      <a href="#users" onclick="showSection('users')" class="nav-item flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-all">
        <i class="fas fa-users w-5"></i>
        <span>Pengguna</span>
      </a>
      <a href="#categories" onclick="showSection('categories')" class="nav-item flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-all">
        <i class="fas fa-tags w-5"></i>
        <span>Kategori</span>
      </a>
      <a href="#circulation" onclick="showSection('circulation')" class="nav-item flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-all">
        <i class="fas fa-exchange-alt w-5"></i>
        <span>Sirkulasi</span>
      </a>
      <a href="#events" onclick="showSection('events')" class="nav-item flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-all">
        <i class="fas fa-calendar-alt w-5"></i>
        <span>Acara & Pengumuman</span>
      </a>
    </nav>

    <!-- Footer Sidebar -->
    <div class="p-4 border-t border-white/20">
      <a href="#" onclick="goToHomePage(); return false;" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-all">
        <i class="fas fa-home w-5"></i>
        <span>Kembali ke Beranda</span>
      </a>
    </div>
  </div>
</aside>

<!-- Main Content -->
<div class="w-full md:ml-64">
  <!-- Top Bar -->
  <header class="bg-gradient-to-r from-slate-50 to-blue-50 shadow-sm sticky top-0 z-30 border-b border-blue-100">
    <div class="flex items-center justify-between px-6 py-4">
      <div class="flex items-center gap-4">
        <button id="sidebarToggle" class="md:hidden text-gray-600 hover:text-blue-600 transition-colors">
          <i class="fas fa-bars text-xl"></i>
        </button>
        <div>
          <h2 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
            Dashboard Perpustakaan
          </h2>
          <p class="text-sm text-gray-600">Selamat datang kembali, Administrator</p>
        </div>
      </div>
      <div class="flex items-center gap-4">
        <div class="hidden md:flex items-center gap-3 text-sm text-gray-600 bg-white/50 px-3 py-2 rounded-lg">
          <i class="fas fa-calendar-alt text-blue-500"></i>
          <span id="currentDate"></span>
        </div>
        <div class="flex items-center gap-3">
          <div class="hidden md:block text-right">
            <p class="text-sm font-semibold text-gray-800">Admin</p>
            <p class="text-xs text-gray-500">Online</p>
          </div>
          <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg">
            A
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Content Area -->
  <main class="p-6">
    <!-- Welcome Section -->
    <div class="mb-8">
      <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-8 text-white shadow-xl">
        <div class="flex items-center justify-between">
          <div>
            <h1 class="text-3xl font-bold mb-2">Selamat Datang di Dashboard Perpustakaan</h1>
            <p class="text-blue-100 text-lg">Pantau aktivitas perpustakaan Anda dengan mudah</p>
          </div>
          <div class="hidden md:block">
            <i class="fas fa-book-open text-6xl text-blue-200 opacity-80"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Overview Section -->
    <section id="overview-section" class="section-content">
      <!-- Key Metrics -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Loading skeleton -->
        <div class="animate-pulse bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
          <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 bg-blue-100 rounded-xl"></div>
            <div>
              <div class="w-16 h-4 bg-gray-200 rounded mb-1"></div>
              <div class="w-20 h-3 bg-gray-100 rounded"></div>
            </div>
          </div>
          <div class="w-24 h-8 bg-gray-300 rounded mb-2"></div>
          <div class="w-32 h-4 bg-gray-200 rounded"></div>
        </div>
        <div class="animate-pulse bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
          <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 bg-red-100 rounded-xl"></div>
            <div>
              <div class="w-16 h-4 bg-gray-200 rounded mb-1"></div>
              <div class="w-20 h-3 bg-gray-100 rounded"></div>
            </div>
          </div>
          <div class="w-24 h-8 bg-gray-300 rounded mb-2"></div>
          <div class="w-32 h-4 bg-gray-200 rounded"></div>
        </div>
        <div class="animate-pulse bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
          <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 bg-green-100 rounded-xl"></div>
            <div>
              <div class="w-16 h-4 bg-gray-200 rounded mb-1"></div>
              <div class="w-20 h-3 bg-gray-100 rounded"></div>
            </div>
          </div>
          <div class="w-24 h-8 bg-gray-300 rounded mb-2"></div>
          <div class="w-32 h-4 bg-gray-200 rounded"></div>
        </div>
      </div>

      <!-- Actual Metrics (hidden initially) -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 hidden" id="actual-metrics">
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
          <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center text-white">
              <i class="fas fa-book-reader text-xl"></i>
            </div>
            <div>
              <h4 class="font-semibold text-gray-800">Peminjaman Aktif</h4>
              <p class="text-sm text-gray-500">Buku sedang dipinjam</p>
            </div>
          </div>
          <div class="text-3xl font-bold text-gray-900 mb-1" id="stat-active-loans">0</div>
          <p class="text-sm text-gray-600"><span id="stat-total-loans">0</span> total hari ini</p>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
          <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 bg-red-500 rounded-xl flex items-center justify-center text-white">
              <i class="fas fa-exclamation-triangle text-xl"></i>
            </div>
            <div>
              <h4 class="font-semibold text-gray-800">Buku Terlambat</h4>
              <p class="text-sm text-gray-500">Perlu penagihan</p>
            </div>
          </div>
          <div class="text-3xl font-bold text-gray-900 mb-1" id="stat-overdue-books">0</div>
          <p class="text-sm text-gray-600">Denda: <span id="stat-overdue-fines">Rp 0</span></p>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
          <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center text-white">
              <i class="fas fa-dollar-sign text-xl"></i>
            </div>
            <div>
              <h4 class="font-semibold text-gray-800">Pendapatan Bulan Ini</h4>
              <p class="text-sm text-gray-500">Dari denda & layanan</p>
            </div>
          </div>
          <div class="text-3xl font-bold text-gray-900 mb-1" id="stat-monthly-fines">Rp 0</div>
          <p class="text-sm text-gray-600">Total tahun ini: <span id="stat-yearly-fines">Rp 0</span></p>
        </div>
      </div>

      <!-- Overview Chart -->
      <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 mb-8">
        <div class="flex items-center justify-between mb-6">
          <div>
            <h3 class="text-xl font-bold text-gray-800">Aktivitas Peminjaman</h3>
            <p class="text-sm text-gray-500">Tren peminjaman 6 bulan terakhir</p>
          </div>
          <div class="flex items-center gap-2 text-sm text-gray-500">
            <i class="fas fa-chart-line"></i>
            <span>Real-time</span>
          </div>
        </div>

        <!-- Chart Skeleton -->
        <div class="animate-pulse" id="chart-skeleton">
          <div class="w-full h-64 bg-gray-200 rounded-lg"></div>
        </div>

        <!-- Actual Chart (hidden initially) -->
        <div class="hidden" id="actual-chart">
          <canvas id="readingTrendsChart" height="250"></canvas>
        </div>
      </div>

      <!-- Quick Actions & Recent Activity -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Quick Actions -->
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
          <h3 class="text-lg font-bold text-gray-800 mb-4">Aksi Cepat</h3>
          <div class="grid grid-cols-2 gap-3">
            <button onclick="showSection('circulation')"
                    class="flex items-center gap-3 p-4 bg-blue-50 hover:bg-blue-100 rounded-xl transition-all duration-200 border border-blue-200">
              <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center text-white">
                <i class="fas fa-plus"></i>
              </div>
              <div class="text-left">
                <div class="font-semibold text-gray-800">Peminjaman Baru</div>
                <div class="text-xs text-gray-500">Tambah peminjaman</div>
              </div>
            </button>

            <button onclick="showSection('books')"
                    class="flex items-center gap-3 p-4 bg-purple-50 hover:bg-purple-100 rounded-xl transition-all duration-200 border border-purple-200">
              <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center text-white">
                <i class="fas fa-book"></i>
              </div>
              <div class="text-left">
                <div class="font-semibold text-gray-800">Kelola Buku</div>
                <div class="text-xs text-gray-500">Tambah/edit buku</div>
              </div>
            </button>

            <button onclick="showSection('users')"
                    class="flex items-center gap-3 p-4 bg-green-50 hover:bg-green-100 rounded-xl transition-all duration-200 border border-green-200">
              <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center text-white">
                <i class="fas fa-users"></i>
              </div>
              <div class="text-left">
                <div class="font-semibold text-gray-800">Kelola Pengguna</div>
                <div class="text-xs text-gray-500">Daftar pengguna</div>
              </div>
            </button>

            <button onclick="showSection('events')"
                    class="flex items-center gap-3 p-4 bg-orange-50 hover:bg-orange-100 rounded-xl transition-all duration-200 border border-orange-200">
              <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center text-white">
                <i class="fas fa-calendar-plus"></i>
              </div>
              <div class="text-left">
                <div class="font-semibold text-gray-800">Jadwalkan Acara</div>
                <div class="text-xs text-gray-500">Event perpustakaan</div>
              </div>
            </button>
          </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-gray-800">Aktivitas Terbaru</h3>
            <a href="#circulation" onclick="showSection('circulation')" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
              Lihat Semua
            </a>
          </div>

          <div id="recent-activity" class="space-y-3">
            <!-- Loading skeleton -->
            <div class="animate-pulse space-y-3">
              <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-gray-200 rounded-full"></div>
                <div class="flex-1">
                  <div class="w-32 h-4 bg-gray-200 rounded mb-1"></div>
                  <div class="w-24 h-3 bg-gray-100 rounded"></div>
                </div>
              </div>
              <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-gray-200 rounded-full"></div>
                <div class="flex-1">
                  <div class="w-32 h-4 bg-gray-200 rounded mb-1"></div>
                  <div class="w-24 h-3 bg-gray-100 rounded"></div>
                </div>
              </div>
              <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-gray-200 rounded-full"></div>
                <div class="flex-1">
                  <div class="w-32 h-4 bg-gray-200 rounded mb-1"></div>
                  <div class="w-24 h-3 bg-gray-100 rounded"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Books Section -->
    <section id="books-section" class="section-content hidden">
      <div class="bg-white rounded-2xl p-6 shadow-lg">
        <div class="flex items-center justify-between mb-6">
          <h3 class="text-2xl font-bold text-gray-800">Daftar Buku</h3>
          <button class="px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:shadow-lg transition-all">
            <i class="fas fa-plus mr-2"></i>Tambah Buku
          </button>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead>
              <tr class="border-b border-gray-200">
                <th class="text-left py-3 px-4 font-semibold text-gray-700">ID</th>
                <th class="text-left py-3 px-4 font-semibold text-gray-700">Judul</th>
                <th class="text-left py-3 px-4 font-semibold text-gray-700">Penulis</th>
                <th class="text-left py-3 px-4 font-semibold text-gray-700">Penerbit</th>
                <th class="text-left py-3 px-4 font-semibold text-gray-700">Kategori</th>
                <th class="text-left py-3 px-4 font-semibold text-gray-700">Rating</th>
                <th class="text-left py-3 px-4 font-semibold text-gray-700">Download</th>
                <th class="text-left py-3 px-4 font-semibold text-gray-700">Aksi</th>
              </tr>
            </thead>
            <tbody id="books-table-body">
              <tr>
                <td colspan="8" class="text-center py-8 text-gray-400">
                  <i class="fas fa-spinner fa-spin text-2xl mb-2"></i>
                  <p>Memuat data...</p>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div id="books-pagination" class="mt-6 flex justify-center gap-2"></div>
      </div>
    </section>

    <!-- Users Section -->
    <section id="users-section" class="section-content hidden">
      <div class="bg-white rounded-2xl p-6 shadow-lg">
        <div class="flex items-center justify-between mb-6">
          <h3 class="text-2xl font-bold text-gray-800">Daftar Pengguna</h3>
          <button class="px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:shadow-lg transition-all">
            <i class="fas fa-plus mr-2"></i>Tambah Pengguna
          </button>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead>
              <tr class="border-b border-gray-200">
                <th class="text-left py-3 px-4 font-semibold text-gray-700">ID</th>
                <th class="text-left py-3 px-4 font-semibold text-gray-700">Nama</th>
                <th class="text-left py-3 px-4 font-semibold text-gray-700">Email</th>
                <th class="text-left py-3 px-4 font-semibold text-gray-700">Username</th>
                <th class="text-left py-3 px-4 font-semibold text-gray-700">Role</th>
                <th class="text-left py-3 px-4 font-semibold text-gray-700">Status</th>
                <th class="text-left py-3 px-4 font-semibold text-gray-700">Aksi</th>
              </tr>
            </thead>
            <tbody id="users-table-body">
              <tr>
                <td colspan="7" class="text-center py-8 text-gray-400">
                  <i class="fas fa-spinner fa-spin text-2xl mb-2"></i>
                  <p>Memuat data...</p>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div id="users-pagination" class="mt-6 flex justify-center gap-2"></div>
      </div>
    </section>

    <!-- Categories Section -->
    <section id="categories-section" class="section-content hidden">
      <div class="bg-white rounded-2xl p-6 shadow-lg">
        <div class="flex items-center justify-between mb-6">
          <h3 class="text-2xl font-bold text-gray-800">Daftar Kategori</h3>
          <button class="px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:shadow-lg transition-all">
            <i class="fas fa-plus mr-2"></i>Tambah Kategori
          </button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="categories-grid">
          <div class="text-center py-8 text-gray-400">
            <i class="fas fa-spinner fa-spin text-2xl mb-2"></i>
            <p>Memuat data...</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Circulation Section -->
    <section id="circulation-section" class="section-content hidden">
      <div class="space-y-6">
        <!-- Circulation Overview -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
          <!-- Active Loans -->
          <div class="bg-white rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-xl font-bold text-gray-800">Peminjaman Aktif</h3>
              <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold" id="active-loans-count">0</span>
            </div>
            <div id="active-loans-list" class="space-y-3 max-h-80 overflow-y-auto">
              <div class="text-center py-4 text-gray-400">
                <i class="fas fa-spinner fa-spin text-xl mb-2"></i>
                <p>Memuat...</p>
              </div>
            </div>
          </div>

          <!-- Overdue Books -->
          <div class="bg-white rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-xl font-bold text-gray-800">Buku Terlambat</h3>
              <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-semibold" id="overdue-count">0</span>
            </div>
            <div id="overdue-books-list" class="space-y-3 max-h-80 overflow-y-auto">
              <div class="text-center py-4 text-gray-400">
                <i class="fas fa-spinner fa-spin text-xl mb-2"></i>
                <p>Memuat...</p>
              </div>
            </div>
          </div>

          <!-- Pending Reservations -->
          <div class="bg-white rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-xl font-bold text-gray-800">Reservasi Pending</h3>
              <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm font-semibold" id="pending-reservations-count">0</span>
            </div>
            <div id="pending-reservations-list" class="space-y-3 max-h-80 overflow-y-auto">
              <div class="text-center py-4 text-gray-400">
                <i class="fas fa-spinner fa-spin text-xl mb-2"></i>
                <p>Memuat...</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Circulation Actions -->
        <div class="bg-white rounded-2xl p-6 shadow-lg">
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold text-gray-800">Manajemen Sirkulasi</h3>
            <div class="flex gap-3">
              <button onclick="showCirculationModal('checkout')" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all">
                <i class="fas fa-plus mr-2"></i>Peminjaman Baru
              </button>
              <button onclick="showCirculationModal('return')" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all">
                <i class="fas fa-undo mr-2"></i>Pengembalian
              </button>
            </div>
          </div>

          <!-- Circulation History -->
          <div class="overflow-x-auto">
            <table class="w-full">
              <thead>
                <tr class="border-b border-gray-200">
                  <th class="text-left py-3 px-4 font-semibold text-gray-700">ID</th>
                  <th class="text-left py-3 px-4 font-semibold text-gray-700">Pengguna</th>
                  <th class="text-left py-3 px-4 font-semibold text-gray-700">Buku</th>
                  <th class="text-left py-3 px-4 font-semibold text-gray-700">Tanggal Pinjam</th>
                  <th class="text-left py-3 px-4 font-semibold text-gray-700">Tanggal Kembali</th>
                  <th class="text-left py-3 px-4 font-semibold text-gray-700">Status</th>
                  <th class="text-left py-3 px-4 font-semibold text-gray-700">Denda</th>
                  <th class="text-left py-3 px-4 font-semibold text-gray-700">Aksi</th>
                </tr>
              </thead>
              <tbody id="circulation-table-body">
                <tr>
                  <td colspan="8" class="text-center py-8 text-gray-400">
                    <i class="fas fa-spinner fa-spin text-2xl mb-2"></i>
                    <p>Memuat data sirkulasi...</p>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div id="circulation-pagination" class="mt-6 flex justify-center gap-2"></div>
        </div>
      </div>
    </section>

    <!-- Events & Announcements Section -->
    <section id="events-section" class="section-content hidden">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Calendar -->
        <div class="lg:col-span-2">
          <div class="bg-white rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between mb-6">
              <h3 class="text-2xl font-bold text-gray-800">Kalender Acara</h3>
              <button onclick="showEventModal()" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:shadow-lg transition-all">
                <i class="fas fa-plus mr-2"></i>Tambah Acara
              </button>
            </div>

            <!-- Calendar Header -->
            <div class="flex items-center justify-between mb-4">
              <button onclick="changeMonth(-1)" class="p-2 hover:bg-gray-100 rounded-lg">
                <i class="fas fa-chevron-left"></i>
              </button>
              <h4 id="calendar-month-year" class="text-xl font-bold text-gray-800">Desember 2025</h4>
              <button onclick="changeMonth(1)" class="p-2 hover:bg-gray-100 rounded-lg">
                <i class="fas fa-chevron-right"></i>
              </button>
            </div>

            <!-- Calendar Grid -->
            <div class="grid grid-cols-7 gap-1 mb-4">
              <div class="p-2 text-center font-semibold text-gray-600">Min</div>
              <div class="p-2 text-center font-semibold text-gray-600">Sen</div>
              <div class="p-2 text-center font-semibold text-gray-600">Sel</div>
              <div class="p-2 text-center font-semibold text-gray-600">Rab</div>
              <div class="p-2 text-center font-semibold text-gray-600">Kam</div>
              <div class="p-2 text-center font-semibold text-gray-600">Jum</div>
              <div class="p-2 text-center font-semibold text-gray-600">Sab</div>
            </div>

            <div id="calendar-grid" class="grid grid-cols-7 gap-1">
              <!-- Calendar days will be populated here -->
            </div>
          </div>
        </div>

        <!-- Upcoming Events & Announcements -->
        <div class="space-y-6">
          <!-- Upcoming Events -->
          <div class="bg-white rounded-2xl p-6 shadow-lg">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Acara Mendatang</h3>
            <div id="upcoming-events" class="space-y-3">
              <div class="text-center py-4 text-gray-400">
                <i class="fas fa-spinner fa-spin text-xl mb-2"></i>
                <p>Memuat acara...</p>
              </div>
            </div>
          </div>

          <!-- Announcements -->
          <div class="bg-white rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-xl font-bold text-gray-800">Pengumuman</h3>
              <button onclick="showAnnouncementModal()" class="text-blue-600 hover:text-blue-700 text-sm font-semibold">
                <i class="fas fa-plus mr-1"></i>Tambah
              </button>
            </div>
            <div id="announcements-list" class="space-y-3">
              <div class="text-center py-4 text-gray-400">
                <i class="fas fa-spinner fa-spin text-xl mb-2"></i>
                <p>Memuat pengumuman...</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</div>

<!-- Overlay untuk mobile -->
<div id="overlay" class="fixed inset-0 bg-black/50 z-30 md:hidden hidden" onclick="toggleSidebar()"></div>

<script>
// Sidebar Toggle
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('overlay');
const sidebarToggle = document.getElementById('sidebarToggle');

function toggleSidebar() {
  sidebar.classList.toggle('sidebar-hidden');
  overlay.classList.toggle('hidden');
}

sidebarToggle?.addEventListener('click', toggleSidebar);

// Set current date
document.getElementById('currentDate').textContent = new Date().toLocaleDateString('id-ID', {
  weekday: 'long',
  year: 'numeric',
  month: 'long',
  day: 'numeric'
});

// Section Navigation
function showSection(section) {
  try {
    // Hide all sections
    document.querySelectorAll('.section-content').forEach(el => el.classList.add('hidden'));

    // Remove active state from all nav items
    document.querySelectorAll('.nav-item').forEach(el => el.classList.remove('active', 'bg-white/10'));

    // Show selected section
    const targetSection = document.getElementById(`${section}-section`);
    if (targetSection) {
      targetSection.classList.remove('hidden');

      // Add active state to clicked nav item
      if (event && event.target) {
        event.target.closest('.nav-item')?.classList.add('active', 'bg-white/10');
      }

      // Load section data
      if (section === 'books') {
        loadBooksTable();
      } else if (section === 'users') {
        loadUsersTable();
      } else if (section === 'categories') {
        loadCategories();
      } else if (section === 'circulation') {
        loadCirculationData();
      } else if (section === 'events') {
        loadEventsData();
      }
    } else {
      console.error(`Section ${section}-section not found`);
    }
  } catch (error) {
    console.error('Error in showSection:', error);
  }
}

// API Functions
async function fetchAPI(endpoint) {
  try {
    const response = await fetch(`api/dashboard.php?${endpoint}`);
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('API Error:', error);
    return { success: false, error: error.message };
  }
}

// Load Notifications
async function loadNotifications() {
  const result = await fetchAPI('action=notifications');
  const container = document.getElementById('notifications-panel');

  if (result.success && result.data && result.data.length > 0) {
    container.innerHTML = result.data.map(notification => {
      let bgColor, icon, iconColor;
      switch(notification.type) {
        case 'overdue':
          bgColor = 'bg-red-50 border-red-200';
          icon = 'fas fa-exclamation-triangle';
          iconColor = 'text-red-500';
          break;
        case 'low_stock':
          bgColor = 'bg-yellow-50 border-yellow-200';
          icon = 'fas fa-exclamation-circle';
          iconColor = 'text-yellow-500';
          break;
        case 'maintenance':
          bgColor = 'bg-blue-50 border-blue-200';
          icon = 'fas fa-tools';
          iconColor = 'text-blue-500';
          break;
        case 'reservation':
          bgColor = 'bg-green-50 border-green-200';
          icon = 'fas fa-clock';
          iconColor = 'text-green-500';
          break;
        default:
          bgColor = 'bg-gray-50 border-gray-200';
          icon = 'fas fa-info-circle';
          iconColor = 'text-gray-500';
      }

      return `
        <div class="${bgColor} border rounded-lg p-4 flex items-start gap-3 hover:shadow-sm transition-all">
          <div class="w-8 h-8 ${iconColor} flex items-center justify-center flex-shrink-0 mt-0.5">
            <i class="${icon}"></i>
          </div>
          <div class="flex-1">
            <h4 class="font-semibold text-gray-800 text-sm">${notification.title}</h4>
            <p class="text-gray-600 text-sm mt-1">${notification.message}</p>
            ${notification.action_url ? `<a href="${notification.action_url}" class="text-blue-600 hover:text-blue-700 text-sm font-medium mt-2 inline-block">Lihat Detail →</a>` : ''}
          </div>
          <button onclick="dismissNotification(${notification.id})" class="text-gray-400 hover:text-gray-600 flex-shrink-0">
            <i class="fas fa-times text-sm"></i>
          </button>
        </div>
      `;
    }).join('');
  } else {
    container.innerHTML = '';
  }
}

function dismissNotification(notificationId) {
  // This would dismiss the notification via API
  // For now, just hide it
  event.target.closest('.border').style.display = 'none';
}

// Load Dashboard Stats
async function loadDashboardStats() {
  const result = await fetchAPI('action=stats');
  if (result.success) {
    const stats = result.data;

    // Replace skeleton with actual metrics
    document.querySelector('.grid.grid-cols-1.md\\:grid-cols-3.gap-6.mb-8').classList.add('hidden');
    document.getElementById('actual-metrics').classList.remove('hidden');

    // Update metrics
    document.getElementById('stat-active-loans').textContent = stats.active_loans || 0;
    document.getElementById('stat-total-loans').textContent = stats.total_loans_today || 0;
    document.getElementById('stat-overdue-books').textContent = stats.overdue_books || 0;
    document.getElementById('stat-overdue-fines').textContent = `Rp ${(stats.overdue_fines || 0).toLocaleString('id-ID')}`;
    document.getElementById('stat-monthly-fines').textContent = `Rp ${(stats.monthly_fines || 0).toLocaleString('id-ID')}`;
    document.getElementById('stat-yearly-fines').textContent = `Rp ${(stats.yearly_fines || 0).toLocaleString('id-ID')}`;
  }
}


// Load Recent Activity
async function loadRecentActivity() {
  try {
    const result = await fetchAPI('action=active_loans&limit=3');
    const container = document.getElementById('recent-activity');

    if (!container) {
      console.error('Recent activity container not found');
      return;
    }

    if (result.success && result.data && result.data.length > 0) {
      container.innerHTML = result.data.map(activity => `
        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
          <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm">
            <i class="fas fa-book"></i>
          </div>
          <div class="flex-1">
            <div class="text-sm font-medium text-gray-800">${activity.book_title || 'Unknown Book'}</div>
            <div class="text-xs text-gray-500">${activity.user_name || 'Unknown User'} • ${new Date(activity.due_date).toLocaleDateString('id-ID')}</div>
          </div>
        </div>
      `).join('');
    } else {
      container.innerHTML = '<p class="text-center py-4 text-gray-400 text-sm">Tidak ada aktivitas terbaru</p>';
    }
  } catch (error) {
    console.error('Error loading recent activity:', error);
    const container = document.getElementById('recent-activity');
    if (container) {
      container.innerHTML = '<p class="text-center py-4 text-red-400 text-sm">Gagal memuat aktivitas</p>';
    }
  }
}

// Load Categories Chart
async function loadCategoriesChart() {
  const result = await fetchAPI('action=categories');
  if (result.success && result.data.length > 0) {
    // Show actual charts and hide skeleton
    document.getElementById('charts-container').classList.add('hidden');
    document.getElementById('actual-charts').classList.remove('hidden');

    const ctx = document.getElementById('categoriesChart');
    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: result.data.map(cat => cat.name),
        datasets: [{
          data: result.data.map(cat => cat.book_count || 0),
          backgroundColor: [
            'rgba(59, 130, 246, 0.8)',
            'rgba(16, 185, 129, 0.8)',
            'rgba(139, 92, 246, 0.8)',
            'rgba(236, 72, 153, 0.8)',
            'rgba(251, 146, 60, 0.8)',
            'rgba(34, 197, 94, 0.8)',
          ]
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'bottom'
          }
        }
      }
    });
  }
}

// Load Popular Books Chart
async function loadPopularBooksChart() {
  const result = await fetchAPI('action=popular_books&limit=5');
  if (result.success && result.data.length > 0) {
    const ctx = document.getElementById('popularBooksChart');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: result.data.map(book => book.title.length > 20 ? book.title.substring(0, 20) + '...' : book.title),
        datasets: [{
          label: 'Download',
          data: result.data.map(book => book.download_count || 0),
          backgroundColor: 'rgba(59, 130, 246, 0.8)'
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false
          }
        },
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  }
}

// Load Reading Trends Chart
async function loadReadingTrendsChart() {
  try {
    const result = await fetchAPI('action=reading_trends&months=6');
    if (result.success && result.data && result.data.length > 0) {
      // Hide skeleton and show actual chart
      document.getElementById('chart-skeleton').classList.add('hidden');
      document.getElementById('actual-chart').classList.remove('hidden');

      const ctx = document.getElementById('readingTrendsChart');
      new Chart(ctx, {
        type: 'line',
        data: {
          labels: result.data.map(item => {
            const date = new Date(item.month);
            return date.toLocaleDateString('id-ID', { month: 'short', year: 'numeric' });
          }),
          datasets: [{
            label: 'Peminjaman',
            data: result.data.map(item => item.loan_count || 0),
            borderColor: 'rgba(59, 130, 246, 1)',
            backgroundColor: 'rgba(59, 130, 246, 0.1)',
            tension: 0.4,
            fill: true,
            pointBackgroundColor: 'rgba(59, 130, 246, 1)',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 4
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                stepSize: 1
              }
            },
            x: {
              grid: {
                display: false
              }
            }
          },
          interaction: {
            intersect: false,
            mode: 'index'
          }
        }
      });
    } else {
      // Hide skeleton and show message
      document.getElementById('chart-skeleton').classList.add('hidden');
      document.getElementById('actual-chart').innerHTML = '<div class="text-center py-8 text-gray-400"><i class="fas fa-chart-line text-4xl mb-2"></i><p>Data tren tidak tersedia</p></div>';
      document.getElementById('actual-chart').classList.remove('hidden');
    }
  } catch (error) {
    console.error('Error loading reading trends chart:', error);
    document.getElementById('chart-skeleton').classList.add('hidden');
    document.getElementById('actual-chart').innerHTML = '<div class="text-center py-8 text-red-400"><i class="fas fa-exclamation-triangle text-4xl mb-2"></i><p>Gagal memuat grafik</p></div>';
    document.getElementById('actual-chart').classList.remove('hidden');
  }
}

// Load Genre Trends Chart
async function loadGenreTrendsChart() {
  const result = await fetchAPI('action=genre_trends&limit=6');
  if (result.success && result.data.length > 0) {
    const ctx = document.getElementById('genreTrendsChart');
    new Chart(ctx, {
      type: 'radar',
      data: {
        labels: result.data.map(item => item.category_name || item.name),
        datasets: [{
          label: 'Peminjaman per Kategori',
          data: result.data.map(item => item.loan_count || 0),
          borderColor: 'rgba(139, 92, 246, 1)',
          backgroundColor: 'rgba(139, 92, 246, 0.2)',
          pointBackgroundColor: 'rgba(139, 92, 246, 1)',
          pointBorderColor: '#fff',
          pointHoverBackgroundColor: '#fff',
          pointHoverBorderColor: 'rgba(139, 92, 246, 1)'
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false
          }
        },
        scales: {
          r: {
            beginAtZero: true,
            ticks: {
              stepSize: 1
            }
          }
        }
      }
    });
  }
}

// Load User Engagement Chart
async function loadUserEngagementChart() {
  const result = await fetchAPI('action=user_engagement');
  if (result.success && result.data) {
    const ctx = document.getElementById('userEngagementChart');
    const data = result.data;

    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Aktif Minggu Ini', 'Aktif Bulan Ini', 'Tidak Aktif'],
        datasets: [{
          data: [
            data.active_this_week || 0,
            data.active_this_month || 0,
            data.inactive || 0
          ],
          backgroundColor: [
            'rgba(34, 197, 94, 0.8)',
            'rgba(59, 130, 246, 0.8)',
            'rgba(156, 163, 175, 0.8)'
          ],
          borderWidth: 0
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'bottom',
            labels: {
              padding: 20,
              usePointStyle: true
            }
          }
        }
      }
    });
  }
}

// Load Books Table
let currentBooksPage = 1;
async function loadBooksTable(page = 1) {
  try {
    currentBooksPage = page;
    const result = await fetchAPI(`action=books_table&page=${page}&limit=10`);
    const tbody = document.getElementById('books-table-body');

    if (!tbody) {
      console.error('Books table body not found');
      return;
    }

    if (result.success && result.data && result.data.length > 0) {
    tbody.innerHTML = result.data.map(book => `
      <tr class="border-b border-gray-100 hover:bg-gray-50">
        <td class="py-3 px-4">${book.id}</td>
        <td class="py-3 px-4 font-semibold">${book.title}</td>
        <td class="py-3 px-4">${book.author || '-'}</td>
        <td class="py-3 px-4">${book.publisher || '-'}</td>
        <td class="py-3 px-4">
          <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">${book.category_name || 'Tanpa Kategori'}</span>
        </td>
        <td class="py-3 px-4">
          <div class="flex items-center gap-1">
            <i class="fas fa-star text-yellow-400"></i>
            <span>${book.rating || 0}</span>
          </div>
        </td>
        <td class="py-3 px-4">${(book.download_count || 0).toLocaleString('id-ID')}</td>
        <td class="py-3 px-4">
          <div class="flex gap-2">
            <button class="text-blue-600 hover:text-blue-700" title="Edit">
              <i class="fas fa-edit"></i>
            </button>
            <button class="text-red-600 hover:text-red-700" title="Hapus">
              <i class="fas fa-trash"></i>
            </button>
          </div>
        </td>
      </tr>
    `).join('');
    
    // Pagination
    const totalPages = Math.ceil(result.total / result.limit);
    const pagination = document.getElementById('books-pagination');
    if (totalPages > 1) {
      pagination.innerHTML = Array.from({ length: totalPages }, (_, i) => i + 1)
        .map(p => `
          <button onclick="loadBooksTable(${p})" 
                  class="px-4 py-2 rounded-lg ${p === page ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'}">
            ${p}
          </button>
        `).join('');
    } else {
      pagination.innerHTML = '';
    }
  } else {
    tbody.innerHTML = '<tr><td colspan="8" class="text-center py-8 text-gray-400">Tidak ada data</td></tr>';
  }
  } catch (error) {
    console.error('Error loading books table:', error);
    const tbody = document.getElementById('books-table-body');
    if (tbody) {
      tbody.innerHTML = '<tr><td colspan="8" class="text-center py-8 text-red-400"><i class="fas fa-exclamation-triangle text-2xl mb-2"></i><p>Terjadi kesalahan saat memuat data</p></td></tr>';
    }
  }
}

// Load Users Table
let currentUsersPage = 1;
async function loadUsersTable(page = 1) {
  currentUsersPage = page;
  const result = await fetchAPI(`action=users_table&page=${page}&limit=10`);
  const tbody = document.getElementById('users-table-body');
  
  if (result.success && result.data.length > 0) {
    tbody.innerHTML = result.data.map(user => `
      <tr class="border-b border-gray-100 hover:bg-gray-50">
        <td class="py-3 px-4">${user.id}</td>
        <td class="py-3 px-4 font-semibold">${user.name}</td>
        <td class="py-3 px-4">${user.email}</td>
        <td class="py-3 px-4">${user.username || '-'}</td>
        <td class="py-3 px-4">
          <span class="px-2 py-1 rounded-full text-xs font-semibold ${
            user.role === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-gray-100 text-gray-700'
          }">${user.role || 'user'}</span>
        </td>
        <td class="py-3 px-4">
          <span class="px-2 py-1 rounded-full text-xs font-semibold ${
            user.status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'
          }">${user.status || 'inactive'}</span>
        </td>
        <td class="py-3 px-4">
          <div class="flex gap-2">
            <button class="text-blue-600 hover:text-blue-700" title="Edit">
              <i class="fas fa-edit"></i>
            </button>
            <button class="text-red-600 hover:text-red-700" title="Hapus">
              <i class="fas fa-trash"></i>
            </button>
          </div>
        </td>
      </tr>
    `).join('');
    
    // Pagination
    const totalPages = Math.ceil(result.total / result.limit);
    const pagination = document.getElementById('users-pagination');
    if (totalPages > 1) {
      pagination.innerHTML = Array.from({ length: totalPages }, (_, i) => i + 1)
        .map(p => `
          <button onclick="loadUsersTable(${p})" 
                  class="px-4 py-2 rounded-lg ${p === page ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'}">
            ${p}
          </button>
        `).join('');
    } else {
      pagination.innerHTML = '';
    }
  } else {
    tbody.innerHTML = '<tr><td colspan="7" class="text-center py-8 text-gray-400">Tidak ada data</td></tr>';
  }
}

// Load Categories
async function loadCategories() {
  const result = await fetchAPI('action=categories');
  const container = document.getElementById('categories-grid');

  if (result.success && result.data.length > 0) {
    container.innerHTML = result.data.map(cat => `
      <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-6 border border-gray-200 hover:shadow-lg transition-all">
        <div class="flex items-center justify-between mb-4">
          <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-2xl text-white">
            <i class="${cat.icon || 'fas fa-tag'}"></i>
          </div>
          <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">
            ${cat.book_count || 0} buku
          </span>
        </div>
        <h4 class="text-xl font-bold text-gray-800 mb-2">${cat.name}</h4>
        <div class="flex gap-2 mt-4">
          <button class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all text-sm">
            <i class="fas fa-edit mr-1"></i>Edit
          </button>
          <button class="px-4 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-all text-sm">
            <i class="fas fa-trash"></i>
          </button>
        </div>
      </div>
    `).join('');
  } else {
    container.innerHTML = '<p class="text-center py-8 text-gray-400 col-span-full">Tidak ada data</p>';
  }
}

// Load Circulation Data
async function loadCirculationData() {
  await Promise.all([
    loadActiveLoans(),
    loadOverdueBooks(),
    loadPendingReservations(),
    loadCirculationTable()
  ]);
}

// Load Active Loans
async function loadActiveLoans() {
  const result = await fetchAPI('action=active_loans&limit=10');
  const container = document.getElementById('active-loans-list');
  const count = document.getElementById('active-loans-count');

  if (result.success && result.data.length > 0) {
    count.textContent = result.data.length;
    container.innerHTML = result.data.map(loan => `
      <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-lg">
        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-xs">
          <i class="fas fa-book"></i>
        </div>
        <div class="flex-1">
          <p class="font-semibold text-gray-800 text-sm">${loan.book_title}</p>
          <p class="text-xs text-gray-600">${loan.user_name}</p>
        </div>
        <div class="text-right">
          <p class="text-xs text-gray-500">Kembali</p>
          <p class="text-xs font-semibold text-blue-600">${new Date(loan.due_date).toLocaleDateString('id-ID')}</p>
        </div>
      </div>
    `).join('');
  } else {
    count.textContent = '0';
    container.innerHTML = '<p class="text-center py-4 text-gray-400 text-sm">Tidak ada peminjaman aktif</p>';
  }
}

// Load Overdue Books
async function loadOverdueBooks() {
  const result = await fetchAPI('action=overdue_books&limit=10');
  const container = document.getElementById('overdue-books-list');
  const count = document.getElementById('overdue-count');

  if (result.success && result.data.length > 0) {
    count.textContent = result.data.length;
    container.innerHTML = result.data.map(book => `
      <div class="flex items-center gap-3 p-3 bg-red-50 rounded-lg border border-red-200">
        <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center text-white text-xs">
          <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div class="flex-1">
          <p class="font-semibold text-gray-800 text-sm">${book.book_title}</p>
          <p class="text-xs text-gray-600">${book.user_name}</p>
        </div>
        <div class="text-right">
          <p class="text-xs text-red-600 font-semibold">Rp ${book.fine_amount?.toLocaleString('id-ID') || 0}</p>
          <p class="text-xs text-gray-500">${book.days_overdue || 0} hari</p>
        </div>
      </div>
    `).join('');
  } else {
    count.textContent = '0';
    container.innerHTML = '<p class="text-center py-4 text-gray-400 text-sm">Tidak ada buku terlambat</p>';
  }
}

// Load Pending Reservations
async function loadPendingReservations() {
  const result = await fetchAPI('action=pending_reservations&limit=10');
  const container = document.getElementById('pending-reservations-list');
  const count = document.getElementById('pending-reservations-count');

  if (result.success && result.data.length > 0) {
    count.textContent = result.data.length;
    container.innerHTML = result.data.map(reservation => `
      <div class="flex items-center gap-3 p-3 bg-yellow-50 rounded-lg">
        <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center text-white text-xs">
          <i class="fas fa-clock"></i>
        </div>
        <div class="flex-1">
          <p class="font-semibold text-gray-800 text-sm">${reservation.book_title}</p>
          <p class="text-xs text-gray-600">${reservation.user_name}</p>
        </div>
        <div class="text-right">
          <p class="text-xs text-gray-500">Requested</p>
          <p class="text-xs font-semibold text-yellow-600">${new Date(reservation.request_date).toLocaleDateString('id-ID')}</p>
        </div>
      </div>
    `).join('');
  } else {
    count.textContent = '0';
    container.innerHTML = '<p class="text-center py-4 text-gray-400 text-sm">Tidak ada reservasi pending</p>';
  }
}

// Load Circulation Table
let currentCirculationPage = 1;
async function loadCirculationTable(page = 1) {
  currentCirculationPage = page;
  const result = await fetchAPI(`action=circulation_table&page=${page}&limit=15`);
  const tbody = document.getElementById('circulation-table-body');

  if (result.success && result.data.length > 0) {
    tbody.innerHTML = result.data.map(item => `
      <tr class="border-b border-gray-100 hover:bg-gray-50">
        <td class="py-3 px-4">${item.id}</td>
        <td class="py-3 px-4 font-semibold">${item.user_name}</td>
        <td class="py-3 px-4">${item.book_title}</td>
        <td class="py-3 px-4">${new Date(item.loan_date).toLocaleDateString('id-ID')}</td>
        <td class="py-3 px-4">${item.return_date ? new Date(item.return_date).toLocaleDateString('id-ID') : '-'}</td>
        <td class="py-3 px-4">
          <span class="px-2 py-1 rounded-full text-xs font-semibold ${
            item.status === 'active' ? 'bg-blue-100 text-blue-700' :
            item.status === 'returned' ? 'bg-green-100 text-green-700' :
            item.status === 'overdue' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-700'
          }">${item.status || 'unknown'}</span>
        </td>
        <td class="py-3 px-4">Rp ${(item.fine_amount || 0).toLocaleString('id-ID')}</td>
        <td class="py-3 px-4">
          <div class="flex gap-2">
            ${item.status === 'active' ?
              `<button onclick="processReturn(${item.id})" class="text-green-600 hover:text-green-700 text-sm" title="Proses Pengembalian">
                <i class="fas fa-check"></i>
              </button>` : ''
            }
            <button class="text-blue-600 hover:text-blue-700 text-sm" title="Detail">
              <i class="fas fa-eye"></i>
            </button>
          </div>
        </td>
      </tr>
    `).join('');

    // Pagination
    const totalPages = Math.ceil(result.total / result.limit);
    const pagination = document.getElementById('circulation-pagination');
    if (totalPages > 1) {
      pagination.innerHTML = Array.from({ length: totalPages }, (_, i) => i + 1)
        .map(p => `
          <button onclick="loadCirculationTable(${p})"
                  class="px-4 py-2 rounded-lg ${p === page ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'}">
            ${p}
          </button>
        `).join('');
    } else {
      pagination.innerHTML = '';
    }
  } else {
    tbody.innerHTML = '<tr><td colspan="8" class="text-center py-8 text-gray-400">Tidak ada data sirkulasi</td></tr>';
  }
}

// Circulation Modal Functions
function showCirculationModal(type) {
  // This would open a modal for checkout or return operations
  alert(`${type === 'checkout' ? 'Peminjaman' : 'Pengembalian'} - Fitur ini akan diimplementasikan`);
}

function processReturn(loanId) {
  if (confirm('Apakah Anda yakin ingin memproses pengembalian buku ini?')) {
    // This would process the return
    alert('Pengembalian berhasil diproses');
    loadCirculationData();
  }
}

// Events & Announcements Functions
let currentCalendarDate = new Date();

async function loadEventsData() {
  await Promise.all([
    loadUpcomingEvents(),
    loadAnnouncements(),
    renderCalendar()
  ]);
}

async function loadUpcomingEvents() {
  const result = await fetchAPI('action=upcoming_events&limit=5');
  const container = document.getElementById('upcoming-events');

  if (result.success && result.data.length > 0) {
    container.innerHTML = result.data.map(event => `
      <div class="flex items-start gap-3 p-3 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg border border-blue-100">
        <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center text-white flex-shrink-0">
          <i class="fas fa-calendar-day text-sm"></i>
        </div>
        <div class="flex-1">
          <h4 class="font-semibold text-gray-800 text-sm">${event.title}</h4>
          <p class="text-xs text-gray-600 mt-1">${event.description}</p>
          <div class="flex items-center gap-2 mt-2">
            <i class="fas fa-clock text-blue-500 text-xs"></i>
            <span class="text-xs text-blue-600">${new Date(event.event_date).toLocaleDateString('id-ID', {
              weekday: 'long',
              year: 'numeric',
              month: 'long',
              day: 'numeric'
            })}</span>
          </div>
        </div>
      </div>
    `).join('');
  } else {
    container.innerHTML = '<p class="text-center py-4 text-gray-400 text-sm">Tidak ada acara mendatang</p>';
  }
}

async function loadAnnouncements() {
  const result = await fetchAPI('action=announcements&limit=5');
  const container = document.getElementById('announcements-list');

  if (result.success && result.data.length > 0) {
    container.innerHTML = result.data.map(announcement => `
      <div class="p-3 bg-gradient-to-r from-yellow-50 to-orange-50 rounded-lg border border-yellow-100">
        <div class="flex items-start gap-3">
          <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center text-white flex-shrink-0 mt-0.5">
            <i class="fas fa-bullhorn text-xs"></i>
          </div>
          <div class="flex-1">
            <h4 class="font-semibold text-gray-800 text-sm">${announcement.title}</h4>
            <p class="text-xs text-gray-600 mt-1">${announcement.content}</p>
            <p class="text-xs text-gray-500 mt-2">${new Date(announcement.created_at).toLocaleDateString('id-ID')}</p>
          </div>
        </div>
      </div>
    `).join('');
  } else {
    container.innerHTML = '<p class="text-center py-4 text-gray-400 text-sm">Tidak ada pengumuman</p>';
  }
}

function renderCalendar() {
  const calendarGrid = document.getElementById('calendar-grid');
  const monthYearDisplay = document.getElementById('calendar-month-year');

  // Update month/year display
  monthYearDisplay.textContent = currentCalendarDate.toLocaleDateString('id-ID', {
    month: 'long',
    year: 'numeric'
  });

  const year = currentCalendarDate.getFullYear();
  const month = currentCalendarDate.getMonth();

  // Get first day of month and last day of month
  const firstDay = new Date(year, month, 1);
  const lastDay = new Date(year, month + 1, 0);
  const startDate = new Date(firstDay);
  startDate.setDate(startDate.getDate() - firstDay.getDay());

  const endDate = new Date(lastDay);
  endDate.setDate(endDate.getDate() + (6 - lastDay.getDay()));

  let calendarHTML = '';
  let currentDate = new Date(startDate);

  while (currentDate <= endDate) {
    const isCurrentMonth = currentDate.getMonth() === month;
    const isToday = currentDate.toDateString() === new Date().toDateString();
    const dayClass = `p-3 text-center text-sm rounded-lg cursor-pointer hover:bg-blue-50 transition-all ${
      isCurrentMonth ? 'text-gray-900' : 'text-gray-400'
    } ${isToday ? 'bg-blue-500 text-white hover:bg-blue-600' : ''}`;

    calendarHTML += `<div class="${dayClass}" onclick="selectDate('${currentDate.toISOString().split('T')[0]}')">
      ${currentDate.getDate()}
    </div>`;

    currentDate.setDate(currentDate.getDate() + 1);
  }

  calendarGrid.innerHTML = calendarHTML;
}

function changeMonth(direction) {
  currentCalendarDate.setMonth(currentCalendarDate.getMonth() + direction);
  renderCalendar();
}

function selectDate(dateString) {
  // This would show events for selected date
  console.log('Selected date:', dateString);
}

function showEventModal() {
  alert('Modal untuk menambah acara - Fitur ini akan diimplementasikan');
}

function showAnnouncementModal() {
  alert('Modal untuk menambah pengumuman - Fitur ini akan diimplementasikan');
}

// Navigate to home page
function goToHomePage() {
  window.location.href = 'index.html';
}

// Initialize Dashboard
document.addEventListener('DOMContentLoaded', async () => {
  try {
    // Load critical data first
    await Promise.all([
      loadNotifications(),
      loadDashboardStats()
    ]);

    // Load chart and recent activity
    await Promise.all([
      loadReadingTrendsChart(),
      loadRecentActivity()
    ]);

  } catch (error) {
    console.error('Error loading dashboard:', error);
  }
});
</script>

</body>
</html>

