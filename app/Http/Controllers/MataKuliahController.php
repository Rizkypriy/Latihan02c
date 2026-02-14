<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Transkrip;
use App\Models\Mahasiswa; 
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data dengan jumlah peserta (transkrip)
        $matakuliahs = MataKuliah::withCount('transkrips')->get();
    
        // Kirim data ke view
        return view('matakuliah.index', compact('matakuliahs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $matakuliahs = MataKuliah::all(); // Ambil semua mata kuliah
    return view('mahasiswa.create', compact('matakuliahs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
    $validated = $request->validate([
        'nim' => 'required|string|max:15|unique:mahasiswas,nim',
        'nama' => 'required|string|max:100',
        'kelas' => 'required|string|max:20',
        // 'matakuliah' => 'required|string|max:50', // Bisa dihapus jika tidak digunakan
        'kode_mk' => 'required|exists:matakuliahs,kode_mk',
        'semester_ambil' => 'required|integer|min:1|max:14'
    ]);

    // Simpan data mahasiswa
    $mahasiswa = Mahasiswa::create([
        'nim' => $request->nim,
        'nama' => $request->nama,
        'kelas' => $request->kelas,
        'matakuliah' => $request->matakuliah ?? '' // Opsional
    ]);

    // Simpan ke tabel transkrip
    Transkrip::create([
        'nim' => $request->nim,
        'kode_mk' => $request->kode_mk,
        'semester_ambil' => $request->semester_ambil,
        'nilai' => null, // Nilai belum diisi
        'grade' => null   // Grade belum diisi
    ]);

    return redirect()->route('mahasiswa.index')
        ->with('success', 'Data mahasiswa berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(MataKuliah $matakuliah)
    {
        // Load relasi peserta untuk ditampilkan di detail
        $matakuliah->load(['transkrips.mahasiswa']);
        
        return view('matakuliah.show', compact('matakuliah'));
    }

    /**
     * TAMPILKAN DAFTAR PESERTA MATA KULIAH
     */
    public function peserta($kode_mk)
    {
        $matakuliah = MataKuliah::with(['transkrips.mahasiswa'])
                                 ->where('kode_mk', $kode_mk)
                                 ->firstOrFail();
        
        return view('matakuliah.peserta', compact('matakuliah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($nim)
{
    $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();
    $matakuliahs = MataKuliah::all();
    
    // Ambil data transkrip mahasiswa ini
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

    // Update atau buat transkrip
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
    public function destroy(MataKuliah $matakuliah)
    {
        $matakuliah->delete();
        
        return redirect()->route('matakuliah.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}