<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanAplikasi extends Model
{
    protected $fillables = [
        'app_name',
        'logo_path'
    ];
}
