<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{

    public function up()
    {
        Schema::create('nis_counters', function (Blueprint $table) {
            $table->id();
            $table->integer('last_number')->default(0);
            $table->timestamps();
        });

        // Insert baris awal
        DB::table('nis_counters')->insert([
            'last_number' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('nis_counters');
    }
};
