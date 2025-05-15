@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Manajemen Jurusan') }}</h1>
                    <button class="btn btn-success mt-2" id="inputUserBtn">Tambah Jurusan</button>
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
                                        <th>Nama Jurusan</th>
                                        <th>SPP</th>
                                        <th>DSP</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jurusans as $j)
                                        <tr>
                                            <td>{{ $j->nama_jurusan }}</td>
                                            <td>{{ rupiah($j->spp) }}</td>
                                            <td>{{ rupiah($j->dsp) }}</td>
                                            <td><button class="btn btn-primary editUserBtn" data-id="{{ $j->id }}"
                                                    data-nama="{{ $j->nama_jurusan }}" data-spp="{{ $j->spp }}"
                                                    data-dsp="{{ $j->dsp }}">
                                                    Edit</button>
                                                <button class="btn btn-danger delUserBtn"
                                                    data-id="{{ $j->id }}">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="userModalLabel">Tambah Jurusan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="userForm">
                                    <div class="modal-body">
                                        <input type="hidden" id="user_id">
                                        <div class="form-group">
                                            <label for="nama">Nama Jurusan</label>
                                            <input type="text" class="form-control" id="nama" name="nama"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="spp">SPP</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                </div>
                                                <input type="text"inputmode="numeric" class="form-control" id="spp"
                                                    name="spp" required>
                                            </div>

                                        </div>
                                         <div class="form-group">
                                            <label for="dsp">DSP</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                </div>
                                                <input type="text"inputmode="numeric" class="form-control" id="dsp"
                                                    name="dsp" required>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
@section('scripts')
    <script type="module">
        $(document).ready(function() {
            let table = $('#usersTable').DataTable({
                responsive: true
            });
            // Tampilkan Modal Tambah Kelas
            $('#inputUserBtn').click(function() {
                $('#user_id').val('');
                $('#nama').val('');
                $('#spp').val('');
                $('#dsp').val('');
                $('#userModalLabel').text('Tambah Jurusan');
                $('#userModal').modal('show');
            });

            // Simpan atau Update Kelas
            $('#userForm').submit(function(e) {
                e.preventDefault();
                let id = $('#user_id').val();
                let url = id ? `jurusan/${id}` : "{{ route('jurusan.store') }}";
                let method = id ? "PUT" : "POST";

                $.ajax({
                    url: url,
                    method: method,
                    data: {
                        nama: $('#nama').val(),
                        spp: $('#spp').val(),
                        dsp: $('#dsp').val(),
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
                            location.reload(); // Refresh halaman setelah berhasil
                        }, 2000);

                    },
                    error: function(res) {
                        console.log(res)
                        Swal.fire('Error', 'Terjadi kesalahan, coba lagi!', 'error');
                    }
                });
            });
            //
            // Tampilkan Modal Edit Kelas
            $(document).on('click', '.editUserBtn', function() {
                let id = $(this).data('id');
                let nama = $(this).data('nama');
                let spp = $(this).data('spp');
                let dsp = $(this).data('dsp');


                $('#user_id').val(id);
                $('#nama').val(nama);
                $('#spp').val(Math.round(spp));
                $('#dsp').val(Math.round(dsp));
                $('#userModalLabel').text('Edit Jurusan');
                $('#userModal').modal('show');
            });

            // Delete Action
            $(document).on('click', '.delUserBtn', function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `jurusan/${id}`,
                            method: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });

                                setTimeout(function() {
                                    location
                                        .reload(); // Refresh halaman setelah berhasil
                                }, 2000);
                            },
                            error: function(r) {
                                console.log(r)
                                Swal.fire("Gagal!", "Terjadi kesalahan, coba lagi!",
                                    "error");
                            }
                        });
                    }
                });
            })
        })
    </script>
@endsection
