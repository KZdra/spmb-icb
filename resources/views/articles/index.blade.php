@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold text-dark">
                    <i class="fas fa-newspaper text-primary mr-2"></i> {{ __('CMS Berita & Artikel') }}
                </h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('articles.create') }}" class="btn btn-primary font-weight-bold shadow-sm">
                    <i class="fas fa-plus-circle mr-1"></i> Buat Artikel Baru
                </a>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
            <div class="card-header bg-white py-3 border-0">
                <h5 class="card-title font-weight-bold mb-0 text-muted">
                    <i class="fas fa-list mr-1"></i> Daftar Seluruh Artikel & Berita SPMB
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th style="width: 50px;" class="text-center">#</th>
                                <th style="width: 100px;">Cover</th>
                                <th>Judul & Ringkasan</th>
                                <th>Kategori</th>
                                <th>Penulis</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Dilihat</th>
                                <th class="text-center" style="width: 170px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($articles as $key => $art)
                                <tr>
                                    <td class="text-center align-middle">{{ $articles->firstItem() + $key }}</td>
                                    <td class="align-middle">
                                        @if($art->gambar)
                                            <img src="{{ asset('storage/' . $art->gambar) }}" alt="Cover" class="rounded img-fluid" style="width: 80px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="bg-light text-muted d-flex align-items-center justify-content-center rounded" style="width: 80px; height: 50px; font-size: 0.8rem;">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <div class="font-weight-bold text-dark" style="font-size: 1.05rem;">
                                            {{ $art->judul }}
                                        </div>
                                        <small class="text-muted d-block" style="max-width: 450px;">
                                            {{ Str::limit($art->ringkasan, 100) }}
                                        </small>
                                        <small class="text-secondary">
                                            <i class="far fa-calendar-alt mr-1"></i> {{ $art->created_at->format('d M Y, H:i') }}
                                        </small>
                                    </td>
                                    <td class="align-middle">
                                        <span class="badge badge-info px-2 py-1">{{ $art->kategori }}</span>
                                    </td>
                                    <td class="align-middle text-muted font-weight-bold">
                                        {{ $art->penulis ?? 'Panitia' }}
                                    </td>
                                    <td class="align-middle text-center">
                                        @if($art->is_published)
                                            <span class="badge badge-success px-2 py-1"><i class="fas fa-check mr-1"></i> Terbit</span>
                                        @else
                                            <span class="badge badge-secondary px-2 py-1">Draft</span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center font-weight-bold text-muted">
                                        <i class="fas fa-eye mr-1"></i> {{ number_format($art->views) }}
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('artikel.show', $art->slug) }}" target="_blank" class="btn btn-sm btn-outline-info" title="Lihat Publik">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                            <a href="{{ route('articles.edit', $art->id) }}" class="btn btn-sm btn-outline-warning" title="Edit Artikel">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('articles.destroy', $art->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Artikel">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        <i class="fas fa-newspaper fa-3x mb-3 text-secondary"></i>
                                        <h6>Belum ada artikel yang dibuat.</h6>
                                        <a href="{{ route('articles.create') }}" class="btn btn-primary btn-sm mt-2">
                                            <i class="fas fa-plus mr-1"></i> Buat Artikel Sekarang
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($articles->hasPages())
                <div class="card-footer bg-white d-flex justify-content-end py-3">
                    {{ $articles->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
