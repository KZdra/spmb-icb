@extends('layouts.app')

@section('styles')
{{-- Quill Snow Theme --}}
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
<style>
    .ql-container {
        font-family: 'Source Sans Pro', sans-serif;
        font-size: 15px;
        border-radius: 0 0 8px 8px;
        border-color: #ced4da !important;
        min-height: 340px;
    }
    .ql-toolbar {
        border-radius: 8px 8px 0 0;
        border-color: #ced4da !important;
        background: #f8fafc;
    }
    .ql-editor {
        min-height: 320px;
        line-height: 1.7;
        color: #1E293B;
    }
    .ql-editor.ql-blank::before {
        color: #94a3b8;
        font-style: normal;
    }
    /* word count badge */
    #word-count {
        font-size: 0.78rem;
        color: #64748B;
        margin-top: 6px;
        text-align: right;
    }
</style>
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold text-dark">
                    <i class="fas fa-plus-circle text-primary mr-2"></i> Tulis Artikel / Berita Baru
                </h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary font-weight-bold">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm border-0" style="border-radius: 12px;">
            <div class="card-body p-4">
                <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data" id="articleForm">
                    @csrf

                    <div class="row">
                        {{-- Left Column: Editor --}}
                        <div class="col-md-8">
                            <div class="form-group mb-3">
                                <label for="judul" class="font-weight-bold">
                                    Judul Artikel <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-lg" id="judul" name="judul"
                                    value="{{ old('judul') }}" placeholder="Masukkan judul berita / panduan..." required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="ringkasan" class="font-weight-bold">
                                    Ringkasan Singkat <small class="text-muted font-weight-normal">(Lead / Excerpt untuk kartu artikel)</small>
                                </label>
                                <textarea class="form-control" id="ringkasan" name="ringkasan" rows="2"
                                    placeholder="Ringkasan 1-2 kalimat yang tampil di halaman depan...">{{ old('ringkasan') }}</textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">
                                    Isi Konten Artikel <span class="text-danger">*</span>
                                </label>

                                {{-- Quill Editor Container --}}
                                <div id="quill-editor"></div>
                                <div id="word-count">0 kata</div>

                                {{-- Hidden textarea synced with Quill --}}
                                <textarea id="konten" name="konten" style="display:none;" required>{!! old('konten') !!}</textarea>
                            </div>
                        </div>

                        {{-- Right Column: Settings --}}
                        <div class="col-md-4">
                            <div class="card bg-light border-0 p-3 mb-3" style="border-radius: 10px;">
                                <h6 class="font-weight-bold text-dark border-bottom pb-2 mb-3">
                                    <i class="fas fa-cog mr-1 text-primary"></i> Pengaturan Publikasi
                                </h6>

                                <div class="form-group mb-3">
                                    <label for="kategori" class="font-weight-bold">
                                        Kategori <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control" id="kategori" name="kategori" required>
                                        <option value="Berita"      {{ old('kategori') == 'Berita'      ? 'selected' : '' }}>Berita</option>
                                        <option value="Panduan"     {{ old('kategori') == 'Panduan'     ? 'selected' : '' }}>Panduan Pendaftaran</option>
                                        <option value="Pengumuman"  {{ old('kategori') == 'Pengumuman'  ? 'selected' : '' }}>Pengumuman</option>
                                        <option value="Prestasi"    {{ old('kategori') == 'Prestasi'    ? 'selected' : '' }}>Prestasi</option>
                                        <option value="Tips & Info" {{ old('kategori') == 'Tips & Info' ? 'selected' : '' }}>Tips & Info</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="penulis" class="font-weight-bold">Nama Penulis</label>
                                    <input type="text" class="form-control" id="penulis" name="penulis"
                                        value="{{ old('penulis', 'Panitia SPMB') }}" placeholder="Nama penulis / humas">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="gambar" class="font-weight-bold">Gambar Cover / Thumbnail</label>
                                    <input type="file" class="form-control-file" id="gambar" name="gambar" accept="image/*">
                                    <small class="text-muted d-block mt-1">Format JPG, PNG, WEBP. Maks 2MB.</small>
                                    <img id="coverPreview" src="#" alt="Preview"
                                        class="img-fluid rounded mt-2" style="display:none; max-height:120px; object-fit:cover;">
                                </div>

                                <div class="custom-control custom-switch mb-3">
                                    <input type="checkbox" class="custom-control-input" id="is_published"
                                        name="is_published" value="1" checked>
                                    <label class="custom-control-label font-weight-bold" for="is_published">
                                        Langsung Publikasikan
                                    </label>
                                </div>

                                <hr>

                                <button type="submit" class="btn btn-primary btn-block font-weight-bold py-2 shadow-sm">
                                    <i class="fas fa-save mr-1"></i> Simpan & Terbitkan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{{-- Quill JS --}}
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<script>
    // ── Quill Init ─────────────────────────────────────
    const quill = new Quill('#quill-editor', {
        theme: 'snow',
        placeholder: 'Tuliskan isi artikel selengkapnya di sini...',
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, 4, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ color: [] }, { background: [] }],
                [{ list: 'ordered' }, { list: 'bullet' }],
                [{ indent: '-1' }, { indent: '+1' }],
                [{ align: [] }],
                ['blockquote', 'code-block'],
                ['link', 'image'],
                ['clean']
            ]
        }
    });

    // ── Load existing value (from old() on validation fail) ──
    const existingContent = document.getElementById('konten').value;
    if (existingContent) {
        quill.root.innerHTML = existingContent;
    }

    // ── Word count ─────────────────────────────────────
    function updateWordCount() {
        const text = quill.getText().trim();
        const words = text.length > 0 ? text.split(/\s+/).length : 0;
        document.getElementById('word-count').textContent = words + ' kata';
    }
    quill.on('text-change', updateWordCount);
    updateWordCount();

    // ── Sync to hidden textarea before submit ───────────
    document.getElementById('articleForm').addEventListener('submit', function (e) {
        const html = quill.root.innerHTML;
        const textarea = document.getElementById('konten');

        // Prevent submitting blank (Quill always has '<p><br></p>' for empty)
        if (quill.getText().trim().length === 0) {
            e.preventDefault();
            alert('Isi konten artikel tidak boleh kosong.');
            return;
        }

        textarea.value = html;
    });

    // ── Cover Image Preview ────────────────────────────
    document.getElementById('gambar').addEventListener('change', function () {
        const preview = document.getElementById('coverPreview');
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
@endsection
