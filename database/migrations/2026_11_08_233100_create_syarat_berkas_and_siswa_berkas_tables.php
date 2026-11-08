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
        // Tabel Master Persyaratan Berkas (Bisa diatur / di-disable oleh admin)
        Schema::create('syarat_berkas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_berkas'); // Contoh: Kartu Keluarga, Akta Kelahiran, Ijazah/SKL, KIP/KKS, Pas Foto
            $table->string('deskripsi')->nullable(); // Petunjuk, misal: "Format file PDF/JPG max 2MB"
            $table->boolean('is_required')->default(true); // Wajib atau Opsional
            $table->boolean('is_active')->default(true); // Toggle Aktif/Nonaktif oleh admin
            $table->integer('urutan')->default(1);
            $table->timestamps();
        });

        // Tabel Berkas yang Diunggah oleh Siswa (Disimpan dalam format aslinya)
        Schema::create('siswa_berkas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->foreignId('syarat_berkas_id')->constrained('syarat_berkas')->onDelete('cascade');
            $table->string('file_name');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa_berkas');
        Schema::dropIfExists('syarat_berkas');
    }
};

