<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keputusan Kelulusan SPMB</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #1E293B;
            background-color: #F8FAFC;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #FFFFFF;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            border: 1px solid #E2E8F0;
        }
        .header {
            background: linear-gradient(135deg, #0B3B7B 0%, #1A56DB 100%);
            color: #FFFFFF;
            padding: 30px 24px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            letter-spacing: 0.5px;
        }
        .header p {
            margin: 6px 0 0 0;
            font-size: 13px;
            opacity: 0.9;
        }
        .content {
            padding: 28px 24px;
            line-height: 1.6;
            font-size: 14px;
        }
        .badge-success {
            display: inline-block;
            background-color: #DEF7EC;
            color: #03543F;
            font-weight: bold;
            padding: 6px 14px;
            border-radius: 9999px;
            font-size: 13px;
            margin-bottom: 16px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 13.5px;
        }
        .info-table td {
            padding: 10px 12px;
            border-bottom: 1px solid #F1F5F9;
        }
        .info-table td.label {
            width: 40%;
            font-weight: bold;
            color: #475569;
            background-color: #F8FAFC;
        }
        .nis-box {
            background: #EFF6FF;
            border: 2px dashed #1A56DB;
            border-radius: 10px;
            padding: 16px;
            text-align: center;
            margin: 20px 0;
        }
        .nis-number {
            font-size: 24px;
            font-weight: bold;
            color: #0B3B7B;
            letter-spacing: 2px;
        }
        .next-steps {
            background: #FDFDEA;
            border-left: 4px solid #E3A008;
            padding: 14px;
            border-radius: 4px;
            margin: 20px 0;
            font-size: 13px;
        }
        .footer {
            background-color: #F8FAFC;
            padding: 18px 24px;
            font-size: 12px;
            color: #64748B;
            text-align: center;
            border-top: 1px solid #E2E8F0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $setting->app_name ?? 'SMK ICB CINTA TEKNIKA' }}</h1>
            <p>Penerimaan Peserta Didik Baru (SPMB) Tahun Ajaran {{ $setting->tahun_ajaran ?? '2027/2028' }}</p>
        </div>

        <div class="content">
            <span class="badge-success">✓ DITERIMA & LOLOS SELEKSI</span>

            <p>Kepada Yth. <strong>{{ $siswa->nama }}</strong> / Orang Tua - Wali,</p>

            <p>
                Berdasarkan hasil verifikasi berkas administrasi dan penilaian seleksi panitia SPMB <strong>{{ $setting->app_name ?? 'SMK ICB Cinta Teknika' }}</strong>, dengan ini kami sampaikan bahwa Anda dinyatakan:
            </p>

            <div style="text-align: center; margin: 15px 0;">
                <h2 style="color: #046C4E; margin: 0; font-size: 22px;">SELAMAT, ANDA DITERIMA!</h2>
            </div>

            <div class="nis-box">
                <div style="font-size: 12px; color: #4B5563; text-transform: uppercase;">Nomor Induk Siswa (NIS) Resmi:</div>
                <div class="nis-number">{{ $siswa->nis }}</div>
            </div>

            <table class="info-table">
                <tr>
                    <td class="label">Kode Pendaftaran</td>
                    <td><strong>{{ $siswa->kode_pendaftaran ?? ('REG-' . $siswa->id) }}</strong></td>
                </tr>
                <tr>
                    <td class="label">Nama Lengkap Siswa</td>
                    <td>{{ $siswa->nama }}</td>
                </tr>
                <tr>
                    <td class="label">Pilihan Jurusan</td>
                    <td><strong>{{ $siswa->jurusan?->nama_jurusan ?? '-' }}</strong></td>
                </tr>
                <tr>
                    <td class="label">Jalur Pendaftaran</td>
                    <td>{{ $siswa->jalur_pendaftaran }}</td>
                </tr>
                <tr>
                    <td class="label">Asal Sekolah</td>
                    <td>{{ $siswa->asal_sekolah }}</td>
                </tr>
                <tr>
                    <td class="label">NISN</td>
                    <td>{{ $siswa->nisn ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Tanggal Verifikasi</td>
                    <td>{{ date('d F Y') }}</td>
                </tr>
            </table>

            <div class="next-steps">
                <strong>Langkah Selanjutnya (Daftar Ulang):</strong>
                <ol style="margin: 8px 0 0 0; padding-left: 20px;">
                    <li>Calon siswa wajib hadir melakukan daftar ulang ke sekolah sesuai jadwal dengan membawa dokumen fisik asli dan fotokopi (Ijazah/SKL, Kartu Keluarga, Akta Kelahiran, Surat Kelakuan Baik, dan Pas Foto).</li>
                    <li>Menyelesaikan administrasi cicilan pertama.</li>
                    <li>Mempersiapkan diri untuk kegiatan Masa Pengenalan Lingkungan Sekolah (MPLS).</li>
                </ol>
            </div>

            <p>
                Jika ada pertanyaan mengenai proses daftar ulang, silakan menghubungi Panitia SPMB melalui WhatsApp: 
                <a href="{{ wa_link($setting->kontak_wa ?? '6281222223333', 'Halo Panitia SPMB, saya ingin konfirmasi daftar ulang atas nama ' . $siswa->nama . ' (NIS: ' . $siswa->nis . ')') }}" style="color: #1A56DB; font-weight: bold;">
                    +{{ $setting->kontak_wa ?? '6281222223333' }}
                </a>.
            </p>

            <p style="margin-top: 25px;">
                Hormat kami,<br>
                <strong>Panitia SPMB {{ $setting->app_name ?? 'SMK ICB Cinta Teknika' }}</strong>
            </p>
        </div>

        <div class="footer">
            {{ $setting->alamat_sekolah ?? 'Bandung, Jawa Barat' }}<br>
            Email ini dibuat secara otomatis oleh Sistem SPMB Resmi.
        </div>
    </div>
</body>
</html>
