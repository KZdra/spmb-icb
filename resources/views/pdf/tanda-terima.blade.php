<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Tanda Terima Pendaftaran - {{ $siswa->kode_pendaftaran }}</title>
    <style>
        @page {
            margin: 8mm 12mm 6mm 12mm;
            size: a4 portrait;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 8.5pt;
            color: #1a1a1a;
            line-height: 1.3;
            margin: 0;
            padding: 0;
        }

        /* Kop Surat */
        .kop-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2px;
        }

        .kop-logo {
            width: 65px;
            vertical-align: middle;
            text-align: center;
        }

        .kop-logo img {
            max-width: 60px;
            max-height: 60px;
        }

        .kop-text {
            text-align: center;
            vertical-align: middle;
            padding: 0 8px;
        }

        .kop-yayasan {
            font-size: 9pt;
            font-weight: normal;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin: 0;
        }

        .kop-sekolah {
            font-size: 13pt;
            font-weight: bold;
            color: #0b3b7b;
            letter-spacing: 0.8px;
            margin: 1px 0;
            text-transform: uppercase;
        }

        .kop-alamat {
            font-size: 7.5pt;
            color: #444;
            margin: 0;
            line-height: 1.25;
        }

        .kop-kontak {
            font-size: 7.5pt;
            color: #333;
            margin-top: 1px;
        }

        /* Garis Ganda Kop Surat */
        .kop-divider-thick {
            border-top: 2px solid #000;
            margin-top: 3px;
            margin-bottom: 1px;
        }

        .kop-divider-thin {
            border-top: 0.8px solid #000;
            margin-bottom: 8px;
        }

        /* Judul Dokumen */
        .doc-title-box {
            text-align: center;
            margin-bottom: 8px;
        }

        .doc-title {
            font-size: 11pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 0;
            color: #111;
        }

        .doc-subtitle {
            font-size: 9pt;
            font-weight: bold;
            color: #0b3b7b;
            margin: 1px 0 0 0;
        }

        .reg-number-badge {
            display: inline-block;
            background: #f1f5f9;
            border: 1px dashed #64748b;
            padding: 2px 10px;
            border-radius: 4px;
            font-family: 'Courier New', Courier, monospace;
            font-size: 9.5pt;
            font-weight: bold;
            color: #0f172a;
            margin-top: 3px;
        }

        /* Header Data Table with QR */
        .summary-header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
        }

        .section-header {
            background-color: #0b3b7b;
            color: #ffffff;
            font-size: 8pt;
            font-weight: bold;
            padding: 3px 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-radius: 2px 2px 0 0;
            margin-top: 4px;
        }

        /* Tabel Data Siswa */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
            font-size: 8pt;
        }

        .data-table th, .data-table td {
            padding: 2.5px 6px;
            vertical-align: top;
            border: 1px solid #cbd5e1;
        }

        .data-table th {
            width: 30%;
            background-color: #f8fafc;
            color: #334155;
            font-weight: 600;
            text-align: left;
        }

        .data-table td {
            color: #0f172a;
        }

        .badge-status {
            display: inline-block;
            padding: 1.5px 6px;
            font-size: 7.5pt;
            font-weight: bold;
            border-radius: 3px;
        }

        .badge-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
        }

        .badge-warning {
            background: #fef9c3;
            color: #854d0e;
            border: 1px solid #fde047;
        }

        .badge-primary {
            background: #dbeafe;
            color: #1e40af;
            border: 1px solid #93c5fd;
        }

        /* Petunjuk Box */
        .info-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-left: 3px solid #0b3b7b;
            border-radius: 4px;
            padding: 4px 8px;
            margin-bottom: 8px;
            font-size: 7.5pt;
            line-height: 1.35;
        }

        .info-box h4 {
            margin: 0 0 2px 0;
            font-size: 8pt;
            color: #0b3b7b;
            font-weight: bold;
        }

        .info-box ol {
            margin: 0;
            padding-left: 14px;
            color: #334155;
        }

        .info-box li {
            margin-bottom: 1px;
        }

        /* Tanda Tangan */
        .ttd-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 4px;
            font-size: 8pt;
        }

        .ttd-table td {
            width: 50%;
            text-align: center;
            vertical-align: top;
            padding: 0 10px;
        }

        .ttd-space {
            height: 35px;
        }

        .ttd-name {
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
            font-size: 8pt;
        }

        /* Watermark Footer */
        .pdf-footer {
            margin-top: 6px;
            border-top: 1px dashed #cbd5e1;
            padding-top: 3px;
            font-size: 6.8pt;
            color: #64748b;
            text-align: center;
            line-height: 1.25;
        }
    </style>
</head>
<body>

    <!-- KOP SURAT RESMI -->
    <table class="kop-table">
        <tr>
            <td class="kop-logo">
                @if(!empty($logoBase64))
                    <img src="{{ $logoBase64 }}" alt="Logo">
                @endif
            </td>
            <td class="kop-text">
                <div class="kop-yayasan">{{ $setting->kop_yayasan ?? 'YAYASAN PENDIDIKAN DAN KEJURUAN INDONESIA' }}</div>
                <div class="kop-sekolah">{{ strtoupper($setting->atas_nama ?? ($setting->app_name ?? 'SMK ICB CINTA TEKNIKA')) }}</div>
                <div class="kop-alamat">
                    {{ $setting->alamat ?? 'Jl. Atlas Tengah No. 2, Babakan Surabaya, Kec. Kiaracondong, Kota Bandung, Jawa Barat 40281' }}
                </div>
                <div class="kop-kontak">
                    Telp: {{ $setting->kontak_telepon ?? '022-7201456' }} &bull; 
                    WhatsApp: {{ $setting->kontak_wa ?? '0812-2248-5558' }} &bull; 
                    Email: {{ $setting->kontak_email ?? 'info@smkicb.sch.id' }} &bull; 
                    Website: {{ url('/') }}
                </div>
            </td>
        </tr>
    </table>

    <div class="kop-divider-thick"></div>
    <div class="kop-divider-thin"></div>

    <!-- JUDUL DOKUMEN & KODE -->
    <div class="doc-title-box">
        <h1 class="doc-title">TANDA TERIMA PENDAFTARAN CALON SISWA BARU</h1>
        <div class="doc-subtitle">TAHUN AJARAN {{ $setting->tahun_ajaran ?? '2027/2028' }}</div>
        <div>
            <span class="reg-number-badge">NO. REGISTRASI: {{ $siswa->kode_pendaftaran }}</span>
        </div>
    </div>

    <!-- SUMMARY CARD + QR CODE -->
    <table class="summary-header-table">
        <tr>
            <td style="vertical-align: middle;">
                <div style="font-size: 8pt; color: #475569; line-height: 1.3;">
                    Dokumen ini adalah bukti resmi bahwa calon siswa berikut telah terdaftar dalam sistem SPMB Online <strong>{{ $setting->atas_nama ?? 'SMK ICB Cinta Teknika' }}</strong>.
                </div>
            </td>
            <td style="width: 65px; text-align: right; vertical-align: middle;">
                @if(!empty($qrBase64))
                    <img src="{{ $qrBase64 }}" alt="QR Code" style="width: 55px; height: 55px; border: 1px solid #cbd5e1; padding: 2px;">
                @endif
            </td>
        </tr>
    </table>

    <!-- SECTION: DATA PENDAFTARAN -->
    <div class="section-header">I. DATA PILIHAN PENDAFTARAN</div>
    <table class="data-table">
        <tr>
            <th>Nomor Registrasi / Kode</th>
            <td><strong>{{ $siswa->kode_pendaftaran }}</strong></td>
        </tr>
        <tr>
            <th>Waktu Pendaftaran</th>
            <td>{{ \Carbon\Carbon::parse($siswa->created_at)->translatedFormat('l, d F Y - H:i') }} WIB</td>
        </tr>
        <tr>
            <th>Jalur Pendaftaran</th>
            <td><span class="badge-status badge-primary">{{ $siswa->jalur_pendaftaran ?? 'Reguler (Umum)' }}</span></td>
        </tr>
        <tr>
            <th>Pilihan Jurusan / Kompetensi</th>
            <td><strong style="color: #0b3b7b;">{{ $siswa->nama_jurusan ?? '-' }}</strong></td>
        </tr>
    </table>

    <!-- SECTION: BIODATA CALON SISWA -->
    <div class="section-header">II. BIODATA PRIBADI CALON SISWA</div>
    <table class="data-table">
        <tr>
            <th>Nama Lengkap Siswa</th>
            <td><strong>{{ strtoupper($siswa->nama) }}</strong></td>
        </tr>
        <tr>
            <th>NISN & Jenis Kelamin</th>
            <td>{{ $siswa->nisn ?? '-' }} &bull; {{ $siswa->jenis_kelamin ?? '-' }}</td>
        </tr>
        <tr>
            <th>Tempat, Tanggal Lahir</th>
            <td>{{ $siswa->tempat_lahir ?? '-' }}, {{ !empty($siswa->tanggal_lahir) ? \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') : '-' }}</td>
        </tr>
        <tr>
            <th>Agama & Kepercayaan</th>
            <td>{{ $siswa->agama ?? '-' }}</td>
        </tr>
        <tr>
            <th>Asal Sekolah (SMP/MTs)</th>
            <td><strong>{{ $siswa->asal_sekolah ?? '-' }}</strong> (Lulus {{ $siswa->tahun_lulus ?? date('Y') }})</td>
        </tr>
        <tr>
            <th>Alamat Domisili Siswa</th>
            <td>
                {{ $siswa->alamat ?? '-' }}
                @if(!empty($siswa->rt) || !empty($siswa->rw))
                    , RT {{ $siswa->rt ?? '0' }}/RW {{ $siswa->rw ?? '0' }}
                @endif
                <br>
                Kel. {{ $siswa->kelurahan ?? '-' }}, Kec. {{ $siswa->kecamatan ?? '-' }}, {{ $siswa->kota ?? '-' }}, {{ $siswa->provinsi ?? '-' }}
            </td>
        </tr>
        <tr>
            <th>Kontak Siswa</th>
            <td>WhatsApp: {{ $siswa->no_hp ?? '-' }} &bull; Email: {{ $siswa->email ?? '-' }}</td>
        </tr>
        <tr>
            <th>Nama Orang Tua / Wali</th>
            <td>
                Ayah: {{ $siswa->nama_ayah ?? '-' }} ({{ $siswa->telepon_ayah ?? '-' }})<br>
                Ibu: {{ $siswa->nama_ibu ?? '-' }} ({{ $siswa->telepon_ibu ?? '-' }})
            </td>
        </tr>
        <tr>
            <th>Status Administrasi & Berkas</th>
            <td>
                @if(strtolower($siswa->status_bayar ?? '') === 'valid' || strtolower($siswa->status ?? '') === 'diterima')
                    <span class="badge-status badge-success">Terverifikasi / Lunas</span>
                @else
                    <span class="badge-status badge-warning">Menunggu Verifikasi Panitia</span>
                @endif
                <span style="color: #64748b; font-size: 8.5pt; margin-left: 6px;">(Biaya Formulir: Rp {{ number_format($setting->biaya_pendaftaran ?? 200000, 0, ',', '.') }})</span>
            </td>
        </tr>
    </table>

    <!-- PETUNJUK & CATATAN RESMI -->
    <div class="info-box">
        <h4>PETUNJUK & LANGKAH SELANJUTNYA:</h4>
        <ol>
            <li>Simpan atau cetak lembar tanda terima pendaftaran ini sebagai bukti registrasi yang sah.</li>
            <li>Bawalah lembar tanda terima ini beserta berkas fotokopi (Kartu Keluarga, Akta Kelahiran, dan Ijazah/SKL) saat jadwal tes wawancara atau verifikasi fisik di kampus sekolah.</li>
            <li>{{ $setting->pdf_catatan_kaki ?? 'Hasil seleksi akhir dan Nomor Induk Siswa (NIS) resmi akan dikirimkan melalui email pendaftar serta dapat dicek pada menu Cek Status di website resmi.' }}</li>
        </ol>
    </div>

    <!-- TANDA TANGAN (2 KOLOM) -->
    <table class="ttd-table">
        <tr>
            <td>
                Calon Siswa / Orang Tua Wali,
                <div class="ttd-space"></div>
                <div class="ttd-name">{{ strtoupper($siswa->nama) }}</div>
                <div style="font-size: 8pt; color: #64748b;">Tanda Tangan & Nama Terang</div>
            </td>
            <td>
                {{ $setting->kota_administrasi ?? 'Bandung' }}, {{ now()->translatedFormat('d F Y') }}<br>
                Panitia Penerimaan Murid Baru,
                <div class="ttd-space"></div>
                <div class="ttd-name">{{ $setting->pdf_penandatangan ?? 'Ketua Panitia SPMB' }}</div>
                <div style="font-size: 8pt; color: #64748b;">NIP/NUPTK Panitia SPMB</div>
            </td>
        </tr>
    </table>

    <!-- WATERMARK / FOOTER -->
    <div class="pdf-footer">
        Dokumen ini diterbitkan secara resmi melalui Sistem Informasi Penerimaan Murid Baru (SPMB Online) {{ $setting->atas_nama ?? ($setting->app_name ?? 'SMK ICB Cinta Teknika') }}.<br>
        Dicetak pada: {{ now()->translatedFormat('d F Y, H:i:s') }} WIB &bull; Kode Keamanan: {{ strtoupper(substr(md5($siswa->kode_pendaftaran . ($siswa->created_at ?? '')), 0, 16)) }}
    </div>

</body>
</html>

