<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
    
</head>
<body style="background:#f5f5f5">

<div class="d-flex">
    
    {{-- SIDEBAR --}}
    <aside class="admin-sidebar p-3">
        <div class="text-center mb-4">
            <img src="{{ asset('images/Logo HKBP.png') }}"
                 alt="Logo"
                 class="mb-2"
                 style="width: 5rem; height: 5rem; object-fit: contain;">
            <strong>Gereja Bethania</strong><br>
            <small>Dashboard Admin</small>
        </div>

        <ul class="nav flex-column gap-2">


            <li>
                <a href="/admin/dashboard" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/admin/jemaat" class="nav-link {{ request()->is('admin/jemaat*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i>
                    <span>Data Jemaat</span>
                </a>
            </li>
            <li>
                <a href="/admin/warta" class="nav-link {{ request()->is('admin/warta*') ? 'active' : '' }}">
                    <i class="bi bi-newspaper"></i>
                    <span>Warta Jemaat</span>
                </a>
            </li>
            <li>
                <a href="/admin/jadwal-ibadah" class="nav-link {{ request()->is('admin/jadwal-ibadah*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-event"></i>
                    <span>Jadwal Ibadah</span>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link">
                    <i class="bi bi-qr-code-scan"></i>
                    <span>Scan Log</span>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link">
                    <i class="bi bi-graph-up-arrow"></i>
                    <span>Analisis Jemaat</span>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link">
                    <i class="bi bi-cash-coin"></i>
                    <span>Keuangan</span>
                </a>
            </li>
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
<script>
  document.addEventListener('alpine:init', () => {
    Alpine.data('sidebarMenu', () => ({
      hovering: false,
      activeLink: '',
      init() {
        const links = this.$el.querySelectorAll('.nav-link');
        

          
          // Hover tracking
          link.addEventListener('mouseenter', () => { this.hovering = true; });
          link.addEventListener('mouseleave', () => { this.hovering = false; });
          
          // Click animation
          link.addEventListener('click', (e) => {
            // Remove active from all, add to clicked
            links.forEach(l => l.classList.remove('active'));
            link.classList.add('active');
          });
        });
      }
    }));
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

</body>
</html>
