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
        Schema::create('pengaturan_aplikasis', function (Blueprint $table) {
            $table->id();
            $table->string('app_name')->default('SPMB');
            $table->string('logo_path')->nullable();
            $table->string('bank_name')->default('Bank BRI');
            $table->string('no_rekening')->default('210501000140303');
            $table->string('atas_nama')->default('SMK ICB Cinta Teknika');
            $table->decimal('biaya_pendaftaran', 15, 2)->default(200000.00);
            $table->string('kontak_wa')->default('6281222223333');
            $table->string('alamat_sekolah')->default('Jl. Atlas No. 4, Babakan Surabaya, Kiaracondong, Bandung');
            $table->string('tahun_ajaran')->default('2027/2028');
            $table->string('nis_prefix')->default('125');
            $table->integer('nis_start_number')->default(1);
            $table->string('email_notifikasi')->nullable();
            $table->string('artikel_judul')->default('Panduan Lengkap Penerimaan Calon Siswa Baru SMK ICB Cinta Teknika Tahun Ajaran 2027/2028');
            $table->longText('artikel_konten')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan_aplikasis');
    }
};
