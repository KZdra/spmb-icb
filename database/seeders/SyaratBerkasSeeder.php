<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SyaratBerkasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultBerkas = [
            [
                'nama_berkas' => 'Kartu Keluarga (KK)',
                'deskripsi' => 'Scan/Foto asli KK jelas dan terbaca',
                'is_required' => 1,
                'is_active' => 1,
                'urutan' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_berkas' => 'Akta Kelahiran',
                'deskripsi' => 'Scan/Foto akta kelahiran calon siswa',
                'is_required' => 1,
                'is_active' => 1,
                'urutan' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_berkas' => 'Ijazah / SKL Sementara',
                'deskripsi' => 'Jika ijazah belum keluar, gunakan Surat Keterangan Lulus dari SMP/MTs asal',
                'is_required' => 0,
                'is_active' => 1,
                'urutan' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_berkas' => 'Pas Foto 3x4',
                'deskripsi' => 'Foto formal berseragam sekolah asal dengan latar belakang rapi',
                'is_required' => 0,
                'is_active' => 1,
                'urutan' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_berkas' => 'KIP / KKS / DTKS (Jalur Afirmasi)',
                'deskripsi' => 'Khusus bagi pendaftar jalur afirmasi / bantuan pendidikan (opsional)',
                'is_required' => 0,
                'is_active' => 0,
                'urutan' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        foreach ($defaultBerkas as $b) {
            DB::table('syarat_berkas')->updateOrInsert(['nama_berkas' => $b['nama_berkas']], $b);
        }
    }
}
