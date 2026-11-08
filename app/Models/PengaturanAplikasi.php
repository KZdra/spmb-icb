<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanAplikasi extends Model
{
    protected $fillable = [
        'app_name',
        'logo_path',
        'primary_color',
        'secondary_color',
        'accent_color',
        'favicon_path',
        'slogan',
        'hero_title',
        'hero_subtitle',
        'hero_badge',
        'hero_cta_text',
        'panduan_title',
        'panduan_desc',
        'cta_banner_title',
        'cta_banner_desc',
        'tentang_sekolah',
        'jam_pelayanan',
        'video_profil_url',
        'bank_name',
        'no_rekening',
        'atas_nama',
        'biaya_pendaftaran',
        'kontak_wa',
        'alamat_sekolah',
        'tahun_ajaran',
        'status_pendaftaran',
        'gelombang_aktif',
        'pesan_penutupan',
        'nis_prefix',
        'nis_start_number',
        'email_notifikasi',
        'wa_template_lulus',
        'wa_template_revisi',
        'pdf_catatan_kaki',
        'pdf_penandatangan',
        'artikel_judul',
        'artikel_konten',
    ];

    public function getLogoUrlAttribute(): string
    {
        if ($this->logo_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($this->logo_path)) {
            return asset('storage/' . $this->logo_path);
        }
        if (file_exists(public_path('images/icb.png'))) {
            return asset('images/icb.png');
        }
        return "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='48' fill='%231A56DB'/%3E%3Ctext x='50' y='58' font-size='32' text-anchor='middle' fill='%23FFFFFF' font-family='sans-serif' font-weight='bold'%3EICB%3C/text%3E%3C/svg%3E";
    }

    public function getFaviconUrlAttribute(): string
    {
        if ($this->favicon_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($this->favicon_path)) {
            return asset('storage/' . $this->favicon_path);
        }
        return $this->logo_url;
    }
}
