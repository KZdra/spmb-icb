@extends('layouts.siswaLayout')

@section('title', 'Cek Status Pendaftaran - SPMB SMK ICB Cinta Teknika')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Card Form Pencarian -->
            <div class="card border-0 shadow-sm rounded-xl mb-4" style="border-radius: 20px; overflow: hidden;">
                <div class="card-header border-0 text-white p-4 text-center" style="background: linear-gradient(135deg, #1E40AF 0%, #3B82F6 100%);">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white text-primary rounded-circle mb-3 shadow" style="width: 60px; height: 60px;">
                        <i class="fas fa-search fa-2x text-primary"></i>
                    </div>
                    <h3 class="font-weight-bold mb-1">Cek Status Pendaftaran</h3>
                    <p class="mb-0 text-white-50">
                        Pantau status berkas pendaftaran dan verifikasi penerimaan siswa secara mandiri tanpa perlu login
                    </p>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('pendaftaran.cekStatus.post') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="keyword" class="font-weight-bold text-dark">
                                Masukkan Kode Pendaftaran, NISN, atau Email:
                            </label>
                            <div class="input-group">
                                <input type="text" name="keyword" id="keyword" class="form-control form-control-lg border-primary" 
                                    placeholder="Contoh: ICB-2026-0001 / 0071234567 / email@gmail.com" 
                                    value="{{ old('keyword', $keyword ?? '') }}" required style="border-radius: 12px 0 0 12px;">
                                <div class="input-group-append">
                                    <button class="btn btn-primary px-4 font-weight-bold" type="submit" style="border-radius: 0 12px 12px 0;">
                                        <i class="fas fa-search mr-1"></i> Periksa
                                    </button>
                                </div>
                            </div>
                            <small class="form-text text-muted mt-2">
                                <i class="fas fa-info-circle mr-1"></i> Gunakan kode pendaftaran yang tercantum pada tanda terima saat mendaftar.
                            </small>
                        </div>
                    </form>

                    <!-- Hasil Pencarian -->
                    @if(isset($keyword))
                        @if($siswa)
                            <div class="mt-4 pt-3 border-top">
                                <div class="card border border-primary shadow-sm" style="border-radius: 16px;">
                                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                                        <span class="font-weight-bold text-primary">
                                            <i class="fas fa-user-graduate mr-1"></i> Data Calon Siswa
                                        </span>
                                        @if($siswa->isAccepted == 1)
                                            <span class="badge badge-success px-3 py-2" style="font-size: 0.9rem;">
                                                <i class="fas fa-check-circle mr-1"></i> DITERIMA SEBAGAI SISWA
                                            </span>
                                        @elseif($siswa->status == 'rejected' || $siswa->isAccepted == 2)
                                            <span class="badge badge-danger px-3 py-2" style="font-size: 0.9rem;">
                                                <i class="fas fa-times-circle mr-1"></i> BERKAS DITOLAK
                                            </span>
                                        @else
                                            <span class="badge badge-warning text-dark px-3 py-2" style="font-size: 0.9rem;">
                                                <i class="fas fa-hourglass-half mr-1"></i> DALAM PROSES VERIFIKASI
                                            </span>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-sm-4 text-muted">Kode Pendaftaran:</div>
                                            <div class="col-sm-8 font-weight-bold text-primary">{{ $siswa->kode_pendaftaran ?? '-' }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-4 text-muted">Nama Lengkap:</div>
                                            <div class="col-sm-8 font-weight-bold text-uppercase">{{ $siswa->nama }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-4 text-muted">NISN:</div>
                                            <div class="col-sm-8">{{ $siswa->nisn }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-4 text-muted">Kompetensi / Jurusan:</div>
                                            <div class="col-sm-8 font-weight-bold text-dark">{{ $siswa->nama_jurusan ?? '-' }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-4 text-muted">Asal Sekolah:</div>
                                            <div class="col-sm-8">{{ $siswa->asal_sekolah }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-4 text-muted">Status Pembayaran:</div>
                                            <div class="col-sm-8">
                                                @if($siswa->status_bayar == 'verified')
                                                    <span class="badge badge-success"><i class="fas fa-check mr-1"></i> Lunas & Terverifikasi</span>
                                                @else
                                                    <span class="badge badge-warning text-dark"><i class="fas fa-clock mr-1"></i> Menunggu Konfirmasi Panitia</span>
                                                @endif
                                            </div>
                                        </div>

                                        @if($siswa->isAccepted == 1)
                                            <div class="mt-3 p-3 rounded" style="background: #F0FDF4; border: 1px solid #86EFAC;">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-award fa-2x text-success mr-3"></i>
                                                    <div>
                                                        <h6 class="font-weight-bold text-success mb-1">Selamat! Anda Resmi Diterima.</h6>
                                                        <div class="text-dark">
                                                            Nomor Induk Siswa (NIS) Resmi: 
                                                            <strong class="text-primary font-weight-bold" style="font-size: 1.15rem;">{{ $siswa->nis ?? 'Dalam Proses' }}</strong>
                                                        </div>
                                                        <small class="text-muted">Surat Keputusan Penerimaan dan panduan daftar ulang telah dikirimkan ke email <strong>{{ $siswa->email }}</strong>.</small>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-warning border-0 rounded-lg p-3 mt-4 text-center">
                                <i class="fas fa-exclamation-triangle fa-2x mb-2 text-warning"></i>
                                <h6 class="font-weight-bold">Data Pendaftaran Tidak Ditemukan</h6>
                                <p class="mb-0 text-muted" style="font-size: 0.9rem;">
                                    Tidak ditemukan pendaftar dengan kata kunci <strong>"{{ $keyword }}"</strong>. Pastikan Anda memasukkan Kode Pendaftaran, NISN, atau Email yang benar saat pengisian formulir.
                                </p>
                            </div>
                        @endif
                    @endif

                    <div class="text-center mt-4">
                        @php
                            $waNumber = $setting->kontak_wa ?? '081222485558';
                        @endphp
                        <p class="text-muted mb-2" style="font-size: 0.9rem;">Butuh bantuan mengenai status pendaftaran Anda?</p>
                        <a href="{{ wa_link($waNumber, 'Halo Panitia SPMB SMK ICB Cinta Teknika, saya ingin menanyakan status pendaftaran saya.') }}" target="_blank" class="btn btn-outline-success btn-sm font-weight-bold">
                            <i class="fab fa-whatsapp mr-1"></i> Hubungi Panitia via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
