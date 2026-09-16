@extends('layouts.siswaLayout')

@section('title', 'Tanda Terima Pendaftaran - SMK ICB Cinta Teknika')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <!-- Print Area -->
            <div id="print-area" class="card border-0 shadow-lg rounded-xl overflow-hidden mb-4" style="border-radius: 20px;">
                <!-- Header Card -->
                <div class="card-header border-0 text-white p-4 p-md-5 text-center" style="background: linear-gradient(135deg, #1E40AF 0%, #3B82F6 100%);">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white text-primary rounded-circle mb-3 shadow" style="width: 70px; height: 70px;">
                        <i class="fas fa-check-circle fa-3x text-success"></i>
                    </div>
                    <h2 class="font-weight-bold mb-1">Pendaftaran Berhasil Dikirim!</h2>
                    <p class="mb-0 text-white-50" style="font-size: 1.1rem;">
                        Tanda Terima Pendaftaran Calon Siswa Baru {{ $setting->tahun_ajaran ?? '2026/2027' }}
                    </p>
                    <div class="mt-3">
                        <span class="badge badge-light px-3 py-2 text-primary font-weight-bold" style="font-size: 1.05rem; letter-spacing: 1px; border-radius: 8px;">
                            KODE PENDAFTARAN: {{ $siswa->kode_pendaftaran ?? ($kode ?? 'ICB-'.date('Y').'-0001') }}
                        </span>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <!-- Status Alert -->
                    <div class="alert alert-info border-0 rounded-lg p-3 p-md-4 mb-4" style="background-color: #EFF6FF; border-left: 5px solid #3B82F6 !important; border-radius: 12px;">
                        <div class="d-flex">
                            <div class="mr-3">
                                <i class="fas fa-info-circle fa-2x text-primary"></i>
                            </div>
                            <div>
                                <h5 class="font-weight-bold text-primary mb-1">Informasi Verifikasi & Pengumuman:</h5>
                                <p class="mb-0 text-dark" style="font-size: 0.95rem; line-height: 1.6;">
                                    Terima kasih telah mendaftar di <strong>SMK ICB Cinta Teknika</strong>. Formulir dan bukti pembayaran Anda sedang diproses oleh Panitia PPDB.
                                    Pengumuman hasil seleksi kelulusan dan pemberian <strong>Nomor Induk Siswa (NIS)</strong> resmi akan dikirimkan secara langsung ke alamat email Anda: 
                                    <strong class="text-primary">{{ $siswa->email ?? 'email Anda' }}</strong>. Anda tidak perlu membuat akun login portal siswa.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Ringkasan Data Pendaftar -->
                    <h5 class="font-weight-bold text-dark border-bottom pb-2 mb-3">
                        <i class="fas fa-id-card text-primary mr-2"></i> Ringkasan Data Calon Siswa
                    </h5>

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

                    <!-- Catatan Panitia -->
                    <div class="bg-light p-3 rounded-lg mb-4" style="border-radius: 12px; font-size: 0.9rem;">
                        <h6 class="font-weight-bold text-dark mb-2">Langkah Selanjutnya:</h6>
                        <ol class="pl-3 mb-0 text-muted">
                            <li>Simpan atau cetak bukti tanda terima pendaftaran ini sebagai bukti pendaftaran yang sah.</li>
                            <li>Pastikan nomor WhatsApp dan email yang Anda daftarkan aktif dan dapat dihubungi.</li>
                            <li>Panitia akan melakukan verifikasi berkas dan bukti pembayaran dalam waktu 1x24 jam kerja.</li>
                            <li>Setelah terverifikasi, Anda akan menerima surat keputusan penerimaan & nomor NIS resmi melalui Email.</li>
                        </ol>
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
                                $waMsg = "Halo Panitia SPMB SMK ICB Cinta Teknika, saya sudah mendaftar secara online dengan Kode Pendaftaran: {$pendaftarKode} atas nama {$pendaftarNama}. Mohon konfirmasinya. Terima kasih.";
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
