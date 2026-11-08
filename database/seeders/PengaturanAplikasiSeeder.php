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
                'favicon_path' => null,
                'primary_color' => '#1A56DB',
                'secondary_color' => '#0B3B7B',
                'accent_color' => '#10B981',
                'slogan' => 'Unggul, Berakhlak, dan Siap Kerja di Era Digital 4.0',
                'hero_badge' => 'TERAKREDITASI A • SPMB ONLINE TA 2027/2028',
                'hero_title' => "Membuka Jalan Menuju Keahlian Nyata\n& Karir Masa Depan",
                'hero_subtitle' => 'Selamat datang calon peserta didik baru dan orang tua di portal resmi SPMB SMK ICB Cinta Teknika. Pelajari program keahlian unggulan kami, fasilitas praktik industri, dan daftar mandiri dari rumah tanpa ribet.',
                'hero_cta_text' => 'Daftar Sekarang (Online)',
                'panduan_title' => '4 Langkah Mudah Pendaftaran Calon Siswa',
                'panduan_desc' => 'Ikuti tahapan resmi pendaftaran calon peserta didik baru secara berurutan dan terstruktur agar proses verifikasi berjalan lancar.',
                'cta_banner_title' => 'Siap Menjadi Bagian dari Keluarga Besar Kami?',
                'cta_banner_desc' => 'Jangan lewatkan kesempatan membangun karir dan keahlian nyata bersama SMK ICB Cinta Teknika. Kuota pendaftaran terbatas setiap gelombangnya.',
                'tentang_sekolah' => 'Sekolah Menengah Kejuruan Terakreditasi A (Unggul). Menghasilkan lulusan yang disiplin, berakhlak mulia, kompeten di bidang kejuruan modern, dan siap kerja maupun melanjutkan studi.',
                'jam_pelayanan' => 'Senin - Sabtu (08:00 - 15:00 WIB)',
                'bank_name' => 'Bank BRI',
                'no_rekening' => '210501000140303',
                'atas_nama' => 'SMK ICB Cinta Teknika',
                'biaya_pendaftaran' => 200000.00,
                'kontak_wa' => '6281222223333',
                'alamat_sekolah' => 'Jl. Atlas No. 4, Babakan Surabaya, Kiaracondong, Bandung',
                'tahun_ajaran' => '2027/2028',
                'status_pendaftaran' => 'buka',
                'gelombang_aktif' => 'Gelombang 1',
                'pesan_penutupan' => 'Pendaftaran saat ini sedang ditutup sementara atau kuota telah terpenuhi. Silakan hubungi panitia via WhatsApp untuk informasi gelombang berikutnya.',
                'nis_prefix' => '125',
                'nis_start_number' => 1,
                'email_notifikasi' => 'admin@spmb.sch.id',
                'wa_template_lulus' => 'Halo Ananda {nama}, selamat! Anda dinyatakan DITERIMA di {sekolah} pada Jurusan {jurusan} dengan Nomor Induk Siswa (NIS) Resmi: {nis}. Silakan cek email Anda untuk surat kelulusan resmi dan petunjuk daftar ulang.',
                'wa_template_revisi' => 'Halo Ananda {nama}, terima kasih telah mendaftar di {sekolah}. Mohon maaf bukti transfer atau berkas Anda belum dapat kami validasi dengan catatan: "{alasan}". Mohon konfirmasi atau kirimkan ulang bukti yang jelas.',
                'pdf_catatan_kaki' => 'Bawalah lembar tanda terima ini beserta berkas fotokopi saat pelaksanaan wawancara atau daftar ulang di kampus sekolah.',
                'pdf_penandatangan' => 'Panitia SPMB',
                'artikel_judul' => 'Panduan Lengkap Penerimaan Calon Siswa Baru SMK ICB Cinta Teknika Tahun Ajaran 2027/2028',
                'artikel_konten' => 'SMK ICB Cinta Teknika membuka Penerimaan Peserta Didik Baru (SPMB) Tahun Ajaran 2027/2028 dengan berbagai kemudahan pendaftaran secara daring.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Inisialisasi NIS Counter bawaan
        DB::table('nis_counters')->updateOrInsert(
            ['id' => 1],
            [
                'last_number' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
