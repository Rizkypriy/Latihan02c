<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswas';
    use HasFactory;

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'nim',
        'nama',
        'kelas',
        // 'matakuliah'
    ];

    // Jika NIM bukan auto-increment
    public $incrementing = false;
    
    // Primary key adalah string (NIM)
    protected $keyType = 'string';
    
    // Nama primary key
    protected $primaryKey = 'nim';

    public function matakuliahs()
    {
        return $this->belongsToMany(
            MataKuliah::class,       // Model target
            'mahasiswa_matakuliah',  // Nama tabel pivot
            'nim',                   // Foreign key di pivot untuk Mahasiswa
            'kode_mk'                // Foreign key di pivot untuk MataKuliah
        );
    }

    
    /**
     * Relasi ke Transkrip
     */
    public function transkrips()
    {
        return $this->hasMany(Transkrip::class, 'nim', 'nim');
    }
}

