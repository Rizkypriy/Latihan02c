<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'nim',
        'nama',
        'kelas',
        'matakuliah'
    ];

    // Jika NIM bukan auto-increment
    public $incrementing = false;
    
    // Primary key adalah string (NIM)
    protected $keyType = 'string';
    
    // Nama primary key
    protected $primaryKey = 'nim';
}