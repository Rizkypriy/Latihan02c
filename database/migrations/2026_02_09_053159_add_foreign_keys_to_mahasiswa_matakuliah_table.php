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
        Schema::table('mahasiswa_matakuliah', function (Blueprint $table) {
            // Pastikan engine tabel adalah InnoDB
            \Illuminate\Support\Facades\DB::statement('ALTER TABLE mahasiswa_matakuliah ENGINE = InnoDB');
            
            // Tambah foreign key
            $table->foreign('nim')
                  ->references('nim')
                  ->on('mahasiswas')
                  ->onDelete('cascade');
                  
            $table->foreign('kode_mk')
                  ->references('kode_mk')
                  ->on('matakuliahs')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswa_matakuliah', function (Blueprint $table) {
            $table->dropForeign(['nim']);
            $table->dropForeign(['kode_mk']);
        });
    }
};