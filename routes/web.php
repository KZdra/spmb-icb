<?php

use App\Http\Controllers\BuktiPembayaranController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::prefix('siswa')->group(function () {
    Route::get('/register', [SiswaController::class, 'registerPage'])->name('siswa.daftar');
    Route::post('/register', [SiswaController::class, 'register'])->name('siswa.daftar.post');
    Route::get('/login', function () {
        return view('masuk');
    })->name('siswa.masuk');
    Route::post('/login', [SiswaController::class, 'login'])->name('siswa.masuk.post');
    Route::post('/logout', [SiswaController::class, 'logout'])->name('siswa.logout');
    Route::middleware(['auth:siswa', 'siswa'])->group(function () {
        Route::get('/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
        Route::get('/datadiri', [SiswaController::class, 'dataDiri'])->name('siswa.datadiri');
        Route::put('/datadiri/update', [SiswaController::class, 'updateData'])->name('siswa.data.update');
        Route::post('/datadiri/update2', [SiswaController::class, 'upsertDataTambahan'])->name('siswa.data.upsertDataTambahan');
        Route::get('/pembayaran', [BuktiPembayaranController::class, 'index'])->name('siswa.pembayaran.index');
        Route::post('/pembayaran', [BuktiPembayaranController::class, 'store'])->name('siswa.pembayaran.store');
        Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('siswa.pendaftaran.index');
    });
});

Auth::routes([
    'register' => false,
]);
Route::prefix('admin')->middleware('auth:web')->group(function () {
    Route::middleware('auth:web')->group(function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::view('about', 'about')->name('about');
        //
        Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        //
        Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
        Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    });
});
