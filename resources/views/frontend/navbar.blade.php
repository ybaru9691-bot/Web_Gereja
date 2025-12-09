<nav class="navbar navbar-expand-lg navbar-light bg-light p-3 shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold">Logo Gereja</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Warta Jemaat</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Jadwal Ibadah</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Pengumuman</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Tentang Gereja</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
            </ul>

            <a href="{{ route('login') }}" class="btn btn-primary px-4">Login</a>
        </div>
    </div>
</nav>
