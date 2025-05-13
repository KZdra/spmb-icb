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
            ['nama_jurusan' => 'Teknik Kendaraan Ringan', 'spp' => 350000, 'dsp' => 3000000],
            ['nama_jurusan' => 'Teknik Sepeda Motor', 'spp' => 350000, 'dsp' => 3000000],
            ['nama_jurusan' => 'Rekayasa Perangkat Lunak', 'spp' => 375000, 'dsp' => 3000000],
            ['nama_jurusan' => 'Teknik Komputer dan Jaringan', 'spp' => 375000, 'dsp' => 3000000],
            ['nama_jurusan' => 'Farmasi', 'spp' => 375000, 'dsp' => 3500000],
            ['nama_jurusan' => 'Asisten Keperawatan', 'spp' => 375000, 'dsp' => 3500000],
        ];

        DB::table('m_jurusans')->insert($jurusan);
    }
}
