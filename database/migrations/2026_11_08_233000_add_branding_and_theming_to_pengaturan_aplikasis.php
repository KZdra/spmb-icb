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
        Schema::table('pengaturan_aplikasis', function (Blueprint $table) {
            // Branding & Warna Tema (Customizable)
            $table->string('primary_color', 10)->default('#1A56DB')->after('logo_path');
            $table->string('secondary_color', 10)->default('#0B3B7B')->after('primary_color');
            $table->string('accent_color', 10)->default('#10B981')->after('secondary_color');
            $table->string('favicon_path')->nullable()->after('accent_color');

            // Konten Landing Page & Slogan
            $table->string('slogan')->nullable()->after('alamat_sekolah');
            $table->string('hero_title')->nullable()->after('slogan');
            $table->text('hero_subtitle')->nullable()->after('hero_title');

            // Status Pendaftaran & Gelombang
            $table->enum('status_pendaftaran', ['buka', 'tutup'])->default('buka')->after('tahun_ajaran');
            $table->string('gelombang_aktif', 50)->default('Gelombang 1')->after('status_pendaftaran');
            $table->text('pesan_penutupan')->nullable()->after('gelombang_aktif');

            // Template WhatsApp & Cetak PDF
            $table->text('wa_template_lulus')->nullable()->after('email_notifikasi');
            $table->text('wa_template_revisi')->nullable()->after('wa_template_lulus');
            $table->text('pdf_catatan_kaki')->nullable()->after('wa_template_revisi');
            $table->string('pdf_penandatangan', 100)->nullable()->after('pdf_catatan_kaki');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaturan_aplikasis', function (Blueprint $table) {
            $table->dropColumn([
                'primary_color',
                'secondary_color',
                'accent_color',
                'favicon_path',
                'slogan',
                'hero_title',
                'hero_subtitle',
                'status_pendaftaran',
                'gelombang_aktif',
                'pesan_penutupan',
                'wa_template_lulus',
                'wa_template_revisi',
                'pdf_catatan_kaki',
                'pdf_penandatangan'
            ]);
        });
    }
};

