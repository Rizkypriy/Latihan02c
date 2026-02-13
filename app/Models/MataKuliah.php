<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'matakuliahs';
    protected $primaryKey = 'kode_mk';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_mk', 'nama_mk', 'sks', 'semester'
    ];

    public function mahasiswas()
    {
        return $this->belongsToMany(
            Mahasiswa::class,        // Model target
            'mahasiswa_matakuliah',  // Nama tabel pivot
            'kode_mk',               // Foreign key di pivot untuk MataKuliah
            'nim'                    // Foreign key di pivot untuk Mahasiswa
        );
    }
}
