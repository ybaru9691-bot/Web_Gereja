<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $warta->judul }}</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            color: #333;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #588157;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #3a5a40;
        }
        .date {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }
        .content {
            margin-bottom: 30px;
            text-align: justify;
        }
        .photos {
            text-align: center;
        }
        .photo-item {
            margin-bottom: 20px;
            page-break-inside: avoid;
        }
        .photo-item img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #999;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">{{ $warta->judul }}</div>
        <div class="date">{{ \Carbon\Carbon::parse($warta->tanggal)->translatedFormat('l, d F Y') }}</div>
    </div>

    <div class="content">
        {!! nl2br(e($warta->isi_warta)) !!}
    </div>

    <div class="photos">
        @foreach($warta->fotos as $foto)
            <div class="photo-item">
                {{-- Use base64 encoding for images in PDF to avoid path issues --}}
                <img src="data:image/{{ pathinfo($foto->nama_file, PATHINFO_EXTENSION) }};base64,{{ base64_encode(file_get_contents(storage_path('app/public/' . $foto->nama_file))) }}">
            </div>
        @endforeach
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} Gereja Bethania - Warta Jemaat Digital
    </div>
</body>
</html>
