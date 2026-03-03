@extends('layouts.siswaLayout')
@section('title', 'Status Pendaftaran')

@section('content')
<div class="container d-flex flex-column mt-3" style="min-height: 80vh">
    <h2 class="mb-3">
        <i class="fas fa-clipboard-check text-primary"></i> Status Pendaftaran
    </h2>

    <div class="alert alert-info shadow-sm">
        <i class="fas fa-info-circle"></i>
        Nomor induk siswa akan diperoleh apabila status siswa diterima!
    </div>

    <div class="cardcont">

        {{-- ================= DATA SISWA ================= --}}
        <div class="card mb-3 shadow-sm">
            <div class="card-header bg-primary text-white">
                <i class="fas fa-user-graduate"></i> Data Pendaftar
            </div>
            <div class="card-body">
                <p>
                    <i class="fas fa-user text-secondary"></i>
                    <strong>Nama:</strong> {{ $dataSis->nama }}
                </p>
                <p>
                    <i class="fas fa-school text-secondary"></i>
                    <strong>Asal Sekolah:</strong> {{ $dataSis->asal_sekolah }}
                </p>
                <p>
                    <i class="fas fa-book-open text-secondary"></i>
                    <strong>Jurusan:</strong> {{ $dataSis->jurusan->nama_jurusan }}
                </p>
            </div>
        </div>

        {{-- ================= STATUS ================= --}}
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white">
                <i class="fas fa-tasks"></i> Status
            </div>
            <div class="card-body">

                @php
                    $payment = $dataSis->buktiPembayaran;
                @endphp

                {{-- ================= PEMBAYARAN ================= --}}
                <h5 class="font-weight-bold">
                    <i class="fas fa-money-check-alt text-success"></i> Pembayaran
                </h5>

                @if($payment)

                    @if($payment->status == 'waiting_upload')
                        <div class="alert alert-warning shadow-sm">
                            <i class="fas fa-upload"></i>
                            Silahkan upload bukti pembayaran.
                            <br>
                            <a href="{{ route('siswa.pembayaran.index') }}" class="btn btn-sm btn-success mt-2">
                                <i class="fas fa-cloud-upload-alt"></i> Upload Sekarang
                            </a>
                        </div>

                    @elseif($payment->status == 'waiting_cash')
                        <div class="alert alert-warning shadow-sm">
                            <i class="fas fa-hand-holding-usd"></i>
                            Silahkan melakukan pembayaran langsung ke sekolah.
                        </div>

                    @elseif($payment->status == 'pending')
                        <div class="alert alert-info shadow-sm">
                            <i class="fas fa-clock"></i>
                            Bukti pembayaran sedang diverifikasi oleh admin.
                        </div>

                    @elseif($payment->status == 'verified')
                        <div class="alert alert-success shadow-sm">
                            <i class="fas fa-check-circle"></i>
                            Pembayaran telah diverifikasi.
                        </div>

                    @elseif($payment->status == 'rejected')
                        <div class="alert alert-danger shadow-sm">
                            <i class="fas fa-times-circle"></i>
                            Pembayaran ditolak.
                            <br>
                            <strong>Alasan:</strong> {{ $payment->alasan ?? 'Tidak ada alasan.' }}
                            <br>
                            <a href="{{ route('siswa.pembayaran.index') }}" class="btn btn-sm btn-warning mt-2">
                                <i class="fas fa-redo"></i> Upload Ulang
                            </a>
                        </div>
                    @endif

                @endif

                {{-- ================= PENDAFTARAN ================= --}}
                <h5 class="font-weight-bold mt-4">
                    <i class="fas fa-user-check text-primary"></i> Pendaftaran
                </h5>

                @if(!$payment || $payment->status != 'verified')
                    <div class="alert alert-secondary shadow-sm">
                        <i class="fas fa-hourglass-half"></i>
                        Menunggu verifikasi pembayaran sebelum proses seleksi.
                    </div>
                @else

                    @if($dataSis->status == 'Pending')
                        <div class="alert alert-info shadow-sm">
                            <i class="fas fa-spinner"></i>
                            Sedang dalam proses seleksi. Silahkan tunggu.
                        </div>

                    @elseif($dataSis->status == 'Diterima')
                        <div class="alert alert-success shadow-sm">
                            <i class="fas fa-trophy"></i>
                            <strong>Selamat! Anda diterima.</strong>
                            <br>
                            <i class="fas fa-id-card"></i>
                            NIS Anda: <strong>{{ $dataSis->nis }}</strong>
                        </div>

                    @elseif($dataSis->status == 'Ditolak')
                        <div class="alert alert-danger shadow-sm">
                            <i class="fas fa-user-times"></i>
                            Mohon maaf, pendaftaran Anda ditolak.
                            <br>
                            <i class="fas fa-phone"></i>
                            Silahkan hubungi admin untuk informasi lebih lanjut.
                        </div>
                    @endif

                @endif

            </div>
        </div>

    </div>
</div>
@endsection
