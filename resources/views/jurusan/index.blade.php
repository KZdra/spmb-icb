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
                                        <tr id="row-jurusan-{{ $j->id }}">
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

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true
                });

                const formatRupiah = (val) => 'Rp. ' + new Intl.NumberFormat('id-ID').format(Math.round(val));

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
                        $('#userModal').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: response.message
                        });

                        const d = response.data || {
                            id: id,
                            nama_jurusan: $('#nama').val(),
                            spp: $('#spp').val(),
                            dsp: $('#dsp').val()
                        };

                        const actionBtn = `
                            <button class="btn btn-primary editUserBtn" data-id="${d.id}"
                                data-nama="${d.nama_jurusan}" data-spp="${d.spp}"
                                data-dsp="${d.dsp}">Edit</button>
                            <button class="btn btn-danger delUserBtn"
                                data-id="${d.id}">Delete</button>
                        `;

                        if (id) {
                            // Update existing row (NO RELOAD!)
                            const rowEl = $(`#row-jurusan-${id}`);
                            if (rowEl.length) {
                                table.row(rowEl).data([
                                    d.nama_jurusan,
                                    formatRupiah(d.spp),
                                    formatRupiah(d.dsp),
                                    actionBtn
                                ]).draw(false);
                            }
                        } else {
                            // Add new row (NO RELOAD!)
                            const newRowNode = table.row.add([
                                d.nama_jurusan,
                                formatRupiah(d.spp),
                                formatRupiah(d.dsp),
                                actionBtn
                            ]).draw(false).node();
                            $(newRowNode).attr('id', `row-jurusan-${d.id}`);
                        }
                    },
                    error: function(res) {
                        Swal.fire('Error', res.responseJSON?.message || 'Terjadi kesalahan, coba lagi!', 'error');
                    }
                });
            });

            // Tampilkan Modal Edit Jurusan
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

            // Delete Action (NO RELOAD!)
            $(document).on('click', '.delUserBtn', function() {
                let id = $(this).data('id');
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true
                });

                Swal.fire({
                    title: "Hapus Jurusan?",
                    text: "Data jurusan ini akan dihapus permanen!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `jurusan/${id}`,
                            method: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                Toast.fire({
                                    icon: 'success',
                                    title: response.message
                                });
                                // Remove row from DataTable immediately (NO RELOAD!)
                                table.row($(`#row-jurusan-${id}`)).remove().draw(false);
                            },
                            error: function(r) {
                                Swal.fire("Gagal!", r.responseJSON?.message || "Terjadi kesalahan, coba lagi!", "error");
                            }
                        });
                    }
                });
            });
        })
    </script>
@endsection
