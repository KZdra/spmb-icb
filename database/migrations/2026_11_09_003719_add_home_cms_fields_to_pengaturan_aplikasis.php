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
            $table->string('hero_badge')->nullable()->after('hero_subtitle');
            $table->string('hero_cta_text')->nullable()->after('hero_badge');
            $table->string('panduan_title')->nullable()->after('hero_cta_text');
            $table->text('panduan_desc')->nullable()->after('panduan_title');
            $table->string('cta_banner_title')->nullable()->after('panduan_desc');
            $table->text('cta_banner_desc')->nullable()->after('cta_banner_title');
            $table->text('tentang_sekolah')->nullable()->after('cta_banner_desc');
            $table->string('jam_pelayanan')->nullable()->after('tentang_sekolah');
            $table->string('video_profil_url')->nullable()->after('jam_pelayanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaturan_aplikasis', function (Blueprint $table) {
            $table->dropColumn([
                'hero_badge',
                'hero_cta_text',
                'panduan_title',
                'panduan_desc',
                'cta_banner_title',
                'cta_banner_desc',
                'tentang_sekolah',
                'jam_pelayanan',
                'video_profil_url',
            ]);
        });
    }
};
