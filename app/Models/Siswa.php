<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    use Notifiable;
    protected $table = 'siswas';

    protected $fillable = [
        'nis',
        'nama',
        'email',
        'password',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'asal_sekolah',
        'jalur_pendaftaran',
        'jurusan',
        'no_hp',
        'abk',
        'nama_orang_tua',
        'alamat_orang_tua',
        'no_hp_orang_tua',
        'mgm',
        'nama_mgm',
        'asal_mgm',
        'isAccepted',
        'rawPass'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
