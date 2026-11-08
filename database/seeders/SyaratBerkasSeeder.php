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
        DB::table('pengaturan_aplikasis')->where('id', 1)->update([
            'primary_color' => '#1A56DB',
            'secondary_color' => '#0B3B7B',
            'accent_color' => '#10B981',
            'slogan' => 'Unggul, Berakhlak, dan Siap Kerja di Era Digital 4.0',
            'hero_title' => 'Raih Masa Depan Gemilang Bersama Kami',
            'hero_subtitle' => 'Penerimaan Peserta Didik Baru (PPDB / SPMB) Online. Pendaftaran cepat, transparan, dan tanpa ribet login akun.',
            'status_pendaftaran' => 'buka',
            'gelombang_aktif' => 'Gelombang 1',
            'pesan_penutupan' => 'Pendaftaran saat ini sedang ditutup sementara. Silakan pantau pengumuman resmi atau hubungi kontak panitia.',
            'wa_template_lulus' => 'Halo Ananda {nama}, selamat! Anda dinyatakan DITERIMA di {sekolah} pada Jurusan {jurusan} dengan Nomor Induk Siswa (NIS) Resmi: {nis}. Silakan cek email Anda untuk surat kelulusan resmi dan petunjuk daftar ulang.',
            'wa_template_revisi' => 'Halo Ananda {nama}, terima kasih telah mendaftar di {sekolah}. Mohon maaf bukti transfer atau berkas Anda belum dapat kami validasi dengan catatan: "{alasan}". Mohon konfirmasi atau kirimkan ulang bukti yang jelas.',
            'pdf_catatan_kaki' => 'Bawalah lembar tanda terima ini beserta berkas fotokopi saat pelaksanaan wawancara atau daftar ulang di kampus sekolah.',
            'pdf_penandatangan' => 'Panitia SPMB',
        ]);

        $defaultBerkas = [
            ['nama_berkas' => 'Kartu Keluarga (KK)', 'deskripsi' => 'Scan/Foto asli KK jelas dan terbaca', 'is_required' => 1, 'is_active' => 1, 'urutan' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nama_berkas' => 'Akta Kelahiran', 'deskripsi' => 'Scan/Foto akta kelahiran calon siswa', 'is_required' => 1, 'is_active' => 1, 'urutan' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nama_berkas' => 'Ijazah / SKL', 'deskripsi' => 'Jika ijazah belum keluar, gunakan Surat Keterangan Lulus dari SMP/MTs', 'is_required' => 0, 'is_active' => 1, 'urutan' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['nama_berkas' => 'Pas Foto 3x4', 'deskripsi' => 'Foto formal berseragam sekolah asal dengan latar belakang biru atau merah', 'is_required' => 0, 'is_active' => 1, 'urutan' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['nama_berkas' => 'KIP / KKS / DTKS (Jalur Afirmasi)', 'deskripsi' => 'Khusus bagi pendaftar jalur afirmasi / bantuan pendidikan (opsional)', 'is_required' => 0, 'is_active' => 0, 'urutan' => 5, 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($defaultBerkas as $b) {
            DB::table('syarat_berkas')->updateOrInsert(['nama_berkas' => $b['nama_berkas']], $b);
        }
    }
}

