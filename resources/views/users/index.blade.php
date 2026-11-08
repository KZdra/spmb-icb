@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Manajemen User') }}</h1>
                    <button class="btn btn-success mt-2" id="inputUserBtn">Tambah User</button>
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
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr id="row-user-{{ $user->id }}">
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ ucwords($user->role->name ?? 'User') }}</td>
                                            <td><button class="btn btn-primary editUserBtn" data-id="{{ $user->id }}"
                                                    data-role_id="{{ $user->role_id }}" data-nama="{{ $user->name }}"
                                                    data-email="{{ $user->email }}">
                                                    Edit</button>
                                                <button class="btn btn-danger delUserBtn"
                                                    data-id="{{ $user->id }}">Delete</button>
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
                                    <h5 class="modal-title" id="userModalLabel">Tambah User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="userForm">
                                    <div class="modal-body">
                                        <input type="hidden" id="user_id">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="role_id">Role</label>
                                            <select name="role_id" id="role_id" class="form-control">
                                                <option value="" disabled selected> Pilih Role</option>
                                                @foreach ($rolesList as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password">
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
                $('#role_id').val('');
                $('#nama').val('');
                $('#email').val('');
                $('#password').val('');
                $('#userModalLabel').text('Tambah User');
                $('#userModal').modal('show');
            });

            // Simpan atau Update Kelas
            $('#userForm').submit(function(e) {
                e.preventDefault();
                let id = $('#user_id').val();
                let url = id ? `users/${id}` : "{{ route('users.store') }}";
                let method = id ? "PUT" : "POST";

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true
                });

                $.ajax({
                    url: url,
                    method: method,
                    data: {
                        role_id: $('#role_id').val(),
                        nama: $('#nama').val(),
                        email: $('#email').val(),
                        password: $('#password').val(),
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
                            name: $('#nama').val(),
                            email: $('#email').val(),
                            role_id: $('#role_id').val(),
                            role_name: $('#role_id option:selected').text()
                        };

                        const actionBtn = `
                            <button class="btn btn-primary editUserBtn" data-id="${d.id}"
                                data-role_id="${d.role_id}" data-nama="${d.name}"
                                data-email="${d.email}">Edit</button>
                            <button class="btn btn-danger delUserBtn"
                                data-id="${d.id}">Delete</button>
                        `;

                        if (id) {
                            // Update existing row (NO RELOAD!)
                            const rowEl = $(`#row-user-${id}`);
                            if (rowEl.length) {
                                table.row(rowEl).data([
                                    d.name,
                                    d.email,
                                    d.role_name,
                                    actionBtn
                                ]).draw(false);
                            }
                        } else {
                            // Add new row (NO RELOAD!)
                            const newRowNode = table.row.add([
                                d.name,
                                d.email,
                                d.role_name,
                                actionBtn
                            ]).draw(false).node();
                            $(newRowNode).attr('id', `row-user-${d.id}`);
                        }
                    },
                    error: function(res) {
                        Swal.fire('Error', res.responseJSON?.message || 'Terjadi kesalahan, coba lagi!', 'error');
                    }
                });
            });

            // Tampilkan Modal Edit User
            $(document).on('click', '.editUserBtn', function() {
                let id = $(this).data('id');
                let role_id = $(this).data('role_id');
                let nama = $(this).data('nama');
                let email = $(this).data('email');

                $('#user_id').val(id);
                $('#role_id').val(role_id);
                $('#nama').val(nama);
                $('#email').val(email);
                $('#password').val('');
                $('#userModalLabel').text('Edit User');
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
                    title: "Hapus User?",
                    text: "User ini akan dihapus permanen dari sistem!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `users/${id}`,
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
                                table.row($(`#row-user-${id}`)).remove().draw(false);
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
