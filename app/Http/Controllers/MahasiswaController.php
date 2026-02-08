<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;


class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswas = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswas'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nim' => 'required|string|max:15|unique:mahasiswas,nim',
            'nama' => 'required|string|max:100',
            'kelas' => 'required|string|max:20',
            'matakuliah' => 'required|string|max:50'
        ]);

        // Simpan data
        Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'matakuliah' => $request->matakuliah
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($nim)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $nim)
    {
        // Validasi data
        $request->validate([
            'nim' => 'required|string|max:15|unique:mahasiswas,nim,' . $nim . ',nim',
            'nama' => 'required|string|max:100',
            'kelas' => 'required|string|max:20',
            'matakuliah' => 'required|string|max:50'
        ]);

        // Cari data berdasarkan NIM
        $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();
        
        // Update data
        $mahasiswa->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'matakuliah' => $request->matakuliah
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($nim)
    {
        // Cari data berdasarkan NIM
        $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();
        
        // Hapus data
        $mahasiswa->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus!');
    }
}
