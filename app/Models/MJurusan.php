<?php

namespace App\Models;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Model;

class MJurusan extends Model
{
    protected $table = 'm_jurusans';

    protected $fillable = [
        'nama_jurusan'
    ];

    public function siswa()
    {
        $this->hasMany(Siswa::class);
    }
}
