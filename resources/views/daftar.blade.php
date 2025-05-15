@extends('layouts.siswaLayout')
@section('title', 'Daftar')
@section('content')

    <main class="container mx-auto my-2">
        <div class="main-content p-3 bg-white rounded shadow-lg w-full">
            <div class="container mt-5">
                <img src="{{ asset('images/icb.png') }}"width="100" height="100" class="img-fluid">
                <h1 class="mt-4 font-bold text-blue-700">Formulir Pendaftaran</h1>


                <form action="{{route('siswa.daftar.post')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf

                    <!-- Data Siswa -->
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="nama_siswa">Nama Lengkap Siswa</label>
                            <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="no_hp">No HP</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="asal_sekolah">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="asal_sekolah">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" required>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="">Pilih</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="agama">Agama</label>
                            <select class="form-control" id="agama" name="agama" required>
                                <option value="">Pilih</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen Protestan">Kristen Protestan</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="jalur_pendaftaran">Jalur Pendaftaran</label>
                            <select class="form-control" id="jalur_pendaftaran" name="jalur_pendaftaran" required>
                                <option value="">Pilih</option>
                                <option value="Reguler">Reguler</option>
                                <option value="RMP">RMP</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="payment_type">Pembayaran</label>
                            <select class="form-control" id="payment_type" name="payment_type" required>
                                <option value="">Pilih Pembayaran</option>
                                <option value="cash">Bayar Di Sekolah</option>
                                <option value="transfer">Bayar Mandiri (Transfer)</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row" style="display: none" id="berkas_tambahan">
                        <div class="form-group ">
                            <label for="dtks">Upload Berkas DTKS</label>
                            <input type="file" name="dtks" accept="image/*" id="dtks" class="form-control">
                        </div>
                        <div class="form-group ">
                            <label for="kip">Upload Kartu Indonesia Pintar (KIP)</label>
                            <input type="file" name="kip" accept="image/*" id="kip" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="id_jurusan">Jurusan</label>
                            <select class="form-control" id="id_jurusan" name="id_jurusan" required>
                                <option value="">Pilih Jurusan</option>
                                @foreach ($listJurusan as $j)
                                    <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- MGM (Member Get Member) -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="asal_sekolah">Asal Sekolah</label>
                            <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mgm">MGM</label>
                            <select class="form-control" id="mgm" name="mgm" required>
                                <option value="">Pilih</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6" id="nama_mgm_group" style="display: none">
                            <label for="nama_mgm">Nama MGM</label>
                            <input type="text" class="form-control" id="nama_mgm" name="nama_mgm">
                        </div>
                        <div class="form-group col-md-6" id="asal_mgm_group" style="display: none">
                            <label for="asal_mgm">Keterangan MGM</label>
                            <input type="text" class="form-control" id="asal_mgm" name="asal_mgm">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Daftar</button>
                </form>
            </div>
        </div>
    </main>
@endsection
<!-- AdminLTE App -->
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'Tutup'
            });
            setTimeout(() => {
                window.location.href = '{{ route('siswa.masuk') }}'
            }, 2000);
        @endif
        (function() {
            'use strict'
            // Cegah pengiriman form jika ada input yang tidak valid
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
        document.getElementById('mgm').addEventListener('change', function() {
            var mgmValue = this.value;
            var namaMgmGroup = document.getElementById('nama_mgm_group');
            var asalMgmGroup = document.getElementById('asal_mgm_group');

            if (mgmValue === "0") {
                namaMgmGroup.style.display = 'none';
                asalMgmGroup.style.display = 'none';
            } else {
                namaMgmGroup.style.display = 'block';
                asalMgmGroup.style.display = 'block';
            }
        });
        document.getElementById('jalur_pendaftaran').addEventListener('change', function() {
            var v = this.value;
            var btbhn = document.getElementById('berkas_tambahan');
            var dtks = document.getElementById('dtks');
            var kip = document.getElementById('kip');
            if (v === "RMP") {
                btbhn.style.display = 'block';
                kip.required = true
                dtks.required = true
            } else {
                btbhn.style.display = 'none';
                kip.required = false
                dtks.required = false
            }
        });
    </script>
@endsection
