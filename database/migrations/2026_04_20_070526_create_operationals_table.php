<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('operationals', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_kapal');
            $table->year('tahun_kapal');
            $table->string('area'); 
            $table->string('tier');
            $table->integer('rpm');
            $table->double('daya_mesin');
            $table->double('lama_operasi');
            $table->double('jarak_tempuh');
            $table->double('konsumsi_bbm');
            $table->foreignId('jenis_bbm_id')->constrained('jenis_bbms')->cascadeOnDelete();
            $table->double('co2')->nullable();
            $table->double('nox')->nullable();
            $table->double('sox')->nullable();
            $table->double('cii')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operationals');
    }
};
