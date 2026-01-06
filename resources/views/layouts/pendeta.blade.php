<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pendeta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Dubai Font --}}
    <link href="https://fonts.cdnfonts.com/css/dubai" rel="stylesheet">


    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Sidebar Styles --}}
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">

    {{-- Pendeta Dashboard Styles --}}
    <link rel="stylesheet" href="{{ asset('css/pendeta/pendeta.css') }}">

    <!-- Font Awesome for icons -->
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    
</head>
<body style="background:#f5f5f5" x-data="{ sidebarOpen: false }">

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
        class="pendeta-sidebar p-3"
        :class="{ 'show': sidebarOpen }"
    >
        <div class="text-center mb-4">
            <div class="profile-section">
                <div class="logo-circle mb-3 mx-auto">
                    <img src="{{ asset('images/Logo HKBP.png') }}" alt="Logo HKBP" class="img-fluid rounded-circle">
                </div>
                <h5 class="fw-bold text-white mb-1">Gereja Bethania</h5>
                <small class="text-white-50">Dashboard Pendeta</small>
            </div>
        </div>

        <ul class="nav flex-column gap-2">
            <li>
                <a href="/pendeta/dashboard" class="nav-link {{ request()->is('pendeta/dashboard') ? 'active' : '' }}" title="Dashboard">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/pendeta/pengumuman" class="nav-link {{ request()->is('pendeta/pengumuman*') ? 'active' : '' }}" title="Pengumuman">
                    <i class="bi bi-megaphone"></i>
                    <span>Pengumuman</span>
                </a>
            </li>
            <li>
                <a href="/pendeta/keuangan" class="nav-link {{ request()->is('pendeta/keuangan*') ? 'active' : '' }}" title="Keuangan">
                    <i class="bi bi-cash-coin"></i>
                    <span>Keuangan</span>
                </a>
            </li>
            <li>
                <a href="/pendeta/analisis" class="nav-link {{ request()->is('pendeta/analisis*') ? 'active' : '' }}" title="Analisis">
                    <i class="bi bi-graph-up"></i>
                    <span>Analisis</span>
                </a>
            </li>
            
            <li class="mt-auto pt-3" style="border-top: 1px solid rgba(255, 255, 255, 0.06);">
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link text-danger p-0 w-100 text-start" style="text-decoration:none;">
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
<script>
  document.addEventListener('alpine:init', () => {
    // Sidebar logic is handled via x-data on body and :class on aside
  });
  
  // Add pulse animation to items if needed
  document.addEventListener('DOMContentLoaded', () => {
    // any extra DOM manipulations
  });
</script>

</body>
</html>
