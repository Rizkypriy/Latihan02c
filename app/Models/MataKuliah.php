<?php

namespace App\Models;
use App\Models\Transkrip;

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

        /**
     * Relasi ke Transkrip (hasMany) - INI YANG AKAN DIGUNAKAN
     */
    public function transkrips()
    {
        return $this->hasMany(Transkrip::class, 'kode_mk', 'kode_mk');
    }

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
