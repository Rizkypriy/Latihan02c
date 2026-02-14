<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transkrip extends Model
{
    use HasFactory;

    protected $table = 'transkrips';
    
    protected $fillable = [
        'nim', 
        'kode_mk', 
        'nilai', 
        'grade', 
        'semester_ambil'
    ];

    /**
     * Relasi ke Mahasiswa
     */
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    /**
     * Relasi ke MataKuliah
     */
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'kode_mk', 'kode_mk');
    }

    /**
     * Accessor untuk menentukan grade dari nilai
     */
    public function getGradeFromNilaiAttribute()
    {
        if (is_null($this->nilai)) return '-';
        
        if ($this->nilai >= 85) return 'A';
        if ($this->nilai >= 75) return 'B';
        if ($this->nilai >= 65) return 'C';
        if ($this->nilai >= 55) return 'D';
        return 'E';
    }
}