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
            $table->string('nis')->unique();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->text('alamat');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
            $table->enum('agama', ['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']);
            $table->string('asal_sekolah');
            $table->enum('jalur_pendaftaran',['Reguler','RMP']);
            $table->string('jurusan');
            $table->string('no_hp',13);
            $table->enum('abk',['Y','T'])->default('T');
            $table->string('nama_orang_tua');
            $table->text('alamat_orang_tua');
            $table->string('no_hp_orang_tua',13);
            $table->enum('mgm',['Y','N'])->default('N');
            $table->string('nama_mgm');
            $table->string('keterangan_mgm');
            $table->enum('isAccepted',['Y','N'])->default('N');
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
