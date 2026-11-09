<!DOCTYPE html>
<html lang="id" prefix="og: https://ogp.me/ns#">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $siteTitle = 'SPMB ' . ($setting->app_name ?? 'SMK ICB Cinta Teknika') . ' - Pendaftaran Siswa Baru TA ' . ($setting->tahun_ajaran ?? '2027/2028');
        $siteDesc = 'Portal Resmi Penerimaan Peserta Didik Baru (SPMB) ' . ($setting->atas_nama ?? 'SMK ICB Cinta Teknika') . ' Tahun Ajaran ' . ($setting->tahun_ajaran ?? '2027/2028') . '. Terakreditasi A (Unggul). Daftar online 24 jam cepat & mudah!';
        $siteImage = !empty($setting?->logo_path) ? asset('storage/' . $setting->logo_path) : asset('images/icb.png');
        $siteUrl = url('/');
    @endphp

    <title>{{ $siteTitle }}</title>

    <meta name="description" content="{{ $siteDesc }}">
    <meta name="keywords" content="SPMB, PPDB, {{ $setting->atas_nama ?? 'SMK ICB Cinta Teknika' }}, SMK ICB, Bandung, Pendaftaran Siswa Baru, Sekolah Kejuruan, Penerimaan Murid Baru">
    <meta name="author" content="{{ $setting->atas_nama ?? 'SMK ICB Cinta Teknika' }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ $siteUrl }}">

    <!-- Open Graph / Facebook / WhatsApp Preview Card -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $siteUrl }}">
    <meta property="og:title" content="{{ $siteTitle }}">
    <meta property="og:description" content="{{ $siteDesc }}">
    <meta property="og:image" content="{{ $siteImage }}">
    <meta property="og:image:secure_url" content="{{ $siteImage }}">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Logo {{ $setting->atas_nama ?? 'SMK ICB Cinta Teknika' }}">
    <meta property="og:site_name" content="{{ $setting->atas_nama ?? ($setting->app_name ?? 'SMK ICB Cinta Teknika') }}">
    <meta property="og:locale" content="id_ID">

    <!-- Schema.org Microdata (WhatsApp / Google Fallback) -->
    <meta itemprop="name" content="{{ $siteTitle }}">
    <meta itemprop="description" content="{{ $siteDesc }}">
    <meta itemprop="image" content="{{ $siteImage }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ $siteUrl }}">
    <meta name="twitter:title" content="{{ $siteTitle }}">
    <meta name="twitter:description" content="{{ $siteDesc }}">
    <meta name="twitter:image" content="{{ $siteImage }}">

    @include('sweetalert::alert')

    <!-- Google Fonts: Plus Jakarta Sans & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <!-- Animate.css (Local Asset + CDN Fallback) -->
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <link rel="shortcut icon" href="{{ $setting?->favicon_url ?? asset('images/icb.png') }}" type="image/x-icon">

    @php
        $pCol = $setting?->primary_color ?? '#1A56DB';
        $sCol = $setting?->secondary_color ?? '#0B3B7B';
        $aCol = $setting?->accent_color ?? '#10B981';
    @endphp
    <style>
        :root {
            --primary-navy: {{ $sCol }};
            --primary-blue: {{ $pCol }};
            --primary-color: {{ $pCol }};
            --secondary-color: {{ $sCol }};
            --accent-color: {{ $aCol }};
            --primary-light: {{ $pCol }}18;
            --accent-gold: {{ $aCol }};
            --accent-gold-dark: #D97706;
            --accent-amber: #FEF3C7;
            --success-green: {{ $aCol }};
            --dark-slate: #0F172A;
            --muted-slate: #64748B;
            --border-color: #E2E8F0;
            --bg-light: #F8FAFC;
        }

        .btn-primary, .bg-primary {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
        }
        .text-primary {
            color: var(--primary-color) !important;
        }
        .border-primary {
            border-color: var(--primary-color) !important;
        }
        .btn-outline-primary {
            color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
        }
        .btn-outline-primary:hover {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
            color: #ffffff !important;
        }
        .badge-primary {
            background-color: var(--primary-color) !important;
            color: #ffffff !important;
        }

        /* Countdown Timer & Milestone Bars */
        .countdown-bar-wrap {
            position: relative;
            z-index: 20;
            margin-top: -36px;
            margin-bottom: 30px;
        }
        .countdown-card {
            background: linear-gradient(135deg, var(--secondary-color) 0%, #0F172A 100%);
            border-radius: 18px;
            padding: 22px 28px;
            color: #ffffff;
            box-shadow: 0 16px 36px rgba(11, 59, 123, 0.18);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }
        .countdown-unit {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            padding: 8px 14px;
            text-align: center;
            min-width: 62px;
        }
        .countdown-num {
            font-size: 1.5rem;
            font-weight: 800;
            font-family: 'Outfit', sans-serif;
            color: #FDE68A;
            line-height: 1.1;
        }
        .countdown-label {
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.85;
            margin-top: 2px;
        }

        .milestone-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 20px 18px;
            text-align: center;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            height: 100%;
        }
        .milestone-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.08);
            border-color: var(--primary-color);
        }
        .milestone-number {
            font-size: 2rem;
            font-weight: 900;
            font-family: 'Outfit', sans-serif;
            color: var(--primary-color);
            line-height: 1;
            margin-bottom: 6px;
        }

        /* Mitra Industri Cards */
        .mitra-card {
            background: #ffffff;
            border: 1px solid #E2E8F0;
            border-radius: 14px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 85px;
            transition: all 0.25s ease;
            box-shadow: 0 2px 6px rgba(0,0,0,0.02);
            text-align: center;
            height: 100%;
        }
        .mitra-card:hover {
            border-color: var(--primary-color);
            box-shadow: 0 8px 20px rgba(0,0,0,0.07);
            transform: translateY(-3px);
        }

        /* Testimoni Alumni Cards */
        .testimoni-card {
            background: #ffffff;
            border: 1px solid #E2E8F0;
            border-radius: 18px;
            padding: 26px;
            display: flex;
            flex-direction: column;
            height: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.02);
        }
        .testimoni-card:hover {
            box-shadow: 0 12px 30px rgba(0,0,0,0.08);
            transform: translateY(-4px);
            border-color: var(--primary-color);
        }
        .testimoni-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary-color);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1E293B;
            background-color: #FFFFFF;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        h1, h2, h3, h4, h5, .font-heading {
            font-family: 'Outfit', 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
        }

        /* Top Announcement Bar */
        .top-bar {
            background: linear-gradient(90deg, var(--secondary-color) 0%, var(--primary-color) 50%, var(--secondary-color) 100%);
            color: #FFFFFF;
            font-size: 0.875rem;
            padding: 8px 0;
            position: relative;
            z-index: 1040;
        }

        .top-bar a {
            color: #FDE68A;
            font-weight: 600;
            text-decoration: underline;
        }

        /* Sticky Glass Navbar — slim & clean */
        .custom-navbar {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.7);
            transition: all 0.3s ease;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            min-height: 60px;
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

        .navbar-nav .nav-item .nav-link {
            font-weight: 600;
            color: #475569 !important;
            padding: 8px 14px !important;
            border-radius: 8px;
            transition: all 0.2s ease;
            font-size: 0.9rem;
            white-space: nowrap;
        }

        .navbar-nav .nav-item .nav-link:hover,
        .navbar-nav .nav-item .nav-link.active {
            color: var(--primary-blue) !important;
            background-color: var(--primary-light);
        }

        /* Navbar Dropdown Menu */
        .custom-navbar .dropdown-menu {
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 12px;
            box-shadow: 0 12px 30px -5px rgba(15, 23, 42, 0.12);
            padding: 8px;
            min-width: 220px;
            margin-top: 6px;
        }

        .custom-navbar .dropdown-item {
            font-size: 0.86rem;
            font-weight: 600;
            color: #475569;
            padding: 8px 12px;
            border-radius: 8px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
        }

        .custom-navbar .dropdown-item:hover {
            color: var(--primary-blue);
            background-color: var(--primary-light);
            transform: translateX(3px);
        }

        .custom-navbar .dropdown-item i {
            width: 20px;
            text-align: center;
            margin-right: 10px;
            font-size: 0.9rem;
        }

        @media (min-width: 992px) {
            .custom-navbar .nav-item.dropdown:hover .dropdown-menu {
                display: block;
                animation: fadeInDown 0.2s cubic-bezier(0.16, 1, 0.3, 1);
            }
        }

        .navbar-cta-group {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-left: 12px;
        }

        .navbar-cta-group .btn-nav-outline {
            font-size: 0.82rem;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 8px;
            border: 1.5px solid #CBD5E1;
            color: #334155;
            background: transparent;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .navbar-cta-group .btn-nav-outline:hover {
            border-color: var(--primary-blue);
            color: var(--primary-blue);
            background: var(--primary-light);
        }

        .navbar-cta-group .btn-nav-primary {
            font-size: 0.82rem;
            font-weight: 700;
            padding: 7px 16px;
            border-radius: 8px;
            background: var(--primary-blue);
            color: #fff;
            border: none;
            transition: all 0.2s;
            white-space: nowrap;
            box-shadow: 0 3px 10px -2px rgba(26,86,219,0.4);
        }

        .navbar-cta-group .btn-nav-primary:hover {
            background: var(--primary-navy);
            color: #fff;
            box-shadow: 0 6px 16px -4px rgba(26,86,219,0.5);
            transform: translateY(-1px);
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            background: radial-gradient(circle at top right, #EBF5FF 0%, #FFFFFF 65%, #F8FAFC 100%);
            padding: 80px 0 60px 0;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, rgba(26, 86, 219, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .badge-akreditasi {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
            color: #92400E;
            font-weight: 700;
            font-size: 0.825rem;
            padding: 6px 14px;
            border-radius: 9999px;
            border: 1px solid #FCD34D;
            box-shadow: 0 2px 6px rgba(245, 158, 11, 0.15);
        }

        .hero-title {
            font-size: 3rem;
            line-height: 1.15;
            color: var(--dark-slate);
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-top: 15px;
            margin-bottom: 20px;
        }

        .hero-title span {
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-lead {
            font-size: 1.125rem;
            color: #475569;
            line-height: 1.65;
            margin-bottom: 28px;
        }

        .btn-brand-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: #FFFFFF;
            font-weight: 700;
            padding: 14px 28px;
            border-radius: 12px;
            box-shadow: 0 10px 20px -5px rgba(26, 86, 219, 0.4);
            border: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-brand-primary:hover {
            color: #FFFFFF;
            transform: translateY(-2px);
            box-shadow: 0 14px 24px -5px rgba(26, 86, 219, 0.5);
        }

        .btn-brand-outline {
            background: #FFFFFF;
            color: var(--primary-navy);
            font-weight: 700;
            padding: 14px 26px;
            border-radius: 12px;
            border: 2px solid #CBD5E1;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-brand-outline:hover {
            color: var(--primary-blue);
            border-color: var(--primary-blue);
            background: var(--primary-light);
            transform: translateY(-2px);
        }

        /* Hero Highlights Strip */
        .hero-pill-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-top: 35px;
            padding-top: 25px;
            border-top: 1px solid #E2E8F0;
        }

        .pill-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            color: #334155;
        }

        .pill-icon {
            width: 32px;
            height: 32px;
            background: var(--primary-light);
            color: var(--primary-blue);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }

        /* Hero Image Showcase Card */
        .hero-poster-card {
            background: #FFFFFF;
            border-radius: 24px;
            padding: 14px;
            box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.15);
            border: 1px solid rgba(226, 232, 240, 0.8);
            position: relative;
            transition: transform 0.3s ease;
        }

        .hero-poster-card:hover {
            transform: translateY(-5px);
        }

        .hero-poster-img {
            width: 100%;
            height: 480px;
            object-fit: cover;
            object-position: top center;
            border-radius: 18px;
            cursor: pointer;
        }

        .poster-floating-badge {
            position: absolute;
            bottom: 25px;
            left: 25px;
            right: 25px;
            background: rgba(11, 59, 123, 0.92);
            backdrop-filter: blur(8px);
            color: white;
            padding: 14px 18px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Section Global */
        .section-padding {
            padding: 80px 0;
        }

        .section-header {
            text-align: center;
            max-width: 720px;
            margin: 0 auto 50px auto;
        }

        .section-tag {
            display: inline-block;
            background: var(--primary-light);
            color: var(--primary-blue);
            font-weight: 700;
            font-size: 0.825rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 6px 14px;
            border-radius: 9999px;
            margin-bottom: 12px;
        }

        .section-title {
            font-size: 2.25rem;
            color: var(--dark-slate);
            letter-spacing: -0.5px;
            margin-bottom: 15px;
        }

        .section-desc {
            font-size: 1.05rem;
            color: var(--muted-slate);
            line-height: 1.6;
        }

        /* 4-Step Cards */
        .step-card {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 20px;
            padding: 30px;
            height: 100%;
            position: relative;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
        }

        .step-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.08);
            border-color: #BFDBFE;
        }

        /* Syarat Pendaftaran Cards */
        .syarat-card {
            transition: all 0.3s ease;
        }
        .syarat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.08) !important;
            border-color: #BFDBFE !important;
        }

        .step-number {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            font-size: 1.5rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            color: #FFFFFF;
        }

        .step-1-num { background: linear-gradient(135deg, #0284C7 0%, #0369A1 100%); }
        .step-2-num { background: linear-gradient(135deg, #DC2626 0%, #B91C1C 100%); }
        .step-3-num { background: linear-gradient(135deg, #16A34A 0%, #15803D 100%); }
        .step-4-num { background: linear-gradient(135deg, #7C3AED 0%, #6D28D9 100%); }

        .step-card h4 {
            font-size: 1.25rem;
            color: var(--dark-slate);
            margin-bottom: 12px;
        }

        .step-checklist {
            list-style: none;
            padding: 0;
            margin: 0;
            font-size: 0.925rem;
            color: #475569;
        }

        .step-checklist li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 10px;
            line-height: 1.45;
        }

        .step-checklist li i {
            color: var(--success-green);
            margin-top: 3px;
            font-size: 0.95rem;
        }

        /* Bank Account Box */
        .bank-info-box {
            background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
            border: 1px dashed #3B82F6;
            border-radius: 14px;
            padding: 16px;
            margin-top: 15px;
        }

        .bank-rek-number {
            font-family: 'Outfit', monospace;
            font-size: 1.25rem;
            font-weight: 800;
            color: #1E3A8A;
            letter-spacing: 1px;
        }

        .btn-copy-rek {
            background: #FFFFFF;
            color: var(--primary-blue);
            font-size: 0.8rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 6px;
            border: 1px solid #93C5FD;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-copy-rek:hover {
            background: var(--primary-blue);
            color: #FFFFFF;
        }

        /* Alur Timeline (9 Steps) */
        .alur-timeline {
            position: relative;
            max-width: 900px;
            margin: 0 auto;
        }

        .alur-timeline::before {
            content: '';
            position: absolute;
            left: 28px;
            top: 10px;
            bottom: 10px;
            width: 4px;
            background: #E2E8F0;
            border-radius: 2px;
        }

        .alur-item {
            position: relative;
            padding-left: 70px;
            margin-bottom: 24px;
        }

        .alur-badge {
            position: absolute;
            left: 0;
            top: 0;
            width: 56px;
            height: 56px;
            border-radius: 16px;
            background: #FFFFFF;
            border: 3px solid var(--primary-blue);
            color: var(--primary-blue);
            font-weight: 800;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
            z-index: 2;
            transition: all 0.3s;
        }

        .alur-item:hover .alur-badge {
            background: var(--primary-blue);
            color: #FFFFFF;
            transform: scale(1.08);
        }

        .alur-card {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 16px;
            padding: 18px 22px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.04);
            transition: all 0.2s;
        }

        .alur-card:hover {
            border-color: #93C5FD;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.06);
        }

        .alur-card h5 {
            font-size: 1.1rem;
            color: var(--dark-slate);
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .alur-card p {
            font-size: 0.925rem;
            color: #64748B;
            margin: 0;
            line-height: 1.5;
        }

        /* Artikel & Panduan Section */
        .article-card {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        }

        .article-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            font-size: 0.85rem;
            color: #64748B;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #F1F5F9;
        }

        .article-body {
            font-size: 1.025rem;
            color: #334155;
            line-height: 1.75;
        }

        .article-body h3 {
            color: var(--primary-navy);
            margin-top: 25px;
            margin-bottom: 12px;
            font-size: 1.4rem;
        }

        .article-highlight-box {
            background: #F8FAFC;
            border-left: 4px solid var(--primary-blue);
            padding: 16px 20px;
            border-radius: 0 12px 12px 0;
            margin: 20px 0;
        }

        /* Brosur Showcase Cards */
        .brochure-card {
            background: #FFFFFF;
            border-radius: 18px;
            border: 1px solid #E2E8F0;
            overflow: hidden;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .brochure-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.15);
        }

        .brochure-thumb {
            width: 100%;
            height: 380px;
            object-fit: cover;
            object-position: top;
            transition: transform 0.5s ease;
        }

        .brochure-card:hover .brochure-thumb {
            transform: scale(1.03);
        }

        .brochure-body {
            padding: 18px;
            background: #FFFFFF;
        }

        /* Jurusan Cards */
        .jurusan-card {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 18px;
            padding: 24px;
            height: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .jurusan-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-blue);
            box-shadow: 0 15px 25px -5px rgba(26, 86, 219, 0.12);
        }

        .jurusan-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        }

        .jurusan-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: var(--primary-light);
            color: var(--primary-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin-bottom: 16px;
        }

        /* CTA Banner */
        .cta-banner {
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
            border-radius: 24px;
            padding: 60px 40px;
            color: #FFFFFF;
            position: relative;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .cta-banner::after {
            content: '';
            position: absolute;
            right: -50px;
            bottom: -50px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
            border-radius: 50%;
        }

        /* Footer */
        .site-footer {
            background-color: #0B1727;
            color: #94A3B8;
            padding: 60px 0 25px 0;
            font-size: 0.925rem;
        }

        .site-footer a {
            color: #CBD5E1;
            text-decoration: none;
            transition: color 0.2s;
        }

        .site-footer a:hover {
            color: #FFFFFF;
        }

        .footer-bottom {
            border-top: 1px solid #1E293B;
            margin-top: 40px;
            padding-top: 25px;
        }

        /* Floating CTA Button */
        .floating-action {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1030;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .floating-btn-wa {
            width: 54px;
            height: 54px;
            border-radius: 50%;
            background: #25D366;
            color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            box-shadow: 0 10px 20px rgba(37, 211, 102, 0.4);
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .floating-btn-wa:hover {
            color: #FFFFFF;
            transform: scale(1.1);
        }

        /* Lightbox Modal */
        .modal-poster-img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .article-grid-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .article-grid-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 30px -10px rgba(15, 23, 42, 0.15) !important;
        }

        .hover-primary:hover {
            color: var(--primary-blue) !important;
        }

        /* === Animate.css Scroll Reveal & Keyframe Preservation === */
        .scroll-reveal {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.4s ease;
        }
        .scroll-reveal.animated {
            opacity: 1;
            visibility: visible;
        }
        /* Stagger delays for Hero and Sections */
        .anim-delay-1 { animation-delay: 0.12s !important; }
        .anim-delay-2 { animation-delay: 0.24s !important; }
        .anim-delay-3 { animation-delay: 0.36s !important; }
        .anim-delay-4 { animation-delay: 0.48s !important; }

        @media (prefers-reduced-motion: reduce) {
            .scroll-reveal,
            .animate__animated {
                opacity: 1 !important;
                transform: none !important;
                animation: none !important;
                transition: none !important;
            }
        }

        /* === Responsive & Humanized Layout Adjustments === */
        @media (max-width: 1199px) {
            .navbar-nav .nav-item .nav-link {
                padding: 6px 10px !important;
                font-size: 0.86rem;
            }
        }

        @media (max-width: 991px) {
            .hero-section {
                padding: 45px 0 35px 0;
            }
            .hero-title {
                font-size: 2.15rem;
                line-height: 1.22;
                margin-top: 10px;
                margin-bottom: 14px;
            }
            .hero-lead {
                font-size: 1rem;
                line-height: 1.6;
                margin-bottom: 20px;
            }
            .hero-poster-img {
                height: 320px;
                margin-top: 25px;
            }
            .countdown-bar-wrap {
                margin-top: 20px !important;
                margin-bottom: 25px !important;
            }
            .section-padding {
                padding: 55px 0;
            }
            .custom-navbar {
                padding-left: 10px !important;
                padding-right: 10px !important;
            }
            .navbar-collapse {
                background: rgba(255, 255, 255, 0.98);
                border-radius: 16px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.1);
                padding: 16px;
                margin-top: 10px;
                border: 1px solid #E2E8F0;
            }
            .navbar-cta-group {
                margin-left: 0;
                margin-top: 10px;
                padding-top: 10px;
                border-top: 1px solid #E2E8F0;
                justify-content: flex-start;
            }
            .hero-action-group .btn-brand-primary,
            .hero-action-group .btn-brand-outline {
                padding: 12px 20px;
                font-size: 0.95rem;
            }
        }

        @media (max-width: 767px) {
            body {
                padding-bottom: 74px; /* Ruang untuk mobile sticky bottom bar */
            }
            .section-padding {
                padding: 42px 0;
            }
            .section-title {
                font-size: 1.7rem !important;
            }
            .section-desc {
                font-size: 0.92rem !important;
            }
            .floating-action {
                bottom: 84px !important;
                right: 16px !important;
            }
            .countdown-card {
                padding: 18px 16px;
                border-radius: 16px;
            }
            .countdown-card h3 {
                font-size: 1.2rem !important;
            }
            .countdown-unit {
                min-width: 54px;
                padding: 6px 8px;
                border-radius: 10px;
            }
            .countdown-num {
                font-size: 1.25rem;
            }
            .milestone-card {
                padding: 14px 10px;
                border-radius: 14px;
            }
            .milestone-number {
                font-size: 1.6rem;
            }
            .hero-action-group {
                flex-direction: column;
                align-items: stretch !important;
            }
            .hero-action-group a,
            .hero-action-group button {
                width: 100%;
                text-align: center;
                justify-content: center;
            }
            .hero-sub-action {
                justify-content: flex-start;
            }
            .hero-tracker-box {
                max-width: 100% !important;
            }
            .hero-poster-img {
                height: 260px;
            }
            .alur-timeline::before {
                left: 20px;
            }
            .alur-item {
                padding-left: 56px;
            }
            .alur-badge {
                width: 42px;
                height: 42px;
                font-size: 1rem;
                border-radius: 12px;
            }
            .alur-card {
                padding: 14px 16px;
                border-radius: 14px;
            }
        }

        /* Mobile Sticky Bottom CTA Bar */
        .mobile-sticky-bottom {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-top: 1px solid #CBD5E1;
            padding: 10px 16px;
            z-index: 1035;
            box-shadow: 0 -4px 18px rgba(0, 0, 0, 0.08);
            gap: 10px;
        }

        .btn-mobile-action {
            min-height: 48px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.92rem;
            font-weight: 700;
        }

        @media (max-width: 575px) {
            .hero-title {
                font-size: 1.7rem;
            }
            .hero-lead {
                font-size: 0.92rem;
            }
            .badge-akreditasi {
                font-size: 0.72rem;
                padding: 5px 10px;
            }
            .countdown-unit {
                min-width: 50px;
                padding: 5px 6px;
            }
            .countdown-num {
                font-size: 1.15rem;
            }
            .countdown-label {
                font-size: 0.6rem;
            }
            .hero-pill-bar {
                gap: 8px;
            }
            .pill-item {
                font-size: 0.78rem;
                padding: 5px 10px;
            }
            .cta-banner {
                padding: 35px 18px;
                border-radius: 16px;
            }
            }
            .section-title {
                font-size: 1.75rem;
            }
            .cta-banner {
                padding: 40px 24px;
            }
            .floating-btn-wa {
                width: 48px;
                height: 48px;
                font-size: 1.4rem;
            }
        }
    </style>
</head>

<body>

    <!-- Announcement Bar -->
    <div class="top-bar text-center">
        <div class="container d-flex flex-wrap justify-content-between align-items-center">
            <div class="text-truncate">
                <span>✨ <strong>Penerimaan Peserta Didik Baru (SPMB) Tahun Ajaran {{ $setting->tahun_ajaran ?? '2027/2028' }} Telah Dibuka!</strong></span>
                <span class="d-none d-md-inline ml-2">| Terakreditasi {{ $setting->stat_akreditasi ?? 'A (Unggul)' }}</span>
            </div>
            <div class="d-none d-lg-flex align-items-center" style="gap: 14px;">
                @if(!empty($setting->sosmed_instagram))
                    <a href="{{ $setting->sosmed_instagram }}" target="_blank" class="text-white" title="Instagram"><i class="fab fa-instagram"></i></a>
                @endif
                @if(!empty($setting->sosmed_tiktok))
                    <a href="{{ $setting->sosmed_tiktok }}" target="_blank" class="text-white" title="TikTok"><i class="fab fa-tiktok"></i></a>
                @endif
                @if(!empty($setting->sosmed_youtube))
                    <a href="{{ $setting->sosmed_youtube }}" target="_blank" class="text-white" title="YouTube"><i class="fab fa-youtube"></i></a>
                @endif
                @if(!empty($setting->sosmed_facebook))
                    <a href="{{ $setting->sosmed_facebook }}" target="_blank" class="text-white" title="Facebook"><i class="fab fa-facebook"></i></a>
                @endif
                <a href="{{ route('siswa.daftar') }}" class="font-weight-bold ml-2 text-warning">Daftar Online &rarr;</a>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg custom-navbar sticky-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#beranda">
                <img src="{{ $setting?->logo_url ?? asset('images/icb.png') }}" alt="Logo {{ $setting->app_name ?? 'Sekolah' }}" height="36" style="object-fit: contain;">
                <div>
                    <div>{{ $setting->app_name ?? 'SMK ICB Cinta Teknika' }}</div>
                    <div class="brand-subtitle">{{ $setting->slogan ?? 'Student Today Leader Tomorrow' }}</div>
                </div>
            </a>

            <button class="navbar-toggler border-0 p-2" type="button" data-toggle="collapse" data-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars text-primary"></i>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav mx-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#jurusan">Jurusan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#panduan">Alur & Syarat</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navDropInfo" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Informasi
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow-sm border-0" aria-labelledby="navDropInfo">
                            <a class="dropdown-item" href="#brosur">
                                <i class="fas fa-file-pdf text-danger"></i> Brosur Resmi
                            </a>
                            <a class="dropdown-item" href="#mitra">
                                <i class="fas fa-handshake text-primary"></i> Mitra Industri DU/DI
                            </a>
                            <a class="dropdown-item" href="#testimoni">
                                <i class="fas fa-comment-dots text-success"></i> Testimoni Alumni
                            </a>
                            <a class="dropdown-item" href="#berita">
                                <i class="fas fa-newspaper text-info"></i> Berita & Kegiatan
                            </a>
                            <div class="dropdown-divider my-1"></div>
                            <a class="dropdown-item" href="#faq">
                                <i class="fas fa-question-circle text-warning"></i> Tanya Jawab (FAQ)
                            </a>
                        </div>
                    </li>
                </ul>

                <div class="navbar-cta-group">
                    <a href="{{ route('pendaftaran.cekStatus') }}" class="btn-nav-outline">
                        <i class="fas fa-search mr-1"></i> Cek Status
                    </a>
                    <a href="{{ route('siswa.daftar') }}" class="btn-nav-primary">
                        <i class="fas fa-paper-plane mr-1"></i> Daftar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <!-- Text Column -->
                <div class="col-lg-7">
                    <div class="badge-akreditasi mb-2 animate__animated animate__fadeInDown">
                        <i class="fas fa-award text-warning"></i>
                        <span>{{ $setting->hero_badge ?? ('TERAKREDITASI ' . ($setting->stat_akreditasi ?? 'A') . ' • SPMB ONLINE TAHUN AJARAN ' . ($setting->tahun_ajaran ?? '2027/2028') . ' • ' . ($setting->gelombang_aktif ?? 'Gelombang 1')) }}</span>
                    </div>

                    <h1 class="hero-title animate__animated animate__fadeInLeft anim-delay-1">
                        @if (!empty($setting->hero_title))
                            {!! nl2br(e($setting->hero_title)) !!}
                        @else
                            Keahlian Nyata & Karir Pasti <br>
                            <span>Dimulai Hari Ini.</span>
                        @endif
                    </h1>

                    <p class="hero-lead animate__animated animate__fadeInLeft anim-delay-2">
                        @if (!empty($setting->hero_subtitle))
                            {{ $setting->hero_subtitle }}
                        @else
                            Selamat datang calon peserta didik dan orang tua di portal resmi SPMB <strong>{{ $setting->atas_nama ?? ($setting->app_name ?? 'SMK ICB Cinta Teknika') }}</strong>. Sekolah kejuruan terakreditasi dengan kurikulum berbasis industri, fasilitas praktik lengkap, dan pendaftaran mandiri cepat tanpa ribet.
                        @endif
                    </p>

                    <!-- Main CTA Action Buttons -->
                    <div class="d-flex flex-wrap align-items-center mb-3 hero-action-group animate__animated animate__fadeInUp anim-delay-3" style="gap: 12px;">
                        @if (($setting->status_pendaftaran ?? 'buka') === 'buka')
                            <a href="{{ route('siswa.daftar') }}" class="btn-brand-primary">
                                <i class="fas fa-paper-plane mr-1"></i>
                                {{ $setting->hero_cta_text ?? 'Daftar Sekarang (Online)' }}
                            </a>
                        @else
                            <button type="button" class="btn btn-secondary py-3 px-4 font-weight-bold" style="border-radius: 12px; cursor: not-allowed;" onclick="Swal.fire('Pendaftaran Ditutup', '{{ addslashes($setting->pesan_penutupan ?? 'Pendaftaran saat ini sedang ditutup sementara.') }}', 'info')">
                                <i class="fas fa-door-closed mr-1"></i> Pendaftaran Ditutup Sementara
                            </button>
                        @endif
                        <a href="{{ route('pendaftaran.cekStatus') }}" class="btn-brand-outline">
                            <i class="fas fa-search mr-1"></i>
                            Cek Status Pendaftaran
                        </a>
                    </div>

                    <!-- Secondary Quick Actions (Pills) -->
                    <div class="d-flex flex-wrap align-items-center mb-4 hero-sub-action animate__animated animate__fadeInUp anim-delay-3" style="gap: 10px;">
                        @if (!empty($setting->video_profil_url))
                            <a href="#modalVideoProfil" data-toggle="modal" class="btn btn-sm btn-white border shadow-sm font-weight-bold py-2 px-3 text-dark" style="border-radius: 20px; font-size: 0.825rem; display: inline-flex; align-items: center; background: #ffffff;">
                                <i class="fas fa-play-circle text-danger mr-2" style="font-size: 1rem;"></i> Tonton Profil Video
                            </a>
                        @endif
                        @php
                            $waKontak = $setting->kontak_wa ?? '081222485558';
                            $waMsg = 'Halo Panitia SPMB ' . ($setting->atas_nama ?? ($setting->app_name ?? 'Sekolah')) . ', saya calon siswa/orang tua ingin konsultasi mengenai pendaftaran siswa baru.';
                        @endphp
                        <a href="{{ wa_link($waKontak, $waMsg) }}" target="_blank" class="btn btn-sm btn-white border shadow-sm font-weight-bold py-2 px-3 text-dark" style="border-radius: 20px; font-size: 0.825rem; display: inline-flex; align-items: center; background: #ffffff;">
                            <i class="fab fa-whatsapp text-success mr-2" style="font-size: 1rem;"></i> Tanya CS SPMB
                        </a>
                    </div>

                    <!-- Quick Status Tracker Box in Hero -->
                    <div class="p-3 bg-white rounded-lg shadow-sm border mb-4 hero-tracker-box animate__animated animate__fadeInUp anim-delay-3" style="border-radius: 14px; max-width: 500px;">
                        <div class="small font-weight-bold text-muted mb-2 d-flex align-items-center">
                            <i class="fas fa-search text-primary mr-2"></i> Lacak Formulir Anda Cepat:
                        </div>
                        <form action="{{ route('pendaftaran.cekStatus.post') }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="keyword" class="form-control" placeholder="Ketik Kode Pendaftaran atau NISN..." required style="border-radius: 8px 0 0 8px; font-size: 14px; min-height: 44px; border-color: #CBD5E1;">
                                <div class="input-group-append">
                                    <button class="btn btn-primary font-weight-bold px-3" type="submit" style="border-radius: 0 8px 8px 0; min-height: 44px;">
                                        Cari Status
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Highlight Badges -->
                    <div class="hero-pill-bar animate__animated animate__fadeInUp anim-delay-4">
                        <div class="pill-item">
                            <div class="pill-icon"><i class="fas fa-money-bill-wave"></i></div>
                            <div>Biaya Daftar <strong>Rp {{ number_format($setting->biaya_pendaftaran ?? 200000, 0, ',', '.') }}</strong></div>
                        </div>
                        <div class="pill-item">
                            <div class="pill-icon"><i class="fas fa-university"></i></div>
                            <div>{{ $setting->bank_name ?? 'Bank BRI' }}: <strong>{{ $setting->no_rekening ?? '210501000140303' }}</strong></div>
                        </div>
                        <div class="pill-item">
                            <div class="pill-icon"><i class="fas fa-graduation-cap"></i></div>
                            <div>{{ $jurusans->count() > 0 ? $jurusans->count() . ' Program Keahlian' : 'Kompetensi Keahlian' }}</div>
                        </div>
                        <div class="pill-item">
                            <div class="pill-icon"><i class="fas fa-user-check"></i></div>
                            <div>Reguler, Prestasi & RMP</div>
                        </div>
                    </div>
                </div>

                <!-- Image / Poster Column -->
                <div class="col-lg-5 mt-4 mt-lg-0">
                    <div class="hero-poster-card text-center animate__animated animate__fadeInRight anim-delay-2" data-toggle="modal" data-target="#modalBrosurPanduan" title="Klik untuk memperbesar brosur">
                        <img src="{{ $setting?->hero_image_url }}" alt="Poster Panduan Pendaftaran {{ $setting->atas_nama ?? ($setting->app_name ?? 'Sekolah') }}" class="hero-poster-img">
                        <div class="poster-floating-badge text-left">
                            <div>
                                <div style="font-size: 0.8rem; opacity: 0.9;">Brosur Resmi SPMB {{ $setting->tahun_ajaran ?? '2027/2028' }}</div>
                                <div style="font-weight: 800; font-size: 0.95rem;">Panduan Pendaftaran Lengkap</div>
                            </div>
                            <span class="badge badge-warning px-3 py-2" style="font-size: 0.8rem;">
                                <i class="fas fa-search-plus mr-1"></i> Perbesar
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Countdown & Social Proof Milestone Section -->
    <section class="countdown-bar-wrap">
        <div class="container">
            @if(!empty($setting->tanggal_tutup_gelombang))
                <div class="countdown-card mb-4 animate__animated animate__fadeInUp" id="countdownWrapper" data-target-date="{{ \Carbon\Carbon::parse($setting->tanggal_tutup_gelombang)->endOfDay()->toIso8601String() }}">
                    <div class="row align-items-center">
                        <div class="col-lg-6 mb-3 mb-lg-0 text-center text-lg-left">
                            <span class="badge badge-warning px-3 py-1 font-weight-bold mb-1 text-dark" style="border-radius: 20px;">
                                <i class="fas fa-stopwatch mr-1"></i> HITUNG MUNDUR PENUTUPAN
                            </span>
                            <h3 class="font-weight-bold mb-1 text-white" style="font-size: 1.45rem;">
                                {{ $setting->gelombang_aktif ?? 'Gelombang 1' }} Segera Berakhir!
                            </h3>
                            <p class="mb-0 text-white-50 small">
                                Amankan kuota jurusan pilihan Anda sebelum: <strong>{{ \Carbon\Carbon::parse($setting->tanggal_tutup_gelombang)->translatedFormat('l, d F Y') }}</strong>
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex justify-content-center justify-content-lg-end" style="gap: 10px;">
                                <div class="countdown-unit">
                                    <div class="countdown-num" id="cd-days">00</div>
                                    <div class="countdown-label">Hari</div>
                                </div>
                                <div class="countdown-unit">
                                    <div class="countdown-num" id="cd-hours">00</div>
                                    <div class="countdown-label">Jam</div>
                                </div>
                                <div class="countdown-unit">
                                    <div class="countdown-num" id="cd-minutes">00</div>
                                    <div class="countdown-label">Menit</div>
                                </div>
                                <div class="countdown-unit">
                                    <div class="countdown-num" id="cd-seconds">00</div>
                                    <div class="countdown-label">Detik</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- 4 Milestone Social Proof Cards -->
            <div class="row">
                <div class="col-lg-3 col-6 mb-3">
                    <div class="milestone-card">
                        <div class="milestone-number">{{ $setting->stat_akreditasi ?? 'A' }}</div>
                        <div class="font-weight-bold text-dark small">Status Akreditasi</div>
                        <div class="text-muted" style="font-size: 11px;">BAN-S/M Unggul Nasional</div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 mb-3">
                    <div class="milestone-card">
                        <div class="milestone-number">{{ $setting->stat_lulusan_kerja ?? '95%+' }}</div>
                        <div class="font-weight-bold text-dark small">Lulusan Terserap</div>
                        <div class="text-muted" style="font-size: 11px;">Bekerja, Wirausaha & Kuliah</div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 mb-3">
                    <div class="milestone-card">
                        <div class="milestone-number">{{ $setting->stat_mitra_industri ?? '50+' }}</div>
                        <div class="font-weight-bold text-dark small">Mitra DU / DI</div>
                        <div class="text-muted" style="font-size: 11px;">Perusahaan Magang & Kerja</div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 mb-3">
                    <div class="milestone-card">
                        <div class="milestone-number">{{ $setting->stat_ekskul_lab ?? '15+' }}</div>
                        <div class="font-weight-bold text-dark small">Fasilitas Praktik</div>
                        <div class="text-muted" style="font-size: 11px;">Lab Kejuruan Berstandar Industri</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4 Langkah Pendaftaran Section -->
    <section id="panduan" class="section-padding bg-light">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Petunjuk Pendaftaran</span>
                <h2 class="section-title">{{ $setting->panduan_title ?? '4 Langkah Mudah Pendaftaran Calon Siswa' }}</h2>
                <p class="section-desc">{{ $setting->panduan_desc ?? ('Ikuti tahapan resmi pendaftaran calon peserta didik baru ' . ($setting->app_name ?? 'SMK ICB Cinta Teknika') . ' secara berurutan dan terstruktur.') }}</p>
            </div>

            <div class="row">
                <!-- Langkah 1 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="step-card">
                        <div class="step-number step-1-num">1</div>
                        <h4>Siapkan Dokumen</h4>
                        <p class="text-muted" style="font-size: 0.9rem;">Kumpulkan berkas dasar untuk kelengkapan administrasi calon siswa:</p>
                        <ul class="step-checklist">
                            <li><i class="fas fa-check-circle"></i> <span>Ijazah SMP / Surat Keterangan Lulus (SKL) sementara</span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Kartu Keluarga (KK) & Akta Kelahiran</span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Surat Kelakuan Baik dari Sekolah Asal</span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Pas foto terbaru (format bebas, rapi)</span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Piagam kejuaraan / KIP / DTKS (khusus jalur beasiswa)</span></li>
                        </ul>
                    </div>
                </div>

                <!-- Langkah 2 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="step-card">
                        <div class="step-number step-2-num">2</div>
                        <h4>Biaya & Pembayaran</h4>
                        <p class="text-muted" style="font-size: 0.9rem;">Pembayaran biaya formulir pendaftaran seleksi:</p>
                        <ul class="step-checklist">
                            <li><i class="fas fa-check-circle"></i> <span>Biaya Formulir: <strong>Rp {{ number_format($setting->biaya_pendaftaran ?? 200000, 0, ',', '.') }}</strong></span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Bisa transfer m-Banking, ATM, atau bayar langsung di sekolah</span></li>
                        </ul>

                        <div class="bank-info-box">
                            @if(isset($rekeningBanks) && $rekeningBanks->count() > 0)
                                @foreach($rekeningBanks as $rek)
                                    <div class="{{ !$loop->first ? 'mt-2 pt-2 border-top' : '' }}">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="badge badge-primary"><i class="fas fa-university mr-1"></i> {{ strtoupper($rek->nama_bank) }}</span>
                                            <button type="button" class="btn-copy-rek" onclick="copyToClipboard('{{ $rek->nomor_rekening }}')">
                                                <i class="fas fa-copy mr-1"></i> Salin Rek
                                            </button>
                                        </div>
                                        <div class="bank-rek-number" style="font-size: 1.15rem;">{{ $rek->nomor_rekening }}</div>
                                        <small class="text-muted d-block font-weight-bold">a.n. {{ $rek->atas_nama }}</small>
                                    </div>
                                @endforeach
                            @else
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="badge badge-primary"><i class="fas fa-university mr-1"></i> {{ strtoupper($setting->bank_name ?? 'BANK BRI') }}</span>
                                    <button type="button" class="btn-copy-rek" onclick="copyToClipboard('{{ $setting->no_rekening ?? '210501000140303' }}')">
                                        <i class="fas fa-copy mr-1"></i> Salin Rek
                                    </button>
                                </div>
                                <div class="bank-rek-number">{{ $setting->no_rekening ?? '210501000140303' }}</div>
                                <small class="text-muted d-block mt-1">a.n. <strong>{{ $setting->atas_nama ?? 'SMK ICB Cinta Teknika' }}</strong></small>
                            @endif
                            <small class="text-danger font-weight-bold d-block mt-2">*Simpan foto bukti transfer untuk di-upload</small>
                        </div>
                    </div>
                </div>

                <!-- Langkah 3 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="step-card">
                        <div class="step-number step-3-num">3</div>
                        <h4>Isi Formulir Online</h4>
                        <p class="text-muted" style="font-size: 0.9rem;">Pengisian mandiri tanpa perlu membuat akun berbelit:</p>
                        <ul class="step-checklist">
                            <li><i class="fas fa-check-circle"></i> <span>Klik tombol <strong>Daftar Sekarang</strong></span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Pilih jalur seleksi & jurusan impian</span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Lengkapi data diri dan kontak orang tua</span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Upload foto bukti transfer pendaftaran</span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Dapatkan <strong>Kode Pendaftaran</strong> unik Anda</span></li>
                        </ul>
                        <div class="mt-auto pt-3">
                            <a href="{{ route('siswa.daftar') }}" class="btn btn-sm btn-success btn-block font-weight-bold py-2" style="border-radius: 8px;">
                                <i class="fas fa-user-plus mr-1"></i> Buka Formulir Daftar
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Langkah 4 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="step-card">
                        <div class="step-number step-4-num">4</div>
                        <h4>Verifikasi & Seleksi</h4>
                        <p class="text-muted" style="font-size: 0.9rem;">Tahapan seleksi dan penetapan kelulusan calon murid:</p>
                        <ul class="step-checklist">
                            <li><i class="fas fa-check-circle"></i> <span>Pemeriksaan berkas oleh panitia (1x24 jam)</span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Wawancara minat bakat & tes fisik ringan</span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Pengumuman kelulusan & terbit <strong>NIS Resmi</strong></span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Daftar ulang & fitting seragam praktik</span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Mengikuti MPLS dan resmi jadi siswa</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Berita & Artikel CMS Section -->
    <section id="berita" class="section-padding bg-white border-bottom">
        <div class="container">
            <div class="section-header text-center mb-5">
                <span class="badge badge-primary px-3 py-2 text-uppercase font-weight-bold" style="letter-spacing: 0.8px; border-radius: 30px;">
                    <i class="fas fa-newspaper mr-1"></i> Berita & Artikel Terbaru
                </span>
                <h2 class="font-weight-bold text-dark mt-2" style="font-size: 2.2rem;">Kabar & Informasi Terkini SPMB</h2>
                <p class="text-muted" style="max-width: 650px; margin: 0 auto; font-size: 1.05rem;">
                    Dapatkan update terbaru mengenai jadwal tes, beasiswa prestasi, kegiatan sekolah, dan panduan pendaftaran peserta didik baru.
                </p>
            </div>

            <div class="row">
                @forelse($articles as $art)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm rounded-xl overflow-hidden article-grid-card" style="border-radius: 18px; transition: all 0.3s ease; border: 1px solid #E2E8F0 !important;">
                            <div class="position-relative overflow-hidden" style="height: 200px; background: #F1F5F9;">
                                @if($art->gambar)
                                    <img src="{{ asset('storage/' . $art->gambar) }}" alt="{{ $art->judul }}" class="w-100 h-100" style="object-fit: cover;">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-secondary" style="background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);">
                                        <i class="fas fa-newspaper fa-3x text-primary" style="opacity: 0.5;"></i>
                                    </div>
                                @endif
                                <span class="position-absolute top-0 left-0 m-3 badge badge-primary px-3 py-1 font-weight-bold shadow-sm" style="border-radius: 8px; font-size: 0.78rem;">
                                    {{ $art->kategori }}
                                </span>
                            </div>
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="text-muted mb-2 d-flex align-items-center justify-content-between" style="font-size: 0.8rem;">
                                    <span><i class="far fa-calendar-alt mr-1"></i> {{ $art->created_at->format('d M Y') }}</span>
                                    <span><i class="far fa-eye mr-1"></i> {{ number_format($art->views) }} views</span>
                                </div>
                                <h5 class="font-weight-bold mb-2">
                                    <a href="{{ route('artikel.show', $art->slug) }}" class="text-dark text-decoration-none hover-primary">
                                        {{ Str::limit($art->judul, 65) }}
                                    </a>
                                </h5>
                                <p class="text-muted mb-4" style="font-size: 0.92rem; line-height: 1.6;">
                                    {{ Str::limit(strip_tags($art->ringkasan ?: $art->konten), 110) }}
                                </p>
                                <div class="mt-auto">
                                    <a href="{{ route('artikel.show', $art->slug) }}" class="btn btn-outline-primary btn-sm font-weight-bold" style="border-radius: 8px;">
                                        Baca Selengkapnya &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4">
                        <p class="text-muted">Belum ada artikel yang dipublikasikan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Informasi & Artikel SPMB -->
    <section id="artikel-info" class="section-padding bg-light">
        <div class="container">
            <div class="row">
                <!-- Main Article Column -->
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="article-card">
                        <span class="badge badge-info px-3 py-2 mb-3" style="font-size: 0.8rem; font-weight: 700;">
                            <i class="fas fa-book-reader mr-1"></i> PANDUAN RESMI SPMB
                        </span>
                        <h2 class="font-weight-bold text-dark mb-3" style="font-size: 1.85rem; line-height: 1.3;">
                            {{ $setting->artikel_judul ?? ('Panduan Lengkap Penerimaan Calon Siswa Baru ' . ($setting->app_name ?? 'SMK ICB Cinta Teknika') . ' Tahun Ajaran ' . ($setting->tahun_ajaran ?? '2026/2027')) }}
                        </h2>

                        <div class="article-meta">
                            <span><i class="fas fa-user-shield text-primary mr-1"></i> Panitia SPMB {{ $setting->app_name ?? 'SMK ICB' }}</span>
                            <span><i class="fas fa-calendar-alt text-primary mr-1"></i> Periode TA {{ $setting->tahun_ajaran ?? '2026/2027' }}</span>
                            <span><i class="fas fa-clock text-primary mr-1"></i> Waktu Baca: 3 Menit</span>
                            <span><i class="fas fa-check-circle text-success mr-1"></i> Informasi Terverifikasi</span>
                        </div>

                        <div class="article-body">
                            @if (!empty($setting?->artikel_konten))
                                <div class="cms-custom-article mb-4 p-3 bg-light rounded border" style="font-size: 1.05rem; line-height: 1.8; color: #1E293B;">
                                    {!! nl2br(e($setting->artikel_konten)) !!}
                                </div>
                            @endif

                            <p>
                                Selamat datang di portal resmi <strong>Sistem Penerimaan Murid Baru (SPMB) {{ $setting->app_name ?? 'SMK ICB Cinta Teknika' }}</strong>. Didirikan sejak tahun 1989 dengan status akreditasi <strong>A (Unggul)</strong>, kami berkomitmen menyelenggarakan pendidikan kejuruan yang mengintegrasikan penguasaan teknologi mutakhir, kompetensi praktikal berstandar industri, serta pembinaan akhlak dan karakter kepemimpinan siswa <em>(Student Today Leader Tomorrow)</em>.
                            </p>

                            <div class="article-highlight-box">
                                <h5 class="font-weight-bold text-primary mb-2"><i class="fas fa-bullhorn mr-2"></i> Poin Penting Pendaftaran:</h5>
                                <ul class="mb-0 pl-3">
                                    <li>Pendaftaran dibuka secara <strong>Online</strong> 24 jam melalui website ini dan <strong>Offline</strong> di kampus sekolah.</li>
                                    <li>Biaya pendaftaran sebesar <strong>Rp. {{ number_format($setting->biaya_pendaftaran ?? 200000, 0, ',', '.') }},-</strong> dibayarkan via transfer ke rekening resmi {{ $setting->bank_name ?? 'Bank BRI' }} <strong>{{ $setting->no_rekening ?? '210501000140303' }}</strong> a.n. {{ $setting->atas_nama ?? 'SMK ICB Cinta Teknika' }}.</li>
                                    <li>Tersedia <strong>Jalur Reguler (Umum)</strong>, <strong>Jalur Beasiswa Prestasi</strong>, dan <strong>Jalur Kerjasama SMP</strong>.</li>
                                </ul>
                            </div>

                            <h3>1. Mekanisme Jalur Pendaftaran</h3>
                            <p>
                                Calon siswa dapat memilih salah satu jalur yang sesuai dengan kondisi dan kualifikasi:
                            </p>
                            <ul>
                                <li><strong>Jalur Reguler (Umum):</strong> Jalur terbuka bagi seluruh lulusan SMP/MTs sederajat untuk semua kompetensi keahlian.</li>
                                <li><strong>Jalur Beasiswa Prestasi:</strong> Diperuntukkan bagi calon murid yang memiliki piagam kejuaraan akademik maupun non-akademik (olahraga, seni, tahfidz) minimal tingkat kota/kabupaten.</li>
                                <li><strong>Jalur Kerjasama SMP:</strong> Jalur khusus bagi lulusan dari sekolah SMP yang telah menjalin nota kesepahaman (MoU) kemitraan dengan {{ $setting->app_name ?? 'SMK ICB Cinta Teknika' }}.</li>
                            </ul>

                            <h3>2. Petunjuk Pembayaran & Konfirmasi</h3>
                            <p>
                                Setiap calon siswa diwajibkan membayar biaya seleksi pendaftaran sebesar <strong>Rp. {{ number_format($setting->biaya_pendaftaran ?? 200000, 0, ',', '.') }},-</strong>. Pembayaran dapat dilakukan melalui transfer ATM, m-Banking, Internet Banking, atau Teller ke rekening resmi:
                            </p>
                            <div class="p-3 bg-light rounded border mb-3">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="font-weight-bold text-dark">{{ strtoupper($setting->bank_name ?? 'BANK BRI') }}</div>
                                        <div class="text-primary font-weight-bold" style="font-size: 1.3rem;">{{ $setting->no_rekening ?? '210501000140303' }}</div>
                                        <div class="text-muted font-weight-bold">a.n. {{ $setting->atas_nama ?? 'SMK ICB CINTA TEKNIKA' }}</div>
                                    </div>
                                    <div class="col-md-4 text-md-right mt-2 mt-md-0">
                                        <button class="btn btn-primary btn-sm px-3" onclick="copyToClipboard('{{ $setting->no_rekening ?? '210501000140303' }}')">
                                            <i class="fas fa-copy mr-1"></i> Salin Nomor Rekening
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <p>
                                <em>Catatan: Pastikan menyimpan foto atau tangkapan layar bukti transfer yang jelas untuk diunggah pada formulir pendaftaran.</em>
                            </p>

                            <h3>3. Tahap Seleksi & Tes Fisik Kesehatan</h3>
                            <p>
                                Setelah data pendaftaran dan pembayaran terverifikasi oleh panitia, calon murid akan dijadwalkan mengikuti:
                            </p>
                            <ol>
                                <li><strong>Tes Fisik dan Kesehatan:</strong> Pemeriksaan kesehatan umum, tinggi/berat badan, dan tes buta warna (khusus keahlian tertentu).</li>
                                <li><strong>Wawancara Minat & Bakat:</strong> Mengetahui potensi calon siswa agar jurusan yang dipilih tepat guna dan sesuai cita-cita.</li>
                            </ol>

                            <h3>4. Pengumuman Kelulusan & Pengiriman NIS</h3>
                            <p>
                                Hasil kelulusan seleksi dan penerbitan <strong>Nomor Induk Siswa (NIS)</strong> resmi akan dikirimkan langsung ke email masing-masing pendaftar dan dapat dicek statusnya melalui menu Cek Status di website ini.
                            </p>

                            <!-- Inline CTA inside article -->
                            <div class="mt-4 p-4 rounded text-center text-white" style="background: linear-gradient(135deg, #1A56DB 0%, #0B3B7B 100%);">
                                <h4 class="font-weight-bold mb-2">Sudah Memahami Panduan Pendaftaran?</h4>
                                <p class="mb-3 text-white-50">Segera daftarkan diri Anda sebelum kuota masing-masing jurusan terpenuhi!</p>
                                <a href="{{ route('siswa.daftar') }}" class="btn btn-warning font-weight-bold px-4 py-2" style="border-radius: 8px; color: #1E293B;">
                                    <i class="fas fa-paper-plane mr-1"></i> Mulai Isi Formulir Pendaftaran Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Column -->
                <div class="col-lg-4">
                    <!-- Quick Actions Card -->
                    <div class="card shadow-sm border-0 rounded-lg mb-4" style="border-radius: 18px !important;">
                        <div class="card-body p-4">
                            <h5 class="font-weight-bold text-dark mb-3"><i class="fas fa-bolt text-warning mr-2"></i> Akses Cepat Pendaftar</h5>
                            <a href="{{ route('siswa.daftar') }}" class="btn btn-primary btn-block py-2 mb-2 font-weight-bold" style="border-radius: 10px;">
                                <i class="fas fa-paper-plane mr-2"></i> Formulir Pendaftaran Online
                            </a>
                            <a href="{{ route('pendaftaran.cekStatus') }}" class="btn btn-outline-primary btn-block py-2 mb-3 font-weight-bold" style="border-radius: 10px;">
                                <i class="fas fa-search mr-2"></i> Cek Status Pendaftaran
                            </a>
                            <hr>
                            <h6 class="font-weight-bold text-muted" style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">Bantuan WhatsApp Panitia</h6>
                            @php
                                $waKontak = $setting->kontak_wa ?? '081222485558';
                            @endphp
                            <a href="{{ wa_link($waKontak, 'Halo Panitia SPMB SMK ICB Cinta Teknika, saya ingin bertanya tentang pendaftaran.') }}" target="_blank" class="btn btn-success btn-block py-2 font-weight-bold" style="border-radius: 10px; background: #25D366; border-color: #25D366;">
                                <i class="fab fa-whatsapp mr-2"></i> Chat Panitia SPMB
                            </a>
                        </div>
                    </div>

                    <!-- Brosur Thumbnail Card -->
                    <div class="card shadow-sm border-0 rounded-lg mb-4" style="border-radius: 18px !important;">
                        <div class="card-header bg-white font-weight-bold text-primary py-3">
                            <i class="fas fa-images mr-2"></i> Brosur Syarat Pendaftaran
                        </div>
                        <div class="card-body p-3 text-center">
                            <img src="{{ asset('images/spmb/syarat_pendaftaran.jpg') }}" alt="Syarat Pendaftaran" class="img-fluid rounded cursor-pointer mb-2" data-toggle="modal" data-target="#modalBrosurSyarat" style="cursor: pointer; max-height: 300px; object-fit: cover;">
                            <button class="btn btn-sm btn-outline-primary btn-block mt-2 font-weight-bold" data-toggle="modal" data-target="#modalBrosurSyarat">
                                <i class="fas fa-search-plus mr-1"></i> Buka Syarat Pendaftaran
                            </button>
                        </div>
                    </div>

                    <!-- Info Alur Card -->
                    <div class="card shadow-sm border-0 rounded-lg" style="border-radius: 18px !important;">
                        <div class="card-header bg-white font-weight-bold text-primary py-3">
                            <i class="fas fa-route mr-2"></i> Brosur Alur Pendaftaran
                        </div>
                        <div class="card-body p-3 text-center">
                            <img src="{{ asset('images/spmb/alur_pendaftaran.jpg') }}" alt="Alur Pendaftaran" class="img-fluid rounded cursor-pointer mb-2" data-toggle="modal" data-target="#modalBrosurAlur" style="cursor: pointer; max-height: 300px; object-fit: cover;">
                            <button class="btn btn-sm btn-outline-primary btn-block mt-2 font-weight-bold" data-toggle="modal" data-target="#modalBrosurAlur">
                                <i class="fas fa-search-plus mr-1"></i> Buka 9 Alur SPMB
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Alur SPMB (9 Tahap Visual) -->
    <section id="alur-spmb" class="section-padding bg-light">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Alur Seleksi</span>
                <h2 class="section-title">9 Tahapan Alur Pendaftaran SPMB</h2>
                <p class="section-desc">Pahami seluruh tahapan pendaftaran dari awal informasi hingga resmi dinyatakan sebagai siswa SMK ICB Cinta Teknika.</p>
            </div>

            <div class="alur-timeline">
                <!-- Tahap 1 -->
                <div class="alur-item">
                    <div class="alur-badge">1</div>
                    <div class="alur-card">
                        <h5><span>Cek Informasi SPMB</span> <i class="fas fa-bullhorn text-primary"></i></h5>
                        <p>Informasi pendaftaran dapat diperoleh melalui media sosial resmi, website spmb ini, layanan WhatsApp panitia, atau datang langsung ke kampus sekolah.</p>
                    </div>
                </div>

                <!-- Tahap 2 -->
                <div class="alur-item">
                    <div class="alur-badge">2</div>
                    <div class="alur-card">
                        <h5><span>Daftar Online</span> <i class="fas fa-laptop text-primary"></i></h5>
                        <p>Calon murid melakukan registrasi akun secara online dan mengisi format formulir pendaftaran dengan data yang benar, jujur, dan lengkap.</p>
                    </div>
                </div>

                <!-- Tahap 3 -->
                <div class="alur-item">
                    <div class="alur-badge">3</div>
                    <div class="alur-card">
                        <h5><span>Pembayaran Biaya Pendaftaran (Rp {{ number_format($setting->biaya_pendaftaran ?? 200000, 0, ',', '.') }})</span> <i class="fas fa-money-check-alt text-primary"></i></h5>
                        <p>Setelah mengisi formulir, lakukan transfer pembayaran pendaftaran sebesar <strong>Rp. {{ number_format($setting->biaya_pendaftaran ?? 200000, 0, ',', '.') }},-</strong> via {{ $setting->bank_name ?? 'Bank BRI' }} ke rekening <strong>{{ $setting->no_rekening ?? '210501000140303' }}</strong>. Simpan bukti transfer untuk di-upload.</p>
                    </div>
                </div>

                <!-- Tahap 4 -->
                <div class="alur-item">
                    <div class="alur-badge">4</div>
                    <div class="alur-card">
                        <h5><span>Verifikasi Data</span> <i class="fas fa-user-check text-primary"></i></h5>
                        <p>Panitia SPMB melakukan pemeriksaan administrasi dan verifikasi data pendaftaran beserta dokumen persyaratan yang telah diunggah.</p>
                    </div>
                </div>

                <!-- Tahap 5 -->
                <div class="alur-item">
                    <div class="alur-badge">5</div>
                    <div class="alur-card">
                        <h5><span>Seleksi / Tes Fisik & Wawancara</span> <i class="fas fa-notes-medical text-primary"></i></h5>
                        <p>Calon murid mengikuti tahapan Penelusuran Minat dan Bakat melalui Tes Fisik dan Kesehatan, Wawancara bakat, serta Verifikasi prestasi pendukung.</p>
                    </div>
                </div>

                <!-- Tahap 6 -->
                <div class="alur-item">
                    <div class="alur-badge">6</div>
                    <div class="alur-card">
                        <h5><span>Pengumuman Hasil Kelulusan</span> <i class="fas fa-award text-primary"></i></h5>
                        <p>Calon murid mendapatkan informasi hasil seleksi penerimaan dari panitia SPMB. Bagi yang dinyatakan <strong>DITERIMA</strong>, lanjut ke tahap daftar ulang.</p>
                    </div>
                </div>

                <!-- Tahap 7 -->
                <div class="alur-item">
                    <div class="alur-badge">7</div>
                    <div class="alur-card">
                        <h5><span>Daftar Ulang & Registrasi Resmi</span> <i class="fas fa-file-signature text-primary"></i></h5>
                        <p>Calon murid yang diterima melakukan daftar ulang, penyerahan berkas fisik, dan menyelesaikan administrasi/cicilan pertama sesuai ketentuan sekolah.</p>
                    </div>
                </div>

                <!-- Tahap 8 -->
                <div class="alur-item">
                    <div class="alur-badge">8</div>
                    <div class="alur-card">
                        <h5><span>Mengikuti Kegiatan MPLS</span> <i class="fas fa-users text-primary"></i></h5>
                        <p>Mengikuti Masa Pengenalan Lingkungan Sekolah (MPLS) untuk mengenal budaya disiplin, pengajar, teman sejawat, dan lingkungan kampus sekolah.</p>
                    </div>
                </div>

                <!-- Tahap 9 -->
                <div class="alur-item">
                    <div class="alur-badge" style="background: var(--primary-blue); color: white;"><i class="fas fa-user-graduate"></i></div>
                    <div class="alur-card" style="border: 2px solid var(--primary-blue); background: #F0FDF4;">
                        <h5 class="text-success font-weight-bold"><span>Resmi Menjadi Siswa di {{ $setting->atas_nama ?? ($setting->app_name ?? 'Sekolah') }}!</span> <i class="fas fa-check-double text-success"></i></h5>
                        <p class="text-dark font-weight-bold">Selamat! Anda resmi menjadi bagian dari keluarga besar {{ $setting->atas_nama ?? ($setting->app_name ?? 'Sekolah') }}. Siap menyongsong masa depan gemilang!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Syarat Pendaftaran Section -->
    <section id="syarat" class="section-padding">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Persyaratan Lengkap</span>
                <h2 class="section-title">Syarat Pendaftaran Calon Murid</h2>
                <p class="section-desc">Pastikan Anda telah memenuhi dan menyiapkan seluruh persyaratan di bawah ini.</p>
            </div>

            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card syarat-card h-100 border-0 shadow-sm p-4 text-center" style="border-radius: 20px; background: #F8FAFC; border: 1px solid #E2E8F0 !important;">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px; font-size: 1.5rem; font-weight: 800;">A</div>
                        <h4 class="font-weight-bold text-dark mb-2">Mengisi Formulir Online</h4>
                        <p class="text-muted" style="font-size: 0.95rem;">
                            Calon murid mengisi formulir pendaftaran melalui website resmi ini dengan data yang benar, lengkap, dan dapat dipertanggungjawabkan.
                        </p>
                        <a href="{{ route('siswa.daftar') }}" class="btn btn-outline-primary btn-sm mt-auto font-weight-bold py-2" style="border-radius: 8px;">
                            Buka Formulir Pendaftaran
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 mb-4">
                    <div class="card syarat-card h-100 border-0 shadow-sm p-4" style="border-radius: 20px; background: #F8FAFC; border: 1px solid #E2E8F0 !important;">
                        <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px; font-size: 1.5rem; font-weight: 800;">B</div>
                        <h4 class="font-weight-bold text-dark text-center mb-2">Melengkapi Dokumen</h4>
                        <p class="text-muted text-center mb-3" style="font-size: 0.9rem;">Siapkan fotokopi & file digital berkas berikut:</p>
                        <ul class="step-checklist" style="font-size: 0.88rem;">
                            @if(isset($syaratBerkas) && $syaratBerkas->count() > 0)
                                @foreach($syaratBerkas as $sb)
                                    <li>
                                        <i class="fas {{ $sb->is_required ? 'fa-check-circle text-primary' : 'fa-info-circle text-muted' }}"></i> 
                                        <span>
                                            {{ $sb->nama_berkas }}
                                            @if($sb->is_required)
                                                <strong class="text-danger small">(Wajib)</strong>
                                            @else
                                                <span class="text-muted small">(Opsional)</span>
                                            @endif
                                        </span>
                                    </li>
                                @endforeach
                            @else
                                <li><i class="fas fa-file-alt text-primary"></i> <span>FC Ijazah / SKL SMP/MTs (Wajib)</span></li>
                                <li><i class="fas fa-file-alt text-primary"></i> <span>FC Akta Kelahiran (Wajib)</span></li>
                                <li><i class="fas fa-file-alt text-primary"></i> <span>FC Kartu Keluarga (KK) (Wajib)</span></li>
                                <li><i class="fas fa-camera text-primary"></i> <span>Pas Foto 3x4 (2 Lembar)</span></li>
                                <li><i class="fas fa-award text-warning"></i> <span>Piagam/Sertifikat Prestasi/DTKS (Opsional)</span></li>
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4 mb-4">
                    <div class="card syarat-card h-100 border-0 shadow-sm p-4 text-center" style="border-radius: 20px; background: #F8FAFC; border: 1px solid #E2E8F0 !important;">
                        <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px; font-size: 1.5rem; font-weight: 800;">C</div>
                        <h4 class="font-weight-bold text-dark mb-2">Bukti Pembayaran</h4>
                        <p class="text-muted" style="font-size: 0.95rem;">
                            Membayar biaya seleksi pendaftaran sebesar <strong>Rp. {{ number_format($setting->biaya_pendaftaran ?? 200000, 0, ',', '.') }},-</strong>. Simpan bukti transfer dan unggah pada formulir saat pendaftaran atau di menu pembayaran portal siswa.
                        </p>
                        <div class="p-2 bg-white rounded border mt-auto">
                            <span class="text-primary font-weight-bold">{{ $setting->bank_name ?? 'Bank BRI' }}: {{ $setting->no_rekening ?? '210501000140303' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri Brosur Resmi (Interactive Showcase) -->
    <section id="brosur" class="section-padding bg-light">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Brosur & Materi</span>
                <h2 class="section-title">Dokumentasi & Brosur Resmi SPMB</h2>
                <p class="section-desc">Klik pada brosur di bawah ini untuk melihat dalam resolusi tinggi atau mengunduh panduan.</p>
            </div>

            <div class="row">
                <!-- Brosur 1 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="brochure-card" data-toggle="modal" data-target="#modalBrosurPanduan">
                        <img src="{{ $setting?->brosur_panduan_url }}" alt="Brosur Panduan Pendaftaran" class="brochure-thumb">
                        <div class="brochure-body">
                            <h5 class="font-weight-bold text-dark mb-1">Panduan Pendaftaran</h5>
                            <p class="text-muted small mb-2">4 Langkah Pendaftaran TA {{ $setting->tahun_ajaran ?? '2027/2028' }}</p>
                            <span class="btn btn-sm btn-outline-primary btn-block font-weight-bold">
                                <i class="fas fa-search-plus mr-1"></i> Klik untuk Perbesar
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Brosur 2 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="brochure-card" data-toggle="modal" data-target="#modalBrosurSyarat">
                        <img src="{{ $setting?->brosur_syarat_url }}" alt="Brosur Syarat Pendaftaran" class="brochure-thumb">
                        <div class="brochure-body">
                            <h5 class="font-weight-bold text-dark mb-1">Syarat Pendaftaran</h5>
                            <p class="text-muted small mb-2">Rincian Berkas & Kelengkapan Dokumen</p>
                            <span class="btn btn-sm btn-outline-primary btn-block font-weight-bold">
                                <i class="fas fa-search-plus mr-1"></i> Klik untuk Perbesar
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Brosur 3 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="brochure-card" data-toggle="modal" data-target="#modalBrosurAlur">
                        <img src="{{ $setting?->brosur_alur_url }}" alt="Brosur Alur SPMB" class="brochure-thumb">
                        <div class="brochure-body">
                            <h5 class="font-weight-bold text-dark mb-1">Alur Pendaftaran SPMB</h5>
                            <p class="text-muted small mb-2">9 Tahapan Menuju Siswa Resmi</p>
                            <span class="btn btn-sm btn-outline-primary btn-block font-weight-bold">
                                <i class="fas fa-search-plus mr-1"></i> Klik untuk Perbesar
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Program Keahlian / Jurusan -->
    <section id="jurusan" class="section-padding">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Kompetensi Keahlian</span>
                <h2 class="section-title">Pilihan Jurusan Unggulan</h2>
                <p class="section-desc">Pilih program keahlian yang sesuai dengan bakat dan impian karir masa depan Anda.</p>
            </div>

            <div class="row">
                @forelse ($jurusans ?? [] as $jurusan)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="jurusan-card">
                            <div class="jurusan-icon">
                                @if (str_contains(strtolower($jurusan->nama_jurusan), 'kendaraan'))
                                    <i class="fas fa-car-side"></i>
                                @elseif (str_contains(strtolower($jurusan->nama_jurusan), 'motor'))
                                    <i class="fas fa-motorcycle"></i>
                                @elseif (str_contains(strtolower($jurusan->nama_jurusan), 'perangkat'))
                                    <i class="fas fa-code"></i>
                                @elseif (str_contains(strtolower($jurusan->nama_jurusan), 'jaringan'))
                                    <i class="fas fa-network-wired"></i>
                                @elseif (str_contains(strtolower($jurusan->nama_jurusan), 'farmasi'))
                                    <i class="fas fa-pills"></i>
                                @elseif (str_contains(strtolower($jurusan->nama_jurusan), 'keperawatan'))
                                    <i class="fas fa-user-nurse"></i>
                                @else
                                    <i class="fas fa-graduation-cap"></i>
                                @endif
                            </div>
                            <h4 class="font-weight-bold text-dark mb-2">{{ $jurusan->nama_jurusan }}</h4>
                            <p class="text-muted" style="font-size: 0.9rem; line-height: 1.5;">
                                Menyiapkan tenaga ahli terampil, siap kerja industri, bersertifikasi keahlian, dan siap melanjutkan studi ke perguruan tinggi.
                            </p>
                            <div class="pt-3 border-top mt-3">
                                <div class="d-flex justify-content-between text-muted small mb-1">
                                    <span>SPP Bulanan:</span>
                                    <strong class="text-primary">Rp {{ number_format($jurusan->spp, 0, ',', '.') }}</strong>
                                </div>
                                <div class="d-flex justify-content-between text-muted small">
                                    <span>Biaya DSP:</span>
                                    <strong class="text-dark">Rp {{ number_format($jurusan->dsp, 0, ',', '.') }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Fallback default majors if none in DB -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="jurusan-card">
                            <div class="jurusan-icon"><i class="fas fa-code"></i></div>
                            <h4 class="font-weight-bold text-dark mb-2">Rekayasa Perangkat Lunak</h4>
                            <p class="text-muted">Software engineering, web & mobile app development, database, dan IoT.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="jurusan-card">
                            <div class="jurusan-icon"><i class="fas fa-network-wired"></i></div>
                            <h4 class="font-weight-bold text-dark mb-2">Teknik Komputer & Jaringan</h4>
                            <p class="text-muted">Infrastruktur jaringan, administrasi server, fiber optic, dan cybersecurity.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="jurusan-card">
                            <div class="jurusan-icon"><i class="fas fa-car"></i></div>
                            <h4 class="font-weight-bold text-dark mb-2">Teknik Kendaraan Ringan</h4>
                            <p class="text-muted">Perawatan & perbaikan otomotif mobil modern dan sistem injeksi terkini.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('siswa.daftar') }}" class="btn btn-primary px-4 py-2 font-weight-bold" style="border-radius: 10px;">
                    <i class="fas fa-check-circle mr-1"></i> Pilih Jurusan Anda & Daftar Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- Mitra Industri / DU-DI Section -->
    <section id="mitra" class="section-padding bg-white border-top">
        <div class="container">
            <div class="section-header text-center mb-5">
                <span class="badge badge-primary px-3 py-2 text-uppercase font-weight-bold" style="letter-spacing: 0.8px; border-radius: 30px;">
                    <i class="fas fa-handshake mr-1"></i> Sinergi Dunia Industri
                </span>
                <h2 class="font-weight-bold text-dark mt-2" style="font-size: 2.2rem;">Mitra Kerja & Penyaluran Lulusan</h2>
                <p class="text-muted" style="max-width: 650px; margin: 0 auto; font-size: 1.05rem;">
                    Bekerja sama erat dengan berbagai perusahaan nasional terkemuka untuk program magang (PKL), kurikulum berbasis industri, dan rekrutmen kerja langsung.
                </p>
            </div>

            <div class="row">
                @forelse($mitraIndustris as $mitra)
                    <div class="col-lg-2 col-md-4 col-6 mb-4">
                        <div class="mitra-card">
                            <div>
                                <i class="fas fa-building text-primary fa-2x mb-2 d-block" style="opacity: 0.85;"></i>
                                <div class="font-weight-bold text-dark small">{{ $mitra->nama_mitra }}</div>
                                @if($mitra->bidang)
                                    <div class="text-muted" style="font-size: 10px;">{{ $mitra->bidang }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">
                        <p>Mitra industri sedang dalam proses sinkronisasi.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Testimoni Alumni & Siswa Berprestasi -->
    <section id="testimoni" class="section-padding bg-light border-top">
        <div class="container">
            <div class="section-header text-center mb-5">
                <span class="badge badge-success px-3 py-2 text-uppercase font-weight-bold" style="letter-spacing: 0.8px; border-radius: 30px;">
                    <i class="fas fa-quote-left mr-1"></i> Cerita Sukses Alumni
                </span>
                <h2 class="font-weight-bold text-dark mt-2" style="font-size: 2.2rem;">Kisah Nyata Para Alumni</h2>
                <p class="text-muted" style="max-width: 650px; margin: 0 auto; font-size: 1.05rem;">
                    Dengarkan langsung pengalaman berharga para alumni yang telah membuktikan kualitas pembelajaran dan sukses berkarir di berbagai bidang.
                </p>
            </div>

            <div class="row">
                @forelse($testimonis as $testi)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="testimoni-card">
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center font-weight-bold mr-3" style="width: 48px; height: 48px; font-size: 1.2rem;">
                                    {{ strtoupper(substr($testi->nama, 0, 1)) }}
                                </div>
                                <div>
                                    <h5 class="font-weight-bold text-dark mb-0" style="font-size: 1rem;">{{ $testi->nama }}</h5>
                                    <div class="text-primary font-weight-bold" style="font-size: 0.82rem;">{{ $testi->profesi_alumni }}</div>
                                    <div class="text-muted" style="font-size: 0.75rem;">{{ $testi->tahun_lulus }} &bull; {{ $testi->jurusan }}</div>
                                </div>
                            </div>
                            <p class="text-muted mb-0" style="font-size: 0.92rem; line-height: 1.6; font-style: italic;">
                                "{{ $testi->testimoni }}"
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">
                        <p>Belum ada testimoni alumni yang dipublikasikan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- FAQ (Pertanyaan yang Sering Diajukan) -->
    <section id="faq" class="section-padding bg-white border-top">
        <div class="container">
            <div class="section-header text-center mb-5">
                <span class="badge badge-primary px-3 py-2 text-uppercase font-weight-bold" style="letter-spacing: 0.8px; border-radius: 30px;">
                    <i class="fas fa-question-circle mr-1"></i> Pusat Tanya Jawab
                </span>
                <h2 class="font-weight-bold text-dark mt-2" style="font-size: 2.2rem;">Pertanyaan yang Sering Diajukan (FAQ)</h2>
                <p class="text-muted" style="max-width: 650px; margin: 0 auto; font-size: 1.05rem;">
                    Temukan jawaban cepat untuk pertanyaan umum calon siswa dan orang tua seputar pendaftaran, berkas, dan pembiayaan.
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="accordion" id="faqAccordion">
                        @forelse($faqs as $idx => $faq)
                            <div class="card border-0 shadow-sm mb-3" style="border-radius: 14px; overflow: hidden; border: 1px solid #E2E8F0 !important;">
                                <div class="card-header bg-white p-3 border-0" id="faqHeading{{ $faq->id }}">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link {{ $idx > 0 ? 'collapsed' : '' }} text-left text-dark font-weight-bold w-100 d-flex justify-content-between align-items-center text-decoration-none" type="button" data-toggle="collapse" data-target="#faqCollapse{{ $faq->id }}" aria-expanded="{{ $idx === 0 ? 'true' : 'false' }}" aria-controls="faqCollapse{{ $faq->id }}" style="font-size: 1.05rem;">
                                            <span><i class="fas fa-question-circle text-primary mr-2"></i> {{ $faq->pertanyaan }}</span>
                                            <i class="fas fa-chevron-down text-muted"></i>
                                        </button>
                                    </h5>
                                </div>
                                <div id="faqCollapse{{ $faq->id }}" class="collapse {{ $idx === 0 ? 'show' : '' }}" aria-labelledby="faqHeading{{ $faq->id }}" data-parent="#faqAccordion">
                                    <div class="card-body pt-0 px-4 pb-4 text-muted" style="line-height: 1.7;">
                                        {!! nl2br(e($faq->jawaban)) !!}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4 text-muted">
                                <p>Belum ada pertanyaan FAQ yang dipublikasikan.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section-padding pt-0">
        <div class="container">
            <div class="cta-banner text-center text-md-left">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h2 class="font-weight-bold mb-3" style="font-size: 2.2rem;">
                            {{ $setting->cta_banner_title ?? 'Siap Menjadi Bagian dari Keluarga Besar Kami?' }}
                        </h2>
                        <p class="mb-4 text-white-50" style="font-size: 1.1rem; line-height: 1.6;">
                            {{ $setting->cta_banner_desc ?? ('Jangan lewatkan kesempatan membangun karir dan keahlian nyata bersama ' . ($setting->app_name ?? 'SMK ICB Cinta Teknika') . '. Kuota pendaftaran terbatas setiap gelombangnya.') }}
                        </p>
                        <div class="d-flex flex-wrap align-items-center gap-3">
                            <a href="{{ route('siswa.daftar') }}" class="btn btn-warning font-weight-bold px-4 py-3 mr-3 mb-2" style="border-radius: 12px; color: #0F172A; font-size: 1.05rem;">
                                <i class="fas fa-rocket mr-2"></i> Daftar Online Sekarang
                            </a>
                            @php
                                $waCta = $setting->kontak_wa ?? '081222485558';
                                $waCtaMsg = 'Halo Panitia SPMB ' . ($setting->app_name ?? 'SMK ICB') . ', saya ingin konsultasi pendaftaran.';
                            @endphp
                            <a href="{{ wa_link($waCta, $waCtaMsg) }}" target="_blank" class="btn btn-outline-light font-weight-bold px-4 py-3 mb-2" style="border-radius: 12px; font-size: 1.05rem;">
                                <i class="fab fa-whatsapp mr-2"></i> Hubungi WhatsApp Panitia
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center mt-4 mt-lg-0">
                        <div class="bg-white p-3 rounded-circle d-inline-block shadow-lg">
                            <img src="{{ $setting?->logo_url ?? asset('images/icb.png') }}" alt="{{ $setting->app_name ?? 'Logo Sekolah' }}" width="130" height="130" style="object-fit: contain;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ $setting?->logo_url ?? asset('images/icb.png') }}" alt="Logo" height="40" class="mr-2" style="object-fit: contain;">
                        <span class="font-weight-bold text-white h5 mb-0">{{ $setting->atas_nama ?? ($setting->app_name ?? 'SMK ICB Cinta Teknika') }}</span>
                    </div>
                    <p class="text-muted" style="line-height: 1.6;">
                        {{ $setting->tentang_sekolah ?? 'Sekolah Menengah Kejuruan Terakreditasi A (Unggul). Menghasilkan lulusan yang disiplin berintegritas, kompeten di bidang kejuruan modern, berkarakter luhur, dan siap bersaing di dunia global maupun melanjutkan studi.' }}
                    </p>
                    <div class="mt-3">
                        <span class="badge badge-warning text-dark font-weight-bold px-3 py-2">
                            Motto: {{ $setting->slogan ?? 'Student Today Leader Tomorrow' }}
                        </span>
                    </div>
                    <!-- Social Media Links in Footer -->
                    <div class="mt-3 d-flex align-items-center" style="gap: 12px;">
                        @if(!empty($setting->sosmed_instagram))
                            <a href="{{ $setting->sosmed_instagram }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center;"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if(!empty($setting->sosmed_tiktok))
                            <a href="{{ $setting->sosmed_tiktok }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center;"><i class="fab fa-tiktok"></i></a>
                        @endif
                        @if(!empty($setting->sosmed_youtube))
                            <a href="{{ $setting->sosmed_youtube }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center;"><i class="fab fa-youtube"></i></a>
                        @endif
                        @if(!empty($setting->sosmed_facebook))
                            <a href="{{ $setting->sosmed_facebook }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center;"><i class="fab fa-facebook"></i></a>
                        @endif
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h5 class="text-white font-weight-bold mb-3">Tautan Cepat</h5>
                    <ul class="list-unstyled" style="line-height: 2;">
                        <li><a href="#beranda">&bull; Beranda</a></li>
                        <li><a href="#panduan">&bull; 4 Langkah Pendaftaran</a></li>
                        <li><a href="#alur-spmb">&bull; 9 Tahapan Alur SPMB</a></li>
                        <li><a href="#jurusan">&bull; Pilihan Jurusan</a></li>
                        <li><a href="#mitra">&bull; Mitra Kerja & DU/DI</a></li>
                        <li><a href="#testimoni">&bull; Testimoni Alumni</a></li>
                        <li><a href="#faq">&bull; Tanya Jawab (FAQ)</a></li>
                        <li><a href="{{ route('pendaftaran.cekStatus') }}">&bull; Cek Status Pendaftaran</a></li>
                    </ul>
                </div>

                <div class="col-lg-5 col-md-6">
                    <h5 class="text-white font-weight-bold mb-3">Sekretariat SPMB</h5>
                    <p class="text-muted mb-2">
                        <i class="fas fa-map-marker-alt text-primary mr-2"></i> {{ $setting->alamat_sekolah ?? 'Bandung, Jawa Barat' }}
                    </p>
                    <p class="text-muted mb-2">
                        <i class="fas fa-university text-primary mr-2"></i> Rekening {{ $setting->bank_name ?? 'BRI' }}: <strong>{{ $setting->no_rekening ?? '210501000140303' }}</strong> (a.n. {{ $setting->atas_nama ?? ($setting->app_name ?? 'Sekolah') }})
                    </p>
                    <p class="text-muted mb-2">
                        <i class="fas fa-money-bill-wave text-primary mr-2"></i> Biaya Formulir: <strong>Rp {{ number_format($setting->biaya_pendaftaran ?? 200000, 0, ',', '.') }},-</strong>
                    </p>
                    <p class="text-muted mb-3">
                        <i class="fas fa-clock text-primary mr-2"></i> Layanan SPMB: {{ $setting->jam_pelayanan ?? 'Senin - Sabtu (08:00 - 15:00 WIB)' }}
                    </p>
                    <div>
                        <a href="{{ route('pendaftaran.cekStatus') }}" class="btn btn-outline-light btn-sm mr-2">
                            <i class="fas fa-search mr-1"></i> Cek Status Pendaftaran
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-cog mr-1"></i> Admin Login
                        </a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom text-center text-muted">
                <p class="mb-0">&copy; {{ date('Y') }} <strong>{{ $setting->atas_nama ?? ($setting->app_name ?? 'SMK ICB Cinta Teknika') }}</strong>. All rights reserved. Developed by <a href="https://kzdra.github.io/" target="_blank" rel="noopener noreferrer" class="text-white font-weight-bold" style="text-decoration: underline;">InDev</a>.</p>
            </div>
        </div>
    </footer>

    <!-- Floating Action WhatsApp -->
    @php
        $waFloating = $setting->kontak_wa ?? '081222485558';
        $waPesan = 'Halo Panitia SPMB ' . ($setting->atas_nama ?? ($setting->app_name ?? 'Sekolah')) . ', saya ingin bertanya mengenai pendaftaran siswa baru.';
    @endphp
    <div class="floating-action">
        <a href="{{ wa_link($waFloating, $waPesan) }}" target="_blank" class="floating-btn-wa" title="Konsultasi WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>

    <!-- Modals Lightbox for Brochures -->
    <!-- Modal 1: Panduan -->
    <div class="modal fade" id="modalBrosurPanduan" tabindex="-1" role="dialog" aria-labelledby="modalBrosurPanduanLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="modalBrosurPanduanLabel">
                        <i class="fas fa-book-open text-primary mr-2"></i> Brosur Panduan Pendaftaran SPMB {{ $setting->tahun_ajaran ?? '2027/2028' }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center p-3">
                    <img src="{{ $setting?->brosur_panduan_url }}" alt="Panduan Pendaftaran" class="modal-poster-img">
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="{{ $setting?->brosur_panduan_url }}" download="Brosur_Panduan_SPMB.jpg" class="btn btn-outline-primary">
                        <i class="fas fa-download mr-1"></i> Unduh Brosur
                    </a>
                    <a href="{{ route('siswa.daftar') }}" class="btn btn-primary font-weight-bold">
                        <i class="fas fa-user-plus mr-1"></i> Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 2: Syarat -->
    <div class="modal fade" id="modalBrosurSyarat" tabindex="-1" role="dialog" aria-labelledby="modalBrosurSyaratLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="modalBrosurSyaratLabel">
                        <i class="fas fa-clipboard-check text-primary mr-2"></i> Brosur Syarat Pendaftaran SPMB {{ $setting->tahun_ajaran ?? '2027/2028' }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center p-3">
                    <img src="{{ $setting?->brosur_syarat_url }}" alt="Syarat Pendaftaran" class="modal-poster-img">
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="{{ $setting?->brosur_syarat_url }}" download="Brosur_Syarat_SPMB.jpg" class="btn btn-outline-primary">
                        <i class="fas fa-download mr-1"></i> Unduh Brosur
                    </a>
                    <a href="{{ route('siswa.daftar') }}" class="btn btn-primary font-weight-bold">
                        <i class="fas fa-user-plus mr-1"></i> Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 3: Alur -->
    <div class="modal fade" id="modalBrosurAlur" tabindex="-1" role="dialog" aria-labelledby="modalBrosurAlurLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="modalBrosurAlurLabel">
                        <i class="fas fa-project-diagram text-primary mr-2"></i> Brosur 9 Alur Pendaftaran SPMB {{ $setting->tahun_ajaran ?? '2027/2028' }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center p-3">
                    <img src="{{ $setting?->brosur_alur_url }}" alt="Alur SPMB" class="modal-poster-img">
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="{{ $setting?->brosur_alur_url }}" download="Brosur_Alur_SPMB.jpg" class="btn btn-outline-primary">
                        <i class="fas fa-download mr-1"></i> Unduh Brosur
                    </a>
                    <a href="{{ route('siswa.daftar') }}" class="btn btn-primary font-weight-bold">
                        <i class="fas fa-user-plus mr-1"></i> Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 4: Video Profil Sekolah -->
    @if(!empty($setting->video_profil_url))
        @php
            $vUrl = $setting->video_profil_url;
            $ytEmbed = $vUrl;
            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $vUrl, $matches)) {
                $ytEmbed = 'https://www.youtube.com/embed/' . $matches[1] . '?rel=0&autoplay=1';
            }
        @endphp
        <div class="modal fade" id="modalVideoProfil" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content border-0 shadow-lg" style="border-radius: 14px; overflow: hidden; background: #000;">
                    <div class="modal-header text-white border-0 py-2 px-3" style="background: rgba(0,0,0,0.85);">
                        <h6 class="modal-title font-weight-bold"><i class="fas fa-play-circle text-danger mr-2"></i> Video Profil Resmi {{ $setting->atas_nama ?? ($setting->app_name ?? 'Sekolah') }}</h6>
                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="{{ $ytEmbed }}" allowfullscreen allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @vite('resources/js/app.js')
    <!-- AdminLTE & jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        /* ==========================================
           Countdown Timer Logic
        ========================================== */
        const cdWrap = document.getElementById('countdownWrapper');
        if (cdWrap) {
            const targetIso = cdWrap.getAttribute('data-target-date');
            if (targetIso) {
                const targetTime = new Date(targetIso).getTime();
                function updateCountdown() {
                    const now = new Date().getTime();
                    const diff = targetTime - now;
                    if (diff <= 0) {
                        const dEl = document.getElementById('cd-days');
                        const hEl = document.getElementById('cd-hours');
                        const mEl = document.getElementById('cd-minutes');
                        const sEl = document.getElementById('cd-seconds');
                        if (dEl) dEl.textContent = '00';
                        if (hEl) hEl.textContent = '00';
                        if (mEl) mEl.textContent = '00';
                        if (sEl) sEl.textContent = '00';
                        return;
                    }
                    const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                    const dEl = document.getElementById('cd-days');
                    const hEl = document.getElementById('cd-hours');
                    const mEl = document.getElementById('cd-minutes');
                    const sEl = document.getElementById('cd-seconds');
                    if (dEl) dEl.textContent = String(days).padStart(2, '0');
                    if (hEl) hEl.textContent = String(hours).padStart(2, '0');
                    if (mEl) mEl.textContent = String(minutes).padStart(2, '0');
                    if (sEl) sEl.textContent = String(seconds).padStart(2, '0');
                }
                updateCountdown();
                setInterval(updateCountdown, 1000);
            }
        }

        /* ==========================================
           Copy to Clipboard
        ========================================== */
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil Disalin!',
                    text: 'Nomor Rekening telah disalin ke clipboard.',
                    timer: 2000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            }, function() {
                prompt("Silakan salin nomor rekening berikut:", text);
            });
        }

        /* ==========================================
           Smooth Scroll for Anchor Links
        ========================================== */
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (!href || href === '#' || href.startsWith('#modal')) return;
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    const offset = 68; // navbar height
                    const top = target.getBoundingClientRect().top + window.pageYOffset - offset;
                    window.scrollTo({ top: top, behavior: 'smooth' });

                    // Close mobile menu if open
                    const navCollapse = document.getElementById('mainNavbar');
                    if (navCollapse && navCollapse.classList.contains('show')) {
                        navCollapse.classList.remove('show');
                    }
                }
            });
        });

        /* ==========================================
           Navbar: Active Link Highlight on Scroll
           + Shadow when scrolled
        ========================================== */
        const sections = document.querySelectorAll('section[id], div[id].section-anchor');
        const navLinks = document.querySelectorAll('#mainNavbar .nav-link');
        const navbar   = document.getElementById('mainNav');

        window.addEventListener('scroll', () => {
            const scrollY = window.pageYOffset;

            // Add shadow when scrolled
            if (scrollY > 20) {
                navbar.style.boxShadow = '0 4px 20px rgba(0,0,0,0.08)';
            } else {
                navbar.style.boxShadow = 'none';
            }

            // Highlight active section
            let currentId = '';
            sections.forEach(section => {
                const top = section.offsetTop - 100;
                if (scrollY >= top) {
                    currentId = section.getAttribute('id');
                }
            });
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + currentId) {
                    link.classList.add('active');
                }
            });
        });

        /* ==========================================
           Animate.css Scroll Reveal (IntersectionObserver)
        ========================================== */
        const animateSelectors = [
            { sel: '.section-header',     anim: 'animate__fadeInDown', delay: 0   },
            { sel: '.step-card',          anim: 'animate__fadeInUp',   delay: 80  },
            { sel: '.syarat-card',        anim: 'animate__fadeInUp',   delay: 100 },
            { sel: '.alur-item',          anim: 'animate__fadeInLeft', delay: 60  },
            { sel: '.jurusan-card',       anim: 'animate__fadeInUp',   delay: 80  },
            { sel: '.brochure-card',      anim: 'animate__zoomIn',     delay: 80  },
            { sel: '.article-grid-card',  anim: 'animate__fadeInUp',   delay: 80  },
            { sel: '.milestone-card',     anim: 'animate__fadeInUp',   delay: 60  },
            { sel: '.mitra-card',         anim: 'animate__fadeInUp',   delay: 40  },
            { sel: '.testimoni-card',     anim: 'animate__fadeInUp',   delay: 80  },
            { sel: '.faq-card',           anim: 'animate__fadeInUp',   delay: 60  },
            { sel: '.cta-banner',         anim: 'animate__fadeInUp',   delay: 0   },
        ];

        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        if (!prefersReducedMotion && 'IntersectionObserver' in window) {
            animateSelectors.forEach(({ sel, anim, delay }) => {
                const els = document.querySelectorAll(sel);
                els.forEach((el, i) => {
                    el.classList.add('scroll-reveal');

                    const observer = new IntersectionObserver((entries, obs) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                const target = entry.target;
                                const stagger = delay * (i % 4);
                                target.style.animationDelay = stagger + 'ms';
                                target.style.animationDuration = '0.65s';
                                target.classList.remove('scroll-reveal');
                                target.classList.add('animate__animated', anim);
                                obs.unobserve(target);
                            }
                        });
                    }, { threshold: 0.08, rootMargin: '0px 0px -20px 0px' });

                    observer.observe(el);
                });
            });
        }
    </script>
    <!-- Mobile Sticky Bottom CTA Bar -->
    <div class="mobile-sticky-bottom d-flex d-md-none">
        <a href="{{ route('pendaftaran.cekStatus') }}" class="btn btn-outline-primary btn-mobile-action">
            <i class="fas fa-search mr-1"></i> Cek Status
        </a>
        <a href="{{ route('siswa.daftar') }}" class="btn btn-primary btn-mobile-action flex-grow-1 font-weight-bold shadow-sm">
            <i class="fas fa-paper-plane mr-1"></i> Daftar SPMB Online
        </a>
    </div>

</body>

</html>
