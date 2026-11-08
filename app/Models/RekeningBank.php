<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekeningBank extends Model
{
    protected $table = 'rekening_banks';

    protected $fillable = [
        'nama_bank',
        'nomor_rekening',
        'atas_nama',
        'petunjuk_transfer',
        'is_active',
        'urutan',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];
}

