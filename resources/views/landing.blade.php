<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SPMB {{ $setting->app_name ?? 'SMK ICB Cinta Teknika' }} - Pendaftaran Siswa Baru {{ $setting->tahun_ajaran ?? '2027/2028' }}</title>

    <meta name="description"
        content="Penerimaan Peserta Didik Baru (SPMB) SMK ICB Cinta Teknika Tahun Ajaran {{ $setting->tahun_ajaran ?? '2027/2028' }}. Terakreditasi A (Unggul). Siap Kerja, Siap Kuliah, Siap Berprestasi.">
    <meta name="keywords" content="SPMB, PPDB, SMK ICB Cinta Teknika, SMK ICB, Bandung, Pendaftaran Siswa Baru">

    @include('sweetalert::alert')

    <!-- Google Fonts: Plus Jakarta Sans & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

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
            --accent-gold: #F59E0B;
            --accent-gold-dark: #D97706;
            --accent-amber: #FEF3C7;
            --success-green: #10B981;
            --dark-slate: #0F172A;
            --muted-slate: #64748B;
            --border-color: #E2E8F0;
            --bg-light: #F8FAFC;
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
            background: linear-gradient(90deg, #0B3B7B 0%, #1A56DB 50%, #0B3B7B 100%);
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
            padding: 6px 11px !important;
            border-radius: 7px;
            transition: all 0.2s ease;
            font-size: 0.875rem;
            white-space: nowrap;
        }

        .navbar-nav .nav-item .nav-link:hover,
        .navbar-nav .nav-item .nav-link.active {
            color: var(--primary-blue) !important;
            background-color: var(--primary-light);
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
            background: linear-gradient(135deg, #0B3B7B 0%, #1A56DB 100%);
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
            background: linear-gradient(135deg, #1A56DB 0%, #0B3B7B 100%);
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
            background: linear-gradient(90deg, #1A56DB, #F59E0B);
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
            background: linear-gradient(135deg, #0B3B7B 0%, #1A56DB 100%);
            border-radius: 24px;
            padding: 60px 40px;
            color: #FFFFFF;
            position: relative;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(11, 59, 123, 0.35);
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

        /* === Animate.css Scroll Reveal === */
        .scroll-reveal {
            opacity: 0;
        }
        .scroll-reveal.animated {
            opacity: 1;
        }
        /* Override animate.css fill-mode so element stays visible */
        .animate__animated {
            animation-fill-mode: both;
        }
        /* Stagger delays */
        .anim-delay-1 { animation-delay: 0.05s !important; }
        .anim-delay-2 { animation-delay: 0.15s !important; }
        .anim-delay-3 { animation-delay: 0.25s !important; }
        .anim-delay-4 { animation-delay: 0.35s !important; }

        /* === Responsive Fixes === */
        @media (max-width: 1199px) {
            .navbar-nav .nav-item .nav-link {
                padding: 6px 9px !important;
                font-size: 0.84rem;
            }
        }

        @media (max-width: 991px) {
            .hero-title {
                font-size: 2rem;
            }
            .hero-lead {
                font-size: 1rem;
            }
            .hero-poster-img {
                height: 300px;
                margin-top: 30px;
            }
            .hero-section {
                padding: 50px 0 40px;
            }
            .section-padding {
                padding: 55px 0;
            }
            .custom-navbar {
                padding-left: 8px !important;
                padding-right: 8px !important;
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
        }

        @media (max-width: 575px) {
            .hero-title {
                font-size: 1.75rem;
            }
            .hero-pill-bar {
                gap: 10px;
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
                bottom: 20px;
                right: 20px;
            }
        }
    </style>
</head>

<body>

    <!-- Announcement Bar -->
    <div class="top-bar text-center">
        <div class="container">
            <span>✨ <strong>Penerimaan Peserta Didik Baru (SPMB) Tahun Ajaran {{ $setting->tahun_ajaran ?? '2027/2028' }} Telah Dibuka!</strong> Terakreditasi A (Unggul).</span>
            <span class="d-none d-md-inline ms-3">| Biaya Pendaftaran Rp {{ number_format($setting->biaya_pendaftaran ?? 200000, 0, ',', '.') }} ({{ $setting->bank_name ?? 'Bank BRI' }}: {{ $setting->no_rekening ?? '210501000140303' }})</span>
            <a href="{{ route('siswa.daftar') }}" class="ml-2 font-weight-bold">Daftar Online &rarr;</a>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg custom-navbar sticky-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#beranda">
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

            <button class="navbar-toggler border-0 p-2" type="button" data-toggle="collapse" data-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars text-primary"></i>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav mx-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#berita">Berita</a></li>
                    <li class="nav-item"><a class="nav-link" href="#panduan">Langkah Daftar</a></li>
                    <li class="nav-item"><a class="nav-link" href="#alur-spmb">Alur SPMB</a></li>
                    <li class="nav-item"><a class="nav-link" href="#brosur">Brosur</a></li>
                    <li class="nav-item"><a class="nav-link" href="#jurusan">Jurusan</a></li>
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
                    <div class="badge-akreditasi mb-2">
                        <i class="fas fa-award text-warning"></i>
                        <span>TERAKREDITASI A (UNGGUL) &bull; TAHUN AJARAN {{ $setting->tahun_ajaran ?? '2026/2027' }}</span>
                    </div>

                    <h1 class="hero-title">
                        Masa Depan Hebat <br>
                        <span>Dimulai dari Sini!</span>
                    </h1>

                    <p class="hero-lead">
                        Bergabunglah bersama <strong>{{ $setting->app_name ?? 'SMK ICB Cinta Teknika' }}</strong>. Sekolah kejuruan modern yang mencetak lulusan berkarakter, kompeten di bidang teknologi, siap kerja, siap kuliah, dan siap berprestasi di tingkat nasional & internasional.
                    </p>

                    <div class="d-flex flex-wrap align-items-center mb-3" style="gap: 12px;">
                        <a href="{{ route('siswa.daftar') }}" class="btn-brand-primary">
                            <i class="fas fa-paper-plane"></i>
                            Daftar Sekarang (Online)
                        </a>
                        <a href="{{ route('pendaftaran.cekStatus') }}" class="btn-brand-outline">
                            <i class="fas fa-search"></i>
                            Cek Status Pendaftaran
                        </a>
                        @php
                            $waKontak = $setting->kontak_wa ?? '081222485558';
                        @endphp
                        <a href="{{ wa_link($waKontak, 'Halo Panitia SPMB SMK ICB Cinta Teknika, saya ingin berkonsultasi mengenai pendaftaran siswa baru.') }}" target="_blank" class="btn btn-outline-success font-weight-bold py-3 px-3" style="border-radius: 12px;">
                            <i class="fab fa-whatsapp text-success mr-1"></i> Tanya Panitia
                        </a>
                    </div>

                    <!-- Quick Status Tracker Box in Hero -->
                    <div class="p-3 bg-white rounded-lg shadow-sm border mt-3" style="border-radius: 14px; max-width: 540px;">
                        <form action="{{ route('pendaftaran.cekStatus.post') }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="keyword" class="form-control border-primary" placeholder="Cek Status: Masukkan Kode Pendaftaran / NISN..." required style="border-radius: 8px 0 0 8px; font-size: 0.9rem;">
                                <div class="input-group-append">
                                    <button class="btn btn-primary font-weight-bold px-3" type="submit" style="border-radius: 0 8px 8px 0;">
                                        <i class="fas fa-search mr-1"></i> Periksa
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Highlight Badges -->
                    <div class="hero-pill-bar">
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
                            <div>6 Program Keahlian</div>
                        </div>
                        <div class="pill-item">
                            <div class="pill-icon"><i class="fas fa-user-check"></i></div>
                            <div>Reguler, Prestasi & Kemitraan</div>
                        </div>
                    </div>
                </div>

                <!-- Image / Poster Column -->
                <div class="col-lg-5 mt-4 mt-lg-0">
                    <div class="hero-poster-card text-center" data-toggle="modal" data-target="#modalBrosurPanduan" title="Klik untuk memperbesar brosur">
                        <img src="{{ asset('images/spmb/panduan_pendaftaran.jpg') }}" alt="Poster Panduan Pendaftaran SMK ICB Cinta Teknika" class="hero-poster-img">
                        <div class="poster-floating-badge text-left">
                            <div>
                                <div style="font-size: 0.8rem; opacity: 0.9;">Brosur Resmi SPMB 2027/2028</div>
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

    <!-- 4 Langkah Pendaftaran Section -->
    <section id="panduan" class="section-padding bg-light">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Petunjuk Pendaftaran</span>
                <h2 class="section-title">4 Langkah Mudah Pendaftaran Calon Siswa</h2>
                <p class="section-desc">Ikuti tahapan resmi pendaftaran calon peserta didik baru SMK ICB Cinta Teknika secara berurutan dan terstruktur.</p>
            </div>

            <div class="row">
                <!-- Langkah 1 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="step-card">
                        <div class="step-number step-1-num">1</div>
                        <h4>Siapkan Dokumen</h4>
                        <p class="text-muted" style="font-size: 0.9rem;">Siapkan seluruh berkas fisik maupun file scan berikut:</p>
                        <ul class="step-checklist">
                            <li><i class="fas fa-check-circle"></i> <span>Ijazah SMP / Surat Keterangan Lulus (SKL)</span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Kartu Keluarga (KK)</span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Surat Kelakuan Baik dari Sekolah Asal</span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Pas foto terbaru (3x4)</span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Dokumen pendukung (Piagam Prestasi / Surat Sehat / DTKS / KIP / DTSEN)</span></li>
                        </ul>
                    </div>
                </div>

                <!-- Langkah 2 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="step-card">
                        <div class="step-number step-2-num">2</div>
                        <h4>Akses & Pembayaran</h4>
                        <p class="text-muted" style="font-size: 0.9rem;">Lakukan pembayaran biaya pendaftaran seleksi:</p>
                        <ul class="step-checklist">
                            <li><i class="fas fa-check-circle"></i> <span>Biaya Pendaftaran: <strong>Rp {{ number_format($setting->biaya_pendaftaran ?? 200000, 0, ',', '.') }}</strong></span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Dapat transfer mandiri atau bayar tunai di sekolah</span></li>
                        </ul>

                        <div class="bank-info-box">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="badge badge-primary"><i class="fas fa-university mr-1"></i> {{ strtoupper($setting->bank_name ?? 'BANK BRI') }}</span>
                                <button type="button" class="btn-copy-rek" onclick="copyToClipboard('{{ $setting->no_rekening ?? '210501000140303' }}')">
                                    <i class="fas fa-copy mr-1"></i> Salin Rek
                                </button>
                            </div>
                            <div class="bank-rek-number">{{ $setting->no_rekening ?? '210501000140303' }}</div>
                            <small class="text-muted d-block mt-1">a.n. <strong>{{ $setting->atas_nama ?? 'SMK ICB Cinta Teknika' }}</strong></small>
                            <small class="text-danger font-weight-bold d-block mt-1">*Simpan bukti pembayaran untuk di-upload</small>
                        </div>
                    </div>
                </div>

                <!-- Langkah 3 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="step-card">
                        <div class="step-number step-3-num">3</div>
                        <h4>Isi Formulir Online</h4>
                        <p class="text-muted" style="font-size: 0.9rem;">Registrasi akun & isi data diri di website:</p>
                        <ul class="step-checklist">
                            <li><i class="fas fa-check-circle"></i> <span>Klik menu <strong>Daftar</strong> & lengkapi biodata</span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Pilih Jalur (Reguler / RMP) & Jurusan</span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Upload foto bukti transfer pendaftaran</span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Kirim formulir pendaftaran</span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Dapatkan konfirmasi & jadwal <strong>Tes Fisik Kesehatan</strong></span></li>
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
                        <h4>Daftar Ulang</h4>
                        <p class="text-muted" style="font-size: 0.9rem;">Finalisasi kelulusan dan persiapan masuk:</p>
                        <ul class="step-checklist">
                            <li><i class="fas fa-check-circle"></i> <span>Cek pengumuman hasil seleksi di portal</span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Wajib daftar ulang sesuai jadwal yang ditentukan</span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Membawa dokumen asli & fotokopi persyaratan</span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Menyelesaikan administrasi & cicilan pertama</span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Mengikuti kegiatan MPLS & resmi jadi siswa ICB</span></li>
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
                                    {{ Str::limit($art->ringkasan, 110) }}
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
                        <h5><span>Daftar Ulang & Menjadi Keluarga ICB</span> <i class="fas fa-file-signature text-primary"></i></h5>
                        <p>Calon murid yang diterima melakukan daftar ulang, penyerahan berkas fisik, dan menyelesaikan administrasi/cicilan pertama sesuai ketentuan sekolah.</p>
                    </div>
                </div>

                <!-- Tahap 8 -->
                <div class="alur-item">
                    <div class="alur-badge">8</div>
                    <div class="alur-card">
                        <h5><span>Mengikuti Kegiatan MPLS</span> <i class="fas fa-users text-primary"></i></h5>
                        <p>Mengikuti Masa Pengenalan Lingkungan Sekolah (MPLS) untuk mengenal budaya disiplin, guru, teman sejawat, dan lingkungan kampus ICB.</p>
                    </div>
                </div>

                <!-- Tahap 9 -->
                <div class="alur-item">
                    <div class="alur-badge" style="background: var(--primary-blue); color: white;"><i class="fas fa-user-graduate"></i></div>
                    <div class="alur-card" style="border: 2px solid var(--primary-blue); background: #F0FDF4;">
                        <h5 class="text-success font-weight-bold"><span>Resmi Menjadi Siswa di SMK ICB Cinta Teknika!</span> <i class="fas fa-check-double text-success"></i></h5>
                        <p class="text-dark font-weight-bold">Selamat! Anda resmi menjadi bagian dari keluarga besar SMK ICB Cinta Teknika. Siap menyongsong masa depan gemilang!</p>
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
                    <div class="card h-100 border-0 shadow-sm p-4 text-center" style="border-radius: 20px; background: #F8FAFC; border: 1px solid #E2E8F0 !important;">
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
                    <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 20px; background: #F8FAFC; border: 1px solid #E2E8F0 !important;">
                        <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px; font-size: 1.5rem; font-weight: 800;">B</div>
                        <h4 class="font-weight-bold text-dark text-center mb-2">Melengkapi Dokumen</h4>
                        <p class="text-muted text-center mb-3" style="font-size: 0.9rem;">Siapkan fotokopi & file digital berkas berikut:</p>
                        <ul class="step-checklist" style="font-size: 0.88rem;">
                            <li><i class="fas fa-file-alt text-primary"></i> <span>FC Ijazah / SKL SMP/MTs</span></li>
                            <li><i class="fas fa-file-alt text-primary"></i> <span>FC Akta Kelahiran</span></li>
                            <li><i class="fas fa-file-alt text-primary"></i> <span>FC Kartu Keluarga (KK)</span></li>
                            <li><i class="fas fa-file-alt text-primary"></i> <span>FC KTP Orang Tua</span></li>
                            <li><i class="fas fa-file-alt text-primary"></i> <span>FC Surat Kelakuan Baik Sekolah</span></li>
                            <li><i class="fas fa-camera text-primary"></i> <span>Pas Foto 3x4 (2 Lembar)</span></li>
                            <li><i class="fas fa-award text-warning"></i> <span>Piagam/Sertifikat Prestasi/DTKS/DTSEN (Jika Ada)</span></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center" style="border-radius: 20px; background: #F8FAFC; border: 1px solid #E2E8F0 !important;">
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
                        <img src="{{ asset('images/spmb/panduan_pendaftaran.jpg') }}" alt="Brosur Panduan Pendaftaran" class="brochure-thumb">
                        <div class="brochure-body">
                            <h5 class="font-weight-bold text-dark mb-1">Panduan Pendaftaran</h5>
                            <p class="text-muted small mb-2">4 Langkah Pendaftaran TA 2027/2028</p>
                            <span class="btn btn-sm btn-outline-primary btn-block font-weight-bold">
                                <i class="fas fa-search-plus mr-1"></i> Klik untuk Perbesar
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Brosur 2 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="brochure-card" data-toggle="modal" data-target="#modalBrosurSyarat">
                        <img src="{{ asset('images/spmb/syarat_pendaftaran.jpg') }}" alt="Brosur Syarat Pendaftaran" class="brochure-thumb">
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
                        <img src="{{ asset('images/spmb/alur_pendaftaran.jpg') }}" alt="Brosur Alur SPMB" class="brochure-thumb">
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
                <a href="{{ route('siswa.daftar') }}" class="btn btn-primary px-4 py-2 font-weight-bold" style="border-radius: 10px; background: #1A56DB;">
                    <i class="fas fa-check-circle mr-1"></i> Pilih Jurusan Anda & Daftar Sekarang
                </a>
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
                            Bergabunglah Menjadi Bagian dari Keluarga Besar ICB!
                        </h2>
                        <p class="mb-4 text-white-50" style="font-size: 1.1rem; line-height: 1.6;">
                            Jangan lewatkan kesempatan emas membangun karir dan masa depan gemilang bersama SMK ICB Cinta Teknika. Kuota pendaftaran terbatas setiap gelombangnya.
                        </p>
                        <div class="d-flex flex-wrap align-items-center gap-3">
                            <a href="{{ route('siswa.daftar') }}" class="btn btn-warning font-weight-bold px-4 py-3 mr-3 mb-2" style="border-radius: 12px; color: #0F172A; font-size: 1.05rem;">
                                <i class="fas fa-rocket mr-2"></i> Daftar Online Sekarang
                            </a>
                            <a href="https://wa.me/6281222223333?text=Halo%20Panitia%20SPMB%20SMK%20ICB%20Cinta%20Teknika,%20saya%20ingin%20konsultasi%20pendaftaran" target="_blank" class="btn btn-outline-light font-weight-bold px-4 py-3 mb-2" style="border-radius: 12px; font-size: 1.05rem;">
                                <i class="fab fa-whatsapp mr-2"></i> Hubungi WhatsApp Panitia
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center mt-4 mt-lg-0">
                        <div class="bg-white p-3 rounded-circle d-inline-block shadow-lg">
                            <img src="{{ asset('images/icb.png') }}" alt="SMK ICB Logo" width="130" height="130">
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
                        @if ($setting?->logo_path)
                            <img src="{{ asset('storage/' . $setting->logo_path) }}" alt="Logo" height="40" class="mr-2">
                        @else
                            <img src="{{ asset('images/icb.png') }}" alt="Logo SMK ICB" height="40" class="mr-2">
                        @endif
                        <span class="font-weight-bold text-white h5 mb-0">{{ $setting->app_name ?? 'SMK ICB Cinta Teknika' }}</span>
                    </div>
                    <p class="text-muted" style="line-height: 1.6;">
                        Sekolah Menengah Kejuruan Terakreditasi A (Unggul). Menghasilkan lulusan yang disiplin berintegritas, kompeten di bidang teknologi, berkarakter luhur, dan siap bersaing di dunia global.
                    </p>
                    <div class="mt-3">
                        <span class="badge badge-warning text-dark font-weight-bold px-3 py-2">
                            Motto: Student Today Leader Tomorrow
                        </span>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h5 class="text-white font-weight-bold mb-3">Tautan Cepat</h5>
                    <ul class="list-unstyled" style="line-height: 2;">
                        <li><a href="#beranda">&bull; Beranda</a></li>
                        <li><a href="#panduan">&bull; 4 Langkah Pendaftaran</a></li>
                        <li><a href="#artikel-info">&bull; Artikel Panduan & Informasi</a></li>
                        <li><a href="#alur-spmb">&bull; 9 Tahapan Alur SPMB</a></li>
                        <li><a href="#syarat">&bull; Persyaratan Dokumen</a></li>
                        <li><a href="#jurusan">&bull; Program Keahlian</a></li>
                    </ul>
                </div>

                <div class="col-lg-5 col-md-6">
                    <h5 class="text-white font-weight-bold mb-3">Sekretariat SPMB</h5>
                    <p class="text-muted mb-2">
                        <i class="fas fa-map-marker-alt text-primary mr-2"></i> {{ $setting->alamat_sekolah ?? 'Kampus SMK ICB Cinta Teknika, Bandung, Jawa Barat' }}
                    </p>
                    <p class="text-muted mb-2">
                        <i class="fas fa-university text-primary mr-2"></i> Rekening {{ $setting->bank_name ?? 'BRI' }}: <strong>{{ $setting->no_rekening ?? '210501000140303' }}</strong> (a.n. {{ $setting->atas_nama ?? 'SMK ICB Cinta Teknika' }})
                    </p>
                    <p class="text-muted mb-2">
                        <i class="fas fa-money-bill-wave text-primary mr-2"></i> Biaya Pendaftaran: <strong>Rp {{ number_format($setting->biaya_pendaftaran ?? 200000, 0, ',', '.') }},-</strong>
                    </p>
                    <p class="text-muted mb-3">
                        <i class="fas fa-clock text-primary mr-2"></i> Layanan SPMB: Senin - Sabtu (08:00 - 15:00 WIB)
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
                <p class="mb-0">&copy; {{ date('Y') }} {{ $setting->app_name ?? 'SMK ICB Cinta Teknika' }}. All rights reserved. Developed for SPMB Portal.</p>
            </div>
        </div>
    </footer>

    <!-- Floating Action WhatsApp -->
    @php
        $waFloating = $setting->kontak_wa ?? '081222485558';
        $waPesan = 'Halo Panitia SPMB ' . ($setting->app_name ?? 'SMK ICB Cinta Teknika') . ', saya ingin bertanya mengenai pendaftaran siswa baru.';
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
                        <i class="fas fa-book-open text-primary mr-2"></i> Brosur Panduan Pendaftaran SPMB 2027/2028
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center p-3">
                    <img src="{{ asset('images/spmb/panduan_pendaftaran.jpg') }}" alt="Panduan Pendaftaran" class="modal-poster-img">
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="{{ asset('images/spmb/panduan_pendaftaran.jpg') }}" download="Panduan_Pendaftaran_SMK_ICB.jpg" class="btn btn-outline-primary">
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
                        <i class="fas fa-clipboard-check text-primary mr-2"></i> Brosur Syarat Pendaftaran SPMB 2027/2028
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center p-3">
                    <img src="{{ asset('images/spmb/syarat_pendaftaran.jpg') }}" alt="Syarat Pendaftaran" class="modal-poster-img">
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="{{ asset('images/spmb/syarat_pendaftaran.jpg') }}" download="Syarat_Pendaftaran_SMK_ICB.jpg" class="btn btn-outline-primary">
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
                        <i class="fas fa-project-diagram text-primary mr-2"></i> Brosur 9 Alur Pendaftaran SPMB 2027/2028
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center p-3">
                    <img src="{{ asset('images/spmb/alur_pendaftaran.jpg') }}" alt="Alur SPMB" class="modal-poster-img">
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="{{ asset('images/spmb/alur_pendaftaran.jpg') }}" download="Alur_Pendaftaran_SMK_ICB.jpg" class="btn btn-outline-primary">
                        <i class="fas fa-download mr-1"></i> Unduh Brosur
                    </a>
                    <a href="{{ route('siswa.daftar') }}" class="btn btn-primary font-weight-bold">
                        <i class="fas fa-user-plus mr-1"></i> Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>

    @vite('resources/js/app.js')
    <!-- AdminLTE & jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
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
                const target = document.querySelector(this.getAttribute('href'));
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
            { sel: '.section-header',    anim: 'animate__fadeInDown', delay: 0   },
            { sel: '.step-card',         anim: 'animate__fadeInUp',   delay: 100 },
            { sel: '.alur-item',         anim: 'animate__fadeInLeft', delay: 80  },
            { sel: '.jurusan-card',      anim: 'animate__fadeInUp',   delay: 100 },
            { sel: '.brochure-card',     anim: 'animate__zoomIn',     delay: 100 },
            { sel: '.article-grid-card', anim: 'animate__fadeInUp',   delay: 100 },
        ];

        animateSelectors.forEach(({ sel, anim, delay }) => {
            const els = document.querySelectorAll(sel);
            els.forEach((el, i) => {
                // Hide before viewport
                el.classList.add('scroll-reveal');

                const observer = new IntersectionObserver((entries, obs) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const el = entry.target;
                            const stagger = delay * (i % 4);
                            el.style.animationDelay = stagger + 'ms';
                            el.style.animationDuration = '0.65s';
                            el.classList.add('animate__animated', anim, 'animated');
                            obs.unobserve(el);
                        }
                    });
                }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });

                observer.observe(el);
            });
        });
    </script>
</body>

</html>
