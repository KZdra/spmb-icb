<?php

namespace Database\Seeders;

use App\Models\PengaturanAplikasi;
use App\Models\RekeningBank;
use Illuminate\Database\Seeder;

class RekeningBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting = PengaturanAplikasi::first();
        $atasNama = $setting->atas_nama ?? 'SMK ICB Cinta Teknika';

        RekeningBank::updateOrInsert(
            ['nomor_rekening' => $setting->no_rekening ?? '210501000140303'],
            [
                'nama_bank' => $setting->bank_name ?? 'Bank BRI',
                'nomor_rekening' => $setting->no_rekening ?? '210501000140303',
                'atas_nama' => $atasNama,
                'petunjuk_transfer' => 'Rekening Utama Operasional SPMB',
                'is_active' => true,
                'urutan' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        RekeningBank::updateOrInsert(
            ['nomor_rekening' => '0245678901'],
            [
                'nama_bank' => 'Bank BNI',
                'nomor_rekening' => '0245678901',
                'atas_nama' => $atasNama,
                'petunjuk_transfer' => 'Rekening Cadangan Pembayaran SPMB',
                'is_active' => true,
                'urutan' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}

