@extends('layouts.siswaLayout')

@section('title', 'Tanda Terima Pendaftaran - SMK ICB Cinta Teknika')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <!-- Print Area -->
            <div id="print-area" class="card border-0 shadow-lg rounded-xl overflow-hidden mb-4" style="border-radius: 20px;">
                <!-- Header Card -->
                <div class="card-header border-0 text-white p-4 p-md-5 text-center" style="background: linear-gradient(135deg, {{ $setting->secondary_color ?? '#0B3B7B' }} 0%, {{ $setting->primary_color ?? '#1A56DB' }} 100%);">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white text-primary rounded-circle mb-3 shadow" style="width: 70px; height: 70px;">
                        <i class="fas fa-check-circle fa-3x text-success"></i>
                    </div>
                    <h2 class="font-weight-bold mb-1">Pendaftaran Berhasil Dikirim!</h2>
                    <p class="mb-0 text-white-50" style="font-size: 1.1rem;">
                        Tanda Terima Pendaftaran Calon Siswa Baru {{ $setting->app_name ?? 'SMK ICB' }} &bull; TA {{ $setting->tahun_ajaran ?? '2027/2028' }}
                    </p>
                    <div class="mt-3">
                        <span class="badge badge-light px-3 py-2 text-primary font-weight-bold" style="font-size: 1.05rem; letter-spacing: 1px; border-radius: 8px;">
                            KODE PENDAFTARAN: {{ $siswa->kode_pendaftaran ?? ($kode ?? 'ICB-'.date('Y').'-0001') }}
                        </span>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <!-- Status Alert -->
                    <div class="alert alert-info border-0 rounded-lg p-3 p-md-4 mb-4" style="background-color: #EFF6FF; border-left: 5px solid {{ $setting->primary_color ?? '#1A56DB' }} !important; border-radius: 12px;">
                        <div class="d-flex">
                            <div class="mr-3">
                                <i class="fas fa-info-circle fa-2x" style="color: {{ $setting->primary_color ?? '#1A56DB' }};"></i>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mb-1" style="color: {{ $setting->primary_color ?? '#1A56DB' }};">Informasi Verifikasi & Pengumuman:</h5>
                                <p class="mb-0 text-dark" style="font-size: 0.95rem; line-height: 1.6;">
                                    Terima kasih telah mendaftar di <strong>{{ $setting->app_name ?? 'SMK ICB' }}</strong>. Formulir dan berkas Anda sedang diproses oleh Panitia SPMB.
                                    Pengumuman hasil seleksi kelulusan dan pemberian <strong>Nomor Induk Siswa (NIS)</strong> resmi akan dikirimkan langsung ke alamat email: 
                                    <strong style="color: {{ $setting->primary_color ?? '#1A56DB' }};">{{ $siswa->email ?? 'email Anda' }}</strong>.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Ringkasan Data Pendaftar + QR Code -->
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                        <h5 class="font-weight-bold text-dark mb-0">
                            <i class="fas fa-id-card mr-2" style="color: {{ $setting->primary_color ?? '#1A56DB' }};"></i> Ringkasan Data Calon Siswa
                        </h5>
                        <div class="text-right">
                            @php
                                $kodePendaftaranSiswa = $siswa->kode_pendaftaran ?? ($kode ?? 'ICB');
                                $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=70x70&data=' . urlencode($kodePendaftaranSiswa);
                            @endphp
                            <img src="{{ $qrUrl }}" alt="QR Code" class="rounded border p-1" style="width: 70px; height: 70px;">
                        </div>
                    </div>

                    <div class="table-responsive mb-4">
                        <table class="table table-bordered mb-0">
                            <tbody>
                                <tr>
                                    <th class="bg-light" style="width: 35%;">Kode Pendaftaran</th>
                                    <td class="font-weight-bold text-primary">{{ $siswa->kode_pendaftaran ?? $kode }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Nama Lengkap Siswa</th>
                                    <td class="font-weight-bold text-uppercase">{{ $siswa->nama ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">NISN</th>
                                    <td>{{ $siswa->nisn ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Jalur Pendaftaran</th>
                                    <td><span class="badge badge-primary px-2 py-1">{{ $siswa->jalur_pendaftaran ?? 'Reguler' }}</span></td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Pilihan Jurusan / Kompetensi</th>
                                    <td class="font-weight-bold text-dark">{{ $siswa->nama_jurusan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Asal Sekolah</th>
                                    <td>{{ $siswa->asal_sekolah ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Nomor WhatsApp Siswa</th>
                                    <td>{{ $siswa->no_hp ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Email Siswa</th>
                                    <td>{{ $siswa->email ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Status Berkas</th>
                                    <td>
                                        <span class="badge badge-warning text-dark px-3 py-1 font-weight-bold">
                                            <i class="fas fa-clock mr-1"></i> Menunggu Verifikasi Panitia
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Rekening Bank Tujuan Transfer (Bisa Lebih Dari 1) -->
                    @if (isset($rekeningBanks) && $rekeningBanks->count() > 0)
                        <div class="mb-4 p-3 rounded-lg border bg-white shadow-sm" style="border-radius: 12px;">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="font-weight-bold text-dark small"><i class="fas fa-university text-primary mr-1"></i> Rekening Resmi Penerimaan Biaya Pendaftaran:</span>
                                <span class="badge badge-success px-2 py-1">Biaya: Rp {{ number_format($setting->biaya_pendaftaran ?? 200000, 0, ',', '.') }}</span>
                            </div>
                            <div class="row">
                                @foreach ($rekeningBanks as $rb)
                                    <div class="{{ $rekeningBanks->count() === 1 ? 'col-12' : 'col-md-6' }} mb-2">
                                        <div class="p-2 bg-light rounded border text-muted small">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <strong class="text-dark"><i class="fas fa-money-check-alt text-success mr-1"></i> {{ $rb->nama_bank }}</strong>
                                                <button type="button" class="btn btn-xs btn-outline-success d-print-none py-0 px-2" onclick="navigator.clipboard.writeText('{{ $rb->nomor_rekening }}'); alert('Nomor rekening tersalin!')">
                                                    <i class="fas fa-copy mr-1"></i> Salin
                                                </button>
                                            </div>
                                            <div class="font-weight-bold text-primary font-monospace mt-1" style="font-size: 1.1rem; letter-spacing: 0.5px;">{{ $rb->nomor_rekening }}</div>
                                            <div>a.n. <strong>{{ $rb->atas_nama }}</strong></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Catatan Panitia & Tanda Tangan -->
                    <div class="bg-light p-3 rounded-lg mb-4" style="border-radius: 12px; font-size: 0.9rem;">
                        <h6 class="font-weight-bold text-dark mb-2">Petunjuk & Langkah Selanjutnya:</h6>
                        <p class="text-muted mb-2">
                            {{ $setting->pdf_catatan_kaki ?? 'Bawalah lembar tanda terima ini beserta berkas fotokopi saat pelaksanaan wawancara atau daftar ulang di kampus sekolah.' }}
                        </p>
                        <ol class="pl-3 mb-0 text-muted small">
                            <li>Simpan atau cetak bukti tanda terima pendaftaran ini sebagai bukti pendaftaran resmi.</li>
                            <li>Pastikan nomor WhatsApp dan email aktif untuk menerima nomor NIS dan surat keputusan kelulusan.</li>
                        </ol>
                        <div class="row pt-4 d-none d-print-flex justify-content-between text-center">
                            <div class="col-6">
                                <div class="text-muted small">Calon Siswa / Orang Tua,</div>
                                <div style="height: 60px;"></div>
                                <div class="font-weight-bold text-uppercase">( {{ $siswa->nama ?? 'Calon Siswa' }} )</div>
                            </div>
                            <div class="col-6">
                                <div class="text-muted small">Panitia Penerimaan Murid Baru,</div>
                                <div style="height: 60px;"></div>
                                <div class="font-weight-bold text-uppercase">( {{ $setting->pdf_penandatangan ?? 'Panitia SPMB' }} )</div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions Buttons (Hidden on Print) -->
                    <div class="d-print-none text-center pt-2">
                        <div class="row g-2 justify-content-center">
                            <div class="col-md-4 mb-2">
                                <button type="button" class="btn btn-outline-primary btn-block py-2 font-weight-bold shadow-sm" onclick="window.print()">
                                    <i class="fas fa-print mr-2"></i> Cetak Tanda Terima
                                </button>
                            </div>
                            @php
                                $waNumber = $setting->kontak_wa ?? '081222485558';
                                $pendaftarKode = $siswa->kode_pendaftaran ?? $kode;
                                $pendaftarNama = $siswa->nama ?? '';
                                $schoolName = $setting->app_name ?? 'SMK ICB';
                                $waMsg = "Halo Panitia SPMB {$schoolName}, saya sudah mendaftar secara online dengan Kode Pendaftaran: {$pendaftarKode} atas nama {$pendaftarNama}. Mohon konfirmasinya. Terima kasih.";
                            @endphp
                            <div class="col-md-5 mb-2">
                                <a href="{{ wa_link($waNumber, $waMsg) }}" target="_blank" class="btn btn-success btn-block py-2 font-weight-bold shadow-sm">
                                    <i class="fab fa-whatsapp mr-2"></i> Konfirmasi ke Panitia WA
                                </a>
                            </div>
                            <div class="col-md-3 mb-2">
                                <a href="{{ url('/') }}" class="btn btn-light btn-block py-2 font-weight-bold text-muted border shadow-sm">
                                    <i class="fas fa-home mr-1"></i> Beranda
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    body * {
        visibility: hidden;
    }
    #print-area, #print-area * {
        visibility: visible;
    }
    #print-area {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        border: 1px solid #ddd !important;
        box-shadow: none !important;
    }
    .d-print-none {
        display: none !important;
    }
}
</style>
@endsection
