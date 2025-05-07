<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sdatatambahan extends Model
{
    protected $table = 's_data_tambahans';

    protected $fillable = [
        'siswa_id',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'is_abk',
        'nama_orang_tua',
        'alamat_orang_tua',
        'pekerjaan_orang_tua',
        'no_hp_orang_tua',
    ];

    // Relasi ke model Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
