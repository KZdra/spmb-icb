<?php

namespace App\Http\Controllers;

use App\Models\PengaturanAplikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PengaturanAplikasiController extends Controller
{
    public function index()
    {
        $setting = PengaturanAplikasi::first();
        $counter = DB::table('nis_counters')->first();
        return view('PengaturanAplikasi.index', compact('setting', 'counter'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'app_name' => 'required|string|max:255',
            'logo_path' => 'nullable|image|max:2048',
            'bank_name' => 'nullable|string|max:100',
            'no_rekening' => 'nullable|string|max:100',
            'atas_nama' => 'nullable|string|max:255',
            'biaya_pendaftaran' => 'nullable|numeric|min:0',
            'kontak_wa' => 'nullable|string|max:50',
            'alamat_sekolah' => 'nullable|string|max:500',
            'tahun_ajaran' => 'nullable|string|max:50',
            'nis_prefix' => 'nullable|string|max:20',
            'nis_start_number' => 'nullable|integer|min:1',
            'email_notifikasi' => 'nullable|email|max:100',
            'artikel_judul' => 'nullable|string|max:255',
            'artikel_konten' => 'nullable|string',
        ]);

        $setting = PengaturanAplikasi::first() ?? new PengaturanAplikasi;

        if ($request->hasFile('logo_path')) {
            if ($setting->logo_path && Storage::disk('public')->exists($setting->logo_path)) {
                Storage::disk('public')->delete($setting->logo_path);
            }
            $path = $request->file('logo_path')->store('logos', 'public');
            $setting->logo_path = $path;
        }

        $setting->app_name = $validated['app_name'];
        $setting->bank_name = $validated['bank_name'] ?? $setting->bank_name;
        $setting->no_rekening = $validated['no_rekening'] ?? $setting->no_rekening;
        $setting->atas_nama = $validated['atas_nama'] ?? $setting->atas_nama;
        $setting->biaya_pendaftaran = $validated['biaya_pendaftaran'] ?? $setting->biaya_pendaftaran;
        $setting->kontak_wa = $validated['kontak_wa'] ?? $setting->kontak_wa;
        $setting->alamat_sekolah = $validated['alamat_sekolah'] ?? $setting->alamat_sekolah;
        $setting->tahun_ajaran = $validated['tahun_ajaran'] ?? $setting->tahun_ajaran;
        $setting->nis_prefix = $validated['nis_prefix'] ?? ($setting->nis_prefix ?? '125');
        $setting->nis_start_number = $validated['nis_start_number'] ?? ($setting->nis_start_number ?? 1);
        $setting->email_notifikasi = $validated['email_notifikasi'] ?? $setting->email_notifikasi;
        $setting->artikel_judul = $validated['artikel_judul'] ?? $setting->artikel_judul;
        $setting->artikel_konten = $validated['artikel_konten'] ?? $setting->artikel_konten;
        $setting->save();

        if ($request->filled('nis_start_number')) {
            $lastNum = max(0, (int)$request->nis_start_number - 1);
            $existing = DB::table('nis_counters')->first();
            if ($existing) {
                DB::table('nis_counters')->where('id', $existing->id)->update([
                    'last_number' => $lastNum,
                    'updated_at' => now()
                ]);
            } else {
                DB::table('nis_counters')->insert([
                    'last_number' => $lastNum,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        Cache::forget('PengaturanAplikasi');

        return response()->json(['message' => 'Pengaturan aplikasi & NIS berhasil diperbarui!']);
    }
}
