@extends('layouts.siswaLayout')
@section('title', 'DataDiri')
@section('content')
    <div class="container  d-flex flex-column  mt-3" style="min-height: 80vh">
        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading"><i class="fas fa-exclamation-triangle"></i>&nbsp;Perhatian!</h4>
            <p>Data Hanya Bisa Diedit Ketika Status Pendaftaran <span class="alert-link">Pending</span>.</p>
            <p>Selain Pending Maka Data Diri Akan Dikunci Permanen!</p>
            <hr>
            <p class="mb-0">Bila Butuh Bantuan Silahkan Hubungi +6283185742207</p>
        </div>
        <div class="cardcont">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="font-weight-bold">
                        <i class="fas fa-user"></i> Data Diri
                    </h5>
                </div>
                <div class="card-body">
                    <form action="#" id="target" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Data Siswa -->
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="nama_siswa">Nama Lengkap Siswa</label>
                                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa"
                                    value="{{ old('nama_siswa', auth_user()->nama) }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', auth_user()->email) }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="no_hp">No HP</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp"
                                    value="{{ old('no_hp', auth_user()->no_hp) }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="asal_sekolah">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Bila Tidak Ingin Diganti Maka Biarlah Kosong">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="asal_sekolah">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    placeholder="Bila Tidak Ingin Diganti Maka Biarlah Kosong" name="password_confirmation">
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="">Pilih</option>
                                    <option value="Laki-laki"
                                        {{ old('jenis_kelamin', auth_user()->jenis_kelamin) == 'Laki-Laki' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="Perempuan"
                                        {{ old('jenis_kelamin', auth_user()->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="agama">Agama</label>
                                <select class="form-control" id="agama" name="agama">
                                    <option value="">Pilih</option>
                                    <option value="Islam"
                                        {{ old('agama', auth_user()->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen Protestan"
                                        {{ old('agama', auth_user()->agama) == 'Kristen Protestan' ? 'selected' : '' }}>
                                        Kristen Protestan</option>
                                    <option value="Katolik"
                                        {{ old('agama', auth_user()->agama) == 'Katolik' ? 'selected' : '' }}>Katolik
                                    </option>
                                    <option value="Hindu"
                                        {{ old('agama', auth_user()->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha"
                                        {{ old('agama', auth_user()->agama) == 'Buddha' ? 'selected' : '' }}>Buddha
                                    </option>
                                    <option value="Konghucu"
                                        {{ old('agama', auth_user()->agama) == 'konghucu' ? 'selected' : '' }}>Konghucu
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="jalur_pendaftaran">Jalur Pendaftaran</label>
                                <select class="form-control" id="jalur_pendaftaran" name="jalur_pendaftaran">
                                    <option value="">Pilih</option>
                                    <option value="Reguler"
                                        {{ old('jalur_pendaftaran', auth_user()->jalur_pendaftaran) == 'Reguler' ? 'selected' : '' }}>
                                        Reguler</option>
                                    <option value="RMP"
                                        {{ old('jalur_pendaftaran', auth_user()->jalur_pendaftaran) == 'RMP' ? 'selected' : '' }}>
                                        RMP</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="id_jurusan">Jurusan</label>
                                <select class="form-control" id="id_jurusan" name="id_jurusan">
                                    <option value="">Pilih Jurusan</option>
                                    @foreach ($listJurusan as $j)
                                        <option value="{{ $j->id }}"
                                            {{ old('id_jurusan', auth_user()->id_jurusan) == $j->id ? 'selected' : '' }}>
                                            {{ $j->nama_jurusan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- MGM (Member Get Member) -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="asal_sekolah">Asal Sekolah</label>
                                <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah"
                                    value="{{ old('asal_sekolah', auth_user()->asal_sekolah) }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="mgm">MGM</label>
                                <select class="form-control" id="mgm" name="mgm">
                                    <option value="">Pilih</option>
                                    <option value="1" {{ old('mgm', auth_user()->mgm) == 1 ? 'selected' : '' }}>Ya
                                    </option>
                                    <option value="0" {{ old('mgm', auth_user()->mgm) == 0 ? 'selected' : '' }}>Tidak
                                    </option>
                                </select>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6" id="nama_mgm_group" style="display: none">
                                <label for="nama_mgm">Nama MGM</label>
                                <input type="text" class="form-control" id="nama_mgm" name="nama_mgm"
                                    value="{{ old('nama_mgm', auth_user()->nama_mgm) }}">
                            </div>
                            <div class="form-group col-md-6" id="asal_mgm_group" style="display: none">
                                <label for="asal_mgm">Keterangan MGM</label>
                                <input type="text" class="form-control" id="asal_mgm" name="asal_mgm"
                                    value="{{ old('asal_mgm', auth_user()->asal_mgm) }}">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="font-weight-bold">
                        <i class="fas fa-user-cog"></i> Data diri Tambahan
                    </h5>
                </div>
                <div class="card-body">
                    <form action="#" id="target2" method="post">
                        @csrf
                        <!-- Data Siswa -->
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="isAbk">Anak Berkebutuhan Khusus ?</label>
                                <select class="form-control" id="isAbk" name="isAbk">
                                    <option value="">Pilih</option>
                                    <option value="1"{{ old('isAbk', $dataTambahan->isAbk) == 1 ? 'selected' : '' }}>
                                        Ya
                                    </option>
                                    <option value="0"
                                        {{ old('isAbk', $dataTambahan->isAbk) == 0 ? 'selected' : '' }}>Tidak
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" name="alamat" id="alamat" cols="5" rows="3"> {{ old('alamat', $dataTambahan->alamat) }}</textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="{{old('tempat_lahir', $dataTambahan->tempat_lahir)}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{old('tanggal_lahir', $dataTambahan->tanggal_lahir)}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="nama_orang_tua">Nama Orang Tua/Wali</label>
                                <input type="text" name="nama_orang_tua" id="nama_orang_tua" class="form-control" value="{{old('nama_orang_tua', $dataTambahan->nama_orang_tua)}}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="alamat_orang_tua">Alamat Orang Tua/Wali</label>
                                <textarea class="form-control" name="alamat_orang_tua" id="alamat_orang_tua" cols="5" rows="3">{{old('alamat_orang_tua', $dataTambahan->alamat_orang_tua)}}</textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="no_hp_orang_tua">Nomor Hp Orang Tua/Wali</label>
                                <input type="text" name="no_hp_orang_tua" id="no_hp_orang_tua" class="form-control" value="{{old('no_hp_orang_tua', $dataTambahan->no_hp_orang_tua)}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pekerjaan_orang_tua">Pekerjaan Orang Tua/Wali</label>
                                <input type="text" name="pekerjaan_orang_tua" id="pekerjaan_orang_tua"
                                    class="form-control" value="{{old('pekerjaan_orang_tua', $dataTambahan->pekerjaan_orang_tua)}}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="module">
        $(function() {
            function toggleMGMFields() {
                const selected = $('#mgm').val();
                if (selected === '1') {
                    $('#nama_mgm_group, #asal_mgm_group').show();
                } else {
                    $('#nama_mgm_group, #asal_mgm_group').hide();
                    $('#nama_mgm, #asal_mgm').val(''); // Kosongkan input jika disembunyikan
                }
            }

            // Jalankan saat halaman pertama kali dimuat
            toggleMGMFields();

            // Jalankan saat nilai dropdown berubah
            $('#mgm').on('change', function() {
                toggleMGMFields();
            });

            $('#target').submit(function(e) {
                e.preventDefault();
                let url = "{{ route('siswa.data.update') }}";
                let method = "PUT";

                $.ajax({
                    url: url,
                    method: method,
                    data: {
                        nama_siswa: $('#nama_siswa').val(),
                        email: $('#email').val(),
                        no_hp: $('#no_hp').val(),
                        password: $('#password').val(),
                        jenis_kelamin: $('#jenis_kelamin').val(),
                        agama: $('#agama').val(),
                        jalur_pendaftaran: $('#jalur_pendaftaran').val(),
                        id_jurusan: $('#id_jurusan').val(),
                        asal_sekolah: $('#asal_sekolah').val(),
                        mgm: $('#mgm').val(),
                        nama_mgm: $('#nama_mgm').val(),
                        asal_mgm: $('#asal_mgm').val(),
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(function() {
                            location.reload(); // Refresh halaman setelah berhasil
                        }, 2000);

                    },
                    error: function(res) {
                        console.log(res)
                        Swal.fire('Error', 'Terjadi kesalahan, coba lagi!', 'error');
                    }
                });
            });
        });
        $('#target2').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('siswa.data.upsertDataTambahan') }}', // URL ke route yang sesuai
                method: 'POST',
                data: {
                    isAbk: $('#isAbk').val(),
                    alamat: $('#alamat').val(),
                    tempat_lahir: $('#tempat_lahir').val(),
                    tanggal_lahir: $('#tanggal_lahir').val(),
                    nama_orang_tua: $('#nama_orang_tua').val(),
                    alamat_orang_tua: $('#alamat_orang_tua').val(),
                    no_hp_orang_tua: $('#no_hp_orang_tua').val(),
                    pekerjaan_orang_tua: $('#pekerjaan_orang_tua').val(),
                    _token: "{{ csrf_token() }}" // Token CSRF untuk keamanan
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    setTimeout(function() {
                        location.reload(); // Refresh halaman setelah berhasil
                    }, 2000);
                },
                error: function(res) {
                    console.log(res);
                    Swal.fire('Error', 'Terjadi kesalahan, coba lagi!', 'error');
                }
            });
        })
        @if (auth_user()->isAccepted == 1)
            $("#target :input").prop("disabled", true);
            $("#target2 :input").prop("disabled", true);
        @endif
    </script>
@endsection
