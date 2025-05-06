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
            ['nama_jurusan' => 'Teknik Kendaraan Ringan'],
            ['nama_jurusan' => 'Teknik Sepeda Motor'],
            ['nama_jurusan' => 'Rekayasa Perangkat Lunak'],
            ['nama_jurusan' => 'Teknik Komputer dan Jaringan'],
            ['nama_jurusan' => 'Farmasi'],
            ['nama_jurusan' => 'Asisten Keperawatan'],
        ];

        DB::table('m_jurusans')->insert($jurusan);
    }
}
