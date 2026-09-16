@extends('layouts.app')

@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-bold text-dark">
                        <i class="fas fa-cogs text-primary mr-2"></i> {{ __('CMS & Pengaturan SPMB') }}
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <form id="formConfig" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Nav Tabs Card -->
                    <div class="col-12">
                        <div class="card card-primary card-outline card-outline-tabs shadow-sm">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="cms-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active font-weight-bold" id="tab-general-link" data-toggle="pill" href="#tab-general" role="tab" aria-controls="tab-general" aria-selected="true">
                                            <i class="fas fa-school mr-1"></i> Identitas & Branding
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bold" id="tab-payment-link" data-toggle="pill" href="#tab-payment" role="tab" aria-controls="tab-payment" aria-selected="false">
                                            <i class="fas fa-money-check-alt mr-1"></i> Rekening & Kontak SPMB
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bold" id="tab-nis-link" data-toggle="pill" href="#tab-nis" role="tab" aria-controls="tab-nis" aria-selected="false">
                                            <i class="fas fa-id-card mr-1"></i> Format & Penomoran NIS
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bold" id="tab-article-link" data-toggle="pill" href="#tab-article" role="tab" aria-controls="tab-article" aria-selected="false">
                                            <i class="fas fa-newspaper mr-1"></i> CMS Panduan Singkat
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="cms-tabs-content">
                                    <!-- TAB 1: IDENTITAS & BRANDING -->
                                    <div class="tab-pane fade show active" id="tab-general" role="tabpanel" aria-labelledby="tab-general-link">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label for="app_name" class="font-weight-bold">Nama Sekolah / Aplikasi <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="app_name" name="app_name"
                                                        value="{{ old('app_name', $setting?->app_name ?? 'SMK ICB Cinta Teknika') }}" required>
                                                    <small class="text-muted">Nama ini akan tampil pada judul navbar, header, formulir, dan kartu pendaftaran.</small>
                                                </div>

                                                <div class="form-group">
                                                    <label for="tahun_ajaran" class="font-weight-bold">Tahun Ajaran Aktif</label>
                                                    <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran"
                                                        value="{{ old('tahun_ajaran', $setting?->tahun_ajaran ?? '2027/2028') }}" placeholder="2027/2028">
                                                    <small class="text-muted">Contoh: 2027/2028</small>
                                                </div>

                                                <div class="form-group">
                                                    <label for="alamat_sekolah" class="font-weight-bold">Alamat Resmi Sekolah</label>
                                                    <textarea class="form-control" id="alamat_sekolah" name="alamat_sekolah" rows="3">{{ old('alamat_sekolah', $setting?->alamat_sekolah ?? 'Jl. Atlas No. 4, Babakan Surabaya, Kiaracondong, Kota Bandung, Jawa Barat') }}</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="img-input" class="font-weight-bold">Upload Logo Sekolah</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="logo_path" id="img-input" accept="image/*">
                                                        <label class="custom-file-label" for="img-input">Pilih file logo...</label>
                                                    </div>
                                                    <small class="text-muted">Format PNG/JPG/WEBP, maksimal 2MB. Transparan lebih dianjurkan.</small>
                                                </div>
                                            </div>

                                            <div class="col-md-5 text-center my-auto">
                                                <div class="p-3 border rounded bg-light d-inline-block">
                                                    <label class="d-block font-weight-bold text-muted mb-2">Pratinjau Logo:</label>
                                                    <img src="" alt="Logo" id="preview" class="img-fluid rounded" style="max-height: 160px; max-width: 200px; object-fit: contain;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- TAB 2: REKENING & KONTAK -->
                                    <div class="tab-pane fade" id="tab-payment" role="tabpanel" aria-labelledby="tab-payment-link">
                                        <div class="alert alert-info py-2">
                                            <i class="fas fa-info-circle mr-1"></i> Data di bawah ini otomatis digunakan di halaman Landing Page, Brosur Informasi, dan Petunjuk Pembayaran Pendaftar.
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="bank_name" class="font-weight-bold">Nama Bank Pembayaran</label>
                                                    <input type="text" class="form-control" id="bank_name" name="bank_name"
                                                        value="{{ old('bank_name', $setting?->bank_name ?? 'Bank BRI') }}" placeholder="Contoh: Bank BRI">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="no_rekening" class="font-weight-bold">Nomor Rekening Bank</label>
                                                    <input type="text" class="form-control font-weight-bold text-primary" id="no_rekening" name="no_rekening"
                                                        value="{{ old('no_rekening', $setting?->no_rekening ?? '210501000140303') }}" placeholder="Contoh: 210501000140303">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="atas_nama" class="font-weight-bold">Nama Pemilik Rekening (Atas Nama)</label>
                                                    <input type="text" class="form-control" id="atas_nama" name="atas_nama"
                                                        value="{{ old('atas_nama', $setting?->atas_nama ?? 'SMK ICB Cinta Teknika') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="biaya_pendaftaran" class="font-weight-bold">Biaya Pendaftaran Seleksi (Rp)</label>
                                                    <input type="number" class="form-control font-weight-bold" id="biaya_pendaftaran" name="biaya_pendaftaran"
                                                        value="{{ old('biaya_pendaftaran', $setting?->biaya_pendaftaran ?? 200000) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="kontak_wa" class="font-weight-bold">Nomor WhatsApp Panitia SPMB</label>
                                                    <input type="text" class="form-control" id="kontak_wa" name="kontak_wa"
                                                        value="{{ old('kontak_wa', $setting?->kontak_wa ?? '6281222223333') }}" placeholder="Format: 628xxxxxxx">
                                                    <small class="text-muted">Gunakan awalan kode negara 62 (contoh: 6281234567890) untuk integrasi link WhatsApp otomatis.</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- TAB 3: PENGATURAN NIS -->
                                    <div class="tab-pane fade" id="tab-nis" role="tabpanel" aria-labelledby="tab-nis-link">
                                        <div class="alert alert-info py-2">
                                            <i class="fas fa-info-circle mr-1"></i> Pengaturan ini menentukan bagaimana Nomor Induk Siswa (NIS) secara otomatis diterbitkan ketika admin memverifikasi/menerima siswa baru.
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nis_prefix" class="font-weight-bold">Awalan / Prefix NIS</label>
                                                    <input type="text" class="form-control font-weight-bold" id="nis_prefix" name="nis_prefix"
                                                        value="{{ old('nis_prefix', $setting?->nis_prefix ?? '125') }}" placeholder="Contoh: 125 atau 2027">
                                                    <small class="text-muted">Kode awal sekolah atau angkatan (misal: 125, 2027, ICB).</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nis_start_number" class="font-weight-bold">Nomor Urut Awal / Selanjutnya</label>
                                                    <input type="number" class="form-control font-weight-bold" id="nis_start_number" name="nis_start_number"
                                                        value="{{ old('nis_start_number', $counter ? $counter->last_number + 1 : ($setting?->nis_start_number ?? 1)) }}">
                                                    <small class="text-muted">Nomor urut yang akan diberikan ke siswa diterima berikutnya (akan di-pad 4 digit, misal: 0001).</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-3 bg-light border rounded mt-2">
                                            <label class="font-weight-bold mb-1">Pratinjau Format NIS Siswa Berikutnya:</label>
                                            <div id="nis_preview" class="h4 font-weight-bold text-success mb-0">
                                                {{ ($setting?->nis_prefix ?? '125') . str_pad($counter ? $counter->last_number + 1 : ($setting?->nis_start_number ?? 1), 4, '0', STR_PAD_LEFT) }}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- TAB 4: CMS ARTIKEL & INFORMASI -->
                                    <div class="tab-pane fade" id="tab-article" role="tabpanel" aria-labelledby="tab-article-link">
                                        <div class="form-group">
                                            <label for="artikel_judul" class="font-weight-bold">Judul Artikel Informasi SPMB</label>
                                            <input type="text" class="form-control" id="artikel_judul" name="artikel_judul"
                                                value="{{ old('artikel_judul', $setting?->artikel_judul ?? 'Panduan Lengkap Penerimaan Calon Siswa Baru SMK ICB Cinta Teknika Tahun Ajaran 2027/2028') }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="artikel_konten" class="font-weight-bold">Isi Konten Artikel / Pengumuman</label>
                                            <textarea class="form-control" id="artikel_konten" name="artikel_konten" rows="12" placeholder="Tuliskan panduan, persyaratan khusus, atau artikel pengumuman pendaftaran di sini...">{{ old('artikel_konten', $setting?->artikel_konten) }}</textarea>
                                            <small class="text-muted">Dapat diisi teks deskriptif panduan atau pengumuman yang akan otomatis ditampilkan di section Artikel Informasi pada Landing Page.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-white text-right">
                                <button type="submit" class="btn btn-primary px-4 font-weight-bold" id="btnSave">
                                    <i class="fas fa-save mr-1"></i> Simpan Semua Pengaturan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="module">
        $(document).ready(function() {
            // Set logo preview
            @if ($setting?->logo_path)
                let logoUrl = "{{ asset('storage/' . $setting->logo_path) }}";
                $('#preview').attr('src', logoUrl);
            @else
                $('#preview').attr('src', "{{ asset('images/icb.png') }}");
            @endif

            // Preview image on change
            $('#img-input').on('change', function() {
                const file = this.files[0];
                if (file) {
                    $('.custom-file-label').text(file.name);
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
                } else {
                    $('#preview').attr('src', '{{ asset('images/icb.png') }}');
                }
            });

            // Handle AJAX form submission
            $('#formConfig').on('submit', function(e) {
                e.preventDefault();
                const btn = $('#btnSave');
                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Menyimpan...');

                const formData = new FormData(this);

                $.ajax({
                    url: '{{ route('appconfig.store') }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message || 'Pengaturan berhasil diperbarui!',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    },
                    error: function(xhr) {
                        btn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Simpan Semua Pengaturan');
                        let errMsg = 'Terjadi kesalahan saat menyimpan!';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errMsg = xhr.responseJSON.message;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Menyimpan',
                            text: errMsg,
                        });
                    }
                });
            });
        });
    </script>
@endsection
