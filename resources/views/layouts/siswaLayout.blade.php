<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Google Fonts: Plus Jakarta Sans & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

    @if ($setting?->logo_path)
        <link rel="shortcut icon" href="{{ asset('storage/' . $setting->logo_path) }}" type="image/x-icon">
    @else
        <link rel="shortcut icon" href="{{ asset('images/icb.png') }}" type="image/x-icon">
    @endif

    <style>
        :root {
            --primary-navy: #0B3B7B;
            --primary-blue: #1A56DB;
            --primary-light: #EBF5FF;
            --dark-slate: #0F172A;
            --muted-slate: #64748B;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1E293B;
            background-color: #F8FAFC;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        h1, h2, h3, h4, h5, .font-heading {
            font-family: 'Outfit', 'Plus Jakarta Sans', sans-serif;
        }

        /* Slim Modern Navbar (matching landing page) */
        .custom-navbar {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            min-height: 60px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        }

        .custom-navbar .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 800;
            color: var(--primary-navy);
            font-size: 1.05rem;
            letter-spacing: -0.3px;
            padding: 10px 0;
        }

        .brand-subtitle {
            font-size: 0.68rem;
            color: var(--muted-slate);
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            line-height: 1.2;
        }

        .navbar-cta-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-nav-outline {
            font-size: 0.84rem;
            font-weight: 700;
            padding: 7px 16px;
            border-radius: 8px;
            border: 1.5px solid #CBD5E1;
            color: #334155;
            background: transparent;
            transition: all 0.2s;
            text-decoration: none !important;
        }

        .btn-nav-outline:hover {
            border-color: var(--primary-blue);
            color: var(--primary-blue);
            background: var(--primary-light);
        }

        .btn-nav-primary {
            font-size: 0.84rem;
            font-weight: 700;
            padding: 8px 18px;
            border-radius: 8px;
            background: var(--primary-blue);
            color: #fff !important;
            border: none;
            transition: all 0.2s;
            box-shadow: 0 3px 10px -2px rgba(26,86,219,0.4);
            text-decoration: none !important;
        }

        .btn-nav-primary:hover {
            background: var(--primary-navy);
            box-shadow: 0 6px 16px -4px rgba(26,86,219,0.5);
            transform: translateY(-1px);
        }

        @media (max-width: 991px) {
            .navbar-collapse {
                background: rgba(255, 255, 255, 0.98);
                border-radius: 16px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.1);
                padding: 16px;
                margin-top: 10px;
                margin-bottom: 12px;
                border: 1px solid #E2E8F0;
            }
            .navbar-cta-group {
                flex-direction: column;
                align-items: stretch;
                width: 100%;
                gap: 8px;
                margin-top: 8px;
            }
            .navbar-cta-group .btn {
                text-align: center;
            }
        }

        /* Slim Ramping Footer */
        .site-footer-slim {
            background: #0F172A;
            color: #94A3B8;
            font-size: 0.875rem;
            padding: 18px 0;
            margin-top: auto;
            border-top: 1px solid #1E293B;
        }

        .site-footer-slim a {
            color: #CBD5E1;
            text-decoration: none;
            transition: color 0.2s;
        }

        .site-footer-slim a:hover {
            color: #FFFFFF;
        }
    </style>

    <!-- jQuery & Select2 JS (Loaded in head so jQuery/Select2 are available globally before view scripts) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>
    @include('sweetalert::alert')

    <!-- Slim Modern Navbar -->
    <nav class="navbar navbar-expand-lg custom-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                @if ($setting?->logo_path)
                    <img src="{{ asset('storage/' . $setting->logo_path) }}" alt="Logo" height="34">
                @else
                    <img src="{{ asset('images/icb.png') }}" alt="Logo SMK ICB" height="34">
                @endif
                <div>
                    <div>{{ $setting->app_name ?? 'SMK ICB Cinta Teknika' }}</div>
                    <div class="brand-subtitle">Student Today Leader Tomorrow</div>
                </div>
            </a>

            <button class="navbar-toggler border-0 p-2" type="button" data-toggle="collapse" data-target="#siswaNavbar"
                aria-controls="siswaNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars text-primary"></i>
            </button>

            <div class="collapse navbar-collapse" id="siswaNavbar">
                <div class="ml-auto navbar-cta-group">
                    <a class="btn btn-nav-outline" href="{{ url('/') }}">
                        <i class="fas fa-home mr-1"></i> Beranda
                    </a>
                    <a class="btn btn-nav-outline" href="{{ route('pendaftaran.cekStatus') }}">
                        <i class="fas fa-search mr-1"></i> Cek Status
                    </a>
                    <a class="btn btn-nav-primary" href="{{ route('siswa.daftar') }}">
                        <i class="fas fa-paper-plane mr-1"></i> Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div style="flex: 1;">
        @yield('content')
    </div>

    <!-- Slim Footer -->
    <footer class="site-footer-slim">
        <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between text-center text-md-left gap-2">
            <div>
                &copy; {{ date('Y') }} <strong>{{ $setting->app_name ?? 'SMK ICB Cinta Teknika' }}</strong>. All rights reserved.
            </div>
            <div class="mt-2 mt-md-0">
                <a href="{{ url('/') }}" class="mr-3"><i class="fas fa-arrow-left mr-1"></i> Kembali ke Beranda</a>
                <a href="{{ route('pendaftaran.cekStatus') }}"><i class="fas fa-search mr-1"></i> Cek Status</a>
            </div>
        </div>
    </footer>

    @vite('resources/js/app.js')
    <!-- jQuery & Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Bootstrap Bundle & AdminLTE -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/adminlte.min.js') }}" defer></script>
    @yield('script')
</body>

</html>
