@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Verifikasi Siswa') }}</h1>
                    {{-- <button class="btn btn-success mt-2" id="inputUserBtn">Tambah User</button> --}}
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    {{-- <div class="alert alert-info">
                        Sample table page
                    </div> --}}

                    <div class="card">
                        <div class="card-body p-2">

                            <table class="table" id="usersTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nis</th>
                                        <th>Nama Siswa</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Asal Sekolah</th>
                                        <th>Jurusan Yang Dipilih</th>
                                        <th>Jalur Pendaftaran</th>
                                        <th>MGM</th>
                                        <th>Nama MGM</th>
                                        <th>Keterangan MGM</th>
                                        <th>Tanggal Daftar</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datasis as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->nis ?? 'Belum Ada' }}</td>
                                            <td>{{ $user->nama }}</td>
                                            <td>{{ ucwords($user->dataTambahan->tempat_lahir ?? 'Belum Diisi') }}</td>
                                            <td>{{ $user->dataTambahan->tanggal_lahir ?? 'belum Diisi' }}</td>
                                            <td>{{ $user->asal_sekolah }}</td>
                                            <td>{{ $user->jurusan->nama_jurusan }}</td>
                                            <td>{{ $user->jalur_pendaftaran }}</td>
                                            <td>{{ $user->mgm ? ' Ya' : 'Tidak' }}</td>
                                            <td>{{ $user->nama_mgm ?? 'Tidak Ada' }}</td>
                                            <td>{{ $user->asal_mgm ?? 'Tidak Ada' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($user->created_at)->locale('id')->translatedFormat('d F Y') }}
                                            <td>
                                                <p
                                                    class="@switch($user->status)
                                                        @case('Diterima')
                                                                badge
                                                                bg-success
                                                                @break
                                                            @case('Pending')
                                                                badge
                                                                bg-warning
                                                                @break
                                                            @case('Ditolak')
                                                                badge
                                                                bg-danger
                                                                @break
                                                            @default
                                                                badge
                                                                bg-muted
                                                        @endswitch">
                                                    {{ $user->status }}</p>
                                            </td>
                                            </td>
                                            <td>
                                                <div>
                                                    @switch($user->status)
                                                        @case('Diterima')
                                                        @break

                                                        @case('Ditolak')
                                                            <button class="btn btn-danger btn-md delUserBtn"
                                                                data-id="{{ $user->id }}">
                                                                Hapus Semua Data Siswa!
                                                            </button>
                                                        @break

                                                        @default
                                                            <button class="btn btn-success btn-md editUserBtn"
                                                                data-id="{{ $user->id }}">
                                                                Terima
                                                            </button>
                                                            <button class="btn btn-danger btn-md delUserBtn"
                                                                data-id="{{ $user->id }}">
                                                                Tolak
                                                            </button>
                                                    @endswitch

                                                    <button class="btn btn-info btn-md seeDetailBtn"
                                                        data-id="{{ $user->id }}">
                                                        Lihat Data Lengkap
                                                    </button>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Modal Detail Siswa -->
    <div class="modal fade" id="detailSiswaModal" tabindex="-1" aria-labelledby="detailSiswaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailSiswaModalLabel">Detail Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Nama</th>
                                <td id="detail-nama"></td>
                            </tr>
                            <tr>
                                <th>Tempat Lahir</th>
                                <td id="detail-tempat-lahir"></td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                                <td id="detail-tanggal-lahir"></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td id="detail-alamat"></td>
                            </tr>
                            <tr>
                                <th>Nama Orang Tua</th>
                                <td id="detail-nama-ortu"></td>
                            </tr>
                            <tr>
                                <th>Pekerjaan Orang Tua</th>
                                <td id="detail-pekerjaan-ortu"></td>
                            </tr>
                            <tr>
                                <th>No HP Orang Tua</th>
                                <td id="detail-nohp-ortu"></td>
                            </tr>
                            <tr>
                                <th>Alamat Orang Tua</th>
                                <td id="detail-alamat-ortu"></td>
                            </tr>
                            {{-- <tr>
                                <th>DTKS</th>
                                <td id="detail-alamat-ortu"></td>
                            </tr>
                            <tr>
                                <th>Kip</th>
                                <td id="detail-alamat-ortu"></td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- /.content -->
@endsection
@section('scripts')
    <script type="module">
        $(document).ready(function() {
            let table = $('#usersTable').DataTable({
                responsive: true
            });

            $(document).on('click', '.seeDetailBtn', function() {
                const id = $(this).data('id');
                $.ajax({
                    url: 'verifsiswa/detail/' + id,
                    method: 'GET',
                    success: function(res) {
                        $('#detail-nama').text(res.nama);
                        $('#detail-tempat-lahir').text(res.data_tambahan?.tempat_lahir ??
                            'Belum Diisi');
                        $('#detail-tanggal-lahir').text(res.data_tambahan?.tanggal_lahir ??
                            'Belum Diisi');
                        $('#detail-alamat').text(res.data_tambahan?.alamat ?? 'Belum Diisi');
                        $('#detail-nama-ortu').text(res.data_tambahan?.nama_orang_tua ??
                            'Belum Diisi');
                        $('#detail-pekerjaan-ortu').text(res.data_tambahan
                            ?.pekerjaan_orang_tua ?? 'Belum Diisi');
                        $('#detail-nohp-ortu').text(res.data_tambahan?.no_hp_orang_tua ??
                            'Belum Diisi');
                        $('#detail-alamat-ortu').text(res.data_tambahan?.alamat_orang_tua ??
                            'Belum Diisi');

                        $('#detailSiswaModal').modal('show');
                    },
                    error: function() {
                        alert('Gagal mengambil data siswa.');
                    }
                });
            });
            // Tampilkan Modal Edit Kelas
            $(document).on('click', '.editUserBtn', function() {
                let id = $(this).data('id');
                SwalHelper.showConfirm('Apakah Anda Yakin? Bila Sudah Di Terima Tidak Bisa Diubah Lagi')
                    .then((res) => {
                        if (res.isConfirmed) {
                            $.ajax({
                                url: "{{ route('verifSiswa.approveStatus') }}",
                                method: "POST",
                                data: {
                                    siswa_id: id,
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
                                        location
                                            .reload(); // Refresh halaman setelah berhasil
                                    }, 2000);

                                },
                                error: function(res) {
                                    console.log(res)
                                    Swal.fire('Error', 'Terjadi kesalahan, coba lagi!',
                                        'error');
                                }
                            });
                        }
                    })
            });
            $(document).on('click', '.inputUlangBtn', function() {
                let id = $(this).data('id');
                SwalHelper.showConfirm('Apakah Anda Yakin? Tidak Bisa Diubah Lagi')
                    .then((res) => {
                        if (res.isConfirmed) {
                            $.ajax({
                                url: `verifsiswa/${id}`,
                                method: "DELETE",
                                data: {
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
                                        location
                                            .reload(); // Refresh halaman setelah berhasil
                                    }, 2000);

                                },
                                error: function(res) {
                                    console.log(res)
                                    Swal.fire('Error', 'Terjadi kesalahan, coba lagi!',
                                        'error');
                                }
                            });
                        }
                    })
            });

            // Delete Action
            $(document).on('click', '.delUserBtn', function() {
                let id = $(this).data('id');
                let url = "{{ route('verifSiswa.notApproveStatus') }}";
                let method = "POST";
                SwalHelper.showConfirm('Apakah Anda Yakin? Data Tidak Bisa Diubah Lagi')
                    .then((res) => {
                        if (res.isConfirmed) {
                            $.ajax({
                                url: url,
                                method: method,
                                data: {
                                    siswa_id: id,
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
                                        $('#userModal').modal('hide');
                                        location
                                            .reload(); // Refresh halaman setelah berhasil
                                    }, 2000);

                                },
                                error: function(res) {
                                    console.log(res)
                                    Swal.fire('Error', 'Terjadi kesalahan, coba lagi!',
                                        'error');
                                }
                            });
                        }
                    })
            })


        })
    </script>
@endsection
