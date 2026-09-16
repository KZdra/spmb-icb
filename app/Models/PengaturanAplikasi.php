<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanAplikasi extends Model
{
    protected $fillable = [
        'app_name',
        'logo_path',
        'bank_name',
        'no_rekening',
        'atas_nama',
        'biaya_pendaftaran',
        'kontak_wa',
        'alamat_sekolah',
        'tahun_ajaran',
        'nis_prefix',
        'nis_start_number',
        'email_notifikasi',
        'artikel_judul',
        'artikel_konten',
    ];
}
