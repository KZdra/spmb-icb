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
        Schema::create('s_data_tambahans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->text('alamat')->nullable();
            $table->string('rt', 10)->nullable();
            $table->string('rw', 10)->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->text('alamat_sekolah_asal')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('telepon_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('telepon_ibu')->nullable();
            $table->string('tinggi_badan', 10)->nullable();
            $table->string('berat_badan', 10)->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('nama_orang_tua')->nullable();
            $table->text('alamat_orang_tua')->nullable();
            $table->string('no_hp_orang_tua')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('s_data_tambahans');
    }
};
