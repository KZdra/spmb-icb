@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Verifikasi Pembayaran') }}</h1>
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
                            <div class="mb-3">
                                <select id="statusFilter" class="form-control w-25">
                                    <option value="">-- Semua Status --</option>
                                    <option value="Verified">Diverifikasi</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Rejected">Ditolak</option>
                                    <option value="Waiting Upload">Pembayaran Transfer</option>
                                    <option value="Waiting Cash">Pembayaran Cash</option>
                                </select>
                            </div>
                            <table class="table" id="usersTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Siswa</th>
                                        <th>Nama Rekening</th>
                                        <th>Nominal Bayar</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Pembayaran Via</th>
                                        <th>Status</th>
                                        <th>foto Bukti Pembayaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->nama_siswa }}</td>
                                            <td>{{ $user->account_name ?? 'Belum Diisi' }}</td>
                                            <td>{{ rupiah($user->amount) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($user->payment_date)->locale('id')->translatedFormat('d F Y') }}
                                            <td>{{ $user->payment_type == 'cash' ? 'Bayar Di Sekolah' : 'Bayar Mandiri (transfer bank)' }}
                                            <td>
                                                @switch($user->status)
                                                    @case('verified')
                                                        <p class="badge bg-success">
                                                            <i class="fas fa-check-circle"></i> Verified
                                                        </p>
                                                    @break

                                                    @case('pending')
                                                        <p class="badge bg-warning text-dark">
                                                            <i class="fas fa-clock"></i> Pending
                                                        </p>
                                                    @break

                                                    @case('rejected')
                                                        <p class="badge bg-danger">
                                                            <i class="fas fa-times-circle"></i> Rejected
                                                        </p>
                                                    @break

                                                    @case('waiting_upload')
                                                        <p class="badge bg-secondary">
                                                            <i class="fas fa-upload"></i> Waiting Upload
                                                        </p>
                                                    @break

                                                    @case('waiting_cash')
                                                        <p class="badge bg-info">
                                                            <i class="fas fa-hand-holding-usd"></i> Waiting Cash
                                                        </p>
                                                    @break
                                                @endswitch
                                            </td>
                                            </td>
                                            <td id="viewer-container">
                                                @if ($user->file_path)
                                                    <img src="{{ asset('storage/' . $user->file_path) }}"
                                                        id="{{ 'foto' . $user->id }}" class="img-thumbnail viewer-item"
                                                        width="200" height="200"
                                                        onclick="MakeViewer('{{ 'foto' . $user->id }}')">
                                                @else
                                                    <p>Tidak Ada Bukti!</p>
                                                @endif

                                            </td>
                                            <td>
                                                @switch($user->status)
                                                    @case('verified')
                                                        <p class="font-weight-bold badge bg-success">Telah DiVerifikasi!</p>
                                                    @break

                                                    @case('rejected')
                                                        <p class="font-weight-bold badge bg-danger">Telah Ditolak!</p>
                                                        <button class="btn btn-success inputUlangBtn"
                                                            data-id="{{ $user->id }}">
                                                            Input Ulang</button>
                                                    @break

                                                    @case('waiting_cash')
                                                        <button class="btn btn-success mb-1 uploadUserBtn"
                                                            data-id="{{ $user->id }}">
                                                            Input Bukti Pembayaran</button>
                                                    @break

                                                    @case('waiting_upload')
                                                        <p class="font-weight-bold badge bg-success">Bukti Belum Di Upload!</p>
                                                    @break

                                                    @default
                                                        <button class="btn btn-success editUserBtn" data-id="{{ $user->id }}">
                                                            Terima</button>
                                                        <button class="btn btn-danger delUserBtn"
                                                            data-id="{{ $user->id }}">Tolak</button>
                                                @endswitch
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
                                    <h5 class="modal-title" id="userModalLabel">Alasan Di Tolak?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="userForm">
                                    <div class="modal-body">
                                        <input type="hidden" id="user_id">
                                        <div class="form-group">
                                            <label for="alasan">Alasan</label>
                                            <input type="text" class="form-control" id="alasan" name="alasan"
                                                required>
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
                    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog"
                        aria-labelledby="uploadModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="uploadModalLabel">Input Bukti Pembayaran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="uploadForm" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input type="hidden" id="user_id">
                                        <div class="form-group">
                                            <label for="payment_date">Tanggal Pembayaran</label>
                                            <input type="date" class="form-control" id="payment_date"
                                                name="payment_date" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="bukti_pembayaran">Bukti Pembayaran</label>
                                            <input type="file" class="form-control" id="bukti_pembayaran"
                                                name="bukti_pembayaran" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Tutup</button>
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
            $('#statusFilter').on('change', function() {
                table.column(6).search(this.value).draw();
            });

            // Tampilkan Modal Edit Kelas
            $(document).on('click', '.editUserBtn', function() {
                let id = $(this).data('id');
                SwalHelper.showConfirm('Apakah Anda Yakin? Bila Sudah Di Terima Tidak Bisa Diubah Lagi')
                    .then((res) => {
                        if (res.isConfirmed) {
                            $.ajax({
                                url: "{{ route('verifPembayaran.approveStatus') }}",
                                method: "POST",
                                data: {
                                    bukti_id: id,
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
                                url: `verifbayar/${id}`,
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
                $('#userModal').modal('show');
                $('#user_id').val(id);
                $('#alasan').val('');

            })
            $(document).on('click', '.uploadUserBtn', function() {
                let id = $(this).data('id');
                $('#uploadModal').modal('show');
                $('#user_id').val(id);
                $('#payment_date').val('');

            })

            $('#userForm').submit(function(e) {
                e.preventDefault();
                let id = $('#user_id').val();
                let url = "{{ route('verifPembayaran.notApproveStatus') }}";
                let method = "POST";
                SwalHelper.showConfirm('Apakah Anda Yakin? Data Tidak Bisa Diubah Lagi')
                    .then((res) => {
                        if (res.isConfirmed) {
                            $.ajax({
                                url: url,
                                method: method,
                                data: {
                                    bukti_id: id,
                                    alasan: $('#alasan').val(),
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
            });
            $('#uploadForm').submit(function(e) {
                e.preventDefault();
                let id = $('#user_id').val();
                let url = "{{ route('verifPembayaran.inputBukti') }}";
                let method = "POST";
                let formData = new FormData(this);
                let bukti_pembayaran = $('#bukti_pembayaran')[0].files[0];
                if (bukti_pembayaran) {
                    formData.append('bukti_pembayaran', bukti_pembayaran);
                }
                formData.append('siswa_id', id);
                formData.append('payment_date', $('#payment_date').val())
                $.ajax({
                    url: url,
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#uploadModal').modal('hide');
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
            });
        })
    </script>
@endsection
