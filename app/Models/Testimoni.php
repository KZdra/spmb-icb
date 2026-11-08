<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Testimoni extends Model
{
    protected $fillable = [
        'nama',
        'profesi_alumni',
        'tahun_lulus',
        'jurusan',
        'foto_path',
        'testimoni',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];

    public function getFotoUrlAttribute(): ?string
    {
        if ($this->foto_path && Storage::disk('public')->exists($this->foto_path)) {
            return asset('storage/' . $this->foto_path);
        }
        return null;
    }
}
