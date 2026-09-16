@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Verifikasi Siswa') }}</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Statistik Card Bar -->
            <div class="row mb-3">
                @php
                    $totalSiswa = $datasis->count();
                    $diterima = $datasis->where('status', 'Diterima')->count();
                    $pending = $datasis->filter(fn($s) => strtolower($s->status) === 'pending')->count();
                    $ditolak = $datasis->where('status', 'Ditolak')->count();
                @endphp
                <div class="col-6 col-md-3">
                    <div class="info-box bg-light shadow-sm">
                        <span class="info-box-icon bg-info text-white"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Terverifikasi</span>
                            <span class="info-box-number text-dark font-weight-bold">{{ $totalSiswa }} Siswa</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="info-box bg-light shadow-sm">
                        <span class="info-box-icon bg-success text-white"><i class="fas fa-user-check"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Diterima / Lulus</span>
                            <span class="info-box-number text-success font-weight-bold">{{ $diterima }} Siswa</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="info-box bg-light shadow-sm">
                        <span class="info-box-icon bg-warning text-white"><i class="fas fa-clock"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Menunggu (Pending)</span>
                            <span class="info-box-number text-warning font-weight-bold">{{ $pending }} Siswa</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="info-box bg-light shadow-sm">
                        <span class="info-box-icon bg-danger text-white"><i class="fas fa-user-times"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Ditolak</span>
                            <span class="info-box-number text-danger font-weight-bold">{{ $ditolak }} Siswa</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3 d-flex flex-wrap justify-content-between align-items-center">
                            <div class="d-flex align-items-center mb-2 mb-md-0">
                                <h5 class="card-title font-weight-bold text-dark mb-0 mr-3">
                                    <i class="fas fa-user-graduate text-primary mr-2"></i> Daftar Calon Siswa Terverifikasi
                                </h5>
                            </div>
                            <div class="d-flex flex-wrap align-items-center" style="gap: 10px;">
                                <div class="d-flex align-items-center">
                                    <label for="filterStatus" class="mr-2 mb-0 text-muted font-weight-bold" style="font-size: 13px;">Filter Status:</label>
                                    <select id="filterStatus" class="form-control form-control-sm" style="width: 160px; border-radius: 6px;">
                                        <option value="">Semua Status</option>
                                        <option value="Diterima">Diterima (Lulus)</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Ditolak">Ditolak</option>
                                    </select>
                                </div>
                                <button type="button" id="btnTerimaSemua" class="btn btn-primary btn-sm font-weight-bold shadow-sm px-3" style="border-radius: 6px;">
                                    <i class="fas fa-check-double mr-1"></i> Terima Semua
                                </button>
                                <a href="{{ route('verifSiswa.exportXlsx') }}" id="btnExportXlsx" class="btn btn-success btn-sm font-weight-bold shadow-sm px-3" style="background-color: #107c41; border-color: #107c41; border-radius: 6px;">
                                    <i class="fas fa-file-excel mr-1"></i> Unduh Rekap Excel (.xlsx)
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <table class="table table-bordered table-striped table-hover" id="usersTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 4%">#</th>
                                        <th>Kode / NIS</th>
                                        <th>Nama Calon Siswa</th>
                                        <th>Jurusan & Asal Sekolah</th>
                                        <th>Status Pembayaran</th>
                                        <th>Status Pendaftaran</th>
                                        <th>Tgl Daftar</th>
                                        <th style="min-width: 150px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datasis as $user)
                                        @php
                                            $bp = $user->buktiPembayaran;
                                            $bpStatus = strtolower($bp?->status ?? 'belum_upload');
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="font-weight-bold text-primary">{{ $user->kode_pendaftaran ?? 'ICB-'.date('Y').'-'.str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</div>
                                                @if($user->nis)
                                                    <span class="badge bg-success"><i class="fas fa-id-badge mr-1"></i> NIS: {{ $user->nis }}</span>
                                                @else
                                                    <span class="badge bg-light text-muted border">NIS: Belum Terbit</span>
                                                @endif
                                            </td>
                                            <td>
                                                <strong class="text-dark">{{ $user->nama }}</strong>
                                                <div class="small text-muted"><i class="fas fa-venus-mars mr-1"></i> {{ $user->jenis_kelamin }} | <i class="fas fa-phone mr-1"></i> {{ $user->no_hp }}</div>
                                            </td>
                                            <td>
                                                <div class="font-weight-bold text-navy">{{ $user->jurusan?->nama_jurusan ?? '-' }}</div>
                                                <small class="text-muted"><i class="fas fa-school mr-1"></i> {{ $user->asal_sekolah }} ({{ $user->jalur_pendaftaran }})</small>
                                            </td>
                                            <td class="text-center">
                                                @if($bpStatus === 'verified' || $bpStatus === 'diverifikasi')
                                                    <span class="badge bg-success p-2"><i class="fas fa-check-circle mr-1"></i> Lunas / Valid</span>
                                                @elseif($bpStatus === 'rejected' || $bpStatus === 'ditolak')
                                                    <span class="badge bg-danger p-2"><i class="fas fa-times-circle mr-1"></i> Ditolak</span>
                                                @elseif($bp && $bp->file_path)
                                                    <span class="badge bg-warning text-dark p-2"><i class="fas fa-clock mr-1"></i> Menunggu Validasi</span>
                                                @else
                                                    <span class="badge bg-secondary p-2"><i class="fas fa-upload mr-1"></i> Belum Upload</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @switch(strtolower($user->status))
                                                    @case('diterima')
                                                        <span class="badge bg-success p-2"><i class="fas fa-user-check mr-1"></i> Diterima</span>
                                                        @break
                                                    @case('ditolak')
                                                        <span class="badge bg-danger p-2"><i class="fas fa-user-times mr-1"></i> Ditolak</span>
                                                        @break
                                                    @default
                                                        <span class="badge bg-warning text-dark p-2"><i class="fas fa-hourglass-half mr-1"></i> Pending</span>
                                                @endswitch
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($user->created_at)->locale('id')->translatedFormat('d M Y') }}</td>
                                            <td>
                                                <button class="btn btn-info btn-sm seeDetailBtn mr-1 mb-1" data-id="{{ $user->id }}" title="Lihat Berkas & Bukti Pembayaran">
                                                    <i class="fas fa-folder-open mr-1"></i> Berkas
                                                </button>

                                                @if(strtolower($user->status) === 'diterima')
                                                    <span class="badge bg-light text-success font-weight-bold border border-success p-1"><i class="fas fa-check"></i> Sudah Lulus</span>
                                                @elseif(strtolower($user->status) === 'ditolak')
                                                    <span class="badge bg-light text-danger font-weight-bold border border-danger p-1"><i class="fas fa-times"></i> Ditolak</span>
                                                @else
                                                    <button class="btn btn-success btn-sm editUserBtn mr-1 mb-1" data-id="{{ $user->id }}" title="Terima Siswa & Verifikasi Pembayaran Sekaligus">
                                                        <i class="fas fa-check mr-1"></i> Terima
                                                    </button>
                                                    <button class="btn btn-danger btn-sm delUserBtn mb-1" data-id="{{ $user->id }}" title="Tolak Pendaftaran">
                                                        <i class="fas fa-times mr-1"></i> Tolak
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Siswa & Verifikasi 1 Pintu -->
    <div class="modal fade" id="detailSiswaModal" tabindex="-1" role="dialog" aria-labelledby="detailSiswaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
                <div class="modal-header text-white" style="background: linear-gradient(135deg, #102C57 0%, #1c4b8b 100%);">
                    <h5 class="modal-title font-weight-bold" id="detailSiswaModalLabel">
                        <i class="fas fa-user-graduate mr-2"></i> Verifikasi Berkas & Pembayaran Siswa
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4 bg-light">
                    <div class="row">
                        <!-- Kolom Kiri: Biodata Siswa -->
                        <div class="col-lg-7 mb-3">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-header bg-white font-weight-bold text-dark border-bottom py-2">
                                    <i class="fas fa-id-card text-primary mr-2"></i> Identitas Calon Siswa & Orang Tua
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-sm table-striped mb-0">
                                        <tbody>
                                            <tr>
                                                <th style="width: 35%;" class="pl-3">Nama Lengkap</th>
                                                <td id="detail-nama" class="font-weight-bold text-primary"></td>
                                            </tr>
                                            <tr>
                                                <th class="pl-3">Jalur Pendaftaran</th>
                                                <td id="detail-jalur"></td>
                                            </tr>
                                            <tr>
                                                <th class="pl-3">Pilihan Jurusan</th>
                                                <td id="detail-jurusan" class="font-weight-bold"></td>
                                            </tr>
                                            <tr>
                                                <th class="pl-3">Jenis Kelamin</th>
                                                <td id="detail-jk"></td>
                                            </tr>
                                            <tr>
                                                <th class="pl-3">Tempat, Tgl Lahir</th>
                                                <td id="detail-ttl"></td>
                                            </tr>
                                            <tr>
                                                <th class="pl-3">Agama</th>
                                                <td id="detail-agama"></td>
                                            </tr>
                                            <tr>
                                                <th class="pl-3">No. HP / WhatsApp</th>
                                                <td id="detail-nohp"></td>
                                            </tr>
                                            <tr>
                                                <th class="pl-3">Email</th>
                                                <td id="detail-email"></td>
                                            </tr>
                                            <tr>
                                                <th class="pl-3">Asal Sekolah</th>
                                                <td id="detail-sekolah"></td>
                                            </tr>
                                            <tr>
                                                <th class="pl-3">NISN / Thn Lulus</th>
                                                <td id="detail-nisn"></td>
                                            </tr>
                                            <tr>
                                                <th class="pl-3">Alamat Domisili</th>
                                                <td id="detail-alamat"></td>
                                            </tr>
                                            <tr>
                                                <th class="pl-3">Data Orang Tua</th>
                                                <td id="detail-ortu"></td>
                                            </tr>
                                            <tr>
                                                <th class="pl-3">Tinggi / Berat Badan</th>
                                                <td id="detail-fisik"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Kanan: Verifikasi Pembayaran -->
                        <div class="col-lg-5 mb-3">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-header bg-white font-weight-bold text-dark border-bottom py-2 d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-receipt text-success mr-2"></i> Bukti Pembayaran</span>
                                    <span id="detail-bukti-badge"></span>
                                </div>
                                <div class="card-body p-3 text-center">
                                    <div id="detail-bukti-container" class="mb-3" style="min-height: 200px; display: flex; align-items: center; justify-content: center; background: #f1f5f9; border-radius: 8px; overflow: hidden; border: 1px dashed #cbd5e1;">
                                        <!-- Image or placeholder inserted by JS -->
                                    </div>
                                    <div class="text-left bg-light p-2 rounded mb-3" style="font-size: 13px;">
                                        <div><strong>Atas Nama:</strong> <span id="detail-bukti-nama">-</span></div>
                                        <div><strong>Tanggal Bayar:</strong> <span id="detail-bukti-tgl">-</span></div>
                                        <div><strong>Nominal:</strong> <span id="detail-bukti-nominal" class="font-weight-bold text-success">-</span></div>
                                    </div>

                                    <!-- Tombol Verifikasi Bukti Langsung -->
                                    <div class="d-flex justify-content-center" style="gap: 8px;" id="bukti-actions-container">
                                        <button type="button" class="btn btn-success btn-sm font-weight-bold px-3" id="btnValidasiBayar">
                                            <i class="fas fa-check-circle mr-1"></i> Validasi Pembayaran
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-sm font-weight-bold px-3" id="btnTolakBayar">
                                            <i class="fas fa-times-circle mr-1"></i> Tolak Bukti
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-white d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">Tutup</button>
                    <div id="modal-quick-actions">
                        <!-- Quick Accept or Reject -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="module">
        $(document).ready(function() {
            let table = $('#usersTable').DataTable({
                responsive: true,
                order: [[0, 'asc']]
            });

            // Current active siswa ID in modal
            let currentSiswaId = null;

            // Filter Status Pendaftaran
            $('#filterStatus').on('change', function() {
                const val = $(this).val();
                // Filter status pendaftaran column (index 5)
                table.column(5).search(val ? val : '', true, false).draw();

                // Update export URL
                const baseUrl = "{{ route('verifSiswa.exportXlsx') }}";
                if (val) {
                    $('#btnExportXlsx').attr('href', baseUrl + '?status=' + encodeURIComponent(val));
                } else {
                    $('#btnExportXlsx').attr('href', baseUrl);
                }
            });

            // See Detail
            $(document).on('click', '.seeDetailBtn', function() {
                const id = $(this).data('id');
                currentSiswaId = id;

                $.ajax({
                    url: "{{ url('admin/verifsiswa/detail') }}/" + id,
                    method: 'GET',
                    success: function(res) {
                        const s = res.siswa || {};
                        const d = res.data_tambahan || {};
                        const b = res.bukti || {};

                        $('#detail-jalur').text(s.jalur_pendaftaran || '-');
                        $('#detail-jurusan').text(res.jurusan || '-');
                        $('#detail-nama').text(res.nama || '-');
                        $('#detail-jk').text(s.jenis_kelamin || '-');
                        $('#detail-ttl').text((d.tempat_lahir || '-') + ', ' + (d.tanggal_lahir || '-'));
                        $('#detail-agama').text(s.agama || '-');
                        $('#detail-nohp').text(s.no_hp || '-');
                        $('#detail-email').text(s.email || '-');

                        let alamatLengkap = d.alamat || '';
                        if (d.rt || d.rw) alamatLengkap += ' (RT ' + (d.rt || '-') + ' / RW ' + (d.rw || '-') + ')';
                        if (d.kelurahan) alamatLengkap += ', Kel. ' + d.kelurahan;
                        if (d.kecamatan) alamatLengkap += ', Kec. ' + d.kecamatan;
                        if (d.kota) alamatLengkap += ', ' + d.kota;
                        if (d.provinsi) alamatLengkap += ', ' + d.provinsi;
                        $('#detail-alamat').text(alamatLengkap || '-');

                        $('#detail-sekolah').text(s.asal_sekolah || '-');
                        $('#detail-nisn').text((s.nisn || '-') + ' (Lulus: ' + (s.tahun_lulus || '-') + ')');

                        let ortuText = 'Ayah: ' + (d.nama_ayah || '-') + ' (' + (d.telepon_ayah || '-') + ') | Ibu: ' + (d.nama_ibu || '-') + ' (' + (d.telepon_ibu || '-') + ')';
                        $('#detail-ortu').text(ortuText);
                        $('#detail-fisik').text((d.tinggi_badan ? d.tinggi_badan + ' cm' : '-') + ' / ' + (d.berat_badan ? d.berat_badan + ' kg' : '-'));

                        // Bukti Pembayaran Section
                        const bpStatus = (b.status || '').toLowerCase();
                        if (bpStatus === 'verified' || bpStatus === 'diverifikasi') {
                            $('#detail-bukti-badge').html('<span class="badge badge-success"><i class="fas fa-check-circle"></i> Lunas (Verified)</span>');
                        } else if (bpStatus === 'rejected' || bpStatus === 'ditolak') {
                            $('#detail-bukti-badge').html('<span class="badge badge-danger"><i class="fas fa-times-circle"></i> Ditolak</span>');
                        } else if (b.file_path) {
                            $('#detail-bukti-badge').html('<span class="badge badge-warning text-dark"><i class="fas fa-clock"></i> Menunggu Validasi</span>');
                        } else {
                            $('#detail-bukti-badge').html('<span class="badge badge-secondary">Belum Upload</span>');
                        }

                        $('#detail-bukti-nama').text(b.account_name || s.nama || '-');
                        $('#detail-bukti-tgl').text(b.payment_date || '-');
                        $('#detail-bukti-nominal').text(b.amount ? 'Rp ' + Number(b.amount).toLocaleString('id-ID') : 'Rp 200.000');

                        if (b.file_path) {
                            const imgUrl = '/storage/' + b.file_path;
                            $('#detail-bukti-container').html(`
                                <div class="text-center p-2">
                                    <a href="${imgUrl}" target="_blank" title="Klik untuk memperbesar">
                                        <img src="${imgUrl}" alt="Bukti Transfer" class="img-fluid rounded shadow-sm" style="max-height: 240px; object-fit: contain; cursor: pointer;">
                                    </a>
                                    <div class="mt-2">
                                        <a href="${imgUrl}" target="_blank" class="btn btn-xs btn-outline-primary">
                                            <i class="fas fa-search-plus mr-1"></i> Buka Gambar Penuh
                                        </a>
                                    </div>
                                </div>
                            `);
                            $('#bukti-actions-container').show();
                        } else {
                            $('#detail-bukti-container').html(`
                                <div class="p-4 text-muted">
                                    <i class="fas fa-file-invoice-dollar fa-3x mb-2 text-secondary"></i>
                                    <div>Calon siswa belum mengunggah bukti pembayaran.</div>
                                </div>
                            `);
                            $('#bukti-actions-container').hide();
                        }

                        // Modal Quick Actions
                        let quickActionsHtml = '';
                        if (String(s.status).toLowerCase() !== 'diterima') {
                            quickActionsHtml += `
                                <button type="button" class="btn btn-success font-weight-bold px-3 modalApproveBtn" data-id="${s.id}">
                                    <i class="fas fa-check-circle mr-1"></i> Terima & Luluskan Siswa
                                </button>
                                <button type="button" class="btn btn-danger font-weight-bold px-3 ml-2 modalRejectBtn" data-id="${s.id}">
                                    <i class="fas fa-times-circle mr-1"></i> Tolak
                                </button>
                            `;
                        } else {
                            quickActionsHtml += `<span class="text-success font-weight-bold mr-2"><i class="fas fa-user-check mr-1"></i> Siswa Sudah Diterima / Lulus</span>`;
                        }
                        $('#modal-quick-actions').html(quickActionsHtml);

                        $('#detailSiswaModal').modal('show');
                    },
                    error: function() {
                        Swal.fire('Error', 'Gagal mengambil data siswa.', 'error');
                    }
                });
            });

            // Action: Validasi Pembayaran Langsung dari Modal
            $('#btnValidasiBayar').on('click', function() {
                if (!currentSiswaId) return;
                Swal.fire({
                    title: 'Validasi Pembayaran?',
                    text: 'Tandai bukti pembayaran calon siswa ini sebagai Valid / Lunas.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Validasi!'
                }).then((res) => {
                    if (res.isConfirmed) {
                        $.ajax({
                            url: "{{ route('verifSiswa.verifBayarDirect') }}",
                            method: "POST",
                            data: {
                                siswa_id: currentSiswaId,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(resp) {
                                Swal.fire({
                                    icon: 'success',
                                    title: resp.message || 'Pembayaran Berhasil Divalidasi!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(err) {
                                Swal.fire('Error', 'Gagal memverifikasi pembayaran.', 'error');
                            }
                        });
                    }
                });
            });

            // Action: Tolak Pembayaran dari Modal
            $('#btnTolakBayar').on('click', function() {
                if (!currentSiswaId) return;
                Swal.fire({
                    title: 'Tolak Bukti Pembayaran?',
                    input: 'text',
                    inputLabel: 'Alasan penolakan bukti bayar:',
                    inputPlaceholder: 'Misal: Bukti buram / transfer belum masuk',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Tolak Pembayaran',
                    inputValidator: (val) => {
                        if (!val) return 'Silakan masukkan alasan penolakan!';
                    }
                }).then((res) => {
                    if (res.isConfirmed) {
                        $.ajax({
                            url: "{{ route('verifSiswa.tolakBayarDirect') }}",
                            method: "POST",
                            data: {
                                siswa_id: currentSiswaId,
                                alasan: res.value,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(resp) {
                                Swal.fire({
                                    icon: 'success',
                                    title: resp.message || 'Bukti bayar ditolak!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(err) {
                                Swal.fire('Error', 'Gagal menolak bukti pembayaran.', 'error');
                            }
                        });
                    }
                });
            });

            // Action Helper: Approve Siswa
            function approveSiswa(id) {
                Swal.fire({
                    title: 'Terima & Meluluskan Siswa?',
                    text: 'Sistem otomatis menerbitkan NIS, memvalidasi bukti pembayaran, dan mengirim surat pengumuman ke email pendaftar.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Terima Siswa!'
                }).then((res) => {
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
                                    title: response.message || 'Siswa Berhasil Diterima!',
                                    showConfirmButton: true
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(res) {
                                const msg = res.responseJSON ? res.responseJSON.message : 'Terjadi kesalahan!';
                                Swal.fire('Error', msg, 'error');
                            }
                        });
                    }
                });
            }

            // Action Helper: Reject Siswa
            function rejectSiswa(id) {
                Swal.fire({
                    title: 'Tolak Pendaftaran Siswa?',
                    text: 'Status pendaftaran akan diubah menjadi Ditolak.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Tolak'
                }).then((res) => {
                    if (res.isConfirmed) {
                        $.ajax({
                            url: "{{ route('verifSiswa.notApproveStatus') }}",
                            method: "POST",
                            data: {
                                siswa_id: id,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: response.message || 'Pendaftaran Siswa Ditolak',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                setTimeout(function() { location.reload(); }, 1500);
                            },
                            error: function(res) {
                                const msg = res.responseJSON ? res.responseJSON.message : 'Terjadi kesalahan!';
                                Swal.fire('Error', msg, 'error');
                            }
                        });
                    }
                });
            }

            // Action Helper: Terima Semua Siswa Pending
            $('#btnTerimaSemua').on('click', function() {
                Swal.fire({
                    title: 'Terima Semua Pendaftar Pending?',
                    html: `
                        <div class="text-left" style="font-size: 13.5px; line-height: 1.6;">
                            <p class="mb-2">Tindakan ini akan memproses <b>seluruh calon siswa berstatus Pending</b> secara otomatis:</p>
                            <ul class="pl-3 mb-2 text-muted">
                                <li>Menerbitkan nomor induk siswa (NIS) resmi berurutan.</li>
                                <li>Mengubah status pendaftaran menjadi <b>Diterima</b>.</li>
                                <li>Memverifikasi bukti pembayaran (jika ada).</li>
                                <li>Mengirimkan surat pengumuman kelulusan ke masing-masing email pendaftar.</li>
                            </ul>
                            <p class="mb-0 text-info font-weight-bold"><i class="fas fa-info-circle mr-1"></i> Proses ini dapat memakan beberapa detik.</p>
                        </div>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#007bff',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="fas fa-check-double mr-1"></i> Ya, Terima Semua',
                    cancelButtonText: 'Batal'
                }).then((res) => {
                    if (res.isConfirmed) {
                        Swal.fire({
                            title: 'Memproses Penerimaan Massal...',
                            text: 'Mohon tunggu, sistem sedang memproses data dan mengirimkan email kelulusan.',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        $.ajax({
                            url: "{{ route('verifSiswa.approveAll') }}",
                            method: "POST",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: response.message,
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(res) {
                                const msg = res.responseJSON ? res.responseJSON.message : 'Terjadi kesalahan saat memproses data.';
                                Swal.fire('Perhatian', msg, res.status === 422 ? 'info' : 'error');
                            }
                        });
                    }
                });
            });

            // Click Handlers from table & modal
            $(document).on('click', '.editUserBtn', function() {
                approveSiswa($(this).data('id'));
            });
            $(document).on('click', '.modalApproveBtn', function() {
                $('#detailSiswaModal').modal('hide');
                approveSiswa($(this).data('id'));
            });
            $(document).on('click', '.delUserBtn', function() {
                rejectSiswa($(this).data('id'));
            });
            $(document).on('click', '.modalRejectBtn', function() {
                $('#detailSiswaModal').modal('hide');
                rejectSiswa($(this).data('id'));
            });
        });
    </script>
@endsection
