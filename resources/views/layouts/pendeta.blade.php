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

    
</head>
<body style="background:#f5f5f5">

<div class="d-flex">
    
    {{-- SIDEBAR --}}
    <aside class="admin-sidebar p-3">
        <div class="text-center mb-4">
            <div class="logo-circle mb-2">Logo</div>
            <strong>Gereja Bethania</strong><br>
            <small>Dashboard Pendeta</small>
        </div>

        <ul class="nav flex-column gap-2">
            <li><a href="/pendeta/dashboard" class="nav-link active" title="Dashboard">📊 Dashboard</a></li>
            <li><a href="/pendeta/pengumuman" class="nav-link" title="Pengumuman">📢 Pengumuman</a></li>
            <li><a href="/pendeta/keuangan" class="nav-link" title="Keuangan">💰 Keuangan</a></li>
            
            <li>
                <a href="{{ route('logout') }}"
                   class="nav-link text-danger"
                   title="Logout"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   🚪 Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
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
  });
</script>

</body>
</html>
