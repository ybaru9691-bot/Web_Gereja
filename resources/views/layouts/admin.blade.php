<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
            <div class="logo-circle mb-2">Logo</div>
            <strong>Gereja Bethania</strong><br>
            <small>Dashboard Admin</small>
        </div>

        <ul class="nav flex-column gap-2">
            <li><a href="/admin/dashboard" class="nav-link active">Dashboard</a></li>
            <li><a href="/admin/jemaat" class="nav-link">Data Jemaat</a></li>
            <li><a href="/admin/warta" class="nav-link">Warta Jemaat</a></li>
            <li><a href="/admin/jadwal-ibadah" class="nav-link">Jadwal Ibadah</a></li>
            <li><a href="#" class="nav-link">Scan Log</a></li>
            <li><a href="#" class="nav-link">Analisis Jemaat</a></li>
            <li><a href="#" class="nav-link">Keuangan</a></li>
            <li class="mt-3">
                <a href="{{ route('logout') }}" class="nav-link text-danger">Logout</a>
            </li>
        </ul>
    </aside>

    {{-- CONTENT --}}
    <main class="flex-fill p-4">
        @yield('content')
    </main>

</div>

</body>
</html>
