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
       Schema::create('mahasiswas', function (Blueprint $table) {
            $table->string('nim', 15)->primary(); // nim sebagai primary key
            $table->string('nama', 100); // nama mahasiswa
            $table->string('kelas', 20); // kelas
            $table->string('matakuliah', 50); // mata kuliah
            
            $table->timestamps(); // optional: created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
