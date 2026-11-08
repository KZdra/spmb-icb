<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\MitraIndustri;
use App\Models\Testimoni;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LandingCmsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed FAQs
        if (Faq::count() === 0) {
            $faqs = [
                [
                    'pertanyaan' => 'Bagaimana jika Ijazah SMP atau SKL belum terbit saat mendaftar?',
                    'jawaban'    => 'Tenang saja, Anda tetap dapat mendaftar sekarang! Calon siswa cukup melampirkan Surat Keterangan bahwa masih duduk di kelas 9 dari sekolah asal atau rapor semester terakhir. Ijazah asli atau SKL resmi dapat diserahkan menyusul saat jadwal daftar ulang.',
                    'kategori'   => 'Pendaftaran',
                    'urutan'     => 1,
                    'is_active'  => true,
                ],
                [
                    'pertanyaan' => 'Apakah biaya pendaftaran dan DSP bisa dicicil?',
                    'jawaban'    => 'Biaya formulir pendaftaran dibayarkan satu kali di awal. Sedangkan untuk biaya Dana Sumbangan Pendidikan (DSP) dan administrasi daftar ulang, pihak sekolah menyediakan skema cicilan bertahap yang fleksibel dan dapat dikonsultasikan dengan bagian keuangan sekolah.',
                    'kategori'   => 'Biaya & Keuangan',
                    'urutan'     => 2,
                    'is_active'  => true,
                ],
                [
                    'pertanyaan' => 'Apakah calon siswa bisa datang langsung mendaftar di kampus sekolah?',
                    'jawaban'    => 'Sangat bisa! Jika calon siswa atau orang tua ingin berkonsultasi langsung, melihat fasilitas bengkel/laboratorium praktik, atau membutuhkan pendampingan pengisian form, silakan datang langsung ke Ruang Sekretariat SPMB pada jam pelayanan kerja.',
                    'kategori'   => 'Layanan',
                    'urutan'     => 3,
                    'is_active'  => true,
                ],
                [
                    'pertanyaan' => 'Berapa lama proses verifikasi bukti pendaftaran saya?',
                    'jawaban'    => 'Panitia SPMB memeriksa berkas masuk secara berkala dalam kurun waktu 1x24 jam kerja. Calon siswa dapat memantau status validasi pembayaran maupun kelulusan setiap saat melalui menu Cek Status menggunakan Kode Pendaftaran atau NISN.',
                    'kategori'   => 'Verifikasi',
                    'urutan'     => 4,
                    'is_active'  => true,
                ],
                [
                    'pertanyaan' => 'Apakah tersedia beasiswa untuk calon siswa berprestasi / keluarga prasejahtera?',
                    'jawaban'    => 'Ya, kami membuka Jalur Beasiswa Prestasi bagi pemegang piagam kejuaraan olahraga/seni/akademik atau sertifikat tahfidz Qur\'an, serta Jalur Kemitraan / RMP bagi keluarga pemegang KIP, DTKS, atau kartu program bantuan pemerintah lainnya.',
                    'kategori'   => 'Beasiswa',
                    'urutan'     => 5,
                    'is_active'  => true,
                ],
            ];

            foreach ($faqs as $f) {
                Faq::create($f);
            }
        }

        // 2. Seed Mitra Industri
        if (MitraIndustri::count() === 0) {
            $mitras = [
                ['nama_mitra' => 'PT Bank Mandiri (Persero) Tbk', 'bidang' => 'Perbankan & Keuangan', 'urutan' => 1],
                ['nama_mitra' => 'PT Telkom Indonesia Tbk', 'bidang' => 'Telekomunikasi & IT', 'urutan' => 2],
                ['nama_mitra' => 'PT Astra International Tbk', 'bidang' => 'Otomotif & Manufaktur', 'urutan' => 3],
                ['nama_mitra' => 'PT Bank Central Asia Tbk', 'bidang' => 'Perbankan & Layanan Keuangan', 'urutan' => 4],
                ['nama_mitra' => 'PT Indomarco Prismatama', 'bidang' => 'Bisnis Ritel & Manajemen', 'urutan' => 5],
                ['nama_mitra' => 'PT Trans Retail Indonesia', 'bidang' => 'Pemasaran & Bisnis Digital', 'urutan' => 6],
            ];

            foreach ($mitras as $m) {
                MitraIndustri::create($m);
            }
        }

        // 3. Seed Testimoni Alumni
        if (Testimoni::count() === 0) {
            $testimonis = [
                [
                    'nama'           => 'Rizky Pratama, A.Md.',
                    'profesi_alumni' => 'Staff Administrasi & Keuangan di BUMN',
                    'tahun_lulus'    => 'Lulusan 2024',
                    'jurusan'        => 'Akuntansi & Keuangan Lembaga',
                    'testimoni'      => 'Pembelajaran praktik dan disiplin yang diajarkan selama sekolah sangat nyata dengan kebutuhan dunia kerja industri. Sebelum wisuda kelulusan bahkan saya sudah diterima bekerja.',
                    'urutan'         => 1,
                    'is_active'      => true,
                ],
                [
                    'nama'           => 'Anisa Rahmawati',
                    'profesi_alumni' => 'Junior Web Developer di Digital Agency Bandung',
                    'tahun_lulus'    => 'Lulusan 2025',
                    'jurusan'        => 'Rekayasa Perangkat Lunak',
                    'testimoni'      => 'Fasilitas komputer labnya lengkap dan guru pembimbingnya sangat suportif mengarahkan portofolio nyata. Mendaftar lewat SPMB online juga sangat praktis dan cepat.',
                    'urutan'         => 2,
                    'is_active'      => true,
                ],
                [
                    'nama'           => 'Dimas Maulana Putra',
                    'profesi_alumni' => 'Mahasiswa Teknik Komputer (Penerima Beasiswa) & Freelancer',
                    'tahun_lulus'    => 'Lulusan 2024',
                    'jurusan'        => 'Teknik Komputer & Jaringan',
                    'testimoni'      => 'Selain siap kerja, bekal teori dan sertifikasi kompetensinya membuat saya percaya diri bersaing dan berhasil lolos seleksi masuk perguruan tinggi negeri.',
                    'urutan'         => 3,
                    'is_active'      => true,
                ],
            ];

            foreach ($testimonis as $t) {
                Testimoni::create($t);
            }
        }

        // 4. Update default tanggal tutup gelombang di pengaturan_aplikasis jika belum diset
        $setting = DB::table('pengaturan_aplikasis')->first();
        if ($setting && empty($setting->tanggal_tutup_gelombang)) {
            DB::table('pengaturan_aplikasis')->where('id', $setting->id)->update([
                'tanggal_tutup_gelombang' => now()->addDays(30)->toDateString(),
                'stat_akreditasi'         => 'A (Unggul)',
                'stat_lulusan_kerja'      => '95%+',
                'stat_mitra_industri'     => '50+',
                'stat_ekskul_lab'         => '15+',
            ]);
        }
    }
}
