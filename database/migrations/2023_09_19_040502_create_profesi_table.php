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
        Schema::create('profesi', function (Blueprint $table) {
            $table->id();
            $table->char('kode_profesi', 1)->unique()->nullable()->comment('
                A = Petani, 
                B = Teknisi,
                C = Guru,
                D = Nelayan,
                E = Seniman            
            ');
            $table->string('profesi', 30)->nullable()->comment('Petani atau Teknisi atau Guru dan seterusnya');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesi');
    }
};
