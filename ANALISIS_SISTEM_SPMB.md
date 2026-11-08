# DOKUMENTASI & ANALISIS LENGKAP SISTEM SPMB / PPDB ONLINE
**Aplikasi: Sistem Penerimaan Murid Baru (SPMB) SMK ICB Cinta Teknika Bandung**  
**Tech Stack:** Laravel 11.x | PHP 8.2+ | MySQL | AdminLTE 3 / Bootstrap | Select2 | DataTables | PhpSpreadsheet

---

## 1. Ringkasan Eksekutif & Karakteristik Sistem

Aplikasi ini adalah platform digital terintegrasi untuk menangani seluruh rangkaian Penerimaan Peserta Didik Baru (PPDB / SPMB), mulai dari penjaringan calon siswa melalui landing page publik, pengisian formulir pendaftaran interaktif 7 langkah, unggah bukti bayar instan, pengecekan status mandiri, hingga verifikasi terpusat satu pintu oleh panitia dengan penerbitan Nomor Induk Siswa (NIS) otomatis serta notifikasi kelulusan via email.

### Keunggulan Arsitektur Utama:
1. **Model Single-Stream (Tanpa Beban Login Siswa):**  
   Calon siswa tidak diwajibkan mendaftar akun atau mengingat password portal. Pendaftaran dilakukan langsung, diverifikasi dengan kode unik, dan status dapat dipantau hanya dengan memasukkan Kode Pendaftaran, NISN, atau Email.
2. **Formulir 7 Langkah dengan Auto-Save Draft (LocalStorage):**  
   Pendaftar tidak perlu khawatir kehilangan data saat browser ter-refresh atau koneksi terputus. Sistem secara cerdas menyimpan draft di peramban dan memulihkannya secara otomatis.
3. **Verifikasi Satu Pintu (Single-Modal Review):**  
   Panitia dapat meninjau biodata lengkap siswa, data orang tua, sekolah asal, dan foto bukti transfer dalam satu modal, lalu memvalidasi pembayaran dan menerbitkan NIS secara instan.
4. **Penerbitan NIS Otomatis & Atomic (Anti-Race Condition):**  
   Menggunakan penguncian baris basis data (`lockForUpdate()`) agar tidak terjadi duplikasi atau lompatan nomor NIS meskipun banyak panitia melakukan verifikasi bersamaan.
5. **Ekspor Rekapitulasi Excel Profesional (.xlsx):**  
   Mendukung ekspor data 32 kolom lengkap dengan styling resmi, zebra-striping, pewarnaan badge status, dan freeze pane untuk kebutuhan administrasi sekolah dan Dinas Pendidikan.

---

## 2. Struktur Entitas Basis Data (Entity Relationship Diagram)

```mermaid
erDiagram
    ROLES ||--o{ USERS : "memiliki"
    USERS {
        bigint id PK
        string name
        string email
        string password
        bigint role_id FK
    }
    ROLES {
        bigint id PK
        string name
    }
    M_JURUSANS ||--o{ SISWAS : "dipilih oleh"
    M_JURUSANS {
        bigint id PK
        string nama_jurusan
        bigint spp
        bigint dsp
    }
    SISWAS ||--|| S_DATA_TAMBAHANS : "memiliki detail"
    SISWAS ||--|| BUKTI_PEMBAYARANS : "memiliki bukti"
    SISWAS ||--|| BERKAS_TAMBAHANS : "memiliki berkas"
    SISWAS {
        bigint id PK
        string kode_pendaftaran
        string nis
        string nama
        string email
        string nisn
        string jenis_kelamin
        string agama
        string asal_sekolah
        string tahun_lulus
        string jalur_pendaftaran
        bigint id_jurusan FK
        string no_hp
        string status
        boolean isAccepted
    }
    S_DATA_TAMBAHANS {
        bigint id PK
        bigint siswa_id FK
        string tempat_lahir
        date tanggal_lahir
        text alamat
        string rt
        string rw
        string kelurahan
        string kecamatan
        string kota
        string provinsi
        string nama_ayah
        string telepon_ayah
        string nama_ibu
        string telepon_ibu
        float tinggi_badan
        float berat_badan
    }
    BUKTI_PEMBAYARANS {
        bigint id PK
        bigint siswa_id FK
        string file_name
        string file_path
        decimal amount
        string status
        text alasan
    }
    PENGATURAN_APLIKASIS {
        bigint id PK
        string app_name
        string logo_path
        string bank_name
        string no_rekening
        string atas_nama
        decimal biaya_pendaftaran
        string kontak_wa
        string tahun_ajaran
        string nis_prefix
        integer nis_start_number
    }
    NIS_COUNTERS {
        bigint id PK
        integer last_number
    }
    ARTICLES {
        bigint id PK
        string judul
        string slug
        string kategori
        text konten
        string gambar
        boolean isPublished
    }
```

---

## 3. Diagram Alur Kerja Sistem (Workflows)

### A. Alur Calon Siswa (Public User Flow)

```mermaid
flowchart TD
    Start([Calon Siswa Buka Website]) --> Landing[Landing Page Profil, Jurusan, Biaya, Berita]
    Landing --> DaftarBtn[Klik 'Daftar Sekarang']
    
    subgraph MultiStepForm ["Formulir 7 Langkah (Auto-Save LocalStorage)"]
        S1["Step 1: Jalur & Pilihan Jurusan"] --> S2["Step 2: Data Diri (Nama, NISN, TTL, JK)"]
        S2 --> S3["Step 3: Alamat Domisili Lengkap (RT/RW/Kota)"]
        S3 --> S4["Step 4: Kontak (No HP/WA & Email Aktif)"]
        S4 --> S5["Step 5: Sekolah Asal & Tahun Kelulusan"]
        S5 --> S6["Step 6: Data Orang Tua / Wali & Fisik"]
        S6 --> S7["Step 7: Upload Bukti Transfer & Konfirmasi"]
    end
    
    DaftarBtn --> MultiStepForm
    MultiStepForm --> Submit[Kirim Formulir Pendaftaran]
    
    Submit --> DBTrans{Database Transaction}
    DBTrans -->|Gagal| Rollback[Tampilkan Alert Kesalahan & Rollback Data]
    DBTrans -->|Berhasil| Commit["1. Generate Kode Unik: ICB-YYYY-XXXX<br/>2. Simpan Data Pokok & Tambahan<br/>3. Simpan File Bukti Bayar ke Disk"]
    
    Commit --> SuksesView["Halaman Tanda Terima Resmi (/pendaftaran/sukses)"]
    SuksesView --> CetakReceipt[Cetak Kartu Tanda Terima / Unduh PDF]
    
    CetakReceipt -.-> PantauStatus["Calon Siswa Memantau Status via /cek-status<br/>(Cukup Input Kode, NISN, atau Email)"]
```

### B. Alur Panitia & Administrator (Admin Flow)

```mermaid
flowchart TD
    Admin[Admin / Operator] --> Login[Login via /login]
    Login --> Dashboard[Dashboard Statistik Ringkas]
    Dashboard --> VerifMenu[Menu Verifikasi Siswa Terpadu]
    
    VerifMenu --> ActionSelection{Pilihan Tindakan}
    
    %% Opsi 1: Verifikasi Tunggal
    ActionSelection -->|Klik Baris Siswa| OpenModal[Buka Modal Detail Siswa 1 Pintu]
    OpenModal --> ReviewData[Periksa Biodata, Orang Tua, & Bukti Transfer]
    ReviewData --> DecStatus{Keputusan Verifikasi}
    
    DecStatus -->|Validasi Bayar Saja| DirectPay[Update Status Bayar: 'verified']
    DecStatus -->|Tolak Bayar Saja| RejectPay[Update Status Bayar: 'rejected' + Alasan]
    
    DecStatus -->|Terima Siswa| ApproveAction["1. Kunci Baris Counter (lockForUpdate)<br/>2. Generate NIS Resmi (Prefix + Counter)<br/>3. Set Status Siswa: 'Diterima'<br/>4. Set Status Bayar: 'verified'<br/>5. Kirim Surat Kelulusan via Email"]
    DecStatus -->|Tolak Siswa| RejectAction[Set Status Siswa: 'Ditolak']
    
    %% Opsi 2: Terima Massal
    ActionSelection -->|Klik 'Terima Semua'| BulkApprove["Iterasi Seluruh Siswa Status Pending:<br/>- Terbitkan NIS berurutan otomatis<br/>- Ubah status menjadi 'Diterima'<br/>- Kirim email kelulusan serentak"]
    
    %% Opsi 3: Ekspor Laporan
    ActionSelection -->|Klik 'Unduh Rekap Excel'| ExportReport["Generate Spreadsheet .xlsx 32 Kolom<br/>Format Siap Cetak & Lengkap Sesuai Filter"]
```

---

## 4. Bedah Fungsionalitas Modul & Kode

### 1. Pendaftaran Publik (`SiswaController.php`)
* **Endpoint:** `GET /siswa/register`, `POST /siswa/register`
* **Fitur Utama:**
  * Validasi komprehensif (keberadaan ID jurusan, keunikan email siswa, ukuran file bukti maksimal 10MB).
  * Pembuatan kode registrasi sekuensial tahunan: `ICB-{TAHUN}-{0001}`.
  * Penyimpanan file upload ke direktori terisolasi: `storage/app/public/pendaftar/{nama_siswa}/bukti_bayar/`.
* **Cek Status Mandiri (`cekStatusPost`):**
  * Pencarian fleksibel multi-kriteria: `WHERE kode_pendaftaran = ? OR nisn = ? OR email = ?`.
  * Menampilkan badge kelulusan, nomor NIS (jika sudah diterima), dan keabsahan pembayaran beserta catatan penolakan jika bukti tidak terbaca.

### 2. Panel Verifikasi Terpadu (`VerifikasiSiswaController.php`)
* **Endpoint:** `/admin/verifsiswa`
* **Fitur Utama:**
  * **Mesin Penomoran NIS Atomic (`generateNIS`):**
    Mengambil format prefix (misal: `125`) dan nomor awal dari tabel pengaturan. Menggunakan `DB::table('nis_counters')->lockForUpdate()` untuk menjamin nomor urut tidak pernah bentrok atau kembar. Mendukung input *Custom NIS* manual bila diperlukan.
  * **Verifikasi Cepat 1 Pintu:** Admin dapat menyetujui, menolak, memvalidasi bukti bayar, atau menolak bayar langsung dari satu modal tampilan.
  * **Penerimaan Massal (`approveAll`):** Mengakomodasi kebutuhan panitia saat rapat pleno kelulusan: memproses puluhan/ratusan siswa pending menjadi diterima hanya dalam sekali klik.
  * **Ekspor Excel Tingkat Mahir (`exportXlsx`):** Menggunakan PhpSpreadsheet untuk menyusun dokumen rekapitulasi 32 kolom lengkap dengan kop surat sekolah, pewarnaan otomatis baris, styling status (hijau/kuning/merah), dan freeze pane.

### 3. Pengaturan Sistem Dinamis (`PengaturanAplikasiController.php`)
* **Endpoint:** `/admin/settings`
* Mengendalikan identitas sekolah, upload logo, konfigurasi nomor rekening bank dan biaya formulir, nomor WhatsApp bantuan panitia, tahun ajaran aktif, serta parameter generator NIS.
* Dilengkapi sistem cache memory (`Cache::rememberForever`) untuk memastikan query pengaturan tidak memperlambat respon web.

### 4. Surat Keputusan Elektronik (`PengumumanKelulusanMail.php`)
* Mengirimkan email surat ketetapan kelulusan formal berformat HTML responsif kepada calon siswa begitu status diubah menjadi `Diterima`.
* Memuat kop surat digital, ucapan selamat resmi, NIS resmi yang diterbitkan, jurusan yang diterima, dan panduan langkah daftar ulang berikutnya.

### 5. CMS Berita & Artikel (`ArticleController.php`)
* **Endpoint:** `/admin/articles`
* Mengelola publikasi artikel, tata cara pendaftaran, dan informasi beasiswa di halaman landing page publik.
* Dilengkapi pembuatan URL ramah SEO (*slug generator* otomatis), upload gambar unggulan, dan editor konten.

---

## 5. Ringkasan Keunggulan untuk Yayasan & Sekolah Mitra

Sistem ini memiliki sifat **Multi-Tenant Ready** atau sangat mudah diadaptasi untuk unit sekolah lain di bawah naungan yayasan yang sama (seperti SMK ICB Cinta Niaga dan SMK ICB Cinta Wisata). Seluruh parameter biaya, rekening tujuan, jurusan, logo, format nomor induk, dan narasi pengumuman bersifat dinamis 100% dari panel admin tanpa perlu mengubah kode sumber inti.

