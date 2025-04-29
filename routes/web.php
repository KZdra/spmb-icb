<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
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
