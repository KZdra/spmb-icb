<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    use Notifiable;
    protected $table = 'siswas';

    protected $fillable = [
        'kode_pendaftaran',
        'nis',
        'nama',
        'email',
        'password',
        'jenis_kelamin',
        'agama',
        'asal_sekolah',
        'nisn',
        'tahun_lulus',
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

    protected static function booted()
    {
        static::creating(function ($siswa) {
            if (empty($siswa->password)) {
                $siswa->password = \Illuminate\Support\Facades\Hash::make(\Illuminate\Support\Str::random(24));
            }
        });
    }

    public function dataTambahan()
    {
        return $this->hasOne(Sdatatambahan::class);
    }
    public function jurusan()
    {
        return $this->belongsTo(MJurusan::class,'id_jurusan');
    }
    public function buktiPembayaran()
    {
        return $this->hasOne(BuktiPembayaran::class);
    }
    public function berkasTambahan(){
        return $this->hasOne(BerkasTambahan::class);
    }
    public function berkas()
    {
        return $this->hasMany(SiswaBerkas::class, 'siswa_id');
    }
}
