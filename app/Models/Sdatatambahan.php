<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sdatatambahan extends Model
{
    protected $table = 's_data_tambahans';

    protected $fillable = [
        'siswa_id',
        'alamat',
        'rt',
        'rw',
        'kelurahan',
        'kecamatan',
        'kota',
        'provinsi',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat_sekolah_asal',
        'nama_ayah',
        'telepon_ayah',
        'nama_ibu',
        'telepon_ibu',
        'tinggi_badan',
        'berat_badan',
        'nama_orang_tua',
        'alamat_orang_tua',
        'no_hp_orang_tua',
    ];

    // Relasi ke model Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
