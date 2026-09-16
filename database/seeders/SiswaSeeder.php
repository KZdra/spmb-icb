<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset NIS Counter agar mulai dari awal saat diterima
        DB::table('nis_counters')->updateOrInsert(
            ['id' => 1],
            [
                'last_number' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        // Bersihkan data lama agar 10 data siswa baru tertata rapi
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('bukti_pembayarans')->truncate();
        DB::table('s_data_tambahans')->truncate();
        DB::table('siswas')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $students = [
            [
                'id' => 1,
                'kode' => 'ICB-2026-0001',
                'nis' => null,
                'nama' => 'Muhammad Rizky Pratama',
                'email' => 'rizky.pratama@gmail.com',
                'id_jurusan' => 4, // Rekayasa Perangkat Lunak
                'jk' => 'Laki-laki',
                'agama' => 'Islam',
                'asal_sekolah' => 'SMPN 1 Bandung',
                'nisn' => '0081293801',
                'tahun_lulus' => '2026',
                'jalur' => 'Prestasi',
                'no_hp' => '081223344501',
                'status' => 'Pending',
                'isAccepted' => 0,
                'tmp_lahir' => 'Bandung',
                'tgl_lahir' => '2008-04-12',
                'alamat' => 'Jl. Jakarta No. 15 RT 02 RW 05',
                'rt' => '02', 'rw' => '05', 'kel' => 'Kebonwaru', 'kec' => 'Batununggal', 'kota' => 'Kota Bandung', 'prov' => 'Jawa Barat',
                'ayah' => 'Bambang Pratama', 'tel_ayah' => '081299887701',
                'ibu' => 'Sri Wahyuni', 'tel_ibu' => '081299887702',
                'tb' => '170', 'bb' => '58',
                'bayar_status' => 'pending',
                'bayar_file' => 'pendaftar/bukti_1.jpg'
            ],
            [
                'id' => 2,
                'kode' => 'ICB-2026-0002',
                'nis' => null,
                'nama' => 'Siti Aisyah Nuraini',
                'email' => 'siti.aisyah@gmail.com',
                'id_jurusan' => 5, // Farmasi
                'jk' => 'Perempuan',
                'agama' => 'Islam',
                'asal_sekolah' => 'SMPN 7 Bandung',
                'nisn' => '0081293802',
                'tahun_lulus' => '2026',
                'jalur' => 'Reguler (Umum)',
                'no_hp' => '081223344502',
                'status' => 'Pending',
                'isAccepted' => 0,
                'tmp_lahir' => 'Bandung',
                'tgl_lahir' => '2008-07-20',
                'alamat' => 'Jl. Cikutra No. 88 RT 04 RW 09',
                'rt' => '04', 'rw' => '09', 'kel' => 'Cikutra', 'kec' => 'Cibeunying Kidul', 'kota' => 'Kota Bandung', 'prov' => 'Jawa Barat',
                'ayah' => 'Asep Nuraini', 'tel_ayah' => '081399887703',
                'ibu' => 'Neneng Hasanah', 'tel_ibu' => '081399887704',
                'tb' => '158', 'bb' => '48',
                'bayar_status' => 'pending',
                'bayar_file' => 'pendaftar/bukti_2.jpg'
            ],
            [
                'id' => 3,
                'kode' => 'ICB-2026-0003',
                'nis' => null,
                'nama' => 'Daffa Arya Putra',
                'email' => 'daffa.arya@gmail.com',
                'id_jurusan' => 4, // Rekayasa Perangkat Lunak
                'jk' => 'Laki-laki',
                'agama' => 'Islam',
                'asal_sekolah' => 'SMP Pasundan 1 Bandung',
                'nisn' => '0081293803',
                'tahun_lulus' => '2026',
                'jalur' => 'Reguler (Umum)',
                'no_hp' => '081223344503',
                'status' => 'Pending',
                'isAccepted' => 0,
                'tmp_lahir' => 'Cimahi',
                'tgl_lahir' => '2008-02-18',
                'alamat' => 'Jl. Amir Machmud No. 120 RT 01 RW 04',
                'rt' => '01', 'rw' => '04', 'kel' => 'Cibabat', 'kec' => 'Cimahi Utara', 'kota' => 'Kota Cimahi', 'prov' => 'Jawa Barat',
                'ayah' => 'Hendra Putra', 'tel_ayah' => '081599887705',
                'ibu' => 'Rina Marlina', 'tel_ibu' => '081599887706',
                'tb' => '165', 'bb' => '54',
                'bayar_status' => 'pending',
                'bayar_file' => 'pendaftar/bukti_3.jpg'
            ],
            [
                'id' => 4,
                'kode' => 'ICB-2026-0004',
                'nis' => null,
                'nama' => 'Nabila Putri Rahmawati',
                'email' => 'nabila.putri@gmail.com',
                'id_jurusan' => 6, // Keperawatan
                'jk' => 'Perempuan',
                'agama' => 'Islam',
                'asal_sekolah' => 'SMPN 13 Bandung',
                'nisn' => '0081293804',
                'tahun_lulus' => '2026',
                'jalur' => 'Afirmasi / KETM',
                'no_hp' => '081223344504',
                'status' => 'Pending',
                'isAccepted' => 0,
                'tmp_lahir' => 'Bandung',
                'tgl_lahir' => '2008-11-05',
                'alamat' => 'Jl. Sukajadi No. 45 RT 03 RW 08',
                'rt' => '03', 'rw' => '08', 'kel' => 'Sukagalih', 'kec' => 'Sukajadi', 'kota' => 'Kota Bandung', 'prov' => 'Jawa Barat',
                'ayah' => 'Rahmat Hidayat', 'tel_ayah' => '081699887707',
                'ibu' => 'Dewi Sartika', 'tel_ibu' => '081699887708',
                'tb' => '160', 'bb' => '50',
                'bayar_status' => 'pending',
                'bayar_file' => 'pendaftar/bukti_4.jpg'
            ],
            [
                'id' => 5,
                'kode' => 'ICB-2026-0005',
                'nis' => null,
                'nama' => 'Indra Hardika',
                'email' => 'indra.hardika@gmail.com',
                'id_jurusan' => 5, // Farmasi
                'jk' => 'Laki-laki',
                'agama' => 'Islam',
                'asal_sekolah' => 'SMP 49 Bandung',
                'nisn' => '0081293805',
                'tahun_lulus' => '2026',
                'jalur' => 'Reguler (Umum)',
                'no_hp' => '083185742207',
                'status' => 'Pending',
                'isAccepted' => 0,
                'tmp_lahir' => 'Bandung',
                'tgl_lahir' => '2008-09-15',
                'alamat' => 'Jl. Sindang Sari 3 No. 9 RT 06 RW 09',
                'rt' => '06', 'rw' => '09', 'kel' => 'Antapani Wetan', 'kec' => 'Antapani', 'kota' => 'Kota Bandung', 'prov' => 'Jawa Barat',
                'ayah' => 'Adiwudia', 'tel_ayah' => '083185742207',
                'ibu' => 'Siti Rohimah', 'tel_ibu' => '083185742208',
                'tb' => '168', 'bb' => '56',
                'bayar_status' => 'pending',
                'bayar_file' => 'pendaftar/bukti_5.jpg'
            ],
            [
                'id' => 6,
                'kode' => 'ICB-2026-0006',
                'nis' => null,
                'nama' => 'Fajar Ramadhan',
                'email' => 'fajar.ramadhan@gmail.com',
                'id_jurusan' => 1, // Teknik Kendaraan Ringan (TKR)
                'jk' => 'Laki-laki',
                'agama' => 'Islam',
                'asal_sekolah' => 'SMP Muhammadiyah 3 Bandung',
                'nisn' => '0081293806',
                'tahun_lulus' => '2026',
                'jalur' => 'Reguler (Umum)',
                'no_hp' => '081223344506',
                'status' => 'Pending',
                'isAccepted' => 0,
                'tmp_lahir' => 'Sumedang',
                'tgl_lahir' => '2008-10-24',
                'alamat' => 'Jl. Terusan Buah Batu No. 202 RT 05 RW 02',
                'rt' => '05', 'rw' => '02', 'kel' => 'Kujangsari', 'kec' => 'Bandung Kidul', 'kota' => 'Kota Bandung', 'prov' => 'Jawa Barat',
                'ayah' => 'Agus Ramadhan', 'tel_ayah' => '081799887709',
                'ibu' => 'Enok Nurjanah', 'tel_ibu' => '081799887710',
                'tb' => '172', 'bb' => '62',
                'bayar_status' => 'pending',
                'bayar_file' => 'pendaftar/bukti_6.jpg'
            ],
            [
                'id' => 7,
                'kode' => 'ICB-2026-0007',
                'nis' => null,
                'nama' => 'Annisa Zahra Maharani',
                'email' => 'annisa.zahra@gmail.com',
                'id_jurusan' => 5, // Farmasi
                'jk' => 'Perempuan',
                'agama' => 'Islam',
                'asal_sekolah' => 'SMPN 14 Bandung',
                'nisn' => '0081293807',
                'tahun_lulus' => '2026',
                'jalur' => 'Prestasi',
                'no_hp' => '081223344507',
                'status' => 'Pending',
                'isAccepted' => 0,
                'tmp_lahir' => 'Bandung',
                'tgl_lahir' => '2008-05-30',
                'alamat' => 'Jl. Gatot Subroto No. 310 RT 01 RW 06',
                'rt' => '01', 'rw' => '06', 'kel' => 'Maleer', 'kec' => 'Batununggal', 'kota' => 'Kota Bandung', 'prov' => 'Jawa Barat',
                'ayah' => 'Yayan Maharani', 'tel_ayah' => '081899887711',
                'ibu' => 'Tuti Alawiyah', 'tel_ibu' => '081899887712',
                'tb' => '156', 'bb' => '47',
                'bayar_status' => 'pending',
                'bayar_file' => 'pendaftar/bukti_7.jpg'
            ],
            [
                'id' => 8,
                'kode' => 'ICB-2026-0008',
                'nis' => null,
                'nama' => 'Bagas Aditya Nugraha',
                'email' => 'bagas.aditya@gmail.com',
                'id_jurusan' => 2, // Teknik Sepeda Motor (TSM)
                'jk' => 'Laki-laki',
                'agama' => 'Islam',
                'asal_sekolah' => 'SMP Kartika XIX Bandung',
                'nisn' => '0081293808',
                'tahun_lulus' => '2026',
                'jalur' => 'Reguler (Umum)',
                'no_hp' => '081223344508',
                'status' => 'Pending',
                'isAccepted' => 0,
                'tmp_lahir' => 'Bandung',
                'tgl_lahir' => '2008-08-14',
                'alamat' => 'Jl. A.H. Nasution No. 77 RT 03 RW 11',
                'rt' => '03', 'rw' => '11', 'kel' => 'Cipadung', 'kec' => 'Cibiru', 'kota' => 'Kota Bandung', 'prov' => 'Jawa Barat',
                'ayah' => 'Dadang Nugraha', 'tel_ayah' => '081999887713',
                'ibu' => 'Yuyun Yuningsih', 'tel_ibu' => '081999887714',
                'tb' => '169', 'bb' => '59',
                'bayar_status' => 'pending',
                'bayar_file' => 'pendaftar/bukti_8.jpg'
            ],
            [
                'id' => 9,
                'kode' => 'ICB-2026-0009',
                'nis' => null,
                'nama' => 'Kevin Alamsyah',
                'email' => 'kevin.alamsyah@gmail.com',
                'id_jurusan' => 3, // Teknik Komputer dan Jaringan
                'jk' => 'Laki-laki',
                'agama' => 'Kristen',
                'asal_sekolah' => 'SMP BPK Penabur Bandung',
                'nisn' => '0081293809',
                'tahun_lulus' => '2026',
                'jalur' => 'Reguler (Umum)',
                'no_hp' => '081223344509',
                'status' => 'Pending',
                'isAccepted' => 0,
                'tmp_lahir' => 'Bandung',
                'tgl_lahir' => '2008-03-08',
                'alamat' => 'Jl. Sudirman No. 512 RT 02 RW 03',
                'rt' => '02', 'rw' => '03', 'kel' => 'Dunguscariang', 'kec' => 'Andir', 'kota' => 'Kota Bandung', 'prov' => 'Jawa Barat',
                'ayah' => 'Johan Alamsyah', 'tel_ayah' => '082199887715',
                'ibu' => 'Maria Kristina', 'tel_ibu' => '082199887716',
                'tb' => '174', 'bb' => '65',
                'bayar_status' => 'pending',
                'bayar_file' => 'pendaftar/bukti_9.jpg'
            ],
            [
                'id' => 10,
                'kode' => 'ICB-2026-0010',
                'nis' => null,
                'nama' => 'Dewi Lestari',
                'email' => 'dewi.lestari@gmail.com',
                'id_jurusan' => 6, // Keperawatan
                'jk' => 'Perempuan',
                'agama' => 'Islam',
                'asal_sekolah' => 'SMPN 2 Bandung',
                'nisn' => '0081293810',
                'tahun_lulus' => '2026',
                'jalur' => 'Reguler (Umum)',
                'no_hp' => '081223344510',
                'status' => 'Pending',
                'isAccepted' => 0,
                'tmp_lahir' => 'Garut',
                'tgl_lahir' => '2008-12-01',
                'alamat' => 'Jl. Riau No. 99 RT 05 RW 07',
                'rt' => '05', 'rw' => '07', 'kel' => 'Cihapit', 'kec' => 'Bandung Wetan', 'kota' => 'Kota Bandung', 'prov' => 'Jawa Barat',
                'ayah' => 'Iwan Lestari', 'tel_ayah' => '082299887717',
                'ibu' => 'Lilis Suryani', 'tel_ibu' => '082299887718',
                'tb' => '155', 'bb' => '45',
                'bayar_status' => 'pending',
                'bayar_file' => 'pendaftar/bukti_10.jpg'
            ],
        ];

        foreach ($students as $st) {
            // 1. Siswa
            DB::table('siswas')->updateOrInsert(
                ['id' => $st['id']],
                [
                    'kode_pendaftaran' => $st['kode'],
                    'nis' => $st['nis'],
                    'nama' => $st['nama'],
                    'email' => $st['email'],
                    'password' => Hash::make('password123'),
                    'id_jurusan' => $st['id_jurusan'],
                    'jenis_kelamin' => $st['jk'],
                    'agama' => $st['agama'],
                    'asal_sekolah' => $st['asal_sekolah'],
                    'nisn' => $st['nisn'],
                    'tahun_lulus' => $st['tahun_lulus'],
                    'jalur_pendaftaran' => $st['jalur'],
                    'no_hp' => $st['no_hp'],
                    'mgm' => 0,
                    'nama_mgm' => null,
                    'asal_mgm' => null,
                    'isAccepted' => $st['isAccepted'],
                    'status' => $st['status'],
                    'created_at' => now()->subDays(10 - $st['id']),
                    'updated_at' => now()->subDays(10 - $st['id']),
                ]
            );

            // 2. Data Tambahan (Tanpa pekerjaan_orang_tua)
            DB::table('s_data_tambahans')->updateOrInsert(
                ['siswa_id' => $st['id']],
                [
                    'alamat' => $st['alamat'],
                    'rt' => $st['rt'],
                    'rw' => $st['rw'],
                    'kelurahan' => $st['kel'],
                    'kecamatan' => $st['kec'],
                    'kota' => $st['kota'],
                    'provinsi' => $st['prov'],
                    'alamat_sekolah_asal' => $st['alamat'],
                    'nama_ayah' => $st['ayah'],
                    'telepon_ayah' => $st['tel_ayah'],
                    'nama_ibu' => $st['ibu'],
                    'telepon_ibu' => $st['tel_ibu'],
                    'tinggi_badan' => $st['tb'],
                    'berat_badan' => $st['bb'],
                    'tempat_lahir' => $st['tmp_lahir'],
                    'tanggal_lahir' => $st['tgl_lahir'],
                    'nama_orang_tua' => $st['ayah'],
                    'alamat_orang_tua' => $st['alamat'],
                    'no_hp_orang_tua' => $st['tel_ayah'],
                    'created_at' => now()->subDays(10 - $st['id']),
                    'updated_at' => now()->subDays(10 - $st['id']),
                ]
            );

            // 3. Bukti Pembayaran
            DB::table('bukti_pembayarans')->updateOrInsert(
                ['siswa_id' => $st['id']],
                [
                    'file_name' => basename($st['bayar_file']),
                    'file_path' => $st['bayar_file'],
                    'payment_type' => 'transfer',
                    'account_name' => $st['nama'],
                    'amount' => 200000.00,
                    'payment_date' => now()->subDays(10 - $st['id'])->toDateString(),
                    'status' => $st['bayar_status'],
                    'alasan' => $st['bayar_status'] === 'rejected' ? 'Bukti transfer tidak terbaca atau nominal tidak sesuai.' : null,
                    'created_at' => now()->subDays(10 - $st['id']),
                    'updated_at' => now()->subDays(10 - $st['id']),
                ]
            );
        }
    }
}

