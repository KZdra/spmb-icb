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
            $table->string('nis')->nullable()->unique();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
            $table->enum('agama', ['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']);
            $table->string('asal_sekolah');
            $table->enum('jalur_pendaftaran', ['Reguler', 'RMP']);
            $table->string('no_hp', 13);
            $table->boolean('mgm')->default(false);
            $table->string('nama_mgm')->nullable();
            $table->string('asal_mgm')->nullable();
            $table->boolean('isAccepted')->default(false);
            $table->enum('status', ['Diterima', 'Ditolak', 'Pending'])->default('Pending');
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
