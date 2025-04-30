<?php

use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::prefix('siswa')->group(function () {
    Route::get('/register', function () {
        return view('daftar');
    })->name('siswa.daftar');
    Route::post('/register', [SiswaController::class, 'register'])->name('siswa.daftar.post');
    Route::get('/login', function () {
        return view('masuk');
    })->name('siswa.masuk');
    Route::post('/login', [SiswaController::class, 'login'])->name('siswa.masuk.post');
});

Auth::routes();
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::view('about', 'about')->name('about');
    //
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    //
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
