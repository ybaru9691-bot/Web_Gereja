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
                    <a class="nav-link {{ request()->routeIs('home') && !request()->has('anchor') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#warta">Warta Jemaat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#jadwal">Jadwal Ibadah</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#pengumuman">Pengumuman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#tentang">Tentang Gereja</a>
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
    background: linear-gradient(135deg, #52796F 0%, #2F3E46 100%) !important;
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
    font-size: 1.1rem;
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
    color: #52796F;
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

        const navLinks = navbarMenu.querySelectorAll('.nav-link');

        // Manual smooth scroll function
        function smoothScroll(targetId, duration) {
            const target = document.getElementById(targetId);
            if (!target) return;

            const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - 80; // offset for navbar
            const startPosition = window.pageYOffset;
            const distance = targetPosition - startPosition;
            let startTime = null;

            function animation(currentTime) {
                if (startTime === null) startTime = currentTime;
                const timeElapsed = currentTime - startTime;
                const run = ease(timeElapsed, startPosition, distance, duration);
                window.scrollTo(0, run);
                if (timeElapsed < duration) requestAnimationFrame(animation);
            }

            // Quadratic easing in/out
            function ease(t, b, c, d) {
                t /= d / 2;
                if (t < 1) return c / 2 * t * t + b;
                t--;
                return -c / 2 * (t * (t - 2) - 1) + b;
            }

            requestAnimationFrame(animation);
        }

        // Global Smooth Scroll for all anchor links
        document.querySelectorAll('a[href^="#"], a[href*="#"]').forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (!href || href === '#') return;

                const urlParts = href.split('#');
                const targetId = urlParts[1];
                if (!targetId) return;

                const currentPath = window.location.pathname.replace(/\/$/, '');
                const targetPath = urlParts[0].replace(window.location.origin, '').replace(/\/$/, '');

                // Only smooth scroll if on the same page
                if (targetPath === '' || targetPath === currentPath) {
                    const targetElement = document.getElementById(targetId);
                    if (targetElement) {
                        e.preventDefault();
                        
                        // Using manual animation for maximum smoothness
                        smoothScroll(targetId, 500); // 500ms for faster feel

                        // Update active state in navbar if applicable
                        navLinks.forEach(l => {
                            l.classList.remove('active');
                            if (l.getAttribute('href').includes('#' + targetId)) {
                                l.classList.add('active');
                            }
                        });

                        // Close mobile menu if clicked from navbar
                        if (window.innerWidth < 992 && this.classList.contains('nav-link')) {
                            navbarMenu.classList.remove('show');
                            toggler.setAttribute('aria-expanded', 'false');
                        }
                    }
                } else {
                    // Regular link to another page - still close menu on mobile
                    if (window.innerWidth < 992 && this.classList.contains('nav-link')) {
                        navbarMenu.classList.remove('show');
                        toggler.setAttribute('aria-expanded', 'false');
                    }
                }
            });
        });

        // ScrollSpy logic
        const sections = ['warta', 'jadwal', 'pengumuman', 'tentang'];
        window.addEventListener('scroll', function() {
            let current = '';
            
            // Check if we are at the top
            if (window.scrollY < 100) {
                current = 'home';
            } else {
                sections.forEach(section => {
                    const element = document.getElementById(section);
                    if (element) {
                        const sectionTop = element.offsetTop;
                        const sectionHeight = element.clientHeight;
                        if (window.scrollY >= (sectionTop - 150)) {
                            current = section;
                        }
                    }
                });
            }

            navLinks.forEach(link => {
                link.classList.remove('active');
                const href = link.getAttribute('href');
                if (current === 'home' && (href === '{{ route("home") }}' || href === '/')) {
                    link.classList.add('active');
                } else if (current !== '' && href.includes('#' + current)) {
                    link.classList.add('active');
                }
            });
        });
    }
});
</script> 