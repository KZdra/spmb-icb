<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengaturanAplikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengaturan_aplikasis')->updateOrInsert(
            ['id' => 1],
            [
                'app_name' => 'SMK ICB Cinta Teknika',
                'logo_path' => null,
                'bank_name' => 'Bank BRI',
                'no_rekening' => '210501000140303',
                'atas_nama' => 'SMK ICB Cinta Teknika',
                'biaya_pendaftaran' => 200000.00,
                'kontak_wa' => '6281222223333',
                'alamat_sekolah' => 'Jl. Atlas No. 4, Babakan Surabaya, Kiaracondong, Bandung',
                'tahun_ajaran' => '2027/2028',
                'nis_prefix' => '125',
                'nis_start_number' => 1,
                'email_notifikasi' => 'admin@x.com',
                'artikel_judul' => 'Panduan Lengkap Penerimaan Calon Siswa Baru SMK ICB Cinta Teknika Tahun Ajaran 2027/2028',
                'artikel_konten' => 'SMK ICB Cinta Teknika membuka Penerimaan Peserta Didik Baru (SPMB) Tahun Ajaran 2027/2028 dengan berbagai kemudahan pendaftaran secara daring.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
