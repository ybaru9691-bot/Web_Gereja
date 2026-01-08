<!DOCTYPE html>
<html>
<head>
    <title>Laporan Analisis Jemaat - {{ $periode }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #444; padding-bottom: 10px; }
        .title { font-size: 18px; font-weight: bold; text-transform: uppercase; }
        .info { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { bg-color: #f2f2f2; }
        .summary { margin-top: 30px; }
        .badge { padding: 3px 8px; border-radius: 10px; font-size: 10px; color: #fff; }
        .bg-success { background-color: #28a745; }
        .bg-warning { background-color: #ffc107; color: #000; }
        .bg-danger { background-color: #dc3545; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: right; font-size: 10px; color: #777; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Laporan Analisis Keaktifan Jemaat</div>
        <div>GKII EMANUEL - Periode {{ $periode }}</div>
    </div>

    <div class="info">
        <p><strong>Tanggal Cetak:</strong> {{ $date }}</p>
        <p><strong>Ringkasan Klaster:</strong></p>
        <ul>
            <li>Aktif: {{ $clusters['Aktif'] ?? 0 }} Jemaat</li>
            <li>Sedang: {{ $clusters['Sedang'] ?? 0 }} Jemaat</li>
            <li>Pasif: {{ $clusters['Pasif'] ?? 0 }} Jemaat</li>
        </ul>
    </div>

    <table>
        <thead>
            <tr>
                <th>Guest UUID</th>
                <th>Freq</th>
                <th>Lateness</th>
                <th>Duration</th>
                <th>Klaster</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td>{{ $row->guest_uuid }}</td>
                <td>{{ $row->score_f }}x</td>
                <td>{{ $row->score_r }}x</td>
                <td>{{ $row->score_d }}m</td>
                <td>{{ $row->cluster_label }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak secara otomatis oleh Sistem Informasi Web Gereja
    </div>
</body>
</html>
