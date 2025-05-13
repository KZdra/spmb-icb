<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;
class BuktiPembayaran extends Model
{
    protected $table = 'bukti_pembayarans';

    protected $fillable = [
        'siswa_id',
        'file_name',
        'file_path',
        'status',
        'account_name',
        'amount',
        'payment_date',
        'payment_type',
        'created_at',
        'updated_at',
        'alasan'
    ];

    public function siswa()
    {
        $this->belongsTo(Siswa::class);
    }
}
