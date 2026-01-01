<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Gereja</title>
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
    <style>
        .nav-link.active {
            background-color: #2E42F0;
            color: #fff !important;
            border-radius: 20px;
            padding: 6px 15px;
        }
        .hero {
            background-color: #ececec;
            padding: 50px 20px;
        }
        .section-box {
            background-color: #f6f2f2;
            padding: 20px;
            border-radius: 12px;        
            text-align: center;
        }
        footer {
            background: #ddd;
            padding: 20px 0;
        }
    </style>
</head>
<body>

    @include('frontend.navbar')

    <main>
        @yield('content')
    </main>

    <footer class="text-center mt-5">
        <p>2025 Gereja, hak cipta dilindungi oleh rafael wkwkwwk</p>
    </footer>

</body>
</html>
