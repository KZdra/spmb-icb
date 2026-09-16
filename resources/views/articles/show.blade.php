@extends('layouts.siswaLayout')

@section('title', $article->judul . ' - SMK ICB Cinta Teknika')

@section('content')
<div class="bg-light py-4 border-bottom">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size: 0.9rem;">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-primary"><i class="fas fa-home mr-1"></i> Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/#berita') }}" class="text-primary">Berita & Informasi</a></li>
                <li class="breadcrumb-item active text-truncate" aria-current="page" style="max-width: 400px;">{{ $article->judul }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <article class="bg-white p-4 p-md-5 rounded-xl shadow-sm" style="border-radius: 20px;">
                <div class="mb-3">
                    <span class="badge badge-primary px-3 py-2 text-uppercase font-weight-bold" style="letter-spacing: 0.5px;">
                        {{ $article->kategori }}
                    </span>
                </div>

                <h1 class="font-weight-bold text-dark mb-3" style="font-size: 2.1rem; line-height: 1.3;">
                    {{ $article->judul }}
                </h1>

                <div class="d-flex flex-wrap align-items-center text-muted mb-4 pb-3 border-bottom" style="font-size: 0.9rem;">
                    <div class="mr-4 mb-2">
                        <i class="far fa-user text-primary mr-1"></i> Oleh: <strong>{{ $article->penulis ?? 'Panitia SPMB' }}</strong>
                    </div>
                    <div class="mr-4 mb-2">
                        <i class="far fa-calendar-alt text-primary mr-1"></i> {{ $article->created_at->format('d F Y') }}
                    </div>
                    <div class="mb-2">
                        <i class="far fa-eye text-primary mr-1"></i> {{ number_format($article->views) }} kali dibaca
                    </div>
                </div>

                @if($article->gambar)
                    <div class="mb-4 rounded overflow-hidden shadow-sm" style="max-height: 420px;">
                        <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}" class="img-fluid w-100" style="object-fit: cover;">
                    </div>
                @endif

                @if($article->ringkasan)
                    <div class="lead font-weight-bold text-secondary mb-4 p-3 bg-light rounded" style="border-left: 4px solid #1A56DB;">
                        {{ $article->ringkasan }}
                    </div>
                @endif

                <div class="article-body text-dark" style="font-size: 1.05rem; line-height: 1.8;">
                    {!! nl2br(e($article->konten)) !!}
                </div>

                <!-- Bagikan Artikel -->
                <div class="mt-5 pt-4 border-top">
                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <div class="font-weight-bold text-dark mb-2 mb-md-0">
                            <i class="fas fa-share-alt mr-2 text-primary"></i> Bagikan Artikel Ini:
                        </div>
                        <div>
                            @php
                                $shareUrl = urlencode(url()->current());
                                $shareTitle = urlencode($article->judul . ' - SPMB SMK ICB Cinta Teknika');
                            @endphp
                            <a href="https://api.whatsapp.com/send?text={{ $shareTitle }}%20{{ $shareUrl }}" target="_blank" class="btn btn-success btn-sm font-weight-bold mr-1">
                                <i class="fab fa-whatsapp mr-1"></i> WhatsApp
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" class="btn btn-primary btn-sm font-weight-bold mr-1">
                                <i class="fab fa-facebook mr-1"></i> Facebook
                            </a>
                        </div>
                    </div>
                </div>
            </article>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4 mt-4 mt-lg-0">
            <!-- CTA Box Pendaftaran -->
            <div class="card border-0 text-white shadow-sm mb-4 rounded-xl text-center p-4" style="background: linear-gradient(135deg, #1E40AF 0%, #3B82F6 100%); border-radius: 20px;">
                <i class="fas fa-graduation-cap fa-3x mb-3 text-warning"></i>
                <h4 class="font-weight-bold mb-2">Pendaftaran Telah Dibuka!</h4>
                <p class="text-white-50 mb-3" style="font-size: 0.95rem;">
                    Daftarkan diri Anda sekarang sebagai calon siswa baru SMK ICB Cinta Teknika secara cepat tanpa antre.
                </p>
                <a href="{{ route('siswa.daftar') }}" class="btn btn-warning btn-block font-weight-bold text-dark py-2 shadow" style="border-radius: 10px;">
                    <i class="fas fa-paper-plane mr-1"></i> Daftar Sekarang Online
                </a>
            </div>

            <!-- Artikel Lainnya -->
            <div class="card border-0 shadow-sm rounded-xl p-4" style="border-radius: 20px;">
                <h5 class="font-weight-bold text-dark border-bottom pb-2 mb-3">
                    <i class="fas fa-newspaper text-primary mr-2"></i> Artikel & Panduan Terkait
                </h5>
                @forelse($recentArticles as $recent)
                    <div class="mb-3 pb-3 border-bottom last-border-0">
                        <span class="badge badge-light text-primary font-weight-bold mb-1" style="font-size: 0.75rem;">
                            {{ $recent->kategori }}
                        </span>
                        <h6 class="font-weight-bold mb-1">
                            <a href="{{ route('artikel.show', $recent->slug) }}" class="text-dark text-decoration-none hover-primary">
                                {{ $recent->judul }}
                            </a>
                        </h6>
                        <small class="text-muted">
                            <i class="far fa-calendar-alt mr-1"></i> {{ $recent->created_at->format('d M Y') }}
                        </small>
                    </div>
                @empty
                    <p class="text-muted mb-0" style="font-size: 0.9rem;">Belum ada artikel terkait lainnya.</p>
                @endforelse

                <div class="mt-2 text-center">
                    <a href="{{ url('/#berita') }}" class="btn btn-outline-primary btn-sm btn-block font-weight-bold">
                        Lihat Semua Artikel
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
