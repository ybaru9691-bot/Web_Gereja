<nav class="navbar navbar-expand-lg navbar-dark p-3 shadow">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('images/Logo HKBP.png') }}" alt="Logo Gereja" height="40" class="me-2">
            <span>Gereja Bethania</span>
        </a>

        <button class="navbar-toggler" type="button" id="navbarToggler">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('warta.*') ? 'active' : '' }}" href="{{ route('warta.index') }}">Warta Jemaat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('jadwal') ? 'active' : '' }}" href="{{ route('jadwal') }}">Jadwal Ibadah</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('pengumuman') ? 'active' : '' }}" href="{{ route('pengumuman') }}">Pengumuman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}" href="{{ route('tentang') }}">Tentang Gereja</a>
                </li>
            </ul>

            <a href="{{ route('login') }}" class="btn btn-login px-4">
                Login
            </a>
        </div>
    </div>
</nav>

<style>
/* NAVBAR STYLING */
.navbar {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    backdrop-filter: blur(10px);
    position: sticky;
    top: 0;
    z-index: 1000;
}

.navbar-brand {
    font-size: 1.4rem;
    color: white !important;
    transition: transform 0.3s ease;
}

.navbar-brand:hover {
    transform: scale(1.05);
}

.logo-icon {
    font-size: 1.8rem;
}

/* NAV LINKS */
.nav-link {
    color: rgba(255, 255, 255, 0.9) !important;
    font-weight: 500;
    padding: 8px 16px !important;
    margin: 0 5px;
    border-radius: 8px;
    transition: all 0.3s ease;
    position: relative;
}

.nav-link:hover {
    background-color: rgba(255, 255, 255, 0.15);
    color: white !important;
    transform: translateY(-2px);
}

.nav-link.active {
    background-color: rgba(255, 255, 255, 0.25);
    color: white !important;
    font-weight: 600;
}

.nav-link.active::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 30px;
    height: 3px;
    background-color: white;
    border-radius: 2px;
}

/* LOGIN BUTTON */
.btn-login {
    background-color: white;
    color: #667eea;
    border: 2px solid white;
    font-weight: 600;
    border-radius: 25px;
    transition: all 0.3s ease;
    padding: 8px 24px !important;
}

.btn-login:hover {
    background-color: transparent;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

/* NAVBAR TOGGLER */
.navbar-toggler {
    border: 2px solid rgba(255, 255, 255, 0.8);
    padding: 8px 12px;
}

.navbar-toggler:focus {
    box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.3);
    outline: none;
}

.navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    width: 1.5em;
    height: 1.5em;
}

/* NAVBAR COLLAPSE ANIMATION */
.navbar-collapse {
    transition: height 0.3s ease-in-out;
}

.navbar-collapse.collapsing {
    transition: height 0.3s ease;
}

/* RESPONSIVE */
@media (max-width: 991px) {
    .navbar-nav {
        margin-top: 1rem;
        padding: 1rem 0;
    }
    
    .nav-link {
        margin: 5px 0;
        padding: 12px 16px !important;
    }
    
    .btn-login {
        margin-top: 1rem;
        width: 100%;
    }
    
    .nav-link.active::after {
        display: none;
    }

    #navbarMenu {
        background: rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        padding: 10px;
        margin-top: 10px;
    }
}

/* NAVBAR SHADOW */
.navbar.shadow {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggler = document.getElementById('navbarToggler');
    const navbarMenu = document.getElementById('navbarMenu');
    
    if (toggler && navbarMenu) {
        toggler.addEventListener('click', function() {
            // Toggle class 'show' untuk menampilkan/menyembunyikan menu
            if (navbarMenu.classList.contains('show')) {
                navbarMenu.classList.remove('show');
                toggler.setAttribute('aria-expanded', 'false');
            } else {
                navbarMenu.classList.add('show');
                toggler.setAttribute('aria-expanded', 'true');
            }
        });

        // Tutup menu saat klik di luar navbar
        document.addEventListener('click', function(event) {
            const isClickInsideNavbar = toggler.contains(event.target) || navbarMenu.contains(event.target);
            
            if (!isClickInsideNavbar && navbarMenu.classList.contains('show')) {
                navbarMenu.classList.remove('show');
                toggler.setAttribute('aria-expanded', 'false');
            }
        });

        // Tutup menu saat link diklik (untuk mobile)
        const navLinks = navbarMenu.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 992) {
                    navbarMenu.classList.remove('show');
                    toggler.setAttribute('aria-expanded', 'false');
                }
            });
        });
    }
});
</script> 