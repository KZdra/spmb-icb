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
        'hero_image_path',
        'hero_cta_text',
        'panduan_title',
        'panduan_desc',
        'brosur_panduan_path',
        'brosur_syarat_path',
        'brosur_alur_path',
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
        'sosmed_instagram',
        'sosmed_tiktok',
        'sosmed_youtube',
        'sosmed_facebook',
        'stat_akreditasi',
        'stat_lulusan_kerja',
        'stat_mitra_industri',
        'stat_ekskul_lab',
        'tahun_ajaran',
        'status_pendaftaran',
        'gelombang_aktif',
        'tanggal_tutup_gelombang',
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
        return "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='48' fill='%231A56DB'/%3E%3Ctext x='50' y='58' font-size='32' text-anchor='middle' fill='%23FFFFFF' font-family='sans-serif' font-weight='bold'%3ESPMB%3C/text%3E%3C/svg%3E";
    }

    public function getFaviconUrlAttribute(): string
    {
        if ($this->favicon_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($this->favicon_path)) {
            return asset('storage/' . $this->favicon_path);
        }
        return $this->logo_url;
    }

    public function getHeroImageUrlAttribute(): string
    {
        if ($this->hero_image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($this->hero_image_path)) {
            return asset('storage/' . $this->hero_image_path);
        }
        if (file_exists(public_path('images/spmb/panduan_pendaftaran.jpg'))) {
            return asset('images/spmb/panduan_pendaftaran.jpg');
        }
        return $this->logo_url;
    }

    public function getBrosurPanduanUrlAttribute(): string
    {
        if ($this->brosur_panduan_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($this->brosur_panduan_path)) {
            return asset('storage/' . $this->brosur_panduan_path);
        }
        if (file_exists(public_path('images/spmb/panduan_pendaftaran.jpg'))) {
            return asset('images/spmb/panduan_pendaftaran.jpg');
        }
        return $this->hero_image_url;
    }

    public function getBrosurSyaratUrlAttribute(): string
    {
        if ($this->brosur_syarat_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($this->brosur_syarat_path)) {
            return asset('storage/' . $this->brosur_syarat_path);
        }
        if (file_exists(public_path('images/spmb/syarat_pendaftaran.jpg'))) {
            return asset('images/spmb/syarat_pendaftaran.jpg');
        }
        return $this->hero_image_url;
    }

    public function getBrosurAlurUrlAttribute(): string
    {
        if ($this->brosur_alur_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($this->brosur_alur_path)) {
            return asset('storage/' . $this->brosur_alur_path);
        }
        if (file_exists(public_path('images/spmb/alur_pendaftaran.jpg'))) {
            return asset('images/spmb/alur_pendaftaran.jpg');
        }
        return $this->hero_image_url;
    }
}
