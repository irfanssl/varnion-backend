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
        Schema::create('hasil_response', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('jenis_kelamin')->nullable()->comment('kolom ini digunakan untuk menyimpan relasi dengan tabel jenis_kelamin');
            $table->index('jenis_kelamin'); // add index to speedup searching

            $table->string('nama', 200)->nullable();
            $table->text('nama_jalan')->nullable();
            $table->string('email', 200)->nullable();
            $table->integer('angka_kurang')->nullable()->comment('kolom ini digunakan untuk menyimpan : jumlah / total kemunculan angka kurang dari 7 dari hasil hashing md5');
            $table->integer('angka_lebih')->nullable()->comment('kolom ini digunakan untuk menyimpan : jumlah / total kemunculan angka lebih dari 7 dari hasil hashing md5');
            
            $table->bigInteger('profesi')->nullable()->comment('kolom ini digunakan untuk menyimpan relasi dengan tabel profesi');
            $table->index('profesi'); // add index to speedup searching

            $table->text('plain_json')->nullable()->comment('kolom ini digunakan untuk menyimpan json dari hasil request. Kolom ini sengaja type nya text, karena jika type json, akan ada masalah dengan Mysql versi tertentu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_response');
    }
};
