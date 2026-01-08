@extends('layouts.pendeta')

@section('content')

<h3 class="fw-bold mb-4">Ringkasan Pelayanan</h3>

{{-- KARTU STATISTIK --}}
<div class="row g-3 mb-4">

    <div class="col-md-3">
        <div class="bg-white p-3 rounded shadow-sm">
            <small>Jumlah Jemaat</small>
            <h4 class="fw-bold">{{ $jemaatCount ?? 0 }}</h4>
            <span class="badge bg-success">Aktif</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="bg-white p-3 rounded shadow-sm">
            <small>Jumlah Warta</small>
            <h4 class="fw-bold">{{ $wartaCount ?? 0 }}</h4>
            <span class="badge bg-warning text-dark">Semua waktu</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="bg-white p-3 rounded shadow-sm">
            <small>Scan Mingguan</small>
            <h4 class="fw-bold">{{ $weeklyScanCount ?? 0 }}</h4>
            <span class="badge bg-primary">QR Code</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="bg-white p-3 rounded shadow-sm">
            <small>Jumlah Pengumuman</small>
            <h4 class="fw-bold">{{ $pengumumanCount ?? 0 }}</h4>
            <span class="badge bg-info text-dark">Total</span>
        </div>
    </div>

</div>

{{-- AKTIVITAS & RINGKASAN --}}
<div class="row g-4">

    {{-- AKTIVITAS --}}
    <div class="col-md-8">
        <div class="bg-white p-4 rounded shadow-sm">
            <h5 class="fw-bold mb-3">Aktivitas Jemaat</h5>

            <p class="text-muted">
                Perbandingan scan kehadiran per hari dalam minggu berjalan
            </p>

            <div class="d-flex gap-2 mb-3" id="dayButtons">
                @php $days = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu']; @endphp
                @foreach($days as $d)
                    <button type="button" class="btn btn-sm @if($currentDay == $d) btn-primary @else btn-light text-dark @endif" data-day="{{ $d }}">{{ $d }}</button>
                @endforeach
            </div>

            <small id="dayInfo" class="text-muted small mt-2"></small>

            <div style="height: 300px;">
                <canvas id="jemaatChart"></canvas>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const ctx = document.getElementById('jemaatChart').getContext('2d');
                const jemaatChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Aktif', 'Sedang', 'Pasif'],
                        datasets: [{
                            label: 'Jumlah Jemaat',
                            data: @json($chartData),
                            backgroundColor: [
                                'rgba(40, 167, 69, 0.7)',
                                'rgba(255, 193, 7, 0.7)',
                                'rgba(220, 53, 69, 0.7)'
                            ],
                            borderColor: [
                                'rgb(40, 167, 69)',
                                'rgb(255, 193, 7)',
                                'rgb(220, 53, 69)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });

                const scanByDayUrl = '{{ route('admin.dashboard.scanByDay') }}';

                document.querySelectorAll('#dayButtons button').forEach(btn => {
                    btn.addEventListener('click', () => {
                        const day = btn.dataset.day;
                        document.querySelectorAll('#dayButtons button').forEach(b => {
                            b.classList.remove('btn-primary');
                            b.classList.add('btn-light','text-dark');
                        });
                        btn.classList.remove('btn-light','text-dark');
                        btn.classList.add('btn-primary');

                        fetch(scanByDayUrl + '?day=' + encodeURIComponent(day))
                            .then(res => res.json())
                            .then(data => {
                                if (data.error) {
                                    document.getElementById('dayInfo').textContent = data.error;
                                    jemaatChart.data.datasets[0].data = [0,0,0];
                                    jemaatChart.update();
                                    return;
                                }
                                if (!data.exists) {
                                    document.getElementById('dayInfo').textContent = 'Tidak ada jadwal ibadah pada ' + day;
                                } else {
                                    document.getElementById('dayInfo').textContent = data.attendees_count + ' orang scan pada ' + data.date;
                                }
                                jemaatChart.data.datasets[0].data = [data.clusters.Aktif, data.clusters.Sedang, data.clusters.Pasif];
                                jemaatChart.update();
                            })
                            .catch(err => {
                                console.error(err);
                                document.getElementById('dayInfo').textContent = 'Terjadi kesalahan';
                            });
                    });
                });

                const defaultBtn = document.querySelector('#dayButtons button.btn-primary') || document.querySelector('#dayButtons button');
                if (defaultBtn) defaultBtn.click();
            </script>
        </div>
    </div>

    {{-- RINGKASAN SCAN --}}
    <div class="col-md-4">
        <div class="bg-white p-4 rounded shadow-sm">
            <h5 class="fw-bold mb-3">Ringkasan Scan Terbaru</h5>

            <ul class="list-unstyled">
                <li class="mb-2">
                    <strong>Ibadah Minggu Pagi</strong><br>
                    <small>08.00 - 10.00</small>
                    <span class="float-end">{{ $pagiCount ?? 0 }} scan</span>
                </li>

                <li class="mb-2">
                    <strong>Ibadah Minggu Siang</strong><br>
                    <small>10.30 - 12.30</small>
                    <span class="float-end">{{ $siangCount ?? 0 }} scan</span>
                </li>
            </ul>

            <small class="text-muted">
                Untuk data lengkap, buka menu Scan Log
            </small>
        </div>
    </div>

</div>

@endsection