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
        'jenis_kelamin',
        'agama',
        'asal_sekolah',
        'jalur_pendaftaran',
        'id_jurusan',
        'no_hp',
        'mgm',
        'nama_mgm',
        'asal_mgm',
        'isAccepted',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function dataTambahan()
    {
        return $this->hasOne(SDataTambahan::class,'id');
    }
    public function jurusan()
    {
        return $this->belongsTo(MJurusan::class,'id_jurusan');
    }
    public function buktiPembayaran()
    {
        return $this->belongsTo(BuktiPembayaran::class,'id');
    }
}
