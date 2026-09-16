@extends('layouts.guest')

@push('styles')
<style>
    .auth-container {
        width: 100%;
        max-width: 450px;
        position: relative;
        z-index: 2;
    }

    .auth-card {
        background: #FFFFFF;
        border-radius: 24px;
        box-shadow: 0 20px 45px -15px rgba(11, 59, 123, 0.12), 0 0 0 1px rgba(226, 232, 240, 0.9);
        padding: 40px 36px;
        transition: all 0.3s ease;
    }

    @media (max-width: 575.98px) {
        .auth-card {
            padding: 30px 22px;
            border-radius: 20px;
            box-shadow: 0 12px 30px -10px rgba(11, 59, 123, 0.1), 0 0 0 1px rgba(226, 232, 240, 0.9);
        }
    }

    /* Logo Styling */
    .auth-logo-wrapper {
        width: 80px;
        height: 80px;
        margin: 0 auto 16px;
        background: #FFFFFF;
        border-radius: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 25px -5px rgba(26, 86, 219, 0.18), 0 0 0 1px rgba(219, 234, 254, 0.8);
        padding: 10px;
        transition: transform 0.3s ease;
    }

    .auth-logo-wrapper:hover {
        transform: translateY(-2px) scale(1.02);
    }

    .auth-logo-img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .auth-title {
        font-family: 'Outfit', sans-serif;
        font-size: 1.65rem;
        font-weight: 800;
        color: #0F172A;
        letter-spacing: -0.5px;
        line-height: 1.25;
    }

    .auth-subtitle {
        font-size: 0.92rem;
        color: #64748B;
        font-weight: 500;
    }

    .badge-ta {
        display: inline-flex;
        align-items: center;
        background: #EFF6FF;
        color: #1A56DB;
        font-size: 0.78rem;
        font-weight: 700;
        padding: 4px 14px;
        border-radius: 30px;
        border: 1px solid #DBEAFE;
        letter-spacing: 0.3px;
    }

    .auth-divider {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 22px 0;
        color: #94A3B8;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    .auth-divider::before,
    .auth-divider::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid #E2E8F0;
    }

    .auth-divider span {
        padding: 0 14px;
    }

    /* Custom Input Group */
    .form-label-custom {
        font-size: 0.86rem;
        font-weight: 700;
        color: #334155;
        margin-bottom: 6px;
        display: block;
    }

    .input-group-custom {
        position: relative;
        display: flex;
        align-items: center;
        width: 100%;
    }

    .input-icon {
        position: absolute;
        left: 16px;
        color: #94A3B8;
        font-size: 0.95rem;
        z-index: 4;
        pointer-events: none;
        transition: color 0.2s ease;
    }

    .form-control-custom {
        width: 100%;
        height: 50px;
        padding: 10px 48px 10px 46px;
        font-size: 0.95rem;
        font-family: inherit;
        color: #0F172A;
        background: #F8FAFC;
        border: 1.5px solid #E2E8F0;
        border-radius: 12px;
        transition: all 0.2s ease;
        outline: none;
    }

    .form-control-custom::placeholder {
        color: #94A3B8;
        font-size: 0.9rem;
    }

    .form-control-custom:focus {
        background: #FFFFFF;
        border-color: #1A56DB;
        box-shadow: 0 0 0 4px rgba(26, 86, 219, 0.12);
    }

    .input-group-custom:focus-within .input-icon {
        color: #1A56DB;
    }

    .input-group-custom.has-error .form-control-custom {
        border-color: #EF4444;
        background: #FEF2F2;
    }

    .btn-toggle-password {
        position: absolute;
        right: 12px;
        background: transparent;
        border: none;
        color: #94A3B8;
        padding: 8px 10px;
        cursor: pointer;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: color 0.2s;
        z-index: 4;
        outline: none;
    }

    .btn-toggle-password:hover {
        color: #1A56DB;
    }

    /* Submit Button */
    .btn-auth-submit {
        height: 50px;
        border-radius: 12px;
        background: linear-gradient(135deg, #1A56DB 0%, #0B3B7B 100%);
        color: #FFFFFF;
        font-weight: 700;
        font-size: 0.98rem;
        border: none;
        box-shadow: 0 10px 20px -4px rgba(26, 86, 219, 0.35);
        transition: all 0.25s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        cursor: pointer;
    }

    .btn-auth-submit:hover {
        background: linear-gradient(135deg, #1D4ED8 0%, #082F64 100%);
        color: #FFFFFF;
        transform: translateY(-2px);
        box-shadow: 0 14px 24px -4px rgba(26, 86, 219, 0.45);
    }

    .btn-auth-submit:active {
        transform: translateY(0);
    }

    .back-home-link {
        color: #64748B;
        font-weight: 600;
        font-size: 0.88rem;
        text-decoration: none;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
    }

    .back-home-link:hover {
        color: #1A56DB;
        text-decoration: none;
        transform: translateX(-3px);
    }
</style>
@endpush

@section('content')
<div class="auth-container">
    <div class="auth-card">
        {{-- Data Dinamis Setting --}}
        @php
            $logoSrc = (!empty($setting?->logo_path))
                ? asset('storage/' . $setting->logo_path)
                : asset('images/icb.png');
            $appName = $setting->app_name ?? 'SPMB';
            $schoolName = $setting->atas_nama ?? 'SMK ICB Cinta Teknika';
            $ta = $setting->tahun_ajaran ?? '2026/2027';
        @endphp

        {{-- Header Logo & Identitas Sekolah --}}
        <div class="text-center mb-3">
            <div class="auth-logo-wrapper">
                <img src="{{ $logoSrc }}" alt="Logo {{ $appName }}" onerror="this.src='{{ asset('images/icb.png') }}'" class="auth-logo-img">
            </div>
            <h3 class="auth-title mb-1">{{ $appName }}</h3>
            <p class="auth-subtitle mb-2">{{ $schoolName }}</p>
            <span class="badge-ta">
                <i class="fas fa-calendar-alt mr-1"></i> Tahun Ajaran {{ $ta }}
            </span>
        </div>

        <div class="auth-divider">
            <span>Portal Masuk Petugas</span>
        </div>

        {{-- Notifikasi Error --}}
        @if ($errors->any())
            <div class="alert alert-danger border-0 mb-4 p-3 shadow-sm" style="border-radius: 12px; font-size: 0.88rem; background: #FEF2F2; color: #991B1B;">
                <div class="d-flex align-items-center mb-1 font-weight-bold">
                    <i class="fas fa-exclamation-circle mr-2" style="font-size: 1rem;"></i>
                    Email atau kata sandi tidak cocok.
                </div>
                <div class="small text-muted" style="color: #B91C1C !important;">
                    Silakan periksa kembali kredensial akun panitia/admin Anda.
                </div>
            </div>
        @endif

        {{-- Form Login --}}
        <form action="{{ route('login') }}" method="post" id="loginForm">
            @csrf

            <!-- Input Email -->
            <div class="form-group mb-3">
                <label for="email" class="form-label-custom">Email Petugas / Admin</label>
                <div class="input-group-custom @error('email') has-error @enderror">
                    <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <input type="email" name="email" id="email" 
                           class="form-control-custom" 
                           placeholder="admin@sekolah.sch.id" 
                           value="{{ old('email') }}" 
                           required autofocus autocomplete="email">
                </div>
            </div>

            <!-- Input Password dengan Toggle Show/Hide -->
            <div class="form-group mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label for="password" class="form-label-custom mb-0">Kata Sandi</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="small text-primary font-weight-bold" style="text-decoration: none;">
                            Lupa sandi?
                        </a>
                    @endif
                </div>
                <div class="input-group-custom @error('password') has-error @enderror">
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input type="password" name="password" id="password" 
                           class="form-control-custom" 
                           placeholder="Masukkan kata sandi..." 
                           required autocomplete="current-password">
                    <button type="button" class="btn-toggle-password" id="togglePasswordBtn" title="Tampilkan / Sembunyikan Sandi" tabindex="-1">
                        <i class="fas fa-eye" id="togglePasswordIcon"></i>
                    </button>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="custom-control-label small text-muted font-weight-medium" for="remember" style="cursor: pointer; user-select: none;">
                        Ingat saya di perangkat ini
                    </label>
                </div>
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-auth-submit">
                <span>Masuk ke Dashboard</span>
                <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </form>

        {{-- Link Kembali ke Beranda --}}
        <div class="text-center mt-4 pt-3 border-top">
            <a href="{{ url('/') }}" class="back-home-link">
                <i class="fas fa-long-arrow-alt-left mr-2"></i> Kembali ke Halaman Utama
            </a>
        </div>
    </div>

    <!-- Security Badge & Footer -->
    <div class="text-center mt-3 text-muted small" style="font-size: 0.8rem;">
        <span class="mr-2"><i class="fas fa-shield-alt text-success mr-1"></i> Sistem Terenkripsi & Terverifikasi</span>
        <span>• &copy; {{ date('Y') }} {{ $appName }}</span>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Toggle Tampilkan / Sembunyikan Password
    const toggleBtn = document.getElementById('togglePasswordBtn');
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('togglePasswordIcon');

    if (toggleBtn && passwordInput && toggleIcon) {
        toggleBtn.addEventListener('click', function () {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            toggleIcon.className = isPassword ? 'fas fa-eye-slash' : 'fas fa-eye';
        });
    }
</script>
@endpush