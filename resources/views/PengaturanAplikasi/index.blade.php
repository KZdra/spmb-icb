@extends('layouts.app')

@section('content')
    <style>
        /* Mobile-First CMS Navigation Tabs */
        #cms-tabs {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
            white-space: nowrap;
            padding: 4px 6px 0 6px;
            border-bottom: 2px solid #dee2e6;
            scrollbar-width: thin;
        }
        #cms-tabs::-webkit-scrollbar {
            height: 4px;
        }
        #cms-tabs::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        #cms-tabs::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        #cms-tabs .nav-item {
            flex: 0 0 auto;
        }
        #cms-tabs .nav-link {
            padding: 10px 16px;
            font-size: 0.92rem;
            min-height: 44px;
            display: inline-flex;
            align-items: center;
            border-radius: 8px 8px 0 0;
        }
        @media (max-width: 767.98px) {
            .sticky-mobile-save {
                position: sticky;
                bottom: 0;
                z-index: 1030;
                background: #ffffff;
                box-shadow: 0 -4px 16px rgba(0,0,0,0.1);
                padding: 12px 16px !important;
            }
            .sticky-mobile-save .btn {
                width: 100%;
                min-height: 48px;
                font-size: 1.05rem;
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }
    </style>
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-bold text-dark">
                        <i class="fas fa-sliders-h text-primary mr-2"></i> {{ __('CMS & Pengaturan SPMB') }}
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
                    <div class="col-12">
                        <div class="card card-primary card-outline card-outline-tabs shadow-sm">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="cms-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active font-weight-bold" id="tab-general-link" data-toggle="pill" href="#tab-general" role="tab">
                                            <i class="fas fa-school mr-1"></i> Identitas & Branding
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bold" id="tab-theme-link" data-toggle="pill" href="#tab-theme" role="tab">
                                            <i class="fas fa-palette mr-1 text-warning"></i> Tema & Warna
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bold" id="tab-banner-link" data-toggle="pill" href="#tab-banner" role="tab">
                                            <i class="fas fa-home mr-1 text-info"></i> Konten Beranda & Banner
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bold" id="tab-payment-link" data-toggle="pill" href="#tab-payment" role="tab">
                                            <i class="fas fa-money-check-alt mr-1 text-success"></i> Rekening & Biaya
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bold" id="tab-nis-link" data-toggle="pill" href="#tab-nis" role="tab">
                                            <i class="fas fa-id-card mr-1 text-primary"></i> Format NIS
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bold" id="tab-berkas-link" data-toggle="pill" href="#tab-berkas" role="tab">
                                            <i class="fas fa-folder-open mr-1 text-secondary"></i> Berkas Dinamis
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bold" id="tab-templates-link" data-toggle="pill" href="#tab-templates" role="tab">
                                            <i class="fab fa-whatsapp mr-1 text-success"></i> Template WA & PDF
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bold" id="tab-article-link" data-toggle="pill" href="#tab-article" role="tab">
                                            <i class="fas fa-newspaper mr-1 text-purple"></i> CMS Panduan
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bold" id="tab-faq-link" data-toggle="pill" href="#tab-faq" role="tab">
                                            <i class="fas fa-question-circle mr-1 text-danger"></i> Tanya Jawab (FAQ)
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bold" id="tab-mitra-link" data-toggle="pill" href="#tab-mitra" role="tab">
                                            <i class="fas fa-handshake mr-1 text-primary"></i> Mitra DU/DI
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bold" id="tab-testimoni-link" data-toggle="pill" href="#tab-testimoni" role="tab">
                                            <i class="fas fa-comment-dots mr-1 text-success"></i> Testimoni Alumni
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="cms-tabs-content">

                                    <!-- TAB 1: IDENTITAS & BRANDING -->
                                    <div class="tab-pane fade show active" id="tab-general" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label for="app_name" class="font-weight-bold">Nama Sekolah / Lembaga <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control font-weight-bold" id="app_name" name="app_name"
                                                        value="{{ old('app_name', $setting?->app_name ?? 'SMK ICB Cinta Teknika') }}" required>
                                                    <small class="text-muted">Nama ini akan tampil di seluruh header, footer, surat kelulusan, dan tanda terima.</small>
                                                </div>

                                                <div class="form-group">
                                                    <label for="slogan" class="font-weight-bold">Slogan / Motto Sekolah</label>
                                                    <input type="text" class="form-control" id="slogan" name="slogan"
                                                        value="{{ old('slogan', $setting?->slogan ?? 'Unggul, Berakhlak, dan Siap Kerja di Era Digital 4.0') }}" placeholder="Contoh: Unggul, Berakhlak, Siap Kerja">
                                                </div>

                                                <div class="form-group">
                                                    <label for="tahun_ajaran" class="font-weight-bold">Tahun Ajaran Aktif</label>
                                                    <input type="text" class="form-control font-weight-bold" id="tahun_ajaran" name="tahun_ajaran"
                                                        value="{{ old('tahun_ajaran', $setting?->tahun_ajaran ?? '2027/2028') }}" placeholder="2027/2028">
                                                </div>

                                                <div class="form-group">
                                                    <label for="alamat_sekolah" class="font-weight-bold">Alamat Resmi Sekolah</label>
                                                    <textarea class="form-control" id="alamat_sekolah" name="alamat_sekolah" rows="3">{{ old('alamat_sekolah', $setting?->alamat_sekolah ?? 'Jl. Atlas No. 4, Babakan Surabaya, Kiaracondong, Kota Bandung, Jawa Barat') }}</textarea>
                                                </div>

                                                <div class="card border rounded bg-white p-3 mb-3">
                                                    <label class="font-weight-bold text-dark d-block mb-2">
                                                        <i class="fas fa-share-alt text-primary mr-1"></i> Tautan Media Sosial Resmi Sekolah
                                                    </label>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-2">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-white text-danger"><i class="fab fa-instagram"></i></span>
                                                                </div>
                                                                <input type="text" class="form-control" name="sosmed_instagram" placeholder="https://instagram.com/sekolah" value="{{ old('sosmed_instagram', $setting?->sosmed_instagram) }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-2">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-white text-dark"><i class="fab fa-tiktok"></i></span>
                                                                </div>
                                                                <input type="text" class="form-control" name="sosmed_tiktok" placeholder="https://tiktok.com/@sekolah" value="{{ old('sosmed_tiktok', $setting?->sosmed_tiktok) }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-2">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-white text-danger"><i class="fab fa-youtube"></i></span>
                                                                </div>
                                                                <input type="text" class="form-control" name="sosmed_youtube" placeholder="https://youtube.com/@sekolah" value="{{ old('sosmed_youtube', $setting?->sosmed_youtube) }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-2">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-white text-primary"><i class="fab fa-facebook"></i></span>
                                                                </div>
                                                                <input type="text" class="form-control" name="sosmed_facebook" placeholder="https://facebook.com/sekolah" value="{{ old('sosmed_facebook', $setting?->sosmed_facebook) }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="jam_pelayanan" class="font-weight-bold">Jam Layanan Sekretariat SPMB</label>
                                                            <input type="text" class="form-control" id="jam_pelayanan" name="jam_pelayanan"
                                                                value="{{ old('jam_pelayanan', $setting?->jam_pelayanan ?? 'Senin - Sabtu (08:00 - 15:00 WIB)') }}" placeholder="Contoh: Senin - Sabtu (08:00 - 15:00 WIB)">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="video_profil_url" class="font-weight-bold">Tautan Video Profil / YouTube</label>
                                                            <input type="text" class="form-control" id="video_profil_url" name="video_profil_url"
                                                                value="{{ old('video_profil_url', $setting?->video_profil_url) }}" placeholder="Contoh: https://www.youtube.com/watch?v=...">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="tentang_sekolah" class="font-weight-bold">Profil Ringkas Sekolah (Footer & Beranda)</label>
                                                    <textarea class="form-control" id="tentang_sekolah" name="tentang_sekolah" rows="3" placeholder="Deskripsi ringkas profil sekolah untuk footer dan bagian tentang kami...">{{ old('tentang_sekolah', $setting?->tentang_sekolah ?? 'Sekolah Menengah Kejuruan Terakreditasi A (Unggul). Menghasilkan lulusan yang disiplin berintegritas, kompeten di bidang keahlian, berkarakter luhur, dan siap kerja maupun melanjutkan studi.') }}</textarea>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="img-input" class="font-weight-bold">Upload Logo Sekolah</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" name="logo_path" id="img-input" accept="image/*">
                                                                <label class="custom-file-label" for="img-input">Pilih file logo...</label>
                                                            </div>
                                                            <small class="text-muted">Format PNG/JPG/WEBP. Otomatis dikonversi ke WebP.</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="favicon-input" class="font-weight-bold">Upload Favicon Browser</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" name="favicon_path" id="favicon-input" accept="image/*,.ico">
                                                                <label class="custom-file-label" for="favicon-input">Pilih favicon...</label>
                                                            </div>
                                                            <small class="text-muted">Ikon kecil pada tab browser (PNG/ICO/WEBP).</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-5 text-center my-auto">
                                                <div class="p-3 border rounded bg-light d-inline-block shadow-sm">
                                                    <label class="d-block font-weight-bold text-muted mb-2">Pratinjau Logo:</label>
                                                    <img src="{{ $setting?->logo_url ?? asset('images/icb.png') }}" alt="Logo" id="preview" class="img-fluid rounded mb-3" style="max-height: 140px; max-width: 180px; object-fit: contain;">
                                                    <div class="border-top pt-2">
                                                        <label class="d-block font-weight-bold text-muted small mb-1">Pratinjau Favicon:</label>
                                                        <img src="{{ $setting?->favicon_url ?? ($setting?->logo_url ?? asset('images/icb.png')) }}" alt="Favicon" id="preview-favicon" style="width: 32px; height: 32px; object-fit: contain;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- TAB 2: TEMA & WARNA TAMPILAN (100% CUSTOMIZABLE) -->
                                    <div class="tab-pane fade" id="tab-theme" role="tabpanel">
                                        <div class="alert alert-warning py-2 mb-3">
                                            <i class="fas fa-magic mr-1"></i> <strong>Sistem Tema Dinamis:</strong> Ubah warna sistem sesuai identitas sekolah dalam 1-klik atau gunakan Color Picker. Semua tombol, kartu, badge, gradien hero, dan kartu tanda terima otomatis mengikuti warna pilihan Anda!
                                        </div>

                                        <!-- Quick Presets -->
                                        <div class="card bg-light border mb-4">
                                            <div class="card-body p-3">
                                                <label class="font-weight-bold text-dark d-block mb-2">
                                                    <i class="fas fa-palette mr-1 text-primary"></i> Preset Warna Cepat Khusus Yayasan ICB & Mitra:
                                                </label>
                                                <div class="d-flex flex-wrap" style="gap: 10px;">
                                                    <button type="button" class="btn btn-outline-primary btn-sm font-weight-bold px-3 shadow-sm" onclick="applyPreset('#1A56DB', '#0B3B7B', '#10B981', 'SMK ICB Cinta Teknika')">
                                                        <span style="display:inline-block; width:12px; height:12px; border-radius:50%; background:#1A56DB; margin-right:5px;"></span>
                                                        SMK ICB Cinta Teknika (Biru Royal)
                                                    </button>
                                                    <button type="button" class="btn btn-outline-warning btn-sm font-weight-bold px-3 shadow-sm text-dark" onclick="applyPreset('#EA580C', '#9A3412', '#D97706', 'SMK ICB Cinta Niaga')">
                                                        <span style="display:inline-block; width:12px; height:12px; border-radius:50%; background:#EA580C; margin-right:5px;"></span>
                                                        SMK ICB Cinta Niaga (Oranye / Emas Bisnis)
                                                    </button>
                                                    <button type="button" class="btn btn-outline-success btn-sm font-weight-bold px-3 shadow-sm" onclick="applyPreset('#0D9488', '#115E59', '#059669', 'SMK ICB Cinta Wisata')">
                                                        <span style="display:inline-block; width:12px; height:12px; border-radius:50%; background:#0D9488; margin-right:5px;"></span>
                                                        SMK ICB Cinta Wisata (Hijau Toska / Emerald)
                                                    </button>
                                                    <button type="button" class="btn btn-outline-secondary btn-sm font-weight-bold px-3 shadow-sm" onclick="applyPreset('#4F46E5', '#312E81', '#06B6D4')">
                                                        <span style="display:inline-block; width:12px; height:12px; border-radius:50%; background:#4F46E5; margin-right:5px;"></span>
                                                        Modern Indigo
                                                    </button>
                                                    <button type="button" class="btn btn-outline-danger btn-sm font-weight-bold px-3 shadow-sm" onclick="applyPreset('#DC2626', '#881337', '#F59E0B')">
                                                        <span style="display:inline-block; width:12px; height:12px; border-radius:50%; background:#DC2626; margin-right:5px;"></span>
                                                        Marun & Gold Elegan
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="primary_color" class="font-weight-bold">Warna Utama (Primary Color)</label>
                                                    <div class="input-group">
                                                        <input type="color" class="form-control form-control-color" id="primary_color" name="primary_color"
                                                            value="{{ old('primary_color', $setting?->primary_color ?? '#1A56DB') }}" style="width: 60px; height: 42px; padding: 2px;">
                                                        <input type="text" class="form-control font-weight-bold text-uppercase" id="primary_color_text"
                                                            value="{{ old('primary_color', $setting?->primary_color ?? '#1A56DB') }}" maxlength="7">
                                                    </div>
                                                    <small class="text-muted">Warna tombol utama, header bar, ikon, dan tautan.</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="secondary_color" class="font-weight-bold">Warna Gelap / Gradien (Secondary)</label>
                                                    <div class="input-group">
                                                        <input type="color" class="form-control form-control-color" id="secondary_color" name="secondary_color"
                                                            value="{{ old('secondary_color', $setting?->secondary_color ?? '#0B3B7B') }}" style="width: 60px; height: 42px; padding: 2px;">
                                                        <input type="text" class="form-control font-weight-bold text-uppercase" id="secondary_color_text"
                                                            value="{{ old('secondary_color', $setting?->secondary_color ?? '#0B3B7B') }}" maxlength="7">
                                                    </div>
                                                    <small class="text-muted">Warna gelap untuk pasangan gradien hero banner.</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="accent_color" class="font-weight-bold">Warna Aksen / Status (Accent)</label>
                                                    <div class="input-group">
                                                        <input type="color" class="form-control form-control-color" id="accent_color" name="accent_color"
                                                            value="{{ old('accent_color', $setting?->accent_color ?? '#10B981') }}" style="width: 60px; height: 42px; padding: 2px;">
                                                        <input type="text" class="form-control font-weight-bold text-uppercase" id="accent_color_text"
                                                            value="{{ old('accent_color', $setting?->accent_color ?? '#10B981') }}" maxlength="7">
                                                    </div>
                                                    <small class="text-muted">Warna badge aktif, status pendaftaran, atau aksen.</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Live Color Preview Box -->
                                        <div class="card border rounded mt-3 shadow-sm overflow-hidden" id="themePreviewBox">
                                            <div class="card-header text-white p-3 font-weight-bold d-flex justify-content-between align-items-center" id="previewHeaderGrad"
                                                style="background: linear-gradient(135deg, {{ $setting?->secondary_color ?? '#0B3B7B' }} 0%, {{ $setting?->primary_color ?? '#1A56DB' }} 100%);">
                                                <span><i class="fas fa-eye mr-2"></i> Pratinjau Tampilan Tema Warna Langsung</span>
                                                <span class="badge badge-light px-3 py-1 font-weight-bold text-dark" id="previewBadge">TAHUN AJARAN {{ $setting?->tahun_ajaran ?? '2027/2028' }}</span>
                                            </div>
                                            <div class="card-body p-4 bg-white">
                                                <h5 class="font-weight-bold" id="previewTextTitle" style="color: {{ $setting?->primary_color ?? '#1A56DB' }};">
                                                    Contoh Tampilan Kartu & Komponen Web SPMB
                                                </h5>
                                                <p class="text-muted mb-3">Ini adalah simulasi tampilan tombol dan elemen visual yang akan langsung dilihat oleh calon siswa di peramban mereka.</p>
                                                <button type="button" class="btn text-white font-weight-bold px-4 py-2 mr-2 shadow-sm" id="previewBtnPrimary"
                                                    style="background-color: {{ $setting?->primary_color ?? '#1A56DB' }}; border-color: {{ $setting?->primary_color ?? '#1A56DB' }};">
                                                    <i class="fas fa-check-circle mr-1"></i> Tombol Aksi Utama
                                                </button>
                                                <button type="button" class="btn text-white font-weight-bold px-3 py-2 shadow-sm" id="previewBtnAccent"
                                                    style="background-color: {{ $setting?->accent_color ?? '#10B981' }}; border-color: {{ $setting?->accent_color ?? '#10B981' }};">
                                                    <i class="fas fa-star mr-1"></i> Tombol Status / Aksen
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- TAB 3: GELOMBANG & BANNER -->
                                    <div class="tab-pane fade" id="tab-banner" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="font-weight-bold d-block">Status Penerimaan Pendaftaran</label>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="status_buka" name="status_pendaftaran" value="buka" class="custom-control-input"
                                                            {{ ($setting?->status_pendaftaran ?? 'buka') === 'buka' ? 'checked' : '' }}>
                                                        <label class="custom-control-label text-success font-weight-bold" for="status_buka">
                                                            <i class="fas fa-door-open mr-1"></i> DIBUKA
                                                        </label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="status_tutup" name="status_pendaftaran" value="tutup" class="custom-control-input"
                                                            {{ ($setting?->status_pendaftaran ?? 'buka') === 'tutup' ? 'checked' : '' }}>
                                                        <label class="custom-control-label text-danger font-weight-bold" for="status_tutup">
                                                            <i class="fas fa-door-closed mr-1"></i> DITUTUP
                                                        </label>
                                                    </div>
                                                    <small class="form-text text-muted">Jika ditutup, tombol daftar menampilkan pesan ramah.</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="gelombang_aktif" class="font-weight-bold">Nama Gelombang Aktif</label>
                                                    <input type="text" class="form-control font-weight-bold" id="gelombang_aktif" name="gelombang_aktif"
                                                        value="{{ old('gelombang_aktif', $setting?->gelombang_aktif ?? 'Gelombang 1') }}" placeholder="Contoh: Gelombang 1 - Early Bird">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="tanggal_tutup_gelombang" class="font-weight-bold">
                                                        <i class="fas fa-stopwatch text-warning mr-1"></i> Batas Akhir Gelombang (Countdown)
                                                    </label>
                                                    <input type="date" class="form-control" id="tanggal_tutup_gelombang" name="tanggal_tutup_gelombang"
                                                        value="{{ old('tanggal_tutup_gelombang', $setting?->tanggal_tutup_gelombang ? \Carbon\Carbon::parse($setting->tanggal_tutup_gelombang)->format('Y-m-d') : '') }}">
                                                    <small class="text-muted">Menghidupkan timer hitung mundur otomatis di beranda.</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Poster & Brosur SPMB Upload Card -->
                                        <div class="card bg-light border mb-3">
                                            <div class="card-header bg-white font-weight-bold text-dark py-2">
                                                <i class="fas fa-images text-primary mr-1"></i> Upload Poster Hero & 3 Brosur Resmi SPMB
                                            </div>
                                            <div class="card-body p-3">
                                                <div class="row">
                                                    <div class="col-md-3 mb-3">
                                                        <label class="font-weight-bold small">Poster Utama Hero</label>
                                                        <div class="custom-file mb-2">
                                                            <input type="file" class="custom-file-input" name="hero_image_path" id="hero-img-input" accept="image/*">
                                                            <label class="custom-file-label small" for="hero-img-input">Pilih file...</label>
                                                        </div>
                                                        <div class="text-center p-2 bg-white rounded border">
                                                            <img src="{{ $setting?->hero_image_url }}" alt="Poster Hero" class="img-fluid rounded" style="max-height: 100px; object-fit: contain;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="font-weight-bold small">Brosur 1: Panduan</label>
                                                        <div class="custom-file mb-2">
                                                            <input type="file" class="custom-file-input" name="brosur_panduan_path" id="brosur1-input" accept="image/*">
                                                            <label class="custom-file-label small" for="brosur1-input">Pilih file...</label>
                                                        </div>
                                                        <div class="text-center p-2 bg-white rounded border">
                                                            <img src="{{ $setting?->brosur_panduan_url }}" alt="Brosur Panduan" class="img-fluid rounded" style="max-height: 100px; object-fit: contain;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="font-weight-bold small">Brosur 2: Syarat</label>
                                                        <div class="custom-file mb-2">
                                                            <input type="file" class="custom-file-input" name="brosur_syarat_path" id="brosur2-input" accept="image/*">
                                                            <label class="custom-file-label small" for="brosur2-input">Pilih file...</label>
                                                        </div>
                                                        <div class="text-center p-2 bg-white rounded border">
                                                            <img src="{{ $setting?->brosur_syarat_url }}" alt="Brosur Syarat" class="img-fluid rounded" style="max-height: 100px; object-fit: contain;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="font-weight-bold small">Brosur 3: Alur SPMB</label>
                                                        <div class="custom-file mb-2">
                                                            <input type="file" class="custom-file-input" name="brosur_alur_path" id="brosur3-input" accept="image/*">
                                                            <label class="custom-file-label small" for="brosur3-input">Pilih file...</label>
                                                        </div>
                                                        <div class="text-center p-2 bg-white rounded border">
                                                            <img src="{{ $setting?->brosur_alur_url }}" alt="Brosur Alur" class="img-fluid rounded" style="max-height: 100px; object-fit: contain;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <small class="text-muted"><i class="fas fa-info-circle mr-1"></i> Format JPG/PNG/WEBP. Jika belum mengunggah, sistem otomatis memakai poster/brosur default.</small>
                                            </div>
                                        </div>

                                        <!-- Statistik & Milestone Counter Bar -->
                                        <div class="card bg-light border mb-3">
                                            <div class="card-header bg-white font-weight-bold text-dark py-2">
                                                <i class="fas fa-chart-line text-success mr-1"></i> 4 Statistik Keberhasilan Sekolah (Social Proof Bar)
                                            </div>
                                            <div class="card-body p-3">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-md-0">
                                                            <label for="stat_akreditasi" class="font-weight-bold small">Status Akreditasi</label>
                                                            <input type="text" class="form-control" id="stat_akreditasi" name="stat_akreditasi"
                                                                value="{{ old('stat_akreditasi', $setting?->stat_akreditasi ?? 'A (Unggul)') }}" placeholder="A (Unggul)">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-md-0">
                                                            <label for="stat_lulusan_kerja" class="font-weight-bold small">% Lulusan Bekerja & Kuliah</label>
                                                            <input type="text" class="form-control" id="stat_lulusan_kerja" name="stat_lulusan_kerja"
                                                                value="{{ old('stat_lulusan_kerja', $setting?->stat_lulusan_kerja ?? '95%+') }}" placeholder="95%+">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-md-0">
                                                            <label for="stat_mitra_industri" class="font-weight-bold small">Total Mitra Industri</label>
                                                            <input type="text" class="form-control" id="stat_mitra_industri" name="stat_mitra_industri"
                                                                value="{{ old('stat_mitra_industri', $setting?->stat_mitra_industri ?? '50+') }}" placeholder="50+">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-md-0">
                                                            <label for="stat_ekskul_lab" class="font-weight-bold small">Lab & Fasilitas</label>
                                                            <input type="text" class="form-control" id="stat_ekskul_lab" name="stat_ekskul_lab"
                                                                value="{{ old('stat_ekskul_lab', $setting?->stat_ekskul_lab ?? '15+') }}" placeholder="15+">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card bg-light border mb-3">
                                            <div class="card-header bg-white font-weight-bold text-dark py-2">
                                                <i class="fas fa-home text-primary mr-1"></i> Konten Bagian Hero (Atas)
                                            </div>
                                            <div class="card-body p-3">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label for="hero_badge" class="font-weight-bold">Teks Badge Paling Atas (Pita Informasi)</label>
                                                            <input type="text" class="form-control" id="hero_badge" name="hero_badge"
                                                                value="{{ old('hero_badge', $setting?->hero_badge ?? 'TERAKREDITASI A • PENERIMAAN SISWA BARU ONLINE') }}"
                                                                placeholder="Contoh: TERAKREDITASI A • PENERIMAAN SISWA BARU ONLINE">
                                                            <small class="text-muted">Teks kecil melengkung di atas judul utama.</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="hero_cta_text" class="font-weight-bold">Teks Tombol Aksi Utama</label>
                                                            <input type="text" class="form-control" id="hero_cta_text" name="hero_cta_text"
                                                                value="{{ old('hero_cta_text', $setting?->hero_cta_text ?? 'Daftar Sekarang (Online)') }}"
                                                                placeholder="Contoh: Daftar Sekarang (Online)">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="hero_title" class="font-weight-bold">Judul Utama Banner Hero</label>
                                                    <input type="text" class="form-control font-weight-bold" id="hero_title" name="hero_title"
                                                        value="{{ old('hero_title', $setting?->hero_title ?? 'Membuka Jalan Menuju Keahlian Nyata & Karir Masa Depan') }}"
                                                        placeholder="Contoh: Membuka Jalan Menuju Keahlian Nyata & Karir Masa Depan">
                                                </div>

                                                <div class="form-group mb-0">
                                                    <label for="hero_subtitle" class="font-weight-bold">Subjudul Deskripsi Hero (Sambutan Ramah Calon Siswa & Ortu)</label>
                                                    <textarea class="form-control" id="hero_subtitle" name="hero_subtitle" rows="3">{{ old('hero_subtitle', $setting?->hero_subtitle ?? 'Selamat datang calon peserta didik baru dan orang tua. Pelajari program keahlian unggulan kami, fasilitas praktik industri, dan daftar mandiri dari rumah dalam hitungan menit.') }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card bg-light border mb-3">
                                            <div class="card-header bg-white font-weight-bold text-dark py-2">
                                                <i class="fas fa-list-ol text-info mr-1"></i> Konten Bagian Langkah & Ajakan Bawah
                                            </div>
                                            <div class="card-body p-3">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="panduan_title" class="font-weight-bold">Judul Bagian Langkah Pendaftaran</label>
                                                            <input type="text" class="form-control font-weight-bold" id="panduan_title" name="panduan_title"
                                                                value="{{ old('panduan_title', $setting?->panduan_title ?? '4 Langkah Mudah Pendaftaran Siswa') }}"
                                                                placeholder="4 Langkah Mudah Pendaftaran Siswa">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="panduan_desc" class="font-weight-bold">Deskripsi Bagian Langkah</label>
                                                            <input type="text" class="form-control" id="panduan_desc" name="panduan_desc"
                                                                value="{{ old('panduan_desc', $setting?->panduan_desc ?? 'Ikuti tahapan pendaftaran secara berurutan agar proses seleksi berjalan lancar.') }}"
                                                                placeholder="Ikuti tahapan pendaftaran secara berurutan...">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-md-0">
                                                            <label for="cta_banner_title" class="font-weight-bold">Judul Banner Ajakan Bawah (CTA)</label>
                                                            <input type="text" class="form-control font-weight-bold" id="cta_banner_title" name="cta_banner_title"
                                                                value="{{ old('cta_banner_title', $setting?->cta_banner_title ?? 'Siap Menjadi Bagian dari Keluarga Besar Kami?') }}"
                                                                placeholder="Siap Menjadi Bagian dari Keluarga Besar Kami?">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-0">
                                                            <label for="cta_banner_desc" class="font-weight-bold">Deskripsi Banner Ajakan Bawah</label>
                                                            <input type="text" class="form-control" id="cta_banner_desc" name="cta_banner_desc"
                                                                value="{{ old('cta_banner_desc', $setting?->cta_banner_desc ?? 'Kuota setiap jurusan terbatas untuk menjamin rasio praktik terbaik. Daftar lebih awal untuk mengamankan pilihan jurusan Anda.') }}"
                                                                placeholder="Kuota setiap jurusan terbatas...">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="pesan_penutupan" class="font-weight-bold">Pesan Ramah Saat Pendaftaran Ditutup</label>
                                            <textarea class="form-control" id="pesan_penutupan" name="pesan_penutupan" rows="2">{{ old('pesan_penutupan', $setting?->pesan_penutupan ?? 'Terima kasih atas antusiasme Anda. Pendaftaran saat ini sedang ditutup sementara atau kuota telah terpenuhi. Silakan hubungi panitia via WhatsApp untuk informasi gelombang berikutnya.') }}</textarea>
                                        </div>
                                    </div>

                                    <!-- TAB 4: REKENING & BIAYA (MULTI-REKENING) -->
                                    <div class="tab-pane fade" id="tab-payment" role="tabpanel">
                                        <div class="alert alert-info py-2">
                                            <i class="fas fa-info-circle mr-1"></i> Atur nominal biaya pendaftaran dan rekening bank tujuan transfer. <strong>Mendukung lebih dari 1 rekening bank</strong> untuk kemudahan pendaftar.
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="biaya_pendaftaran" class="font-weight-bold">Biaya Pendaftaran / Formulir (Rp) <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control font-weight-bold text-success" id="biaya_pendaftaran" name="biaya_pendaftaran"
                                                        value="{{ old('biaya_pendaftaran', $setting?->biaya_pendaftaran ?? 200000) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="kontak_wa" class="font-weight-bold">Nomor WhatsApp Panitia SPMB</label>
                                                    <input type="text" class="form-control" id="kontak_wa" name="kontak_wa"
                                                        value="{{ old('kontak_wa', $setting?->kontak_wa ?? '6281222223333') }}" placeholder="Format: 628xxxxxxx">
                                                    <small class="text-muted">Gunakan awalan 62 (contoh: 6281234567890) untuk integrasi link WhatsApp otomatis.</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email_notifikasi" class="font-weight-bold">Email Notifikasi Sekolah</label>
                                                    <input type="email" class="form-control" id="email_notifikasi" name="email_notifikasi"
                                                        value="{{ old('email_notifikasi', $setting?->email_notifikasi ?? 'admin@x.com') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="atas_nama" class="font-weight-bold">Nama Atas Nama Institusi / Yayasan</label>
                                                    <input type="text" class="form-control" id="atas_nama" name="atas_nama"
                                                        value="{{ old('atas_nama', $setting?->atas_nama ?? 'SMK ICB Cinta Teknika') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Multi-Rekening Bank Section -->
                                        <div class="card border rounded bg-white shadow-sm mt-3">
                                            <div class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                                                <span class="font-weight-bold text-dark">
                                                    <i class="fas fa-university text-primary mr-1"></i> Daftar Pilihan Rekening Bank Tujuan Transfer (Multi-Rekening)
                                                </span>
                                                <button type="button" class="btn btn-primary btn-sm font-weight-bold px-3 shadow-sm" data-toggle="modal" data-target="#modalTambahRekening">
                                                    <i class="fas fa-plus mr-1"></i> Tambah Rekening Bank
                                                </button>
                                            </div>
                                            <div class="card-body p-0">
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-striped mb-0" id="tableRekeningBank">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th style="width: 6%; text-align: center;">Urutan</th>
                                                                <th>Nama Bank</th>
                                                                <th>Nomor Rekening</th>
                                                                <th>Atas Nama</th>
                                                                <th>Keterangan</th>
                                                                <th style="width: 14%; text-align: center;">Status</th>
                                                                <th style="width: 10%; text-align: center;">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($rekeningBanks as $rb)
                                                                <tr id="row-rekening-{{ $rb->id }}">
                                                                    <td class="text-center font-weight-bold">{{ $rb->urutan }}</td>
                                                                    <td class="font-weight-bold text-primary"><i class="fas fa-money-check-alt mr-1"></i> {{ $rb->nama_bank }}</td>
                                                                    <td class="font-weight-bold">{{ $rb->nomor_rekening }}</td>
                                                                    <td>{{ $rb->atas_nama }}</td>
                                                                    <td class="text-muted small">{{ $rb->petunjuk_transfer ?? '-' }}</td>
                                                                    <td class="text-center">
                                                                        <button type="button" class="btn btn-sm {{ $rb->is_active ? 'btn-success' : 'btn-outline-danger' }} font-weight-bold btnToggleRekening"
                                                                            data-id="{{ $rb->id }}" style="border-radius: 20px; font-size: 11px;">
                                                                            <i class="fas {{ $rb->is_active ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                                                                            {{ $rb->is_active ? 'AKTIF' : 'NONAKTIF' }}
                                                                        </button>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <button type="button" class="btn btn-danger btn-xs btnHapusRekening" data-id="{{ $rb->id }}" data-bank="{{ $rb->nama_bank }}">
                                                                            <i class="fas fa-trash-alt"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr id="empty-rekening-row">
                                                                    <td colspan="7" class="text-center text-muted py-3">
                                                                        Belum ada rekening bank terdaftar. Silakan klik "Tambah Rekening Bank".
                                                                    </td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- TAB 5: PENGATURAN NIS -->
                                    <div class="tab-pane fade" id="tab-nis" role="tabpanel">
                                        <div class="alert alert-info py-2">
                                            <i class="fas fa-info-circle mr-1"></i> Penomoran NIS otomatis saat calon siswa diterima di panel verifikasi.
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
                                                    <small class="text-muted">Nomor urut yang akan diberikan ke siswa diterima berikutnya (di-pad 4 digit, misal: 0001).</small>
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

                                    <!-- TAB 6: PERSYARATAN BERKAS TAMBAHAN (DINAMIS / BISA DI-DISABLE) -->
                                    <div class="tab-pane fade" id="tab-berkas" role="tabpanel">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div>
                                                <h6 class="font-weight-bold text-dark mb-1">Daftar Dokumen Persyaratan Calon Siswa</h6>
                                                <p class="text-muted small mb-0">
                                                    Atur berkas yang perlu diunggah oleh pendaftar. 
                                                    <strong>Jika semua berkas di-nonaktifkan (disable)</strong>, siswa tidak akan diminta upload berkas tambahan dan pendaftaran hanya memerlukan bukti pembayaran.
                                                </p>
                                            </div>
                                            <button type="button" class="btn btn-success btn-sm font-weight-bold px-3 shadow-sm" data-toggle="modal" data-target="#modalTambahBerkas">
                                                <i class="fas fa-plus mr-1"></i> Tambah Persyaratan Berkas
                                            </button>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover bg-white" id="tableSyaratBerkas">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th style="width: 6%; text-align: center;">Urutan</th>
                                                        <th>Nama Dokumen</th>
                                                        <th>Deskripsi / Petunjuk</th>
                                                        <th style="width: 14%; text-align: center;">Kewajiban</th>
                                                        <th style="width: 15%; text-align: center;">Status</th>
                                                        <th style="width: 12%; text-align: center;">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($syaratBerkas as $sb)
                                                        <tr id="row-syarat-{{ $sb->id }}">
                                                            <td class="text-center font-weight-bold">{{ $sb->urutan }}</td>
                                                            <td class="font-weight-bold text-dark">{{ $sb->nama_berkas }}</td>
                                                            <td class="text-muted small">{{ $sb->deskripsi ?? '-' }}</td>
                                                            <td class="text-center">
                                                                @if ($sb->is_required)
                                                                    <span class="badge badge-danger px-2 py-1">WAJIB</span>
                                                                @else
                                                                    <span class="badge badge-secondary px-2 py-1">OPSIONAL</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-sm {{ $sb->is_active ? 'btn-success' : 'btn-outline-danger' }} font-weight-bold btnToggleBerkas"
                                                                    data-id="{{ $sb->id }}" style="border-radius: 20px; font-size: 12px;">
                                                                    <i class="fas {{ $sb->is_active ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                                                                    {{ $sb->is_active ? 'AKTIF' : 'NONAKTIF (OFF)' }}
                                                                </button>
                                                            </td>
                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-danger btn-xs btnHapusBerkas" data-id="{{ $sb->id }}" data-nama="{{ $sb->nama_berkas }}">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr id="empty-berkas-row">
                                                            <td colspan="6" class="text-center text-muted py-4">
                                                                Belum ada persyaratan berkas tambahan. Silakan klik tombol "Tambah Persyaratan Berkas".
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- TAB 7: TEMPLATE WHATSAPP & CETAK PDF -->
                                    <div class="tab-pane fade" id="tab-templates" role="tabpanel">
                                        <div class="alert alert-info py-2 mb-3">
                                            <i class="fab fa-whatsapp mr-1"></i> <strong>Template Notifikasi Direct WhatsApp & Cetak PDF:</strong>
                                            Gunakan variabel dinamis: <code>{nama}</code>, <code>{sekolah}</code>, <code>{jurusan}</code>, <code>{nis}</code>, dan <code>{alasan}</code>.
                                        </div>

                                        <div class="form-group">
                                            <label for="wa_template_lulus" class="font-weight-bold text-success">
                                                <i class="fab fa-whatsapp mr-1"></i> Template WhatsApp Siswa Diterima
                                            </label>
                                            <textarea class="form-control" id="wa_template_lulus" name="wa_template_lulus" rows="3">{{ old('wa_template_lulus', $setting?->wa_template_lulus ?? 'Halo Ananda {nama}, selamat! Anda dinyatakan DITERIMA di {sekolah} pada Jurusan {jurusan} dengan Nomor Induk Siswa (NIS) Resmi: {nis}. Silakan cek email Anda untuk surat kelulusan resmi dan petunjuk daftar ulang.') }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="wa_template_revisi" class="font-weight-bold text-warning">
                                                <i class="fab fa-whatsapp mr-1"></i> Template WhatsApp Perbaikan / Bukti Ditolak
                                            </label>
                                            <textarea class="form-control" id="wa_template_revisi" name="wa_template_revisi" rows="3">{{ old('wa_template_revisi', $setting?->wa_template_revisi ?? 'Halo Ananda {nama}, terima kasih telah mendaftar di {sekolah}. Mohon maaf bukti transfer atau berkas Anda belum dapat kami validasi dengan catatan: "{alasan}". Mohon konfirmasi atau kirimkan ulang bukti yang jelas.') }}</textarea>
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="pdf_penandatangan" class="font-weight-bold">Nama / Jabatan Penandatangan di Tanda Terima PDF</label>
                                                    <input type="text" class="form-control" id="pdf_penandatangan" name="pdf_penandatangan"
                                                        value="{{ old('pdf_penandatangan', $setting?->pdf_penandatangan ?? 'Panitia SPMB') }}" placeholder="Contoh: Panitia SPMB / Kepala Sekolah">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="pdf_catatan_kaki" class="font-weight-bold">Catatan Kaki Petunjuk di Lembar Tanda Terima PDF</label>
                                                    <textarea class="form-control" id="pdf_catatan_kaki" name="pdf_catatan_kaki" rows="2">{{ old('pdf_catatan_kaki', $setting?->pdf_catatan_kaki ?? 'Bawalah lembar tanda terima ini beserta berkas fotokopi saat pelaksanaan wawancara atau daftar ulang di kampus sekolah.') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- TAB 8: CMS PANDUAN -->
                                    <div class="tab-pane fade" id="tab-article" role="tabpanel">
                                        <div class="form-group">
                                            <label for="artikel_judul" class="font-weight-bold">Judul Artikel Informasi SPMB</label>
                                            <input type="text" class="form-control font-weight-bold" id="artikel_judul" name="artikel_judul"
                                                value="{{ old('artikel_judul', $setting?->artikel_judul ?? 'Panduan Lengkap Penerimaan Calon Siswa Baru') }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="artikel_konten" class="font-weight-bold">Isi Konten Artikel / Pengumuman</label>
                                            <textarea class="form-control" id="artikel_konten" name="artikel_konten" rows="10">{{ old('artikel_konten', $setting?->artikel_konten) }}</textarea>
                                        </div>
                                    </div>

                                    <!-- TAB 9: TANYA JAWAB (FAQ) DINAMIS -->
                                    <div class="tab-pane fade" id="tab-faq" role="tabpanel">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div>
                                                <h5 class="font-weight-bold text-dark mb-1"><i class="fas fa-question-circle text-danger mr-2"></i> Kelola Pertanyaan & Jawaban (FAQ)</h5>
                                                <p class="text-muted small mb-0">Pertanyaan umum ini akan langsung tampil di accordion FAQ beranda calon siswa.</p>
                                            </div>
                                            <button type="button" class="btn btn-danger btn-sm font-weight-bold px-3 shadow-sm" data-toggle="modal" data-target="#modalTambahFaq">
                                                <i class="fas fa-plus mr-1"></i> Tambah Pertanyaan FAQ
                                            </button>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-hover table-striped border rounded" id="tableFaq">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th style="width: 5%; text-align: center;">Urutan</th>
                                                        <th style="width: 30%;">Pertanyaan</th>
                                                        <th>Jawaban</th>
                                                        <th style="width: 12%; text-align: center;">Kategori</th>
                                                        <th style="width: 12%; text-align: center;">Status</th>
                                                        <th style="width: 10%; text-align: center;">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($faqs as $f)
                                                        <tr id="row-faq-{{ $f->id }}">
                                                            <td class="text-center font-weight-bold">{{ $f->urutan }}</td>
                                                            <td class="font-weight-bold text-dark">{{ $f->pertanyaan }}</td>
                                                            <td class="small text-muted">{{ Str::limit($f->jawaban, 100) }}</td>
                                                            <td class="text-center"><span class="badge badge-light border">{{ $f->kategori }}</span></td>
                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-xs {{ $f->is_active ? 'btn-success' : 'btn-outline-danger' }} btnToggleFaq font-weight-bold" data-id="{{ $f->id }}">
                                                                    {{ $f->is_active ? 'AKTIF' : 'NONAKTIF' }}
                                                                </button>
                                                            </td>
                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-xs btn-outline-danger btnHapusFaq" data-id="{{ $f->id }}" data-pertanyaan="{{ $f->pertanyaan }}">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr id="empty-faq-row">
                                                            <td colspan="6" class="text-center py-4 text-muted">Belum ada pertanyaan FAQ.</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- TAB 10: MITRA INDUSTRI (DU/DI) -->
                                    <div class="tab-pane fade" id="tab-mitra" role="tabpanel">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div>
                                                <h5 class="font-weight-bold text-dark mb-1"><i class="fas fa-handshake text-primary mr-2"></i> Rekanan Mitra Industri (Dunia Usaha & Kerja)</h5>
                                                <p class="text-muted small mb-0">Logo perusahaan rekanan magang & penyaluran kerja yang tampil di beranda sekolah.</p>
                                            </div>
                                            <button type="button" class="btn btn-primary btn-sm font-weight-bold px-3 shadow-sm" data-toggle="modal" data-target="#modalTambahMitra">
                                                <i class="fas fa-plus mr-1"></i> Tambah Mitra Industri
                                            </button>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-hover table-striped border rounded" id="tableMitra">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th style="width: 6%; text-align: center;">Urutan</th>
                                                        <th style="width: 35%;">Nama Perusahaan / Institusi</th>
                                                        <th>Bidang Usaha</th>
                                                        <th style="width: 14%; text-align: center;">Status</th>
                                                        <th style="width: 10%; text-align: center;">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($mitraIndustris as $m)
                                                        <tr id="row-mitra-{{ $m->id }}">
                                                            <td class="text-center font-weight-bold">{{ $m->urutan }}</td>
                                                            <td class="font-weight-bold text-primary">
                                                                <i class="fas fa-building mr-1"></i> {{ $m->nama_mitra }}
                                                            </td>
                                                            <td class="small">{{ $m->bidang ?? 'Industri & Teknologi' }}</td>
                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-xs {{ $m->is_active ? 'btn-success' : 'btn-outline-danger' }} btnToggleMitra font-weight-bold" data-id="{{ $m->id }}">
                                                                    {{ $m->is_active ? 'AKTIF' : 'NONAKTIF' }}
                                                                </button>
                                                            </td>
                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-xs btn-outline-danger btnHapusMitra" data-id="{{ $m->id }}" data-nama="{{ $m->nama_mitra }}">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr id="empty-mitra-row">
                                                            <td colspan="5" class="text-center py-4 text-muted">Belum ada mitra industri.</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- TAB 11: TESTIMONI ALUMNI -->
                                    <div class="tab-pane fade" id="tab-testimoni" role="tabpanel">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div>
                                                <h5 class="font-weight-bold text-dark mb-1"><i class="fas fa-comment-dots text-success mr-2"></i> Testimoni Alumni & Siswa</h5>
                                                <p class="text-muted small mb-0">Ulasan nyata alumni yang sudah berkarir sukses untuk menginspirasi pendaftar baru.</p>
                                            </div>
                                            <button type="button" class="btn btn-success btn-sm font-weight-bold px-3 shadow-sm" data-toggle="modal" data-target="#modalTambahTestimoni">
                                                <i class="fas fa-plus mr-1"></i> Tambah Testimoni
                                            </button>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-hover table-striped border rounded" id="tableTestimoni">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th style="width: 6%; text-align: center;">Urutan</th>
                                                        <th style="width: 25%;">Nama Alumni</th>
                                                        <th style="width: 25%;">Profesi / Pekerjaan Saat Ini</th>
                                                        <th>Ulasan Singkat</th>
                                                        <th style="width: 12%; text-align: center;">Status</th>
                                                        <th style="width: 10%; text-align: center;">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($testimonis as $t)
                                                        <tr id="row-testimoni-{{ $t->id }}">
                                                            <td class="text-center font-weight-bold">{{ $t->urutan }}</td>
                                                            <td class="font-weight-bold text-dark">
                                                                {{ $t->nama }}
                                                                <small class="d-block text-muted">{{ $t->tahun_lulus }} &bull; {{ $t->jurusan }}</small>
                                                            </td>
                                                            <td class="small text-primary font-weight-bold">{{ $t->profesi_alumni }}</td>
                                                            <td class="small text-muted">"{{ Str::limit($t->testimoni, 90) }}"</td>
                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-xs {{ $t->is_active ? 'btn-success' : 'btn-outline-danger' }} btnToggleTestimoni font-weight-bold" data-id="{{ $t->id }}">
                                                                    {{ $t->is_active ? 'AKTIF' : 'NONAKTIF' }}
                                                                </button>
                                                            </td>
                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-xs btn-outline-danger btnHapusTestimoni" data-id="{{ $t->id }}" data-nama="{{ $t->nama }}">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr id="empty-testimoni-row">
                                                            <td colspan="6" class="text-center py-4 text-muted">Belum ada testimoni alumni.</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer bg-white text-right sticky-mobile-save">
                                <button type="submit" class="btn btn-primary px-4 font-weight-bold shadow" id="btnSave">
                                    <i class="fas fa-save mr-1"></i> Simpan Semua Pengaturan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Tambah Rekening Bank -->
    <div class="modal fade" id="modalTambahRekening" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
                <div class="modal-header text-white" style="background: linear-gradient(135deg, #102C57 0%, #1c4b8b 100%);">
                    <h5 class="modal-title font-weight-bold"><i class="fas fa-university mr-1"></i> Tambah Rekening Bank Tujuan</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <form id="formTambahRekening">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="form-group">
                            <label for="modal_nama_bank" class="font-weight-bold">Nama Bank <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="modal_nama_bank" name="nama_bank" required placeholder="Contoh: Bank BRI / Bank BNI / BCA / Bank Mandiri / Bank BJB">
                        </div>
                        <div class="form-group">
                            <label for="modal_no_rek" class="font-weight-bold">Nomor Rekening <span class="text-danger">*</span></label>
                            <input type="text" class="form-control font-weight-bold text-primary" id="modal_no_rek" name="nomor_rekening" required placeholder="Contoh: 210501000140303">
                        </div>
                        <div class="form-group">
                            <label for="modal_atas_nama" class="font-weight-bold">Nama Pemilik Rekening (Atas Nama) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="modal_atas_nama" name="atas_nama" required value="{{ $setting->atas_nama ?? '' }}" placeholder="Contoh: SMK ICB Cinta Teknika">
                        </div>
                        <div class="form-group">
                            <label for="modal_petunjuk" class="font-weight-bold">Catatan / Keterangan Transfer</label>
                            <input type="text" class="form-control" id="modal_petunjuk" name="petunjuk_transfer" placeholder="Contoh: Rekening Utama Penerimaan SPMB">
                        </div>
                        <div class="form-group">
                            <label for="modal_urutan_rek" class="font-weight-bold">Urutan Tampil</label>
                            <input type="number" class="form-control" id="modal_urutan_rek" name="urutan" value="{{ ($rekeningBanks->max('urutan') ?? 0) + 1 }}" min="1">
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary px-3" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary font-weight-bold px-4" id="btnSimpanRekening">
                            <i class="fas fa-save mr-1"></i> Simpan Rekening
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Syarat Berkas -->
    <div class="modal fade" id="modalTambahBerkas" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
                <div class="modal-header text-white" style="background: linear-gradient(135deg, #102C57 0%, #1c4b8b 100%);">
                    <h5 class="modal-title font-weight-bold"><i class="fas fa-plus-circle mr-1"></i> Tambah Dokumen Persyaratan</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <form id="formTambahBerkas">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="form-group">
                            <label for="modal_nama_berkas" class="font-weight-bold">Nama Dokumen / Berkas <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="modal_nama_berkas" name="nama_berkas" required placeholder="Contoh: Kartu Keluarga (KK) / Akta Lahir">
                        </div>
                        <div class="form-group">
                            <label for="modal_deskripsi" class="font-weight-bold">Petunjuk Pengunggahan</label>
                            <input type="text" class="form-control" id="modal_deskripsi" name="deskripsi" placeholder="Contoh: Scan/Foto asli dokumen jelas dan terbaca">
                        </div>
                        <div class="form-group">
                            <label for="modal_urutan" class="font-weight-bold">Urutan Tampil</label>
                            <input type="number" class="form-control" id="modal_urutan" name="urutan" value="{{ ($syaratBerkas->max('urutan') ?? 0) + 1 }}" min="1">
                        </div>
                        <div class="custom-control custom-checkbox mt-2">
                            <input type="checkbox" class="custom-control-input" id="modal_is_required" name="is_required" value="1" checked>
                            <label class="custom-control-label font-weight-bold" for="modal_is_required">Wajib Diunggah Siswa (Mandatory)</label>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary px-3" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success font-weight-bold px-4" id="btnSimpanBerkas">
                            <i class="fas fa-save mr-1"></i> Simpan Dokumen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah FAQ -->
    <div class="modal fade" id="modalTambahFaq" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
                <div class="modal-header text-white" style="background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%);">
                    <h5 class="modal-title font-weight-bold"><i class="fas fa-question-circle mr-1"></i> Tambah Pertanyaan FAQ</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <form id="formTambahFaq">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="form-group">
                            <label class="font-weight-bold">Pertanyaan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control font-weight-bold" name="pertanyaan" required placeholder="Contoh: Bagaimana jika ijazah belum terbit?">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Jawaban <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="jawaban" rows="4" required placeholder="Tuliskan jawaban yang jelas dan membantu..."></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Kategori</label>
                                    <input type="text" class="form-control" name="kategori" value="Umum" placeholder="Umum / Biaya / Berkas">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Urutan</label>
                                    <input type="number" class="form-control" name="urutan" value="{{ ($faqs->max('urutan') ?? 0) + 1 }}" min="1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary px-3" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger font-weight-bold px-4" id="btnSimpanFaq">
                            <i class="fas fa-save mr-1"></i> Simpan FAQ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Mitra Industri -->
    <div class="modal fade" id="modalTambahMitra" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
                <div class="modal-header text-white" style="background: linear-gradient(135deg, #1A56DB 0%, #0B3B7B 100%);">
                    <h5 class="modal-title font-weight-bold"><i class="fas fa-handshake mr-1"></i> Tambah Rekanan Mitra Industri</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <form id="formTambahMitra">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="form-group">
                            <label class="font-weight-bold">Nama Perusahaan / Institusi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control font-weight-bold" name="nama_mitra" required placeholder="Contoh: PT Telkom Indonesia Tbk">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Bidang Usaha</label>
                            <input type="text" class="form-control" name="bidang" placeholder="Contoh: Telekomunikasi & Teknologi Informasi">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Urutan Tampil</label>
                            <input type="number" class="form-control" name="urutan" value="{{ ($mitraIndustris->max('urutan') ?? 0) + 1 }}" min="1">
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary px-3" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary font-weight-bold px-4" id="btnSimpanMitra">
                            <i class="fas fa-save mr-1"></i> Simpan Mitra
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Testimoni Alumni -->
    <div class="modal fade" id="modalTambahTestimoni" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
                <div class="modal-header text-white" style="background: linear-gradient(135deg, #10B981 0%, #047857 100%);">
                    <h5 class="modal-title font-weight-bold"><i class="fas fa-comment-dots mr-1"></i> Tambah Testimoni Alumni</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <form id="formTambahTestimoni">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="form-group">
                            <label class="font-weight-bold">Nama Alumni <span class="text-danger">*</span></label>
                            <input type="text" class="form-control font-weight-bold" name="nama" required placeholder="Contoh: Ahmad Fauzi">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Profesi / Pekerjaan Saat Ini <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="profesi_alumni" required placeholder="Contoh: Staff Keuangan di Bank Mandiri">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Tahun Lulus</label>
                                    <input type="text" class="form-control" name="tahun_lulus" placeholder="Lulusan 2024">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Kompetensi / Jurusan</label>
                                    <input type="text" class="form-control" name="jurusan" placeholder="Akuntansi / RPL">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Ulasan Singkat / Testimoni <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="testimoni" rows="3" required placeholder="Ceritakan pengalaman belajar atau kesiapan kerja yang didapatkan..."></textarea>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Urutan</label>
                            <input type="number" class="form-control" name="urutan" value="{{ ($testimonis->max('urutan') ?? 0) + 1 }}" min="1">
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary px-3" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success font-weight-bold px-4" id="btnSimpanTestimoni">
                            <i class="fas fa-save mr-1"></i> Simpan Testimoni
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="module">
        $(document).ready(function() {
            // SweetAlert Toast Notification Helper (NO RELOAD NEEDED)
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true
            });

            // Tab Memory: Persist active tab across interactions & without page reload
            const TAB_STORAGE_KEY = 'spmb_settings_active_tab';
            $('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
                const targetId = $(e.target).attr('href');
                localStorage.setItem(TAB_STORAGE_KEY, targetId);
                if (history.replaceState) {
                    history.replaceState(null, null, targetId);
                }
            });

            // Restore active tab on load
            const savedTab = window.location.hash || localStorage.getItem(TAB_STORAGE_KEY);
            if (savedTab && $(`a[href="${savedTab}"]`).length) {
                $(`a[href="${savedTab}"]`).tab('show');
            }

            // Preset Application Function
            window.applyPreset = function(primary, secondary, accent, schoolName = null) {
                $('#primary_color').val(primary);
                $('#primary_color_text').val(primary.toUpperCase());
                $('#secondary_color').val(secondary);
                $('#secondary_color_text').val(secondary.toUpperCase());
                $('#accent_color').val(accent);
                $('#accent_color_text').val(accent.toUpperCase());

                if (schoolName) {
                    $('#app_name').val(schoolName);
                }

                updateLivePreview();
                Toast.fire({
                    icon: 'info',
                    title: `Preset warna ${schoolName || 'dipilih'}! Klik 'Simpan' untuk menerapkan.`
                });
            };

            function updateLivePreview() {
                const primary = $('#primary_color').val();
                const secondary = $('#secondary_color').val();
                const accent = $('#accent_color').val();

                $('#previewHeaderGrad').css('background', `linear-gradient(135deg, ${secondary} 0%, ${primary} 100%)`);
                $('#previewTextTitle').css('color', primary);
                $('#previewBtnPrimary').css({
                    'background-color': primary,
                    'border-color': primary
                });
                $('#previewBtnAccent').css({
                    'background-color': accent,
                    'border-color': accent
                });
            }

            // Sync color picker with text inputs
            $('#primary_color').on('input', function() {
                $('#primary_color_text').val($(this).val().toUpperCase());
                updateLivePreview();
            });
            $('#primary_color_text').on('input', function() {
                if ($(this).val().length === 7) {
                    $('#primary_color').val($(this).val());
                    updateLivePreview();
                }
            });

            $('#secondary_color').on('input', function() {
                $('#secondary_color_text').val($(this).val().toUpperCase());
                updateLivePreview();
            });
            $('#secondary_color_text').on('input', function() {
                if ($(this).val().length === 7) {
                    $('#secondary_color').val($(this).val());
                    updateLivePreview();
                }
            });

            $('#accent_color').on('input', function() {
                $('#accent_color_text').val($(this).val().toUpperCase());
                updateLivePreview();
            });
            $('#accent_color_text').on('input', function() {
                if ($(this).val().length === 7) {
                    $('#accent_color').val($(this).val());
                    updateLivePreview();
                }
            });

            // Preview Logo Image on change
            $('#img-input').on('change', function() {
                const file = this.files[0];
                if (file) {
                    $(this).next('.custom-file-label').text(file.name);
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Preview Favicon Image on change
            $('#favicon-input').on('change', function() {
                const file = this.files[0];
                if (file) {
                    $(this).next('.custom-file-label').text(file.name);
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview-favicon').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Handle AJAX form submission for Settings (NO RELOAD!)
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
                        btn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Simpan Semua Pengaturan');
                        Toast.fire({
                            icon: 'success',
                            title: response.message || 'Pengaturan berhasil disimpan!'
                        });
                        if (response.logo_url) {
                            $('#preview').attr('src', response.logo_url);
                        }
                        if (response.favicon_url) {
                            $('#preview-favicon').attr('src', response.favicon_url);
                        }
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

            // Handle Tambah Rekening Bank (NO RELOAD!)
            $('#formTambahRekening').on('submit', function(e) {
                e.preventDefault();
                const btn = $('#btnSimpanRekening');
                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Menyimpan...');

                $.ajax({
                    url: '{{ route('appconfig.rekening.store') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(res) {
                        btn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Simpan Rekening');
                        $('#modalTambahRekening').modal('hide');
                        $('#formTambahRekening')[0].reset();

                        const rb = res.data;
                        const newRow = `
                            <tr id="row-rekening-${rb.id}">
                                <td class="text-center font-weight-bold">${rb.urutan}</td>
                                <td class="font-weight-bold text-primary"><i class="fas fa-money-check-alt mr-1"></i> ${rb.nama_bank}</td>
                                <td class="font-weight-bold">${rb.nomor_rekening}</td>
                                <td>${rb.atas_nama}</td>
                                <td class="text-muted small">${rb.petunjuk_transfer || '-'}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-success font-weight-bold btnToggleRekening"
                                        data-id="${rb.id}" style="border-radius: 20px; font-size: 11px;">
                                        <i class="fas fa-check-circle mr-1"></i> AKTIF
                                    </button>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-xs btnHapusRekening" data-id="${rb.id}" data-bank="${rb.nama_bank}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                        $('#empty-rekening-row').remove();
                        $('#tableRekeningBank tbody').append(newRow);

                        Toast.fire({
                            icon: 'success',
                            title: res.message
                        });
                    },
                    error: function(xhr) {
                        btn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Simpan Rekening');
                        Swal.fire('Error', xhr.responseJSON?.message || 'Gagal menambahkan rekening bank.', 'error');
                    }
                });
            });

            // Handle Toggle Status Rekening (NO RELOAD!)
            $(document).on('click', '.btnToggleRekening', function() {
                const id = $(this).data('id');
                const btn = $(this);
                btn.prop('disabled', true);

                $.ajax({
                    url: `{{ url('admin/settings/rekening') }}/${id}/toggle`,
                    method: 'POST',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(res) {
                        btn.prop('disabled', false);
                        if (res.is_active) {
                            btn.removeClass('btn-outline-danger').addClass('btn-success').html('<i class="fas fa-check-circle mr-1"></i> AKTIF');
                        } else {
                            btn.removeClass('btn-success').addClass('btn-outline-danger').html('<i class="fas fa-times-circle mr-1"></i> NONAKTIF');
                        }
                        Toast.fire({
                            icon: 'success',
                            title: res.message
                        });
                    },
                    error: function() {
                        btn.prop('disabled', false);
                        Swal.fire('Error', 'Gagal mengubah status rekening.', 'error');
                    }
                });
            });

            // Handle Hapus Rekening Bank (NO RELOAD!)
            $(document).on('click', '.btnHapusRekening', function() {
                const id = $(this).data('id');
                const bank = $(this).data('bank');
                const row = $(this).closest('tr');

                Swal.fire({
                    title: 'Hapus Rekening Bank?',
                    text: `Apakah Anda yakin ingin menghapus rekening '${bank}'?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `{{ url('admin/settings/rekening') }}/${id}`,
                            method: 'DELETE',
                            data: { _token: '{{ csrf_token() }}' },
                            success: function(res) {
                                row.fadeOut(300, function() { $(this).remove(); });
                                Toast.fire({
                                    icon: 'success',
                                    title: res.message
                                });
                            },
                            error: function() {
                                Swal.fire('Error', 'Gagal menghapus rekening.', 'error');
                            }
                        });
                    }
                });
            });

            // Handle Tambah Syarat Berkas (NO RELOAD!)
            $('#formTambahBerkas').on('submit', function(e) {
                e.preventDefault();
                const btn = $('#btnSimpanBerkas');
                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Menyimpan...');

                $.ajax({
                    url: '{{ route('appconfig.syaratBerkas.store') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(res) {
                        btn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Simpan Dokumen');
                        $('#modalTambahBerkas').modal('hide');
                        $('#formTambahBerkas')[0].reset();

                        const b = res.data;
                        const newRow = `
                            <tr id="row-syarat-${b.id}">
                                <td class="text-center font-weight-bold">${b.urutan}</td>
                                <td class="font-weight-bold text-dark">${b.nama_berkas}</td>
                                <td class="text-muted small">${b.deskripsi || '-'}</td>
                                <td class="text-center">
                                    <span class="badge ${b.is_required ? 'badge-danger' : 'badge-secondary'} px-2 py-1">
                                        ${b.is_required ? 'WAJIB' : 'OPSIONAL'}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-success font-weight-bold btnToggleBerkas"
                                        data-id="${b.id}" style="border-radius: 20px; font-size: 12px;">
                                        <i class="fas fa-check-circle mr-1"></i> AKTIF
                                    </button>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-xs btnHapusBerkas" data-id="${b.id}" data-nama="${b.nama_berkas}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                        $('#empty-berkas-row').remove();
                        $('#tableSyaratBerkas tbody').append(newRow);

                        Toast.fire({
                            icon: 'success',
                            title: res.message
                        });
                    },
                    error: function(xhr) {
                        btn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Simpan Dokumen');
                        Swal.fire('Error', xhr.responseJSON?.message || 'Gagal menambahkan berkas.', 'error');
                    }
                });
            });

            // Handle Toggle Status Berkas (NO RELOAD!)
            $(document).on('click', '.btnToggleBerkas', function() {
                const id = $(this).data('id');
                const btn = $(this);
                btn.prop('disabled', true);

                $.ajax({
                    url: `{{ url('admin/settings/syarat-berkas') }}/${id}/toggle`,
                    method: 'POST',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(res) {
                        btn.prop('disabled', false);
                        if (res.is_active) {
                            btn.removeClass('btn-outline-danger').addClass('btn-success').html('<i class="fas fa-check-circle mr-1"></i> AKTIF');
                        } else {
                            btn.removeClass('btn-success').addClass('btn-outline-danger').html('<i class="fas fa-times-circle mr-1"></i> NONAKTIF (OFF)');
                        }
                        Toast.fire({
                            icon: 'success',
                            title: res.message
                        });
                    },
                    error: function() {
                        btn.prop('disabled', false);
                        Swal.fire('Error', 'Gagal mengubah status berkas.', 'error');
                    }
                });
            });

            // Handle Hapus Syarat Berkas (NO RELOAD!)
            $(document).on('click', '.btnHapusBerkas', function() {
                const id = $(this).data('id');
                const nama = $(this).data('nama');
                const row = $(this).closest('tr');

                Swal.fire({
                    title: 'Hapus Persyaratan?',
                    text: `Apakah Anda yakin ingin menghapus persyaratan '${nama}'?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `{{ url('admin/settings/syarat-berkas') }}/${id}`,
                            method: 'DELETE',
                            data: { _token: '{{ csrf_token() }}' },
                            success: function(res) {
                                row.fadeOut(300, function() { $(this).remove(); });
                                Toast.fire({
                                    icon: 'success',
                                    title: res.message
                                });
                            },
                            error: function() {
                                Swal.fire('Error', 'Gagal menghapus berkas.', 'error');
                            }
                        });
                    }
                });
            });

            // ─────────────────────────────────────────────────────────────
            // FAQ Handlers (NO RELOAD!)
            // ─────────────────────────────────────────────────────────────
            $('#formTambahFaq').on('submit', function(e) {
                e.preventDefault();
                const btn = $('#btnSimpanFaq');
                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Menyimpan...');

                $.ajax({
                    url: '{{ route('appconfig.faq.store') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(res) {
                        btn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Simpan FAQ');
                        $('#modalTambahFaq').modal('hide');
                        $('#formTambahFaq')[0].reset();

                        const f = res.data;
                        const newRow = `
                            <tr id="row-faq-${f.id}">
                                <td class="text-center font-weight-bold">${f.urutan}</td>
                                <td class="font-weight-bold text-dark">${f.pertanyaan}</td>
                                <td class="small text-muted">${f.jawaban.substring(0, 100)}</td>
                                <td class="text-center"><span class="badge badge-light border">${f.kategori}</span></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-xs btn-success btnToggleFaq font-weight-bold" data-id="${f.id}">AKTIF</button>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-xs btn-outline-danger btnHapusFaq" data-id="${f.id}" data-pertanyaan="${f.pertanyaan}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                        $('#empty-faq-row').remove();
                        $('#tableFaq tbody').append(newRow);
                        Toast.fire({ icon: 'success', title: res.message });
                    },
                    error: function(xhr) {
                        btn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Simpan FAQ');
                        Swal.fire('Error', xhr.responseJSON?.message || 'Gagal menambahkan FAQ.', 'error');
                    }
                });
            });

            $(document).on('click', '.btnToggleFaq', function() {
                const id = $(this).data('id');
                const btn = $(this);
                btn.prop('disabled', true);

                $.ajax({
                    url: `{{ url('admin/settings/faq') }}/${id}/toggle`,
                    method: 'POST',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(res) {
                        btn.prop('disabled', false);
                        if (res.is_active) {
                            btn.removeClass('btn-outline-danger').addClass('btn-success').text('AKTIF');
                        } else {
                            btn.removeClass('btn-success').addClass('btn-outline-danger').text('NONAKTIF');
                        }
                        Toast.fire({ icon: 'success', title: res.message });
                    },
                    error: function() {
                        btn.prop('disabled', false);
                        Swal.fire('Error', 'Gagal mengubah status FAQ.', 'error');
                    }
                });
            });

            $(document).on('click', '.btnHapusFaq', function() {
                const id = $(this).data('id');
                const row = $(this).closest('tr');

                Swal.fire({
                    title: 'Hapus FAQ?',
                    text: 'Apakah Anda yakin ingin menghapus pertanyaan ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((r) => {
                    if (r.isConfirmed) {
                        $.ajax({
                            url: `{{ url('admin/settings/faq') }}/${id}`,
                            method: 'DELETE',
                            data: { _token: '{{ csrf_token() }}' },
                            success: function(res) {
                                row.fadeOut(300, function() { $(this).remove(); });
                                Toast.fire({ icon: 'success', title: res.message });
                            }
                        });
                    }
                });
            });

            // ─────────────────────────────────────────────────────────────
            // Mitra Industri Handlers (NO RELOAD!)
            // ─────────────────────────────────────────────────────────────
            $('#formTambahMitra').on('submit', function(e) {
                e.preventDefault();
                const btn = $('#btnSimpanMitra');
                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Menyimpan...');

                $.ajax({
                    url: '{{ route('appconfig.mitra.store') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(res) {
                        btn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Simpan Mitra');
                        $('#modalTambahMitra').modal('hide');
                        $('#formTambahMitra')[0].reset();

                        const m = res.data;
                        const newRow = `
                            <tr id="row-mitra-${m.id}">
                                <td class="text-center font-weight-bold">${m.urutan}</td>
                                <td class="font-weight-bold text-primary"><i class="fas fa-building mr-1"></i> ${m.nama_mitra}</td>
                                <td class="small">${m.bidang || '-'}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-xs btn-success btnToggleMitra font-weight-bold" data-id="${m.id}">AKTIF</button>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-xs btn-outline-danger btnHapusMitra" data-id="${m.id}" data-nama="${m.nama_mitra}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                        $('#empty-mitra-row').remove();
                        $('#tableMitra tbody').append(newRow);
                        Toast.fire({ icon: 'success', title: res.message });
                    },
                    error: function(xhr) {
                        btn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Simpan Mitra');
                        Swal.fire('Error', xhr.responseJSON?.message || 'Gagal menambahkan mitra.', 'error');
                    }
                });
            });

            $(document).on('click', '.btnToggleMitra', function() {
                const id = $(this).data('id');
                const btn = $(this);
                btn.prop('disabled', true);

                $.ajax({
                    url: `{{ url('admin/settings/mitra') }}/${id}/toggle`,
                    method: 'POST',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(res) {
                        btn.prop('disabled', false);
                        if (res.is_active) {
                            btn.removeClass('btn-outline-danger').addClass('btn-success').text('AKTIF');
                        } else {
                            btn.removeClass('btn-success').addClass('btn-outline-danger').text('NONAKTIF');
                        }
                        Toast.fire({ icon: 'success', title: res.message });
                    }
                });
            });

            $(document).on('click', '.btnHapusMitra', function() {
                const id = $(this).data('id');
                const row = $(this).closest('tr');

                Swal.fire({
                    title: 'Hapus Mitra Industri?',
                    text: 'Apakah Anda yakin ingin menghapus mitra ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((r) => {
                    if (r.isConfirmed) {
                        $.ajax({
                            url: `{{ url('admin/settings/mitra') }}/${id}`,
                            method: 'DELETE',
                            data: { _token: '{{ csrf_token() }}' },
                            success: function(res) {
                                row.fadeOut(300, function() { $(this).remove(); });
                                Toast.fire({ icon: 'success', title: res.message });
                            }
                        });
                    }
                });
            });

            // ─────────────────────────────────────────────────────────────
            // Testimoni Handlers (NO RELOAD!)
            // ─────────────────────────────────────────────────────────────
            $('#formTambahTestimoni').on('submit', function(e) {
                e.preventDefault();
                const btn = $('#btnSimpanTestimoni');
                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Menyimpan...');

                $.ajax({
                    url: '{{ route('appconfig.testimoni.store') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(res) {
                        btn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Simpan Testimoni');
                        $('#modalTambahTestimoni').modal('hide');
                        $('#formTambahTestimoni')[0].reset();

                        const t = res.data;
                        const newRow = `
                            <tr id="row-testimoni-${t.id}">
                                <td class="text-center font-weight-bold">${t.urutan}</td>
                                <td class="font-weight-bold text-dark">
                                    ${t.nama}
                                    <small class="d-block text-muted">${t.tahun_lulus || ''} &bull; ${t.jurusan || ''}</small>
                                </td>
                                <td class="small text-primary font-weight-bold">${t.profesi_alumni}</td>
                                <td class="small text-muted">"${t.testimoni.substring(0, 90)}"</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-xs btn-success btnToggleTestimoni font-weight-bold" data-id="${t.id}">AKTIF</button>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-xs btn-outline-danger btnHapusTestimoni" data-id="${t.id}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                        $('#empty-testimoni-row').remove();
                        $('#tableTestimoni tbody').append(newRow);
                        Toast.fire({ icon: 'success', title: res.message });
                    },
                    error: function(xhr) {
                        btn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Simpan Testimoni');
                        Swal.fire('Error', xhr.responseJSON?.message || 'Gagal menambahkan testimoni.', 'error');
                    }
                });
            });

            $(document).on('click', '.btnToggleTestimoni', function() {
                const id = $(this).data('id');
                const btn = $(this);
                btn.prop('disabled', true);

                $.ajax({
                    url: `{{ url('admin/settings/testimoni') }}/${id}/toggle`,
                    method: 'POST',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(res) {
                        btn.prop('disabled', false);
                        if (res.is_active) {
                            btn.removeClass('btn-outline-danger').addClass('btn-success').text('AKTIF');
                        } else {
                            btn.removeClass('btn-success').addClass('btn-outline-danger').text('NONAKTIF');
                        }
                        Toast.fire({ icon: 'success', title: res.message });
                    }
                });
            });

            $(document).on('click', '.btnHapusTestimoni', function() {
                const id = $(this).data('id');
                const row = $(this).closest('tr');

                Swal.fire({
                    title: 'Hapus Testimoni?',
                    text: 'Apakah Anda yakin ingin menghapus testimoni ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((r) => {
                    if (r.isConfirmed) {
                        $.ajax({
                            url: `{{ url('admin/settings/testimoni') }}/${id}`,
                            method: 'DELETE',
                            data: { _token: '{{ csrf_token() }}' },
                            success: function(res) {
                                row.fadeOut(300, function() { $(this).remove(); });
                                Toast.fire({ icon: 'success', title: res.message });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
