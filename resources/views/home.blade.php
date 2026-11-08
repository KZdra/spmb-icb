@extends('layouts.app')

@section('content')
    <!-- Content Header -->
    <div class="content-header pb-2">
        <div class="container-fluid">
            <div class="d-flex flex-wrap justify-content-between align-items-center" style="gap: 12px;">
                <div>
                    <h1 class="m-0 font-weight-bold text-dark" style="font-size: 1.6rem; letter-spacing: -0.5px;">
                        <i class="fas fa-chart-line text-primary mr-2"></i> Ringkasan SPMB Eksekutif
                    </h1>
                    <p class="text-muted small mb-0 mt-1">
                        Portal monitoring penerimaan siswa baru <strong>{{ $setting->app_name ?? 'SMK ICB' }}</strong> &bull; Tahun Ajaran {{ $setting->tahun_ajaran ?? '2027/2028' }}
                    </p>
                </div>
                <div class="d-flex flex-wrap align-items-center" style="gap: 8px;">
                    @if (($setting->status_pendaftaran ?? 'buka') === 'buka')
                        <span class="badge badge-success px-3 py-2 font-weight-bold shadow-sm" style="font-size: 0.85rem; border-radius: 20px;">
                            <i class="fas fa-door-open mr-1"></i> Pendaftaran Buka ({{ $setting->gelombang_aktif ?? 'Gelombang 1' }})
                        </span>
                    @else
                        <span class="badge badge-danger px-3 py-2 font-weight-bold shadow-sm" style="font-size: 0.85rem; border-radius: 20px;">
                            <i class="fas fa-door-closed mr-1"></i> Pendaftaran Ditutup
                        </span>
                    @endif
                    <a href="{{ route('verifSiswa.exportXlsx') }}" class="btn btn-outline-success btn-sm font-weight-bold shadow-sm" style="border-radius: 8px; min-height: 36px; display: inline-flex; align-items: center;">
                        <i class="fas fa-file-excel mr-1"></i> Rekap Excel
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <!-- 4 Executive Stat Cards -->
            <div class="row">
                <!-- Total Pendaftar -->
                <div class="col-12 col-sm-6 col-xl-3 mb-3">
                    <div class="card shadow-sm border-0 h-100" style="border-radius: 14px; border-left: 5px solid #1A56DB !important;">
                        <div class="card-body p-3 d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted text-uppercase font-weight-bold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Total Pendaftar</span>
                                <h2 class="font-weight-bold mb-0 text-dark" style="font-size: 1.85rem;">{{ number_format($totalSiswa) }}</h2>
                                <small class="text-muted">Calon siswa terdata</small>
                            </div>
                            <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle shadow-sm" style="width: 52px; height: 52px; font-size: 1.3rem;">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Siswa Diterima -->
                <div class="col-12 col-sm-6 col-xl-3 mb-3">
                    <div class="card shadow-sm border-0 h-100" style="border-radius: 14px; border-left: 5px solid #10B981 !important;">
                        <div class="card-body p-3 d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted text-uppercase font-weight-bold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Siswa Diterima</span>
                                <h2 class="font-weight-bold mb-0 text-success" style="font-size: 1.85rem;">{{ number_format($totalDiterima) }}</h2>
                                <small class="text-muted">Telah terbit NIS resmi</small>
                            </div>
                            <div class="d-flex align-items-center justify-content-center bg-success text-white rounded-circle shadow-sm" style="width: 52px; height: 52px; font-size: 1.3rem;">
                                <i class="fas fa-user-check"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Menunggu Verifikasi -->
                <div class="col-12 col-sm-6 col-xl-3 mb-3">
                    <div class="card shadow-sm border-0 h-100" style="border-radius: 14px; border-left: 5px solid #F59E0B !important;">
                        <div class="card-body p-3 d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted text-uppercase font-weight-bold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Menunggu / Pending</span>
                                <h2 class="font-weight-bold mb-0 text-warning" style="font-size: 1.85rem;">{{ number_format($totalPending) }}</h2>
                                <small class="text-muted">Butuh verifikasi berkas</small>
                            </div>
                            <div class="d-flex align-items-center justify-content-center bg-warning text-white rounded-circle shadow-sm" style="width: 52px; height: 52px; font-size: 1.3rem;">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dana Terverifikasi -->
                <div class="col-12 col-sm-6 col-xl-3 mb-3">
                    <div class="card shadow-sm border-0 h-100" style="border-radius: 14px; border-left: 5px solid #065F46 !important;">
                        <div class="card-body p-3 d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted text-uppercase font-weight-bold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Pemasukan Pendaftaran</span>
                                <h2 class="font-weight-bold mb-0 text-dark" style="font-size: 1.5rem; color: #065F46 !important;">Rp {{ number_format($totalDanaMasuk, 0, ',', '.') }}</h2>
                                <small class="text-success font-weight-bold">{{ $paymentStats->verified ?? 0 }} transaksi valid</small>
                            </div>
                            <div class="d-flex align-items-center justify-content-center text-white rounded-circle shadow-sm" style="width: 52px; height: 52px; font-size: 1.3rem; background: #065F46;">
                                <i class="fas fa-wallet"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Action Shortcut Bar -->
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 14px; background: linear-gradient(135deg, #F8FAFC 0%, #EFF6FF 100%);">
                <div class="card-body p-3">
                    <div class="d-flex flex-wrap align-items-center justify-content-between" style="gap: 10px;">
                        <div class="d-flex align-items-center">
                            <span class="badge badge-primary px-3 py-1 mr-2 font-weight-bold" style="font-size: 0.8rem; border-radius: 6px;">Pintasan Cepat</span>
                            <span class="text-dark small font-weight-bold d-none d-md-inline">Akses cepat tugas operasional panitia:</span>
                        </div>
                        <div class="d-flex flex-wrap align-items-center" style="gap: 8px;">
                            <a href="{{ route('verifSiswa.index') }}" class="btn btn-primary btn-sm font-weight-bold px-3 shadow-sm" style="border-radius: 8px; min-height: 38px; display: inline-flex; align-items: center;">
                                <i class="fas fa-user-check mr-1"></i> Verifikasi Siswa ({{ $totalPending }} Pending)
                            </a>
                            <a href="{{ route('appconfig.index') }}#tab-banner" class="btn btn-outline-info btn-sm font-weight-bold px-3 bg-white" style="border-radius: 8px; min-height: 38px; display: inline-flex; align-items: center;">
                                <i class="fas fa-bullhorn mr-1"></i> Status Gelombang
                            </a>
                            <a href="{{ route('appconfig.index') }}#tab-payment" class="btn btn-outline-dark btn-sm font-weight-bold px-3 bg-white" style="border-radius: 8px; min-height: 38px; display: inline-flex; align-items: center;">
                                <i class="fas fa-university mr-1"></i> Rekening Bank
                            </a>
                            <a href="{{ route('jurusan.index') }}" class="btn btn-outline-secondary btn-sm font-weight-bold px-3 bg-white" style="border-radius: 8px; min-height: 38px; display: inline-flex; align-items: center;">
                                <i class="fas fa-medal mr-1"></i> Kuota Jurusan
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section (Responsive Grid) -->
            <div class="row">
                <!-- Bar Chart: Pendaftar per Jurusan & Gender -->
                <div class="col-lg-7 mb-4">
                    <div class="card shadow-sm border-0 h-100" style="border-radius: 14px;">
                        <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                            <h5 class="card-title font-weight-bold text-dark mb-0" style="font-size: 1rem;">
                                <i class="fas fa-chart-bar text-primary mr-2"></i> Pendaftar per Jurusan & Gender
                            </h5>
                            <span class="text-muted small">Pilihan Kompetensi</span>
                        </div>
                        <div class="card-body p-3">
                            <div style="position: relative; height: 280px; width: 100%;">
                                <canvas id="pendaftarChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Donut Chart: Komposisi Peminatan Jurusan -->
                <div class="col-lg-5 mb-4">
                    <div class="card shadow-sm border-0 h-100" style="border-radius: 14px;">
                        <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                            <h5 class="card-title font-weight-bold text-dark mb-0" style="font-size: 1rem;">
                                <i class="fas fa-chart-pie text-info mr-2"></i> Proporsi Pilihan Jurusan
                            </h5>
                            <span class="text-muted small">Distribusi Total</span>
                        </div>
                        <div class="card-body p-3 d-flex align-items-center justify-content-center">
                            <div style="position: relative; height: 280px; width: 100%;">
                                <canvas id="pendaftarChart2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table: Pendaftar Terbaru Masuk -->
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card shadow-sm border-0" style="border-radius: 14px; overflow: hidden;">
                        <div class="card-header bg-white py-3 border-bottom d-flex flex-wrap justify-content-between align-items-center" style="gap: 8px;">
                            <div>
                                <h5 class="card-title font-weight-bold text-dark mb-0" style="font-size: 1.05rem;">
                                    <i class="fas fa-user-clock text-primary mr-2"></i> Pendaftar Masuk Terbaru
                                </h5>
                                <small class="text-muted d-block mt-1">Calon siswa yang baru saja menyelesaikan formulir online</small>
                            </div>
                            <a href="{{ route('verifSiswa.index') }}" class="btn btn-outline-primary btn-sm font-weight-bold" style="border-radius: 6px;">
                                Lihat Semua Pendaftar &rarr;
                            </a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped mb-0" style="font-size: 0.92rem;">
                                    <thead class="bg-light">
                                        <tr>
                                            <th style="width: 130px;">Kode Pendaftaran</th>
                                            <th>Nama Calon Siswa</th>
                                            <th>Jurusan Dipilih</th>
                                            <th>Asal Sekolah</th>
                                            <th class="text-center">Status Bayar</th>
                                            <th class="text-center">Status Seleksi</th>
                                            <th>Waktu Daftar</th>
                                            <th class="text-center" style="width: 100px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentSiswas as $s)
                                            <tr>
                                                <td class="align-middle font-weight-bold text-primary font-monospace">
                                                    {{ $s->kode_pendaftaran ?? '-' }}
                                                </td>
                                                <td class="align-middle">
                                                    <strong class="text-dark">{{ $s->nama }}</strong>
                                                    <div class="small text-muted"><i class="fas fa-phone mr-1"></i> {{ $s->no_hp }}</div>
                                                </td>
                                                <td class="align-middle font-weight-bold text-navy">
                                                    {{ $s->nama_jurusan ?? '-' }}
                                                </td>
                                                <td class="align-middle text-muted small">
                                                    {{ $s->asal_sekolah ?? '-' }}
                                                </td>
                                                <td class="align-middle text-center">
                                                    @php
                                                        $sb = strtolower($s->status_bayar ?? '');
                                                    @endphp
                                                    @if ($sb === 'verified' || $sb === 'diverifikasi')
                                                        <span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i> Valid</span>
                                                    @elseif ($sb === 'rejected' || $sb === 'ditolak')
                                                        <span class="badge badge-danger px-2 py-1"><i class="fas fa-times-circle mr-1"></i> Ditolak</span>
                                                    @elseif ($sb === 'pending')
                                                        <span class="badge badge-warning text-dark px-2 py-1"><i class="fas fa-clock mr-1"></i> Menunggu</span>
                                                    @else
                                                        <span class="badge badge-secondary px-2 py-1">Belum Upload</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center">
                                                    @if ($s->isAccepted == 1)
                                                        <span class="badge badge-success px-2 py-1"><i class="fas fa-check mr-1"></i> Diterima</span>
                                                    @elseif ($s->status === 'Ditolak')
                                                        <span class="badge badge-danger px-2 py-1"><i class="fas fa-times mr-1"></i> Ditolak</span>
                                                    @else
                                                        <span class="badge badge-warning text-dark px-2 py-1"><i class="fas fa-hourglass-half mr-1"></i> Pending</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-muted small">
                                                    {{ \Carbon\Carbon::parse($s->created_at)->locale('id')->diffForHumans() }}
                                                </td>
                                                <td class="align-middle text-center">
                                                    <a href="{{ route('verifSiswa.index') }}" class="btn btn-xs btn-primary font-weight-bold px-2 py-1 shadow-sm" style="border-radius: 6px;" title="Verifikasi">
                                                        <i class="fas fa-eye mr-1"></i> Proses
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-5 text-muted">
                                                    <i class="fas fa-user-friends fa-3x mb-2 text-secondary"></i>
                                                    <h6>Belum ada data pendaftar baru.</h6>
                                                    <small>Data akan otomatis muncul saat calon siswa mengisi formulir online.</small>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="module">
        $(document).ready(function() {
            const chartData = @json($chartData);
            const labels = chartData.map(item => item.jurusan);
            const maleData = chartData.map(item => item.total_male);
            const femaleData = chartData.map(item => item.total_female);
            const totalSiswa = chartData.map(item => item.total_male + item.total_female);

            // Chart 1: Bar Chart per Jurusan & Gender
            const ctx1 = document.getElementById('pendaftarChart');
            if (ctx1) {
                const chart1Obj = {
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Laki-laki',
                                data: maleData,
                                backgroundColor: 'rgba(26, 86, 219, 0.75)',
                                borderColor: 'rgba(26, 86, 219, 1)',
                                borderWidth: 1,
                                borderRadius: 6
                            },
                            {
                                label: 'Perempuan',
                                data: femaleData,
                                backgroundColor: 'rgba(236, 72, 153, 0.75)',
                                borderColor: 'rgba(236, 72, 153, 1)',
                                borderWidth: 1,
                                borderRadius: 6
                            }
                        ]
                    },
                    config: {
                        chartId: 'pendaftarChart',
                        type: 'bar',
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'top',
                                    labels: { font: { weight: '600' } }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return context.dataset.label + ': ' + context.raw + ' siswa';
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: { precision: 0 }
                                }
                            }
                        }
                    }
                };
                if (typeof MakeChart === 'function') {
                    MakeChart(chart1Obj);
                }
            }

            // Chart 2: Doughnut Chart
            const ctx2 = document.getElementById('pendaftarChart2');
            if (ctx2) {
                const palette = ['#1A56DB', '#10B981', '#F59E0B', '#8B5CF6', '#EC4899', '#06B6D4', '#F97316'];
                const chart2Obj = {
                    data: {
                        labels: labels,
                        datasets: [{
                            data: totalSiswa,
                            backgroundColor: palette.slice(0, labels.length),
                            borderWidth: 2,
                            borderColor: '#ffffff'
                        }]
                    },
                    config: {
                        chartId: 'pendaftarChart2',
                        type: 'doughnut',
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: { boxWidth: 14, font: { size: 11, weight: '600' } }
                                }
                            }
                        }
                    }
                };
                if (typeof MakeChart === 'function') {
                    MakeChart(chart2Obj);
                }
            }
        });
    </script>
@endsection
