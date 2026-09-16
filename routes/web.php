<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MJurusanController;
use App\Http\Controllers\PengaturanAplikasiController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\VerifikasiPembayaranController;
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
    return view('landing', compact('jurusans', 'articles', 'setting'));
})->name('landing');

// Public Article Detail
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('artikel.show');

// Public Status Pendaftaran
Route::get('/cek-status', [SiswaController::class, 'cekStatusPage'])->name('pendaftaran.cekStatus');
Route::post('/cek-status', [SiswaController::class, 'cekStatusPost'])->name('pendaftaran.cekStatus.post');

// Public Pendaftaran Sukses / Tanda Terima
Route::get('/pendaftaran/sukses', [SiswaController::class, 'pendaftaranSukses'])->name('pendaftaran.sukses');

// Pendaftaran Siswa Baru (tanpa portal/login)
Route::prefix('siswa')->group(function () {
    Route::get('/register', [SiswaController::class, 'registerPage'])->name('siswa.daftar');
    Route::post('/register', [SiswaController::class, 'register'])->name('siswa.daftar.post');
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
        //Verif Pembayaran (Legacy / Direct Route)
        Route::get('verifbayar', fn() => redirect()->route('verifSiswa.index'))->name('verifPembayaran.index');
        Route::post('verifbayar/upload', [VerifikasiPembayaranController::class, 'inputBukti'])->name('verifPembayaran.inputBukti');
        Route::post('verifbayar/accept', [VerifikasiPembayaranController::class, 'approveStatus'])->name('verifPembayaran.approveStatus');
        Route::post('verifbayar/reject', [VerifikasiPembayaranController::class, 'notApproveStatus'])->name('verifPembayaran.notApproveStatus');
        Route::delete('verifbayar/{id}', [VerifikasiPembayaranController::class, 'inputUlang'])->name('verifPembayaran.inputUlang');

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
        // CMS Artikel
        Route::resource('articles', ArticleController::class);
    });
});
