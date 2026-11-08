<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SyaratBerkas extends Model
{
    protected $table = 'syarat_berkas';

    protected $fillable = [
        'nama_berkas',
        'deskripsi',
        'is_required',
        'is_active',
        'urutan',
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];

    public function siswaBerkas()
    {
        return $this->hasMany(SiswaBerkas::class, 'syarat_berkas_id');
    }
}

