<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $jurusan = [
            ['id' => 1, 'nama_jurusan' => 'Teknik Kendaraan Ringan (TKR)', 'spp' => 350000, 'dsp' => 3000000],
            ['id' => 2, 'nama_jurusan' => 'Teknik Sepeda Motor (TSM)', 'spp' => 350000, 'dsp' => 3000000],
            ['id' => 3, 'nama_jurusan' => 'Teknik Komputer dan Jaringan', 'spp' => 375000, 'dsp' => 3000000],
            ['id' => 4, 'nama_jurusan' => 'Rekayasa Perangkat Lunak', 'spp' => 375000, 'dsp' => 3000000],
            ['id' => 5, 'nama_jurusan' => 'Farmasi', 'spp' => 375000, 'dsp' => 3500000],
            ['id' => 6, 'nama_jurusan' => 'Keperawatan', 'spp' => 375000, 'dsp' => 3500000],
        ];

        foreach ($jurusan as $j) {
            DB::table('m_jurusans')->updateOrInsert(['id' => $j['id']], $j);
        }
    }
}
