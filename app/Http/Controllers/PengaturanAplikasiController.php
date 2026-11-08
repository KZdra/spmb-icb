<?php

namespace App\Http\Controllers;

use App\Models\PengaturanAplikasi;
use App\Models\RekeningBank;
use App\Models\SyaratBerkas;
use App\Services\ImageService;
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
        $syaratBerkas = SyaratBerkas::orderBy('urutan', 'asc')->get();
        $rekeningBanks = RekeningBank::orderBy('urutan', 'asc')->get();

        return view('PengaturanAplikasi.index', compact('setting', 'counter', 'syaratBerkas', 'rekeningBanks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'app_name' => 'required|string|max:255',
            'logo_path' => 'nullable|image|max:3072',
            'favicon_path' => 'nullable|file|mimes:jpeg,jpg,png,ico,svg,webp|max:1024',
            'primary_color' => 'nullable|string|max:10',
            'secondary_color' => 'nullable|string|max:10',
            'accent_color' => 'nullable|string|max:10',
            'slogan' => 'nullable|string|max:255',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'bank_name' => 'nullable|string|max:100',
            'no_rekening' => 'nullable|string|max:100',
            'atas_nama' => 'nullable|string|max:255',
            'biaya_pendaftaran' => 'nullable|numeric|min:0',
            'kontak_wa' => 'nullable|string|max:50',
            'alamat_sekolah' => 'nullable|string|max:500',
            'tahun_ajaran' => 'nullable|string|max:50',
            'status_pendaftaran' => 'nullable|in:buka,tutup',
            'gelombang_aktif' => 'nullable|string|max:50',
            'pesan_penutupan' => 'nullable|string',
            'nis_prefix' => 'nullable|string|max:20',
            'nis_start_number' => 'nullable|integer|min:1',
            'email_notifikasi' => 'nullable|email|max:100',
            'wa_template_lulus' => 'nullable|string',
            'wa_template_revisi' => 'nullable|string',
            'pdf_catatan_kaki' => 'nullable|string',
            'pdf_penandatangan' => 'nullable|string|max:100',
            'artikel_judul' => 'nullable|string|max:255',
            'artikel_konten' => 'nullable|string',
        ]);

        $setting = PengaturanAplikasi::first() ?? new PengaturanAplikasi;

        // Upload & Convert Logo ke WebP untuk performa cepat
        if ($request->hasFile('logo_path')) {
            if ($setting->logo_path && Storage::disk('public')->exists($setting->logo_path)) {
                Storage::disk('public')->delete($setting->logo_path);
            }
            $setting->logo_path = ImageService::uploadAsWebp($request->file('logo_path'), 'logos', 88);
        }

        // Upload Favicon
        if ($request->hasFile('favicon_path')) {
            if ($setting->favicon_path && Storage::disk('public')->exists($setting->favicon_path)) {
                Storage::disk('public')->delete($setting->favicon_path);
            }
            $setting->favicon_path = ImageService::uploadAsWebp($request->file('favicon_path'), 'favicons', 90);
        }

        $setting->app_name = $validated['app_name'];
        $setting->primary_color = $validated['primary_color'] ?? ($setting->primary_color ?? '#1A56DB');
        $setting->secondary_color = $validated['secondary_color'] ?? ($setting->secondary_color ?? '#0B3B7B');
        $setting->accent_color = $validated['accent_color'] ?? ($setting->accent_color ?? '#10B981');
        $setting->slogan = $validated['slogan'] ?? $setting->slogan;
        $setting->hero_title = $validated['hero_title'] ?? $setting->hero_title;
        $setting->hero_subtitle = $validated['hero_subtitle'] ?? $setting->hero_subtitle;
        $setting->bank_name = $validated['bank_name'] ?? $setting->bank_name;
        $setting->no_rekening = $validated['no_rekening'] ?? $setting->no_rekening;
        $setting->atas_nama = $validated['atas_nama'] ?? $setting->atas_nama;
        $setting->biaya_pendaftaran = $validated['biaya_pendaftaran'] ?? $setting->biaya_pendaftaran;
        $setting->kontak_wa = $validated['kontak_wa'] ?? $setting->kontak_wa;
        $setting->alamat_sekolah = $validated['alamat_sekolah'] ?? $setting->alamat_sekolah;
        $setting->tahun_ajaran = $validated['tahun_ajaran'] ?? $setting->tahun_ajaran;
        $setting->status_pendaftaran = $validated['status_pendaftaran'] ?? ($setting->status_pendaftaran ?? 'buka');
        $setting->gelombang_aktif = $validated['gelombang_aktif'] ?? ($setting->gelombang_aktif ?? 'Gelombang 1');
        $setting->pesan_penutupan = $validated['pesan_penutupan'] ?? $setting->pesan_penutupan;
        $setting->nis_prefix = $validated['nis_prefix'] ?? ($setting->nis_prefix ?? '125');
        $setting->nis_start_number = $validated['nis_start_number'] ?? ($setting->nis_start_number ?? 1);
        $setting->email_notifikasi = $validated['email_notifikasi'] ?? $setting->email_notifikasi;
        $setting->wa_template_lulus = $validated['wa_template_lulus'] ?? $setting->wa_template_lulus;
        $setting->wa_template_revisi = $validated['wa_template_revisi'] ?? $setting->wa_template_revisi;
        $setting->pdf_catatan_kaki = $validated['pdf_catatan_kaki'] ?? $setting->pdf_catatan_kaki;
        $setting->pdf_penandatangan = $validated['pdf_penandatangan'] ?? $setting->pdf_penandatangan;
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

        return response()->json([
            'message' => 'Pengaturan aplikasi & branding berhasil disimpan!',
            'setting' => $setting,
            'logo_url' => $setting->logo_url,
            'favicon_url' => $setting->favicon_url,
        ]);
    }

    /**
     * Simpan Rekening Bank Baru
     */
    public function storeRekening(Request $request)
    {
        $validated = $request->validate([
            'nama_bank' => 'required|string|max:100',
            'nomor_rekening' => 'required|string|max:100',
            'atas_nama' => 'required|string|max:255',
            'petunjuk_transfer' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer',
        ]);

        $maxUrutan = RekeningBank::max('urutan') ?? 0;

        $rekening = RekeningBank::create([
            'nama_bank' => $validated['nama_bank'],
            'nomor_rekening' => $validated['nomor_rekening'],
            'atas_nama' => $validated['atas_nama'],
            'petunjuk_transfer' => $validated['petunjuk_transfer'] ?? null,
            'is_active' => true,
            'urutan' => $validated['urutan'] ?? ($maxUrutan + 1),
        ]);

        return response()->json([
            'message' => "Rekening {$rekening->nama_bank} berhasil ditambahkan!",
            'data' => $rekening
        ]);
    }

    /**
     * Update Rekening Bank
     */
    public function updateRekening(Request $request, $id)
    {
        $rekening = RekeningBank::findOrFail($id);

        $validated = $request->validate([
            'nama_bank' => 'required|string|max:100',
            'nomor_rekening' => 'required|string|max:100',
            'atas_nama' => 'required|string|max:255',
            'petunjuk_transfer' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer',
        ]);

        $rekening->update([
            'nama_bank' => $validated['nama_bank'],
            'nomor_rekening' => $validated['nomor_rekening'],
            'atas_nama' => $validated['atas_nama'],
            'petunjuk_transfer' => $validated['petunjuk_transfer'] ?? null,
            'urutan' => $validated['urutan'] ?? $rekening->urutan,
        ]);

        return response()->json([
            'message' => "Rekening {$rekening->nama_bank} berhasil diperbarui!",
            'data' => $rekening
        ]);
    }

    /**
     * Toggle Aktif / Nonaktif Rekening Bank
     */
    public function toggleRekening($id)
    {
        $rekening = RekeningBank::findOrFail($id);
        $rekening->is_active = !$rekening->is_active;
        $rekening->save();

        $statusStr = $rekening->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return response()->json([
            'message' => "Rekening {$rekening->nama_bank} berhasil {$statusStr}!",
            'is_active' => $rekening->is_active
        ]);
    }

    /**
     * Hapus Rekening Bank
     */
    public function destroyRekening($id)
    {
        $rekening = RekeningBank::findOrFail($id);
        $nama = $rekening->nama_bank;
        $rekening->delete();

        return response()->json(['message' => "Rekening {$nama} berhasil dihapus!"]);
    }

    /**
     * Simpan Syarat Berkas Tambahan Baru
     */
    public function storeSyaratBerkas(Request $request)
    {
        $validated = $request->validate([
            'nama_berkas' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:500',
            'is_required' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'urutan' => 'nullable|integer',
        ]);

        $maxUrutan = SyaratBerkas::max('urutan') ?? 0;

        $syarat = SyaratBerkas::create([
            'nama_berkas' => $validated['nama_berkas'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'is_required' => $request->has('is_required'),
            'is_active' => true,
            'urutan' => $validated['urutan'] ?? ($maxUrutan + 1),
        ]);

        return response()->json([
            'message' => 'Syarat berkas tambahan berhasil ditambahkan!',
            'data' => $syarat
        ]);
    }

    /**
     * Update Syarat Berkas Tambahan
     */
    public function updateSyaratBerkas(Request $request, $id)
    {
        $syarat = SyaratBerkas::findOrFail($id);

        $validated = $request->validate([
            'nama_berkas' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:500',
            'is_required' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'urutan' => 'nullable|integer',
        ]);

        $syarat->update([
            'nama_berkas' => $validated['nama_berkas'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'is_required' => $request->boolean('is_required'),
            'is_active' => $request->boolean('is_active'),
            'urutan' => $validated['urutan'] ?? $syarat->urutan,
        ]);

        return response()->json([
            'message' => 'Syarat berkas berhasil diperbarui!',
            'data' => $syarat
        ]);
    }

    /**
     * Toggle Aktif / Nonaktifkan Syarat Berkas
     */
    public function toggleSyaratBerkas($id)
    {
        $syarat = SyaratBerkas::findOrFail($id);
        $syarat->is_active = !$syarat->is_active;
        $syarat->save();

        $statusStr = $syarat->is_active ? 'diaktifkan' : 'dinonaktifkan (di-disable)';
        return response()->json([
            'message' => "Berkas '{$syarat->nama_berkas}' berhasil {$statusStr}!",
            'is_active' => $syarat->is_active
        ]);
    }

    /**
     * Hapus Syarat Berkas Tambahan
     */
    public function destroySyaratBerkas($id)
    {
        $syarat = SyaratBerkas::findOrFail($id);
        $syarat->delete();

        return response()->json(['message' => 'Syarat berkas berhasil dihapus!']);
    }
}
