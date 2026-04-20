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
        Schema::create('jenis_bbms', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_bbm');
            $table->decimal('faktor_emisi', 5, 3);
            $table->decimal('sulfur', 5, 4); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_bbms');
    }
};
