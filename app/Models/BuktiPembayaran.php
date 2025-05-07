<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuktiPembayaran extends Model
{
    protected $table = 'bukti_pembayarans';

    protected $fillable = [
        'siswa_id',
        'file_name',
        'file_path',
        'status',
        'amount',
        'payment_date',
        'created_at',
        'updated_at',
    ];

    public function siswa()
    {
        $this->hasMany(Siswa::class);
    }
}
