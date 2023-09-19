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
        Schema::create('jenis_kelamin', function (Blueprint $table) {
            $table->id();
            $table->integer('kode_kelamin')->unique()->nullable()->comment('keterangan : 2 = perempuan, 1 = Laki - laki');
            $table->string('kelamin', 30)->nullable()->comment('Perempuan atau Laki - laki');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_kelamin');
    }
};
