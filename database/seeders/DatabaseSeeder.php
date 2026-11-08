<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with clean master & default data.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeders::class,
            UserSeeder::class,
            PengaturanAplikasiSeeder::class,
            RekeningBankSeeder::class,
            JurusanSeeders::class,
            SyaratBerkasSeeder::class,
            ArticleSeeder::class,
            // SiswaSeeder::class, // Opsional: Dibiarkan nonaktif agar database produksi tetap bersih dari dummy pendaftar
        ]);

        if ($this->command) {
            $this->command->newLine();
            $this->command->info('===========================================================');
            $this->command->info(' SPMB MASTER & DEFAULT DATA SEEDED SUCCESSFULLY! (CLEAN)  ');
            $this->command->info('===========================================================');
            $this->command->line(' [V] Master Role & Hak Akses');
            $this->command->line(' [V] Default Akun Admin : admin@x.com (password: admin)');
            $this->command->line(' [V] Default Pengaturan CMS & Branding Sekolah');
            $this->command->line(' [V] Default Rekening Transfer (BRI & BNI)');
            $this->command->line(' [V] Default Master Jurusan (6 Program Keahlian)');
            $this->command->line(' [V] Default Master Syarat Dokumen Pendaftaran');
            $this->command->line(' [V] Default Panduan & Artikel Berita');
            $this->command->line(' [V] Data Pendaftar Siswa: BERSIH / KOSONG (Siap Digunakan)');
            $this->command->info('===========================================================');
            $this->command->newLine();
        }
    }
}
