<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiswaBerkas extends Model
{
    protected $table = 'siswa_berkas';

    protected $fillable = [
        'siswa_id',
        'syarat_berkas_id',
        'file_name',
        'file_path',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function syaratBerkas()
    {
        return $this->belongsTo(SyaratBerkas::class, 'syarat_berkas_id');
    }
}

