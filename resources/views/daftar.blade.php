<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar | {{ config('app.name', 'Laravel') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/icb.png') }}" type="image/x-icon">

</head>

<body class="bg-primary">
    @include('sweetalert::alert')

    <main class="container mx-auto my-2">
        <div class="main-content p-3 bg-white rounded shadow-lg w-full">
            <div class="container mt-5">
                <img src="{{ asset('images/icb.png') }}"width="100" height="100" class="img-fluid">
                <h1 class="mt-4 font-bold text-blue-700">Formulir Pendaftaran</h1>


                <form action="{{ route('siswa.daftar.post') }}" method="POST" enctype="multipart/form-data"
                    class="needs-validation" novalidate>
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
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ttl">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="ttl" name="ttl" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
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
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="asal_sekolah">Asal Sekolah</label>
                            <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" required>
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
                            <label for="jurusan">Jurusan</label>
                            <select class="form-control" id="jurusan" name="jurusan" required>
                                <option value="">Pilih Jurusan</option>
                                <option value="TKR">TKR (Teknik Kendaraan Ringan)</option>
                                <option value="TSM">TSM (Teknik Sepeda Motor)</option>
                                <option value="RPL">RPL (Rekayasa Perangkat Lunak)</option>
                                <option value="TKJ">TKJ (Teknik Komputer dan Jaringan)</option>
                                <option value="FAR">FAR (Farmasi)</option>
                                <option value="KEP">KEP (Asisten Keperawatan)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="no_hp">No HP</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="abk">Anak Berkebutuhan Khusus?</label>
                            <select class="form-control" id="abk" name="abk" required>
                                <option value="">Pilih</option>
                                <option value="Y">Ya</option>
                                <option value="N">Tidak</option>
                            </select>
                        </div>
                    </div>

                    <!-- Informasi Orang Tua/Wali -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nama_ortu_wali">Nama Orang Tua/Wali</label>
                            <input type="text" class="form-control" id="nama_ortu_wali" name="nama_ortu_wali"
                                required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="alamat_wali">Alamat Orang Tua/Wali</label>
                            <textarea class="form-control" id="alamat_wali" name="alamat_wali" required></textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="pekerjaan_wali">Pekerjaan Orang Tua/Wali</label>
                            <input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali"
                                required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="no_hp_wali">No HP Orang Tua/Wali</label>
                            <input type="text" class="form-control" id="no_hp_wali" name="no_hp_wali" required>
                        </div>
                    </div>

                    <!-- MGM (Member Get Member) -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="mgm">MGM</label>
                            <select class="form-control" id="mgm" name="mgm" required>
                                <option value="">Pilih</option>
                                <option value="Y">Ya</option>
                                <option value="N">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6" id="nama_mgm_group">
                            <label for="nama_mgm">Nama MGM</label>
                            <input type="text" class="form-control" id="nama_mgm" name="nama_mgm">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12" id="asal_mgm_group">
                            <label for="asal_mgm">Keterangan MGM</label>
                            <input type="text" class="form-control" id="asal_mgm" name="asal_mgm">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Daftar</button>
                </form>
            </div>
        </div>
    </main>

</body>
@vite('resources/js/app.js')
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}" defer></script>
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

        if (mgmValue === 'N') {
            namaMgmGroup.style.display = 'none';
            asalMgmGroup.style.display = 'none';
        } else {
            namaMgmGroup.style.display = 'block';
            asalMgmGroup.style.display = 'block';
        }
    });
</script>

</html>
