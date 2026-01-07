<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Gereja</title>
    {{-- Dubai Font --}}
    <link href="https://fonts.cdnfonts.com/css/dubai" rel="stylesheet">

      <link rel="stylesheet" href="{{ asset('css/jemaat/home.css') }}">
        <link rel="stylesheet" href="{{ asset('css/jemaat/warta.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jemaat/jadwal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jemaat/pengumuman.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jemaat/tentang.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jemaat/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jemaat/warta-show.css') }}">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">

</head>
<body>

    @include('frontend.navbar')

    <main>
        @yield('content')
    </main>

    <footer class="text-center mt-5">
        <p>2025 Gereja, hak cipta dilindungi </p>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
