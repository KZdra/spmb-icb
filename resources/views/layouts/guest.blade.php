<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ ($setting->app_name ?? 'SPMB') . ' - Portal Masuk Admin & Petugas' }}</title>

    <!-- Google Fonts: Plus Jakarta Sans & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <!-- Theme style (Bootstrap 4 & AdminLTE) -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">

    {{-- Dynamic Favicon dari Logo Upload --}}
    @if (!empty($setting?->logo_path))
        <link rel="shortcut icon" href="{{ asset('storage/' . $setting->logo_path) }}" type="image/x-icon">
    @else
        <link rel="shortcut icon" href="{{ asset('images/icb.png') }}" type="image/x-icon">
    @endif

    <style>
        :root {
            --primary-blue: #1A56DB;
            --primary-navy: #0B3B7B;
            --primary-light: #EFF6FF;
            --text-dark: #0F172A;
            --text-muted: #64748B;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-dark);
            background: #F8FAFC;
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
        }

        /* Ambient Glow & Background Elements */
        body::before {
            content: '';
            position: fixed;
            top: -150px;
            right: -150px;
            width: 450px;
            height: 450px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(26, 86, 219, 0.12) 0%, rgba(26, 86, 219, 0) 70%);
            pointer-events: none;
            z-index: 0;
        }

        body::after {
            content: '';
            position: fixed;
            bottom: -150px;
            left: -150px;
            width: 450px;
            height: 450px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.09) 0%, rgba(245, 158, 11, 0) 70%);
            pointer-events: none;
            z-index: 0;
        }

        .auth-wrapper {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 24px 16px;
            position: relative;
            z-index: 1;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="auth-wrapper">
        @yield('content')
    </div>

    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
