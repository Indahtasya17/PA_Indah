@extends('layouting.guest.master')

@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                <i class="fas fa-dolly-flatbed"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Total Barang Masuk</p>
                                <h4 class="card-title">{{ number_format($totalBarangMasuk) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                <i class="fas fa-dolly"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Total Barang Keluar</p>
                                <h4 class="card-title">{{ number_format($totalBarangKeluar) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="fas fa-luggage-cart"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Total Supplier</p>
                                <h4 class="card-title">{{ $totalSupplier }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-7">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Grafik Barang Keluar </h4>
                </div>
                <div class="card-body">
                    <canvas id="topBarangKeluarChart" height="100"></canvas>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Notifikasi
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class ="text-center">No</th>
                                <th>Nama barang</th>
                                <th>Stok Barang</th>
                                <th>ROP</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($barangs as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}
                                    </td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td>
                                        <span class="badge badge-{{ $item->badge_color }}">
                                            <b>
                                                {{ $item->rop }}
                                            </b>
                                        </span>
                                    </td>
                                    <td>
                                        @if ($item->badge_color == 'danger' || $item->badge_color == 'warning')
                                            Lakukan Pemesanan Ulang
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="no-data">Data tidak ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Grafik Barang Masuk dan Keluar 7 Terakhir</h4>
                </div>
                <div class="card-body">
                    <canvas id="chartBarang" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('chartBarang').getContext('2d');

        const chartBarang = new Chart(ctx, {
            type: 'line', // bisa diganti 'bar' jika ingin chart batang
            data: {
                labels: {!! json_encode($datasets['transaksi']['label']) !!},
                datasets: [{
                        label: 'Barang Masuk',
                        data: {!! json_encode($datasets['transaksi']['data']['barang_masuk']) !!},
                        borderColor: 'green',
                        backgroundColor: 'rgba(0, 128, 0, .4)',
                        fill: true,
                        tension: 0.3
                    },
                    {
                        label: 'Barang Keluar',
                        data: {!! json_encode($datasets['transaksi']['data']['barang_keluar']) !!},
                        borderColor: 'red',
                        backgroundColor: 'rgba(255, 0, 0, .4)',
                        fill: true,
                        tension: 0.3
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Barang (Kg)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: ''
                        }
                    }
                }
            }
        });

        const ctxTopBarang = document.getElementById('topBarangKeluarChart').getContext('2d');

        new Chart(ctxTopBarang, {
            type: 'bar',
            data: {
                labels: {!! json_encode($datasets['barang_keluar_terbanyak']['label']) !!},
                datasets: [{
                    label: '',
                    data: {!! json_encode($datasets['barang_keluar_terbanyak']['data']) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)', // Merah
                        'rgba(54, 162, 235, 0.7)', // Biru
                        'rgba(255, 206, 86, 0.7)', // Kuning
                        'rgba(75, 192, 192, 0.7)', // Hijau toska
                        'rgba(153, 102, 255, 0.7)' // Ungu
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false // Nonaktifkan legend
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Keluar'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Nama Barang'
                        }
                    }
                }
            }
        });
    </script>
@endpush
