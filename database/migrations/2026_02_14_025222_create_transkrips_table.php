<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transkrips', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('kode_mk');
            $table->integer('nilai')->nullable();
            $table->string('grade', 2)->nullable();
            $table->integer('semester_ambil');
            $table->timestamps();
            
            $table->foreign('nim')->references('nim')->on('mahasiswas')->onDelete('cascade');
            $table->foreign('kode_mk')->references('kode_mk')->on('matakuliahs')->onDelete('cascade');
            $table->unique(['nim', 'kode_mk']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transkrips');
    }
};