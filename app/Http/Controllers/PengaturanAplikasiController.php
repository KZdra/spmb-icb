<?php

namespace App\Http\Controllers;

use App\Models\PengaturanAplikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PengaturanAplikasiController extends Controller
{
   public function index()
    {
        return view('PengaturanAplikasi.index');
    }
    public function store(Request $request)
    {
        $request->validate([
            'app_name' => 'required|string|max:255',
            'logo_path' => 'nullable|image|max:2048',
        ]);

        // Get the first config, or create a new one
        $setting = PengaturanAplikasi::first() ?? new PengaturanAplikasi;

        if ($request->hasFile('logo_path')) {
            // Delete old logo if exists
            if ($setting->logo_path && Storage::disk('public')->exists($setting->logo_path)) {
                Storage::disk('public')->delete($setting->logo_path);
            }

            // Store new logo
            $path = $request->file('logo_path')->store('logos', 'public');
            $setting->logo_path = $path;
        }

        $setting->app_name = $request->app_name;
        $setting->save();

        Cache::forget('PengaturanAplikasi');

        return response()->json(['message' => 'Pengaturan berhasil diperbarui!']);
    }
}
