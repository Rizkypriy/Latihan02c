<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. Ambil semua data dari database
        $matakuliahs = MataKuliah::all();
    
        // 2. Kirim data ke view
        return view('matakuliah.index', compact('matakuliahs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 1. Tampilkan form kosong
        return view('matakuliah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. VALIDASI input user
        $validated = $request->validate([
            'kode_mk' => 'required|unique:matakuliahs|max:10',
            'nama_mk' => 'required|max:100',
            'sks' => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:8'
        ]);
        
        // 2. SIMPAN ke database
        MataKuliah::create($validated);
        
        // 3. REDIRECT dengan pesan sukses
        return redirect()->route('matakuliah.index')
            ->with('success', 'Mata kuliah berhasil ditambahkan!');
        }

    /**
     * Display the specified resource.
     */
    public function show(MataKuliah $matakuliah)
    {
        // 1. Tampilkan detail satu record
        return view('matakuliah.show', compact('matakuliah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MataKuliah $matakuliah)
    {
        // 1. Tampilkan form dengan data lama
        return view('matakuliah.edit', compact('matakuliah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MataKuliah $matakuliah)
    {
        // 1. VALIDASI (kecuali kode_mk yang unique)
        $validated = $request->validate([
            'kode_mk' => 'required|max:10|unique:matakuliahs,kode_mk,'.$matakuliah->kode_mk.',kode_mk',
            'nama_mk' => 'required|max:100',
            'sks' => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:8'
        ]);
        
        // 2. UPDATE database
        $matakuliah->update($validated);
        
        // 3. REDIRECT dengan pesan
        return redirect()->route('matakuliah.index')
            ->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MataKuliah $matakuliah)
    {
         // 1. HAPUS dari database
        $matakuliah->delete();
        
        // 2. REDIRECT dengan pesan
        return redirect()->route('matakuliah.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}
