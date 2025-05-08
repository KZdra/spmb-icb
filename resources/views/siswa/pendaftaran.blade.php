@extends('layouts.siswaLayout')
@section('title', 'DataDiri')
@section('content')
    <div class="container  d-flex flex-column  mt-3" style="min-height: 80vh">
        <h2>Status Pendaftaran</h2>
        <div class="alert alert-primary" role="alert">
            Nis Siswa Akan Di Peroleh Apabila Siswa Sudah Diterima.
        </div>
        <div class="cardcont">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5><i class="fas fa-user"></i>&nbsp; Data Pendaftar</h5>
                </div>
                <div class="card-body">
                    <h5>Nama: <span class="font-weight-bold">{{ auth_user()->nama }}</span></h5>
                    <h5>Asal Sekolah: <span class="font-weight-bold">{{ auth_user()->asal_sekolah }}</span></h5>
                    <h5>Jurusan Yang Dipilih: <span class="font-weight-bold">{{ $dataSis->jurusan->nama_jurusan }}</span>
                    </h5>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-info">
                    <h5><i class="fas fa-file"></i>&nbsp; Status</h5>
                </div>
                <div class="card-body">
                    <h5 class="font-weight-bold">Pembayaran: </h5>
                    @if ($dataSis->buktiPembayaran)
                        @switch($dataSis->buktiPembayaran->status)
                            @case('Diverifikasi')
                                <div class="alert alert-success" role="alert">
                                    <h5 class="mb-0 font-weight-bold">
                                        <i class="fas fa-check"></i>&nbsp;&nbsp;Pembayaran Diverifikasi!
                                    </h5>
                                </div>
                            @break

                            @case('Ditolak')
                                <div class="alert alert-danger" role="alert">
                                    <h5 class="mb-0 font-weight-bold">
                                        <i class="fas fa-times"></i>&nbsp;&nbsp;Pembayaran DiTolak! <br>
                                        Karena : {{ $dataSis->buktiPembayaran->alasan ?? 'Tidak Ada Alasan.' }}
                                    </h5>
                                    <h5 class="mt-1 mb-0">Silahkan Hubungi No Dibawah Ini <br>Untuk Input Ulang Bukti Pembayaran
                                    </h5>
                                    <h5>0895.597847514</h5>
                                </div>
                            @break

                            @default
                                <div class="alert alert-info" role="alert">
                                    <h5 class="mb-0 font-weight-bold">
                                        <i class="fas fa-info"></i>&nbsp;&nbsp;Pembayaran Sedang Dalam Proses Verifikasi!
                                    </h5>
                                </div>
                        @endswitch
                    @else
                        <div class="alert alert-warning" role="alert">
                            <h5 class="mb-0 font-weight-bold">
                                <i class="fa fa-sad-tear"></i>&nbsp;&nbsp;Belum Melakukan Verifikasi Pembayaran
                            </h5>
                            <h5 class="mt-1 mb-0">Silahkan Verifikasi Di <br></h5>
                            <a href="{{ route('siswa.pembayaran.index') }}"
                                class="btn btn-success text-decoration-none">Halaman Verifikasi Pembayaran</a>
                        </div>
                    @endif
                    <h5 class="font-weight-bold">Pendaftaran: </h5>
                    @if ($dataSis->buktiPembayaran)
                        @switch($dataSis->status)
                            @case('Diterima')
                                <div class="alert alert-success" role="alert">
                                    <h5 class="mb-0 font-weight-bold">
                                        <i class="fas fa-check"></i>&nbsp;&nbsp;Selamat Anda Diterima!
                                    </h5>
                                    <h5 class="mt-1 mb-0">Berikut Ini Adalah NIS anda : <br></h5>
                                    <h5 class="font-weight-bold">{{ $dataSis->nis }}</h5>
                                </div>
                            @break

                            @case('Ditolak')
                                <div class="alert alert-danger" role="alert">
                                    <h5 class="mb-0 font-weight-bold">
                                        <i class="fas fa-times"></i>&nbsp;&nbsp;Pendaftaran DITOLAK ! <br>

                                    </h5>
                                    <h5 class="mt-1 mb-0">Silahkan Hubungi No Dibawah Ini <br>Untuk Bantuan
                                    </h5>
                                    <h5>0895.597847514</h5>
                                </div>
                            @break

                            @default
                                <div class="alert alert-info" role="alert">
                                    <h5 class="mb-0 font-weight-bold">
                                        <i class="fas fa-info"></i>&nbsp;&nbsp;Sedang Dalam Proses! Silahkan Tunggu
                                    </h5>
                                </div>
                        @endswitch
                    @else
                        <div class="alert alert-warning" role="alert">
                            <h5 class="mb-0 font-weight-bold">
                                <i class="fa fa-sad-tear"></i>&nbsp;&nbsp;Belum Melakukan Verifikasi Pembayaran
                            </h5>
                            <h5 class="mt-1 mb-0">Silahkan Verifikasi Di <br></h5>
                            <a href="" class="btn btn-success text-decoration-none">Halaman Verifikasi Pembayaran</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
