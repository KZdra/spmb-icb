@extends('layouts.siswaLayout')
@section('title', 'Dashboard')
@section('content')
    <div class="container  d-flex flex-column  mt-3" style="min-height: 80vh">
        <div class="mb-4">
            <h2 class="font-weight-bold">Hello👋!, {{auth_user()->nama}}</h2>
            <p>Silahkan Pilih Menu Dibawah ini</p>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <a href="{{route('siswa.datadiri')}}" class="text-decoration-none text-white">
                    <div class="card bg-primary h-100">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h4 class="card-title mb-0"> <i class="fas fa-user-edit"></i>&nbsp;Lengkapi Data Diri</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{route('siswa.pembayaran.index')}}" class="text-decoration-none text-white">
                    <div class="card bg-primary h-100">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h4 class="card-title mb-0"><i class="fas fa-wallet"></i>&nbsp;Pembayaran</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{route('siswa.pendaftaran.index')}}" class="text-decoration-none text-white">
                    <div class="card bg-primary h-100">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h4 class="card-title mb-0"><i class="fas fa-user-check"></i>&nbsp;Status Pendaftaran</h4>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>
@endsection
