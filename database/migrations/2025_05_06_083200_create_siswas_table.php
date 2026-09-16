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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pendaftaran')->nullable()->unique();
            $table->string('nis', 50)->nullable()->unique();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('id_jurusan')->constrained('m_jurusans')->onDelete('restrict');
            $table->string('jenis_kelamin', 50);
            $table->string('agama', 50);
            $table->string('asal_sekolah');
            $table->string('nisn')->nullable();
            $table->string('tahun_lulus')->nullable();
            $table->string('jalur_pendaftaran')->default('Reguler (Umum)');
            $table->string('no_hp', 50);
            $table->boolean('mgm')->default(false);
            $table->string('nama_mgm')->nullable();
            $table->string('asal_mgm')->nullable();
            $table->boolean('isAccepted')->default(false);
            $table->string('status', 50)->default('pending');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
