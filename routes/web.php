<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MJurusanController;
use App\Http\Controllers\PengaturanAplikasiController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\VerifikasiSiswaController;
use App\Models\Article;
use App\Models\MJurusan;
use App\Models\PengaturanAplikasi;
use Illuminate\Support\Facades\Route;

// Public Landing Page
Route::get('/', function () {
    $jurusans = MJurusan::all();
    $articles = Article::where('is_published', true)->latest()->take(6)->get();
    $setting = PengaturanAplikasi::first();
    $rekeningBanks = \App\Models\RekeningBank::where('is_active', true)->orderBy('urutan', 'asc')->get();
    $syaratBerkas = \App\Models\SyaratBerkas::where('is_active', true)->orderBy('urutan', 'asc')->get();
    $faqs = \App\Models\Faq::where('is_active', true)->orderBy('urutan', 'asc')->get();
    $mitraIndustris = \App\Models\MitraIndustri::where('is_active', true)->orderBy('urutan', 'asc')->get();
    $testimonis = \App\Models\Testimoni::where('is_active', true)->orderBy('urutan', 'asc')->get();

    return view('landing', compact(
        'jurusans', 'articles', 'setting', 'rekeningBanks', 'syaratBerkas', 'faqs', 'mitraIndustris', 'testimonis'
    ));
})->name('landing');

// Public Article Detail
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('artikel.show');

// Public Status Pendaftaran
Route::get('/cek-status', [SiswaController::class, 'cekStatusPage'])->name('pendaftaran.cekStatus');
Route::post('/cek-status', [SiswaController::class, 'cekStatusPost'])->name('pendaftaran.cekStatus.post');

// Public Pendaftaran Sukses / Tanda Terima
Route::get('/pendaftaran/sukses', [SiswaController::class, 'pendaftaranSukses'])->name('pendaftaran.sukses');
Route::get('/pendaftaran/tanda-terima/pdf/{kode}', [SiswaController::class, 'downloadTandaTerimaPdf'])->name('pendaftaran.tandaTerimaPdf');

// Pendaftaran Siswa Baru (tanpa portal/login)
Route::prefix('siswa')->group(function () {
    Route::get('/register', [SiswaController::class, 'registerPage'])->name('siswa.daftar');
    Route::post('/register', [SiswaController::class, 'register'])->name('siswa.daftar.post');
});

// API Wilayah Indonesia (Internal Proxy & Caching v2 - emsifa)
Route::prefix('api/wilayah')->group(function () {
    Route::get('/provinsi', [\App\Http\Controllers\WilayahController::class, 'provinces'])->name('wilayah.provinsi');
    Route::get('/kota/{provId}', [\App\Http\Controllers\WilayahController::class, 'regencies'])->name('wilayah.kota');
    Route::get('/kecamatan/{regId}', [\App\Http\Controllers\WilayahController::class, 'districts'])->where('regId', '[0-9.]+')->name('wilayah.kecamatan');
    Route::get('/kelurahan/{distId}', [\App\Http\Controllers\WilayahController::class, 'villages'])->where('distId', '[0-9.]+')->name('wilayah.kelurahan');
});

Auth::routes([
    'register' => false,
]);

Route::prefix('admin')->middleware('auth:web')->group(function () {
    Route::middleware('auth:web')->group(function () {
        //Homepageeeeee
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        //User Management Brooo
        Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::post('users', [\App\Http\Controllers\UserController::class, 'store'])->name('users.store');
        Route::put('users/{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
        Route::delete('users/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
        //Jurusan
        Route::get('jurusan', [MJurusanController::class, 'index'])->name('jurusan.index');
        Route::post('jurusan', [MJurusanController::class, 'store'])->name('jurusan.store');
        Route::put('jurusan/{id}', [MJurusanController::class, 'update'])->name('jurusan.update');
        Route::delete('jurusan/{id}', [MJurusanController::class, 'destroy'])->name('jurusan.destroy');
        //Verif Pembayaran (Redirect ke Verifikasi Satu Pintu)
        Route::get('verifbayar', fn() => redirect()->route('verifSiswa.index'))->name('verifPembayaran.index');

        //Verifikasi Terpadu (1 Pintu)
        Route::get('verifsiswa', [VerifikasiSiswaController::class, 'index'])->name('verifSiswa.index');
        Route::get('verifsiswa/export/xlsx', [VerifikasiSiswaController::class, 'exportXlsx'])->name('verifSiswa.exportXlsx');
        Route::get('verifsiswa/detail/{id}', [VerifikasiSiswaController::class, 'getDataTambahan'])->name('verifSiswa.getDataTambahan');
        Route::post('verifsiswa/accept', [VerifikasiSiswaController::class, 'approveStatus'])->name('verifSiswa.approveStatus');
        Route::post('verifsiswa/accept-all', [VerifikasiSiswaController::class, 'approveAll'])->name('verifSiswa.approveAll');
        Route::post('verifsiswa/reject', [VerifikasiSiswaController::class, 'notApproveStatus'])->name('verifSiswa.notApproveStatus');
        Route::post('verifsiswa/verif-bayar', [VerifikasiSiswaController::class, 'verifBayarDirect'])->name('verifSiswa.verifBayarDirect');
        Route::post('verifsiswa/tolak-bayar', [VerifikasiSiswaController::class, 'tolakBayarDirect'])->name('verifSiswa.tolakBayarDirect');
        //Profile Solo
        Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
        Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
        // Settings
        Route::get('settings', [PengaturanAplikasiController::class, 'index'])->name('appconfig.index');
        Route::post('settings', [PengaturanAplikasiController::class, 'store'])->name('appconfig.store');
        Route::post('settings/syarat-berkas', [PengaturanAplikasiController::class, 'storeSyaratBerkas'])->name('appconfig.syaratBerkas.store');
        Route::put('settings/syarat-berkas/{id}', [PengaturanAplikasiController::class, 'updateSyaratBerkas'])->name('appconfig.syaratBerkas.update');
        Route::post('settings/syarat-berkas/{id}/toggle', [PengaturanAplikasiController::class, 'toggleSyaratBerkas'])->name('appconfig.syaratBerkas.toggle');
        Route::delete('settings/syarat-berkas/{id}', [PengaturanAplikasiController::class, 'destroySyaratBerkas'])->name('appconfig.syaratBerkas.destroy');
        // Multi Rekening Bank
        Route::post('settings/rekening', [PengaturanAplikasiController::class, 'storeRekening'])->name('appconfig.rekening.store');
        Route::put('settings/rekening/{id}', [PengaturanAplikasiController::class, 'updateRekening'])->name('appconfig.rekening.update');
        Route::post('settings/rekening/{id}/toggle', [PengaturanAplikasiController::class, 'toggleRekening'])->name('appconfig.rekening.toggle');
        Route::delete('settings/rekening/{id}', [PengaturanAplikasiController::class, 'destroyRekening'])->name('appconfig.rekening.destroy');

        // CMS FAQ
        Route::post('settings/faq', [PengaturanAplikasiController::class, 'storeFaq'])->name('appconfig.faq.store');
        Route::put('settings/faq/{id}', [PengaturanAplikasiController::class, 'updateFaq'])->name('appconfig.faq.update');
        Route::post('settings/faq/{id}/toggle', [PengaturanAplikasiController::class, 'toggleFaq'])->name('appconfig.faq.toggle');
        Route::delete('settings/faq/{id}', [PengaturanAplikasiController::class, 'destroyFaq'])->name('appconfig.faq.destroy');

        // CMS Mitra Industri
        Route::post('settings/mitra', [PengaturanAplikasiController::class, 'storeMitra'])->name('appconfig.mitra.store');
        Route::put('settings/mitra/{id}', [PengaturanAplikasiController::class, 'updateMitra'])->name('appconfig.mitra.update');
        Route::post('settings/mitra/{id}/toggle', [PengaturanAplikasiController::class, 'toggleMitra'])->name('appconfig.mitra.toggle');
        Route::delete('settings/mitra/{id}', [PengaturanAplikasiController::class, 'destroyMitra'])->name('appconfig.mitra.destroy');

        // CMS Testimoni
        Route::post('settings/testimoni', [PengaturanAplikasiController::class, 'storeTestimoni'])->name('appconfig.testimoni.store');
        Route::put('settings/testimoni/{id}', [PengaturanAplikasiController::class, 'updateTestimoni'])->name('appconfig.testimoni.update');
        Route::post('settings/testimoni/{id}/toggle', [PengaturanAplikasiController::class, 'toggleTestimoni'])->name('appconfig.testimoni.toggle');
        Route::delete('settings/testimoni/{id}', [PengaturanAplikasiController::class, 'destroyTestimoni'])->name('appconfig.testimoni.destroy');
        // CMS Artikel
        Route::resource('articles', ArticleController::class);
    });
});
