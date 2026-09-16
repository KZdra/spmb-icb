@extends('layouts.siswaLayout')
@section('title', 'Formulir Pendaftaran Siswa Baru - ' . ($setting->app_name ?? 'SMK ICB Cinta Teknika'))

@section('content')

{{-- Select2 CSS --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

<style>
    /* Select2 custom styling to match form */
    .select2-container--default .select2-selection--single {
        border: 1.5px solid var(--form-border, #E2E8F0);
        border-radius: 10px;
        height: 42px;
        padding: 5px 10px;
        font-size: 0.925rem;
        transition: border-color 0.2s;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 30px;
        color: #374151;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px;
    }
    .select2-container--default.select2-container--focus .select2-selection--single,
    .select2-container--default.select2-container--open .select2-selection--single {
        border-color: #1A56DB;
        box-shadow: 0 0 0 3px rgba(26,86,219,0.12);
        outline: none;
    }
    .select2-dropdown {
        border: 1.5px solid #1A56DB;
        border-radius: 10px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        overflow: hidden;
    }
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background: #1A56DB;
    }
    .select2-search--dropdown .select2-search__field {
        border-radius: 6px;
        border: 1.5px solid #E2E8F0;
        padding: 6px 10px;
    }
    .select2-container { width: 100% !important; }
    /* Disabled state */
    .select2-container--default.select2-container--disabled .select2-selection--single {
        background: #F8FAFC;
        cursor: not-allowed;
        opacity: 0.7;
    }

    :root {
        --form-primary: #1A56DB;
        --form-navy: #0B3B7B;
        --form-success: #10B981;
        --form-light: #EBF5FF;
        --form-border: #E2E8F0;
        --form-muted: #64748B;
    }

    body { background: #F8FAFC; }

    /* === Progress Bar === */
    .form-progress-wrapper {
        background: #fff;
        border-bottom: 1px solid var(--form-border);
        padding: 18px 0;
        position: sticky;
        top: 0;
        z-index: 100;
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
    }

    .progress-steps {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0;
        max-width: 700px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .progress-step {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;
        position: relative;
        cursor: pointer;
    }

    .progress-step:not(:last-child)::after {
        content: '';
        position: absolute;
        top: 18px;
        left: calc(50% + 18px);
        width: calc(100% - 36px);
        height: 2px;
        background: var(--form-border);
        z-index: 0;
        transition: background 0.4s;
    }

    .progress-step.completed:not(:last-child)::after {
        background: var(--form-success);
    }

    .step-circle {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #fff;
        border: 2px solid var(--form-border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.875rem;
        color: var(--form-muted);
        position: relative;
        z-index: 1;
        transition: all 0.3s ease;
    }

    .progress-step.active .step-circle {
        background: var(--form-primary);
        border-color: var(--form-primary);
        color: #fff;
        box-shadow: 0 4px 12px rgba(26,86,219,0.3);
        transform: scale(1.1);
    }

    .progress-step.completed .step-circle {
        background: var(--form-success);
        border-color: var(--form-success);
        color: #fff;
    }

    .step-label {
        font-size: 0.7rem;
        font-weight: 600;
        color: var(--form-muted);
        margin-top: 6px;
        text-align: center;
        white-space: nowrap;
    }

    .progress-step.active .step-label { color: var(--form-primary); }
    .progress-step.completed .step-label { color: var(--form-success); }

    /* === Form Sections === */
    .form-section { display: none; }
    .form-section.active { display: block; }

    .section-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid var(--form-border);
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .section-card-header {
        background: linear-gradient(135deg, var(--form-navy) 0%, var(--form-primary) 100%);
        color: #fff;
        padding: 16px 24px;
        font-weight: 700;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-card-header .step-badge {
        background: rgba(255,255,255,0.2);
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
    }

    .section-card-body { padding: 28px; }

    /* === Input Styling === */
    .form-control {
        border: 1.5px solid var(--form-border);
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.925rem;
        transition: all 0.2s;
        background: #fff;
    }

    .form-control:focus {
        border-color: var(--form-primary);
        box-shadow: 0 0 0 3px rgba(26,86,219,0.12);
    }

    .form-control.is-invalid { border-color: #EF4444; }

    label {
        font-weight: 600;
        font-size: 0.875rem;
        color: #374151;
        margin-bottom: 6px;
    }

    .input-hint {
        font-size: 0.8rem;
        color: var(--form-muted);
        margin-top: 4px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .input-with-icon {
        position: relative;
    }

    .input-with-icon .input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--form-muted);
        font-size: 0.875rem;
        pointer-events: none;
    }

    .input-with-icon .form-control {
        padding-left: 38px;
    }

    /* === Payment Box === */
    .payment-box {
        background: linear-gradient(135deg, #F0FDF4 0%, #DCFCE7 100%);
        border: 1.5px solid #86EFAC;
        border-radius: 16px;
        padding: 20px 24px;
        margin-bottom: 20px;
    }

    .rek-number {
        font-family: 'Outfit', monospace;
        font-size: 1.4rem;
        font-weight: 800;
        color: #1E3A8A;
        letter-spacing: 1px;
    }

    /* === Upload Area === */
    .upload-area {
        border: 2px dashed #CBD5E1;
        border-radius: 14px;
        padding: 30px 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.25s;
        background: #FAFAFA;
        position: relative;
    }

    .upload-area:hover, .upload-area.drag-over {
        border-color: var(--form-primary);
        background: var(--form-light);
    }

    .upload-area input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    .upload-preview {
        max-height: 180px;
        border-radius: 10px;
        margin-top: 14px;
        object-fit: contain;
        display: none;
    }

    /* === Navigation Buttons === */
    .form-nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 0;
        margin-top: 10px;
    }

    .btn-next, .btn-prev, .btn-submit-final {
        padding: 12px 28px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.95rem;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }

    .btn-next {
        background: var(--form-primary);
        color: #fff;
        box-shadow: 0 6px 16px -4px rgba(26,86,219,0.4);
    }

    .btn-next:hover { background: var(--form-navy); transform: translateY(-1px); }

    .btn-prev {
        background: #fff;
        color: #374151;
        border: 1.5px solid var(--form-border);
    }

    .btn-prev:hover { background: #F8FAFC; }

    .btn-submit-final {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        color: #fff;
        padding: 14px 40px;
        box-shadow: 0 8px 20px -5px rgba(16,185,129,0.45);
    }

    .btn-submit-final:hover { transform: translateY(-2px); }

    /* === MGM Toggle === */
    .mgm-section {
        background: #F8FAFC;
        border-radius: 12px;
        padding: 16px;
        border: 1px solid var(--form-border);
        margin-top: 16px;
    }

    /* === Radio/Checkbox custom === */
    .radio-cards { display: flex; gap: 12px; flex-wrap: wrap; }

    .radio-card {
        flex: 1;
        min-width: 120px;
        border: 2px solid var(--form-border);
        border-radius: 12px;
        padding: 12px 16px;
        cursor: pointer;
        transition: all 0.2s;
        text-align: center;
    }

    .radio-card:hover { border-color: var(--form-primary); }
    .radio-card input { display: none; }

    .radio-card.selected {
        border-color: var(--form-primary);
        background: var(--form-light);
        color: var(--form-primary);
    }

    .radio-card .rc-icon { font-size: 1.4rem; margin-bottom: 4px; display: block; }
    .radio-card .rc-label { font-size: 0.85rem; font-weight: 700; }

    /* === Disclaimer === */
    .disclaimer-box {
        background: #FFFBEB;
        border: 1.5px solid #FCD34D;
        border-radius: 14px;
        padding: 18px 20px;
        margin-bottom: 20px;
    }

    @media (max-width: 767px) {
        .step-label { display: none; }
        .section-card-body { padding: 20px 16px; }
        .form-nav { flex-direction: column; gap: 12px; }
        .btn-next, .btn-prev, .btn-submit-final { width: 100%; text-align: center; }
    }
</style>

{{-- Progress Bar --}}
<div class="form-progress-wrapper">
    <div class="progress-steps" id="progressSteps">
        <div class="progress-step active" data-step="1">
            <div class="step-circle">1</div>
            <span class="step-label">Jalur & Jurusan</span>
        </div>
        <div class="progress-step" data-step="2">
            <div class="step-circle">2</div>
            <span class="step-label">Data Pribadi</span>
        </div>
        <div class="progress-step" data-step="3">
            <div class="step-circle">3</div>
            <span class="step-label">Alamat</span>
        </div>
        <div class="progress-step" data-step="4">
            <div class="step-circle">4</div>
            <span class="step-label">Kontak</span>
        </div>
        <div class="progress-step" data-step="5">
            <div class="step-circle">5</div>
            <span class="step-label">Asal Sekolah</span>
        </div>
        <div class="progress-step" data-step="6">
            <div class="step-circle">6</div>
            <span class="step-label">Orang Tua</span>
        </div>
        <div class="progress-step" data-step="7">
            <div class="step-circle">7</div>
            <span class="step-label">Pembayaran</span>
        </div>
    </div>
</div>

<main class="container py-4" style="max-width: 760px;">

    {{-- Header --}}
    <div class="text-center mb-4">
        <div class="d-flex justify-content-center align-items-center mb-3">
            @if ($setting?->logo_path)
                <img src="{{ asset('storage/' . $setting->logo_path) }}" alt="Logo" height="60" class="mr-3">
            @else
                <img src="{{ asset('images/icb.png') }}" alt="Logo SMK ICB" height="60" class="mr-3">
            @endif
            <div class="text-left">
                <h4 class="font-weight-bold text-primary mb-0">{{ $setting->app_name ?? 'SMK ICB Cinta Teknika' }}</h4>
                <p class="text-muted mb-0" style="font-size: 0.9rem;">Formulir Pendaftaran Siswa Baru (SPMB) TA {{ $setting->tahun_ajaran ?? '2027/2028' }}</p>
            </div>
        </div>
    </div>

    @if (isset($errors) && $errors->any())
        <div class="alert alert-danger shadow-sm mb-4" style="border-radius: 14px;">
            <h6 class="font-weight-bold mb-2"><i class="fas fa-exclamation-triangle mr-1"></i> Terdapat kesalahan:</h6>
            <ul class="mb-0 pl-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Banner Notifikasi Pemulihan Draft Otomatis --}}
    <div id="draftRestoredAlert" class="alert alert-info shadow-sm mb-4 align-items-center justify-content-between" style="display: none; border-radius: 14px; background: #EFF6FF; border: 1.5px solid #BFDBFE;">
        <div class="d-flex align-items-center">
            <div class="mr-3 text-primary" style="font-size: 1.5rem;">
                <i class="fas fa-history"></i>
            </div>
            <div>
                <h6 class="font-weight-bold text-primary mb-1">Draft Pendaftaran Otomatis Dipulihkan</h6>
                <p class="mb-0 text-muted" style="font-size: 0.85rem;">
                    Data Anda sebelumnya tersimpan di browser pada <strong>Langkah <span id="draftStepText">1</span></strong>. 
                    <span id="draftStep7Note" style="display: none;" class="text-warning font-weight-bold ml-1">Silakan pilih kembali file bukti transfer jika ingin mengirim.</span>
                </p>
            </div>
        </div>
        <button type="button" class="btn btn-outline-danger btn-sm font-weight-bold ml-2 mt-2 mt-md-0" onclick="clearDraftAndReset()" style="border-radius: 8px; white-space: nowrap;">
            <i class="fas fa-redo-alt mr-1"></i> Mulai Dari Awal
        </button>
    </div>

    <form action="{{ route('siswa.daftar.post') }}" method="POST" enctype="multipart/form-data" id="registrationForm" novalidate>
        @csrf

        {{-- ===== STEP 1: JALUR & JURUSAN ===== --}}
        <div class="form-section active" id="step-1">
            <div class="section-card">
                <div class="section-card-header">
                    <div class="step-badge">1</div>
                    Pilihan Jalur &amp; Jurusan
                </div>
                <div class="section-card-body">
                    <div class="form-group mb-4">
                        <label>Jalur Pendaftaran <span class="text-danger">*</span></label>
                        <div class="radio-cards" id="jalurCards">
                            <label class="radio-card {{ old('jalur_pendaftaran') == 'Reguler (Umum)' ? 'selected' : '' }}" onclick="selectRadioCard(this, 'jalur_pendaftaran', 'Reguler (Umum)')">
                                <input type="radio" name="jalur_pendaftaran" value="Reguler (Umum)" {{ old('jalur_pendaftaran') == 'Reguler (Umum)' ? 'checked' : '' }} required>
                                <span class="rc-icon">📋</span>
                                <span class="rc-label">Reguler (Umum)</span>
                            </label>
                            <label class="radio-card {{ old('jalur_pendaftaran') == 'Beasiswa Prestasi' ? 'selected' : '' }}" onclick="selectRadioCard(this, 'jalur_pendaftaran', 'Beasiswa Prestasi')">
                                <input type="radio" name="jalur_pendaftaran" value="Beasiswa Prestasi" {{ old('jalur_pendaftaran') == 'Beasiswa Prestasi' ? 'checked' : '' }}>
                                <span class="rc-icon">🏆</span>
                                <span class="rc-label">Beasiswa Prestasi</span>
                            </label>
                            <label class="radio-card {{ old('jalur_pendaftaran') == 'Kerjasama SMP' ? 'selected' : '' }}" onclick="selectRadioCard(this, 'jalur_pendaftaran', 'Kerjasama SMP')">
                                <input type="radio" name="jalur_pendaftaran" value="Kerjasama SMP" {{ old('jalur_pendaftaran') == 'Kerjasama SMP' ? 'checked' : '' }}>
                                <span class="rc-icon">🤝</span>
                                <span class="rc-label">Kerjasama SMP</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <label for="id_jurusan">Pilihan Jurusan <span class="text-danger">*</span></label>
                        <select class="form-control" id="id_jurusan" name="id_jurusan" required>
                            <option value="">-- Pilih Jurusan --</option>
                            @foreach ($listJurusan as $j)
                                <option value="{{ $j->id }}" {{ old('id_jurusan') == $j->id ? 'selected' : '' }}>
                                    {{ $j->nama_jurusan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-nav">
                <span></span>
                <button type="button" class="btn-next" onclick="goToStep(2)">
                    Lanjut <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>

        {{-- ===== STEP 2: DATA PRIBADI ===== --}}
        <div class="form-section" id="step-2">
            <div class="section-card">
                <div class="section-card-header">
                    <div class="step-badge">2</div>
                    Data Pribadi Calon Siswa
                </div>
                <div class="section-card-body">
                    <div class="form-group">
                        <label for="nama_siswa">Nama Lengkap Sesuai Kartu Keluarga <span class="text-danger">*</span></label>
                        <div class="input-with-icon">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" class="form-control" id="nama_siswa" name="nama_siswa"
                                value="{{ old('nama_siswa') }}" placeholder="Contoh: Muhammad Rizky Pratama" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Jenis Kelamin <span class="text-danger">*</span></label>
                            <div class="radio-cards">
                                <label class="radio-card {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}" onclick="selectRadioCard(this, 'jenis_kelamin', 'Laki-laki')">
                                    <input type="radio" name="jenis_kelamin" value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }} required>
                                    <span class="rc-icon">👦</span>
                                    <span class="rc-label">Laki-laki</span>
                                </label>
                                <label class="radio-card {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}" onclick="selectRadioCard(this, 'jenis_kelamin', 'Perempuan')">
                                    <input type="radio" name="jenis_kelamin" value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }}>
                                    <span class="rc-icon">👧</span>
                                    <span class="rc-label">Perempuan</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tempat_lahir">Tempat Lahir <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                value="{{ old('tempat_lahir') }}" placeholder="Contoh: Bandung" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                value="{{ old('tanggal_lahir') }}" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="agama">Agama &amp; Kepercayaan <span class="text-danger">*</span></label>
                            <select class="form-control" id="agama" name="agama" required>
                                <option value="">-- Pilih Agama --</option>
                                @foreach(['Islam','Kristen Protestan','Kristen Katolik','Hindu','Budha','Kong Hu Chu','Lainnya'] as $ag)
                                    <option value="{{ $ag }}" {{ old('agama') == $ag ? 'selected' : '' }}>{{ $ag }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tinggi_badan">Tinggi Badan (cm)</label>
                            <div class="input-with-icon">
                                <i class="fas fa-ruler-vertical input-icon"></i>
                                <input type="number" class="form-control" id="tinggi_badan" name="tinggi_badan"
                                    value="{{ old('tinggi_badan') }}" placeholder="Contoh: 165" min="100" max="250">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="berat_badan">Berat Badan (kg)</label>
                            <div class="input-with-icon">
                                <i class="fas fa-weight input-icon"></i>
                                <input type="number" class="form-control" id="berat_badan" name="berat_badan"
                                    value="{{ old('berat_badan') }}" placeholder="Contoh: 55" min="20" max="200">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-nav">
                <button type="button" class="btn-prev" onclick="goToStep(1)">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </button>
                <button type="button" class="btn-next" onclick="goToStep(3)">
                    Lanjut <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>

        {{-- ===== STEP 3: ALAMAT ===== --}}
        <div class="form-section" id="step-3">
            <div class="section-card">
                <div class="section-card-header">
                    <div class="step-badge">3</div>
                    Alamat Domisili Siswa
                </div>
                <div class="section-card-body">
                    <div class="form-group">
                        <label for="alamat">Jalan / Alamat Lengkap <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="2"
                            placeholder="Contoh: Jl. Merdeka No. 10, RT 03/RW 02" required>{{ old('alamat') }}</textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-6 col-md-2">
                            <label for="rt">RT <span class="text-danger">*</span></label>
                            <input type="text" class="form-control text-center" id="rt" name="rt"
                                value="{{ old('rt') }}" placeholder="01" maxlength="4" required>
                        </div>
                        <div class="form-group col-6 col-md-2">
                            <label for="rw">RW <span class="text-danger">*</span></label>
                            <input type="text" class="form-control text-center" id="rw" name="rw"
                                value="{{ old('rw') }}" placeholder="02" maxlength="4" required>
                        </div>

                        {{-- Provinsi → Kota → Kecamatan → Kelurahan (cascading via API) --}}
                        <div class="form-group col-md-8">
                            <label for="provinsi_select">Provinsi <span class="text-danger">*</span></label>
                            <select id="provinsi_select" class="form-control wilayah-select" required>
                                <option value="">-- Pilih Provinsi --</option>
                            </select>
                            <input type="hidden" id="provinsi" name="provinsi" value="{{ old('provinsi') }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="kota_select">Kota / Kabupaten <span class="text-danger">*</span></label>
                            <select id="kota_select" class="form-control wilayah-select" disabled required>
                                <option value="">-- Pilih Provinsi dulu --</option>
                            </select>
                            <input type="hidden" id="kota" name="kota" value="{{ old('kota') }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="kecamatan_select">Kecamatan <span class="text-danger">*</span></label>
                            <select id="kecamatan_select" class="form-control wilayah-select" disabled required>
                                <option value="">-- Pilih Kota/Kab dulu --</option>
                            </select>
                            <input type="hidden" id="kecamatan" name="kecamatan" value="{{ old('kecamatan') }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="kelurahan_select">Kelurahan / Desa <span class="text-danger">*</span></label>
                            <select id="kelurahan_select" class="form-control wilayah-select" disabled required>
                                <option value="">-- Pilih Kecamatan dulu --</option>
                            </select>
                            <input type="hidden" id="kelurahan" name="kelurahan" value="{{ old('kelurahan') }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-nav">
                <button type="button" class="btn-prev" onclick="goToStep(2)">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </button>
                <button type="button" class="btn-next" onclick="goToStep(4)">
                    Lanjut <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>

        {{-- ===== STEP 4: KONTAK ===== --}}
        <div class="form-section" id="step-4">
            <div class="section-card">
                <div class="section-card-header">
                    <div class="step-badge">4</div>
                    Informasi Kontak
                </div>
                <div class="section-card-body">
                    <div class="disclaimer-box mb-4">
                        <i class="fas fa-bell text-warning mr-2"></i>
                        <strong>Penting:</strong> Nomor WhatsApp dan email yang Anda masukkan akan digunakan untuk mengirimkan
                        <strong>notifikasi status pendaftaran dan pengumuman kelulusan</strong>. Pastikan aktif dan bisa dihubungi.
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="no_hp">No. Handphone / WhatsApp <span class="text-danger">*</span></label>
                            <div class="input-with-icon">
                                <i class="fab fa-whatsapp input-icon" style="color: #25D366;"></i>
                                <input type="tel" class="form-control" id="no_hp" name="no_hp"
                                    value="{{ old('no_hp') }}" placeholder="Contoh: 081234567890"
                                    pattern="[0-9+\-\s]{9,15}" required>
                            </div>
                            <p class="input-hint"><i class="fas fa-info-circle"></i> Digunakan untuk info kelulusan via WhatsApp</p>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Alamat Email <span class="text-danger">*</span></label>
                            <div class="input-with-icon">
                                <i class="fas fa-envelope input-icon"></i>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email') }}" placeholder="nama@email.com" required>
                            </div>
                            <p class="input-hint"><i class="fas fa-info-circle"></i> Pengumuman resmi akan dikirim ke email ini</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-nav">
                <button type="button" class="btn-prev" onclick="goToStep(3)">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </button>
                <button type="button" class="btn-next" onclick="goToStep(5)">
                    Lanjut <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>

        {{-- ===== STEP 5: ASAL SEKOLAH ===== --}}
        <div class="form-section" id="step-5">
            <div class="section-card">
                <div class="section-card-header">
                    <div class="step-badge">5</div>
                    Asal Pendidikan Siswa
                </div>
                <div class="section-card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="asal_sekolah_select">Nama Sekolah Asal (SMP/MTs) <span class="text-danger">*</span></label>
                            <select id="asal_sekolah_select" class="form-control" style="width:100%">
                                @if(old('asal_sekolah'))
                                    <option value="{{ old('asal_sekolah') }}" selected>{{ old('asal_sekolah') }}</option>
                                @else
                                    <option value="">Ketik nama sekolah...</option>
                                @endif
                            </select>
                            {{-- hidden input yang dikirim ke server --}}
                            <input type="hidden" id="asal_sekolah" name="asal_sekolah" value="{{ old('asal_sekolah') }}" required>
                            <p class="input-hint mt-1"><i class="fas fa-info-circle"></i> Ketik minimal 3 huruf untuk mencari. Jika tidak ditemukan, ketik nama manual lalu tekan Enter.</p>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="nisn">NISN <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nisn" name="nisn"
                                value="{{ old('nisn') }}" placeholder="10 digit NISN"
                                maxlength="10" pattern="[0-9]{10}" required>
                            <p class="input-hint"><i class="fas fa-info-circle"></i> 10 digit angka</p>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="tahun_lulus">Tahun Lulus <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="tahun_lulus" name="tahun_lulus"
                                value="{{ old('tahun_lulus', date('Y')) }}" placeholder="{{ date('Y') }}"
                                maxlength="4" pattern="[0-9]{4}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat_sekolah_asal">Alamat Sekolah Asal <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="alamat_sekolah_asal" name="alamat_sekolah_asal" rows="2"
                            placeholder="Alamat lengkap SMP/MTs asal" required>{{ old('alamat_sekolah_asal') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="form-nav">
                <button type="button" class="btn-prev" onclick="goToStep(4)">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </button>
                <button type="button" class="btn-next" onclick="goToStep(6)">
                    Lanjut <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>

        {{-- ===== STEP 6: DATA ORANG TUA ===== --}}
        <div class="form-section" id="step-6">
            <div class="section-card">
                <div class="section-card-header">
                    <div class="step-badge">6</div>
                    Data Orang Tua / Wali
                </div>
                <div class="section-card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nama_ayah">Nama Ayah Kandung / Wali <span class="text-danger">*</span></label>
                            <div class="input-with-icon">
                                <i class="fas fa-male input-icon"></i>
                                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah"
                                    value="{{ old('nama_ayah') }}" placeholder="Nama lengkap ayah / wali" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="telepon_ayah">No. Telepon / WA Ayah <span class="text-danger">*</span></label>
                            <div class="input-with-icon">
                                <i class="fas fa-phone input-icon"></i>
                                <input type="tel" class="form-control" id="telepon_ayah" name="telepon_ayah"
                                    value="{{ old('telepon_ayah') }}" placeholder="Contoh: 081234567890" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nama_ibu">Nama Ibu Kandung <span class="text-danger">*</span></label>
                            <div class="input-with-icon">
                                <i class="fas fa-female input-icon"></i>
                                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu"
                                    value="{{ old('nama_ibu') }}" placeholder="Nama lengkap ibu" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="telepon_ibu">No. Telepon / WA Ibu <span class="text-danger">*</span></label>
                            <div class="input-with-icon">
                                <i class="fas fa-phone input-icon"></i>
                                <input type="tel" class="form-control" id="telepon_ibu" name="telepon_ibu"
                                    value="{{ old('telepon_ibu') }}" placeholder="Contoh: 081234567890" required>
                            </div>
                        </div>
                    </div>

                    {{-- MGM (Disabled for now) --}}
                    {{--
                    <div class="pt-3 mt-2 border-top">
                        <div class="form-row align-items-center">
                            <div class="col-md-6">
                                <label for="mgm" class="font-weight-bold mb-1">Mendapat Rekomendasi / Referral?</label>
                                <select class="form-control" id="mgm" name="mgm">
                                    <option value="0" {{ old('mgm', '0') == '0' ? 'selected' : '' }}>Tidak</option>
                                    <option value="1" {{ old('mgm') == '1' ? 'selected' : '' }}>Ya</option>
                                </select>
                            </div>
                        </div>
                        <div class="mgm-section mt-3" id="mgm_fields" style="display: {{ old('mgm') == '1' ? 'block' : 'none' }};">
                            <div class="form-row">
                                <div class="form-group col-md-6 mb-0">
                                    <label for="nama_mgm">Nama Pemberi Rekomendasi</label>
                                    <input type="text" class="form-control" id="nama_mgm" name="nama_mgm"
                                        value="{{ old('nama_mgm') }}" placeholder="Nama siswa / guru / alumni">
                                </div>
                                <div class="form-group col-md-6 mb-0">
                                    <label for="asal_mgm">Keterangan</label>
                                    <input type="text" class="form-control" id="asal_mgm" name="asal_mgm"
                                        value="{{ old('asal_mgm') }}" placeholder="Contoh: Kelas XII RPL / Guru SMP">
                                </div>
                            </div>
                        </div>
                    </div>
                    --}}
                </div>
            </div>
            <div class="form-nav">
                <button type="button" class="btn-prev" onclick="goToStep(5)">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </button>
                <button type="button" class="btn-next" onclick="goToStep(7)">
                    Lanjut <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>

        {{-- ===== STEP 7: PEMBAYARAN ===== --}}
        <div class="form-section" id="step-7">
            <div class="section-card">
                <div class="section-card-header" style="background: linear-gradient(135deg, #065F46 0%, #10B981 100%);">
                    <div class="step-badge">7</div>
                    Pembayaran Biaya Pendaftaran
                </div>
                <div class="section-card-body">
                    {{-- Payment Info --}}
                    <div class="payment-box">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                            <div>
                                <span class="badge badge-success px-2 py-1 mb-2">
                                    <i class="fas fa-university mr-1"></i> {{ $setting->bank_name ?? 'Bank BRI' }}
                                </span>
                                <div class="text-muted mb-1" style="font-size: 0.85rem;">No. Rekening</div>
                                <div class="rek-number">{{ $setting->no_rekening ?? '210501000140303' }}</div>
                                <div class="text-muted mt-1">a.n. <strong>{{ $setting->atas_nama ?? 'SMK ICB Cinta Teknika' }}</strong></div>
                            </div>
                            <div class="text-right">
                                <div class="text-muted mb-1" style="font-size: 0.85rem;">Biaya Pendaftaran</div>
                                <div style="font-size: 1.5rem; font-weight: 800; color: #065F46;">
                                    Rp {{ number_format($setting->biaya_pendaftaran ?? 200000, 0, ',', '.') }}
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-success mt-2 font-weight-bold"
                                    onclick="copyRekening('{{ $setting->no_rekening ?? '210501000140303' }}')">
                                    <i class="fas fa-copy mr-1"></i> Salin No. Rek
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Upload --}}
                    <div class="form-group">
                        <label>Bukti Transfer / Pembayaran <span class="text-danger">*</span></label>
                        <div class="upload-area" id="uploadArea">
                            <input type="file" id="bukti_pembayaran" name="bukti_pembayaran"
                                accept="image/*,.pdf" required onchange="handleFileUpload(this)">
                            <div id="uploadPlaceholder">
                                <i class="fas fa-cloud-upload-alt text-muted" style="font-size: 2.5rem; margin-bottom: 10px; display: block;"></i>
                                <p class="font-weight-bold text-muted mb-1">Klik atau seret file ke sini</p>
                                <p class="text-muted" style="font-size: 0.82rem;">Format: JPG, PNG, atau PDF &bull; Maks. <strong>10 MB</strong></p>
                            </div>
                            <img id="uploadPreview" class="upload-preview" src="" alt="Preview">
                        </div>
                        <div id="fileInfo" class="mt-2 text-success font-weight-bold" style="display:none;font-size:0.9rem;"></div>
                    </div>

                    {{-- Agreement --}}
                    <div class="mt-4 p-3" style="background:#F8FAFC; border-radius: 12px; border: 1px solid #E2E8F0;">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="persetujuan" required>
                            <label class="custom-control-label" for="persetujuan" style="font-size:0.9rem;">
                                Saya menyatakan bahwa seluruh data yang diisikan adalah <strong>benar, akurat, dan sesuai dokumen asli</strong>.
                                Saya siap bertanggung jawab atas kebenaran data tersebut.
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-nav">
                <button type="button" class="btn-prev" onclick="goToStep(6)">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </button>
                <button type="submit" class="btn-submit-final" id="submitBtn">
                    <i class="fas fa-paper-plane mr-2"></i> Kirim Formulir Pendaftaran
                </button>
            </div>
        </div>

    </form>
</main>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
<script>
    const TOTAL_STEPS = 7;
    let currentStep = 1;
    const STORAGE_KEY = 'spmb_form_draft_v1';
    const STORAGE_STEP_KEY = 'spmb_form_step_v1';

    function goToStep(step, bypassValidation = false) {
        if (step < 1 || step > TOTAL_STEPS) return;

        // Validasi step saat ini jika maju ke depan (kecuali saat restore otomatis)
        if (!bypassValidation && step > currentStep && !validateStep(currentStep)) return;

        // Sembunyikan semua section
        document.querySelectorAll('.form-section').forEach(s => s.classList.remove('active'));
        document.querySelectorAll('.progress-step').forEach((el, i) => {
            el.classList.remove('active', 'completed');
            if (i + 1 < step) el.classList.add('completed');
            if (i + 1 === step) el.classList.add('active');
        });

        const targetStep = document.getElementById('step-' + step);
        if (targetStep) targetStep.classList.add('active');
        currentStep = step;

        // Simpan posisi step ke browser
        localStorage.setItem(STORAGE_STEP_KEY, currentStep);

        // Update catatan pada banner pemulihan jika ada
        const step7Note = document.getElementById('draftStep7Note');
        if (step7Note) {
            step7Note.style.display = (currentStep === 7) ? 'inline' : 'none';
        }

        // Scroll halus ke atas form
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function validateStep(step) {
        const section = document.getElementById('step-' + step);
        if (!section) return true;

        let valid = true;
        let firstInvalid = null;

        // 1. Validasi Input, Select, Textarea standar
        const inputs = section.querySelectorAll('input[required]:not([type="radio"]):not([type="checkbox"]):not([type="file"]), select[required], textarea[required]');
        inputs.forEach(input => {
            if (!input.value || !input.value.trim()) {
                input.classList.add('is-invalid');
                valid = false;
                if (!firstInvalid) firstInvalid = input;
            } else {
                input.classList.remove('is-invalid');
            }
        });

        // 2. Validasi Radio Buttons (Jalur, Jurusan, Jenis Kelamin)
        const radioGroups = new Set();
        section.querySelectorAll('input[type="radio"][required]').forEach(r => radioGroups.add(r.name));
        radioGroups.forEach(name => {
            const checked = section.querySelector(`input[type="radio"][name="${name}"]:checked`);
            const cards = section.querySelectorAll(`[onclick*="${name}"]`);
            if (!checked) {
                valid = false;
                cards.forEach(c => c.style.borderColor = '#EF4444');
                if (!firstInvalid) firstInvalid = cards[0];
            } else {
                cards.forEach(c => c.style.borderColor = '');
            }
        });

        // 3. Validasi Khusus Step 7 (Bukti Bayar & Persetujuan)
        if (step === 7) {
            const buktiInput = document.getElementById('bukti_pembayaran');
            if (buktiInput && (!buktiInput.files || buktiInput.files.length === 0)) {
                valid = false;
                const uploadArea = document.getElementById('uploadArea');
                if (uploadArea) uploadArea.style.borderColor = '#EF4444';
                if (!firstInvalid) firstInvalid = buktiInput;
            } else {
                const uploadArea = document.getElementById('uploadArea');
                if (uploadArea) uploadArea.style.borderColor = '';
            }

            const persetujuan = document.getElementById('persetujuan');
            if (persetujuan && !persetujuan.checked) {
                valid = false;
                persetujuan.classList.add('is-invalid');
                if (!firstInvalid) firstInvalid = persetujuan;
            } else if (persetujuan) {
                persetujuan.classList.remove('is-invalid');
            }
        }

        if (!valid) {
            if (firstInvalid && typeof firstInvalid.focus === 'function') {
                firstInvalid.focus();
            }
            Swal.fire({
                icon: 'warning',
                title: 'Kolom Wajib Belum Lengkap',
                text: 'Harap periksa dan lengkapi kolom yang bertanda merah sebelum melanjutkan.',
                confirmButtonColor: '#1A56DB'
            });
        }

        return valid;
    }

    /* Validasi semua langkah dari awal hingga akhir sebelum submit final */
    function validateAllSteps() {
        for (let s = 1; s <= TOTAL_STEPS; s++) {
            if (!validateStep(s)) {
                goToStep(s, true);
                return false;
            }
        }
        return true;
    }

    /* Radio card selection */
    function selectRadioCard(el, name, value) {
        if (!el) return;
        document.querySelectorAll(`[onclick*="${name}"]`).forEach(c => {
            c.classList.remove('selected');
            c.style.borderColor = '';
        });
        el.classList.add('selected');
        const radio = el.querySelector('input[type="radio"]');
        if (radio) { 
            radio.checked = true; 
            radio.classList.remove('is-invalid'); 
            saveDraft();
        }
    }

    /* File Upload Handler */
    function handleFileUpload(input) {
        if (!input || !input.files || !input.files[0]) return;

        const file = input.files[0];
        const sizeMB = (file.size / (1024 * 1024)).toFixed(2);

        if (sizeMB > 10) {
            Swal.fire({ icon: 'error', title: 'File Terlalu Besar', text: `Ukuran file ${sizeMB} MB melebihi batas 10 MB.` });
            input.value = '';
            return;
        }

        const info = document.getElementById('fileInfo');
        if (info) {
            info.innerHTML = `<i class="fas fa-check-circle mr-1"></i> ${file.name} (${sizeMB} MB)`;
            info.style.display = 'block';
        }

        const uploadArea = document.getElementById('uploadArea');
        if (uploadArea) uploadArea.style.borderColor = '#10B981';

        // Show image preview
        const preview = document.getElementById('uploadPreview');
        if (preview) {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        }
    }

    /* Drag & Drop */
    const uploadArea = document.getElementById('uploadArea');
    if (uploadArea) {
        ['dragenter','dragover'].forEach(e => uploadArea.addEventListener(e, ev => { ev.preventDefault(); uploadArea.classList.add('drag-over'); }));
        ['dragleave','drop'].forEach(e => uploadArea.addEventListener(e, ev => { ev.preventDefault(); uploadArea.classList.remove('drag-over'); }));
        uploadArea.addEventListener('drop', ev => {
            const file = ev.dataTransfer.files[0];
            if (file) {
                const bukti = document.getElementById('bukti_pembayaran');
                if (bukti) {
                    bukti.files = ev.dataTransfer.files;
                    handleFileUpload(bukti);
                }
            }
        });
    }

    /* MGM Toggle */
    const mgmEl = document.getElementById('mgm');
    if (mgmEl) {
        mgmEl.addEventListener('change', function() {
            const mgmFields = document.getElementById('mgm_fields');
            if (mgmFields) mgmFields.style.display = this.value === '1' ? 'block' : 'none';
            saveDraft();
        });
    }

    /* Copy Rekening */
    function copyRekening(rek) {
        navigator.clipboard.writeText(rek).then(() => {
            Swal.fire({
                icon: 'success', title: 'Tersalin!',
                text: `Nomor rekening ${rek} telah disalin.`,
                timer: 2000, showConfirmButton: false, toast: true, position: 'top-end'
            });
        });
    }

    /* ==========================================================
       AUTO-SAVE & RESTORE DRAFT FORM KE BROWSER (localStorage)
    ========================================================== */
    let saveTimeout = null;
    function saveDraft() {
        clearTimeout(saveTimeout);
        saveTimeout = setTimeout(() => {
            const regForm = document.getElementById('registrationForm');
            if (!regForm) return;

            const draft = {};
            const formData = new FormData(regForm);

            // Simpan semua field teks, radio, select
            formData.forEach((value, key) => {
                if (key !== '_token' && key !== 'bukti_pembayaran' && key !== 'password') {
                    draft[key] = value;
                }
            });

            // Simpan juga radio cards yang checked
            regForm.querySelectorAll('input[type="radio"]:checked').forEach(r => {
                draft[r.name] = r.value;
            });

            // Simpan persetujuan
            const persetujuan = document.getElementById('persetujuan');
            if (persetujuan) {
                draft['_persetujuan'] = persetujuan.checked;
            }

            localStorage.setItem(STORAGE_KEY, JSON.stringify(draft));
            localStorage.setItem(STORAGE_STEP_KEY, currentStep);
        }, 300);
    }

    function restoreDraft() {
        const raw = localStorage.getItem(STORAGE_KEY);
        const savedStep = localStorage.getItem(STORAGE_STEP_KEY);
        if (!raw) return;

        try {
            const draft = JSON.parse(raw);
            if (!draft || Object.keys(draft).length === 0) return;

            const regForm = document.getElementById('registrationForm');
            if (!regForm) return;

            // Isi nilai-nilai form yang tersimpan
            Object.keys(draft).forEach(key => {
                const val = draft[key];
                if (key === '_persetujuan') {
                    const persetujuan = document.getElementById('persetujuan');
                    if (persetujuan) persetujuan.checked = val;
                    return;
                }

                // Radio buttons
                const radio = regForm.querySelector(`input[type="radio"][name="${key}"][value="${val}"]`);
                if (radio) {
                    radio.checked = true;
                    const card = radio.closest('.radio-card');
                    if (card) {
                        document.querySelectorAll(`[onclick*="${key}"]`).forEach(c => c.classList.remove('selected'));
                        card.classList.add('selected');
                    }
                    return;
                }

                // Input standar & Select
                const input = regForm.querySelector(`[name="${key}"]`);
                if (input && input.type !== 'file') {
                    input.value = val;
                    // Trigger input event
                    input.classList.remove('is-invalid');
                }
            });

            // Tampilkan banner bahwa draft dipulihkan
            const stepNum = savedStep ? parseInt(savedStep) : 1;
            const draftAlert = document.getElementById('draftRestoredAlert');
            const draftStepText = document.getElementById('draftStepText');
            if (draftAlert && draftStepText && stepNum > 1) {
                draftStepText.textContent = stepNum;
                draftAlert.style.display = 'flex';
            }

            // Kembalikan ke step yang terakhir dibuka
            if (stepNum > 1 && stepNum <= TOTAL_STEPS) {
                goToStep(stepNum, true);
            }
        } catch (e) {
            console.warn('Gagal memulihkan draft form:', e);
        }
    }

    function clearDraftAndReset() {
        Swal.fire({
            title: 'Mulai Dari Awal?',
            text: 'Seluruh data yang telah tersimpan di browser akan dihapus dan formulir akan direset.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Reset Formulir',
            cancelButtonText: 'Batal'
        }).then((res) => {
            if (res.isConfirmed) {
                localStorage.removeItem(STORAGE_KEY);
                localStorage.removeItem(STORAGE_STEP_KEY);
                window.location.reload();
            }
        });
    }

    /* Submit Form: Validasi menyeluruh & hapus draft setelah berhasil */
    const regForm = document.getElementById('registrationForm');
    if (regForm) {
        regForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Jalankan validasi semua langkah
            if (!validateAllSteps()) {
                return false;
            }

            // Bersihkan draft browser agar tidak tertinggal setelah pendaftaran sukses
            localStorage.removeItem(STORAGE_KEY);
            localStorage.removeItem(STORAGE_STEP_KEY);

            const submitBtn = document.getElementById('submitBtn');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengirim data, harap tunggu...';
            }

            // Kirim form sesungguhnya
            regForm.submit();
        });

        // Dengarkan event input dan change untuk auto-save
        regForm.addEventListener('input', saveDraft);
        regForm.addEventListener('change', saveDraft);
    }

    /* Remove invalid class on input */
    document.querySelectorAll('input, select, textarea').forEach(el => {
        el.addEventListener('input', () => el.classList.remove('is-invalid'));
    });

    /* Attach functions to window explicitly */
    window.goToStep = goToStep;
    window.validateStep = validateStep;
    window.validateAllSteps = validateAllSteps;
    window.selectRadioCard = selectRadioCard;
    window.handleFileUpload = handleFileUpload;
    window.copyRekening = copyRekening;
    window.saveDraft = saveDraft;
    window.clearDraftAndReset = clearDraftAndReset;
</script>
<script>
$(document).ready(function () {
    function initSelect2Components() {
        if (typeof $.fn.select2 !== 'function') {
            setTimeout(initSelect2Components, 50);
            return;
        }

        /* ==========================================================
           WILAYAH: Cascading Provinsi → Kota → Kecamatan → Kelurahan
           API: emsifa.com/api-wilayah-indonesia (free, no API key)
        ========================================================== */
        const BASE = 'https://www.emsifa.com/api-wilayah-indonesia/api';

        // Helper: populate a Select2 dropdown
        function populateSelect(selector, data, placeholder, nameKey = 'name') {
            const $el = $(selector);
            $el.empty().append(`<option value="">${placeholder}</option>`);
            data.forEach(item => {
                $el.append(`<option value="${item[nameKey]}" data-id="${item.id}">${item[nameKey]}</option>`);
            });
            $el.prop('disabled', false).trigger('change.select2');
        }

        // Init Select2 for all wilayah selects
        $('.wilayah-select').select2({
            placeholder: 'Cari atau pilih...',
            allowClear: true,
            language: { searching: () => 'Mencari...', noResults: () => 'Tidak ditemukan' }
        });

    // Load Provinsi on page ready
    fetch(`${BASE}/provinces.json`)
        .then(r => r.json())
        .then(data => {
            populateSelect('#provinsi_select', data, '-- Pilih Provinsi --');
            // Restore old value if any
            const oldVal = '{{ old("provinsi") }}';
            if (oldVal) { $('#provinsi_select').val(oldVal).trigger('change'); }
        })
        .catch(() => console.warn('Gagal load provinsi, gunakan input manual'));

    // Provinsi → Kota
    $('#provinsi_select').on('change', function () {
        const name = $(this).val();
        const id   = $(this).find(':selected').data('id');
        $('#provinsi').val(name);

        // Reset downstream
        ['#kota_select','#kecamatan_select','#kelurahan_select'].forEach(s => {
            $(s).empty().append('<option value="">-- Pilih dahulu --</option>').prop('disabled', true);
        });
        ['#kota','#kecamatan','#kelurahan'].forEach(s => $(s).val(''));

        if (!id) return;
        fetch(`${BASE}/regencies/${id}.json`)
            .then(r => r.json())
            .then(data => {
                populateSelect('#kota_select', data, '-- Pilih Kota/Kab --');
                const oldKota = '{{ old("kota") }}';
                if (oldKota) { $('#kota_select').val(oldKota).trigger('change'); }
            });
    });

    // Kota → Kecamatan
    $('#kota_select').on('change', function () {
        const name = $(this).val();
        const id   = $(this).find(':selected').data('id');
        $('#kota').val(name);

        ['#kecamatan_select','#kelurahan_select'].forEach(s => {
            $(s).empty().append('<option value="">-- Pilih dahulu --</option>').prop('disabled', true);
        });
        ['#kecamatan','#kelurahan'].forEach(s => $(s).val(''));

        if (!id) return;
        fetch(`${BASE}/districts/${id}.json`)
            .then(r => r.json())
            .then(data => {
                populateSelect('#kecamatan_select', data, '-- Pilih Kecamatan --');
                const oldKec = '{{ old("kecamatan") }}';
                if (oldKec) { $('#kecamatan_select').val(oldKec).trigger('change'); }
            });
    });

    // Kecamatan → Kelurahan
    $('#kecamatan_select').on('change', function () {
        const name = $(this).val();
        const id   = $(this).find(':selected').data('id');
        $('#kecamatan').val(name);

        $('#kelurahan_select').empty().append('<option value="">-- Pilih dahulu --</option>').prop('disabled', true);
        $('#kelurahan').val('');

        if (!id) return;
        fetch(`${BASE}/villages/${id}.json`)
            .then(r => r.json())
            .then(data => {
                populateSelect('#kelurahan_select', data, '-- Pilih Kelurahan --');
                const oldKel = '{{ old("kelurahan") }}';
                if (oldKel) { $('#kelurahan_select').val(oldKel).trigger('change'); }
            });
    });

    // Kelurahan change
    $('#kelurahan_select').on('change', function () {
        $('#kelurahan').val($(this).val());
    });

    /* ==========================================================
       ASAL SEKOLAH: Select2 AJAX Autocomplete
       API: https://sekolah.devapi.id/sekolah
       Fallback: user dapat ketik manual & tekan Enter
    ========================================================== */
    $('#asal_sekolah_select').select2({
        placeholder: 'Ketik nama sekolah... (min. 3 huruf)',
        allowClear: true,
        minimumInputLength: 3,
        language: {
            inputTooShort: () => 'Ketik minimal 3 huruf untuk mencari',
            searching:     () => 'Mencari sekolah...',
            noResults:     () => 'Tidak ditemukan. Ketik nama lengkap lalu tekan Enter untuk input manual.'
        },
        tags: true,  // allow manual entry
        ajax: {
            url: 'https://sekolah.devapi.id/sekolah',
            dataType: 'json',
            delay: 400,
            data: params => ({ nama: params.term }),
            processResults: data => {
                const list = data.data || [];
                const items = list.map(s => {
                    const namaSekolah = s.nama || s;
                    const kab = s.alamat ? (s.alamat.nama_kabupaten || '') : '';
                    const prov = s.alamat ? (s.alamat.nama_provinsi || '') : '';
                    const lokasi = [kab, prov].filter(Boolean).join(', ');
                    return {
                        id: namaSekolah,
                        text: namaSekolah + (lokasi ? ` (${lokasi})` : '')
                    };
                });
                return { results: items };
            },
            error: () => {
                return { results: [] };
            }
        }
    });

    // Sync to hidden input
    $('#asal_sekolah_select').on('change', function () {
        const val = $(this).val();
        // If it's a tag (manual entry), val = typed text; if from API, val = id (nama sekolah)
        $('#asal_sekolah').val(val);
    });

    // Pre-select existing value (on validation fail)
    const existingSekolah = '{{ old("asal_sekolah") }}';
    if (existingSekolah) {
        const opt = new Option(existingSekolah, existingSekolah, true, true);
        $('#asal_sekolah_select').append(opt).trigger('change');
    }

    } // end initSelect2Components

    initSelect2Components();
    restoreDraft();
});
</script>
@endsection
