<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'id' => 1,
                'judul' => 'Panduan Lengkap Pendaftaran Calon Siswa Baru TA 2027/2028',
                'slug' => 'panduan-lengkap-pendaftaran-2027-2028',
                'kategori' => 'Panduan',
                'ringkasan' => 'Panduan komprehensif bagi calon murid dan orang tua untuk mendaftar di SMK ICB Cinta Teknika secara online.',
                'konten' => '<p>SMK ICB Cinta Teknika membuka Penerimaan Peserta Didik Baru (SPMB) Tahun Ajaran 2027/2028. Calon murid dapat mendaftar dengan mengisi formulir secara online tanpa perlu repot login akun terlebih dahulu.</p><p><strong>Tahapan Pendaftaran:</strong></p><ol><li>Menyiapkan kelengkapan berkas identitas dan asal sekolah.</li><li>Melakukan transfer pembayaran biaya formulir pendaftaran sebesar Rp 200.000,- ke rekening resmi Bank BRI.</li><li>Mengunggah foto bukti transfer saat mengisi formulir pendaftaran daring.</li><li>Panitia SPMB memverifikasi berkas dan bukti pembayaran.</li><li>Siswa yang diterima akan diterbitkan Nomor Induk Siswa (NIS) resmi dan menerima surat pengumuman kelulusan langsung ke email.</li></ol>',
                'gambar' => null,
                'penulis' => 'Panitia SPMB',
                'is_published' => 1,
                'views' => 127,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'judul' => 'Informasi Biaya Pendaftaran & Nomor Rekening Resmi BRI',
                'slug' => 'informasi-biaya-dan-rekening-bri',
                'kategori' => 'Pembayaran',
                'ringkasan' => 'Rincian biaya seleksi pendaftaran sebesar Rp 200.000,- melalui rekening resmi Bank BRI SMK ICB Cinta Teknika.',
                'konten' => '<p>Seluruh pembayaran biaya seleksi pendaftaran peserta didik baru SMK ICB Cinta Teknika dilakukan melalui transfer ke rekening resmi:</p><ul><li><strong>Nama Bank:</strong> Bank BRI</li><li><strong>Nomor Rekening:</strong> 210501000140303</li><li><strong>Atas Nama:</strong> SMK ICB Cinta Teknika</li><li><strong>Biaya Pendaftaran:</strong> Rp 200.000,-</li></ul><p>Pastikan Anda menyimpan bukti transfer untuk diunggah pada formulir pendaftaran daring.</p>',
                'gambar' => null,
                'penulis' => 'Keuangan SPMB',
                'is_published' => 1,
                'views' => 98,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'judul' => 'Jalur Beasiswa Prestasi & Program Kerjasama SMP Kemitraan',
                'slug' => 'jalur-beasiswa-prestasi-dan-kerjasama-smp',
                'kategori' => 'Beasiswa',
                'ringkasan' => 'Dapatkan potongan biaya pendidikan dan beasiswa bagi calon siswa berprestasi di bidang akademik, olahraga, maupun keagamaan.',
                'konten' => '<p>SMK ICB Cinta Teknika menyediakan jalur <strong>Beasiswa Prestasi</strong> bagi calon siswa yang memiliki piagam kejuaraan minimal tingkat kota/kabupaten, serta jalur kemitraan bagi lulusan SMP yang telah menjalin kerjasama.</p><p>Silakan pilih jalur tersebut saat mengisi formulir pendaftaran online untuk mendapatkan penyesuaian biaya.</p>',
                'gambar' => null,
                'penulis' => 'Humas ICB',
                'is_published' => 1,
                'views' => 150,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($articles as $art) {
            DB::table('articles')->updateOrInsert(
                ['id' => $art['id']],
                $art
            );
        }
    }
}
