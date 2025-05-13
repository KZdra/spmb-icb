<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BerkasTambahan extends Model
{
    protected $table = 'berkas_tambahans';

    protected $fillable = [
        'siswa_id',
        'dtks',
        'dtks_path',
        'kip',
        'kip_path',
    ];

    // Relasi ke model Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
