<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Dubai Font --}}
    <link href="https://fonts.cdnfonts.com/css/dubai" rel="stylesheet">


    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Sidebar Styles --}}
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">

    {{-- CSS Admin --}}
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/data.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/tambah.css') }}">
      <link rel="stylesheet" href="{{ asset('css/admin/warta.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/hints.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/analisis.css') }}">
    
    {{-- Flatpickr --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
</head>
<body style="background:#f0f4f2" x-data="{ sidebarOpen: false }">

<div class="d-flex">
    {{-- BACKDROP (Mobile Only) --}}
    <div 
        class="sidebar-overlay" 
        x-show="sidebarOpen" 
        @click="sidebarOpen = false"
        x-transition:opacity
    ></div>

    {{-- BURGER BUTTON (Mobile Only) --}}
    <button 
        class="mobile-toggle-btn d-md-none" 
        @click="sidebarOpen = !sidebarOpen"
    >
        <i class="bi bi-list"></i>
    </button>
    
    {{-- SIDEBAR --}}
    <aside 
        class="admin-sidebar p-3" 
        :class="{ 'show': sidebarOpen }"
    >
        <div class="text-center mb-4">
            <div class="profile-section">
                <div class="logo-circle mb-3 mx-auto">
                    <img src="{{ asset('images/Logo HKBP.png') }}" alt="Logo HKBP" class="img-fluid rounded-circle">
                </div>
                <h5 class="fw-bold mb-1">Gereja Bethania</h5>
                <small class="text-muted">Dashboard Admin</small>
            </div>
        </div>

        <ul class="nav flex-column gap-2">


            <li><a href="/admin/dashboard" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">Dashboard</a></li>
            <li><a href="/admin/jemaat" class="nav-link {{ request()->is('admin/jemaat*') ? 'active' : '' }}">Data Jemaat</a></li>
            <li><a href="/admin/warta" class="nav-link {{ request()->is('admin/warta*') ? 'active' : '' }}">Warta Jemaat</a></li>
            <li><a href="/admin/jadwal-ibadah" class="nav-link {{ request()->is('admin/jadwal-ibadah*') ? 'active' : '' }}">Jadwal Ibadah</a></li>
            <li><a href="/admin/scan" class="nav-link {{ request()->is('admin/scan*') ? 'active' : '' }}">Scan Log</a></li>
            <li><a href="/admin/analisis" class="nav-link {{ request()->is('admin/analisis*') ? 'active' : '' }}">Analisis Jemaat</a></li>
            <li><a href="/admin/keuangan" class="nav-link {{ request()->is('admin/keuangan*') ? 'active' : '' }}">Keuangan</a></li>
            <li class="mt-3">
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link text-danger p-0 w-100 text-start d-flex align-items-center gap-2" style="text-decoration:none;">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </aside>

    {{-- CONTENT --}}
    <main class="flex-fill p-4">
        @yield('content')
    </main>

</div>

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
  // Placeholder for any sidebar initialization if needed
  document.addEventListener('alpine:init', () => {
    // Sidebar logic is handled via x-data on body and :class on aside
  });
  
  // Add pulse animation to new/updated menu items
  document.addEventListener('DOMContentLoaded', () => {
    const menuLinks = document.querySelectorAll('.nav-link');
    menuLinks.forEach((link, index) => {
      if (index === 0 || index === 2) { // Dashboard and Warta as examples
        // Uncomment to enable pulse: link.classList.add('pulse');
      }
    });
  });
</script>

@yield('scripts')

</body>
</html>
