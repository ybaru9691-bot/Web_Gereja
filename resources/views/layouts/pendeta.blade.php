<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pendeta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Sidebar Styles --}}
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">

    {{-- Pendeta Dashboard Styles --}}
    <link rel="stylesheet" href="{{ asset('css/pendeta/dashboard.css') }}">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    
</head>
<body style="background:#f5f5f5">

<div class="d-flex">
    
    {{-- SIDEBAR --}}
    <aside class="pendeta-sidebar p-3">
        <div class="text-center mb-4">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="logo-circle mb-2"><i class="fas fa-church"></i></div>
                    <strong>Gereja Bethania</strong><br>
                    <small>Dashboard Pendeta</small>
                </div>
                <button id="pendetaSidebarClose" class="btn btn-sm btn-outline-light d-lg-none pendeta-close"><i class="fas fa-times"></i></button>
            </div>
        </div>

        <ul class="nav flex-column gap-2">
            <li><a href="/pendeta/dashboard" class="nav-link active" title="Dashboard"><i class="fas fa-chart-pie me-2"></i>Dashboard</a></li>
            <li><a href="/pendeta/pengumuman" class="nav-link" title="Pengumuman"><i class="fas fa-bullhorn me-2"></i>Pengumuman</a></li>
            <li><a href="/pendeta/keuangan" class="nav-link" title="Keuangan"><i class="fas fa-wallet me-2"></i>Keuangan</a></li>
            
            <li class="mt-auto pt-3" style="border-top: 1px solid rgba(255, 255, 255, 0.06);">
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link text-danger p-0 w-100 text-start" style="text-decoration:none;">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </aside>

    {{-- Overlay for mobile sidebar --}}
    <div id="pendeta-overlay" class="sidebar-overlay"></div>

    {{-- CONTENT --}}
    <main class="flex-fill p-4">
        <!-- Mobile: sidebar toggle button -->
        <button id="pendetaSidebarToggle" class="btn btn-outline-secondary d-lg-none mb-3">
            <i class="fas fa-bars"></i>
        </button>

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
        
        // Track active link
        const currentPath = window.location.pathname;
        links.forEach(link => {
          const href = link.getAttribute('href');
          if (href && currentPath.includes(href)) {
            link.classList.add('active');
          }
          
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
      if (index === 1) { // Pengumuman as example
        // Uncomment to enable pulse: link.classList.add('pulse');
      }
    });

    // Mobile sidebar toggle
    const toggle = document.getElementById('pendetaSidebarToggle');
    const sidebar = document.querySelector('.pendeta-sidebar');
    const overlay = document.getElementById('pendeta-overlay');

    function openSidebar(){
      sidebar.classList.add('active');
      overlay.classList.add('active');
      document.body.classList.add('no-scroll');
    }

    function closeSidebar(){
      sidebar.classList.remove('active');
      overlay.classList.remove('active');
      document.body.classList.remove('no-scroll');
    }

    if (toggle && sidebar && overlay){
      // Ensure sidebar is closed initially on small screens
      if (window.innerWidth <= 991) closeSidebar();

      toggle.addEventListener('click', (e) => { e.stopPropagation(); openSidebar(); });
      overlay.addEventListener('click', closeSidebar);

      // Close button inside sidebar (mobile)
      const closeBtn = document.getElementById('pendetaSidebarClose');
      if (closeBtn) closeBtn.addEventListener('click', closeSidebar);

      // Close on escape
      document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeSidebar(); });

      // Close/open on resize if crossing breakpoint
      let lastWidth = window.innerWidth;
      window.addEventListener('resize', () => {
        const w = window.innerWidth;
        if ((lastWidth > 991 && w <= 991)) {
          // entered mobile size
          closeSidebar();
        }
        lastWidth = w;
      });
    }
  });
</script>

</body>
</html>
