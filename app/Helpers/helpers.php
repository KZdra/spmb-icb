<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('auth_user')) {
    function auth_user()
    {
        if (Auth::guard('web')->check()) {
            return Auth::guard('web')->user();
        } elseif (Auth::guard('siswa')->check()) {
            return Auth::guard('siswa')->user();
        }
        return null;
    }
}
