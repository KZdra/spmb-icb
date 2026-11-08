<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Tambah Kolom ke pengaturan_aplikasis
        Schema::table('pengaturan_aplikasis', function (Blueprint $table) {
            $table->string('hero_image_path')->nullable()->after('hero_badge');
            $table->string('brosur_panduan_path')->nullable()->after('panduan_desc');
            $table->string('brosur_syarat_path')->nullable()->after('brosur_panduan_path');
            $table->string('brosur_alur_path')->nullable()->after('brosur_syarat_path');
            $table->date('tanggal_tutup_gelombang')->nullable()->after('gelombang_aktif');
            $table->string('sosmed_instagram')->nullable()->after('alamat_sekolah');
            $table->string('sosmed_tiktok')->nullable()->after('sosmed_instagram');
            $table->string('sosmed_youtube')->nullable()->after('sosmed_tiktok');
            $table->string('sosmed_facebook')->nullable()->after('sosmed_youtube');
            $table->string('stat_akreditasi')->default('A (Unggul)')->after('slogan');
            $table->string('stat_lulusan_kerja')->default('95%+')->after('stat_akreditasi');
            $table->string('stat_mitra_industri')->default('50+')->after('stat_lulusan_kerja');
            $table->string('stat_ekskul_lab')->default('15+')->after('stat_mitra_industri');
        });

        // 2. Tabel FAQs Dinamis
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('pertanyaan');
            $table->text('jawaban');
            $table->string('kategori')->default('Umum');
            $table->integer('urutan')->default(1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 3. Tabel Mitra Industri / DU/DI
        Schema::create('mitra_industris', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mitra');
            $table->string('logo_path')->nullable();
            $table->string('bidang')->nullable(); // misal Perbankan, IT, Otomotif, dll
            $table->integer('urutan')->default(1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 4. Tabel Testimoni Alumni & Siswa
        Schema::create('testimonis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('profesi_alumni'); // e.g. Staff Akuntansi Bank Mandiri / Mahasiswa ITB
            $table->string('tahun_lulus')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('foto_path')->nullable();
            $table->text('testimoni');
            $table->integer('urutan')->default(1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonis');
        Schema::dropIfExists('mitra_industris');
        Schema::dropIfExists('faqs');

        Schema::table('pengaturan_aplikasis', function (Blueprint $table) {
            $table->dropColumn([
                'hero_image_path',
                'brosur_panduan_path',
                'brosur_syarat_path',
                'brosur_alur_path',
                'tanggal_tutup_gelombang',
                'sosmed_instagram',
                'sosmed_tiktok',
                'sosmed_youtube',
                'sosmed_facebook',
                'stat_akreditasi',
                'stat_lulusan_kerja',
                'stat_mitra_industri',
                'stat_ekskul_lab',
            ]);
        });
    }
};
