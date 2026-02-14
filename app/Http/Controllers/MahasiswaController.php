<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Transkrip;
use App\Models\MataKuliah;
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
        // AMBIL DATA MATA KULIAH
        $matakuliahs = MataKuliah::all();
        
        return view('mahasiswa.create', compact('matakuliahs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required|string|max:15|unique:mahasiswas,nim',
            'nama' => 'required|string|max:100',
            'kelas' => 'required|string|max:20',
            'kode_mk' => 'required|exists:matakuliahs,kode_mk',
            'semester_ambil' => 'required|integer|min:1|max:14'
        ]);

        $mahasiswa = Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
        ]);

        Transkrip::create([
            'nim' => $request->nim,
            'kode_mk' => $request->kode_mk,
            'semester_ambil' => $request->semester_ambil,
            'nilai' => null,
            'grade' => null
        ]);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($nim)
    {
        $mahasiswa = Mahasiswa::with('transkrips.mataKuliah')
                              ->where('nim', $nim)
                              ->firstOrFail();
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($nim)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();
        $matakuliahs = MataKuliah::all();
        $transkrip = Transkrip::where('nim', $nim)->first();
        
        return view('mahasiswa.edit', compact('mahasiswa', 'matakuliahs', 'transkrip'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $nim)
    {
        $request->validate([
            'nim' => 'required|string|max:15|unique:mahasiswas,nim,' . $nim . ',nim',
            'nama' => 'required|string|max:100',
            'kelas' => 'required|string|max:20',
            'kode_mk' => 'required|exists:matakuliahs,kode_mk',
            'semester_ambil' => 'required|integer|min:1|max:14'
        ]);

        $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();
        $mahasiswa->update([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
        ]);

        Transkrip::updateOrCreate(
            ['nim' => $nim],
            [
                'kode_mk' => $request->kode_mk,
                'semester_ambil' => $request->semester_ambil
            ]
        );

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($nim)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus!');
    }
}