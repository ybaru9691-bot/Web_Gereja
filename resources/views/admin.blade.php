<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- CSS Admin --}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body style="background:#f4f6f9">

<div class="d-flex">

    {{-- SIDEBAR --}}
    <aside class="bg-dark text-white p-3" style="width:250px; min-height:100vh;">
        <h5 class="text-center mb-4">Gereja Bethania</h5>

        <ul class="nav flex-column gap-2">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#" class="nav-link text-white">Data Jemaat</a>
            </li>
            <li>
                <a href="#" class="nav-link text-white">Warta Jemaat</a>
            </li>
            <li>
                <a href="#" class="nav-link text-white">Jadwal Ibadah</a>
            </li>
            <li>
                <a href="#" class="nav-link text-white">Scan Log</a>
            </li>

            <hr class="text-secondary">

            <li>
                <a href="{{ route('logout') }}"
                   class="nav-link text-danger"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
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

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
