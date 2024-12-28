<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;

class DokterController extends Controller
{
    public function index()
    {
        $dokter = Dokter::all();
        $dokter = Dokter::orderByRaw("FIELD(status, 'Aktif', 'Nonaktif') ASC")->orderBy('nama')->get();
        return view('dokter.index', compact('dokter'));
    }

    public function create()
    {
        return view('dokter.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|digits_between:1,3|unique:tb_dokter',
            'nama' => 'required|string|max:255',
            'nipnib' => 'required|digits:18|unique:tb_dokter',
            'subdivisi' => 'nullable|digits_between:1,2',
            'spesialisasi' => 'required|string|in:THT-KL,Anak,Mata,Orthopedi,Obgyn,Bedah Mulut,Syaraf,Thorax,Digestive,Vaskuler,Plastik,Urologi,RI,Tumor,Bedah Thorax,Kardio Vaskuler,Kardio Anak',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);
    
        Dokter::create($validatedData);
    
        return redirect()->route('dokter.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit(Dokter $dokter)
    {
        return view('dokter.edit', compact('dokter'));
    }

    public function update(Request $request, Dokter $dokter)
{
    $validatedData = $request->validate([
        'id' => 'required|digits_between:1,3|unique:tb_dokter,id,' . $dokter->id,
        'nama' => 'required|string|max:255',
        'nipnib' => 'required|digits:18|unique:tb_dokter,nipnib,' . $dokter->id,
        'subdivisi' => 'nullable|digits_between:1,2',
        'spesialisasi' => 'required|string|in:THT-KL,Anak,Mata,Orthopedi,Obgyn,Bedah Mulut,Syaraf,Thorax,Digestive,Vaskuler,Plastik,Urologi,RI,Tumor,Bedah Thorax,Kardio Vaskuler,Kardio Anak',
        'status' => 'required|in:Aktif,Nonaktif',
    ]);

    $dokter->update($validatedData);

    return redirect()->route('dokter.index')->with('success', 'Data berhasil diperbarui.');
}

    public function destroy(Dokter $dokter)
    {
        $dokter->delete();
        return redirect()->route('dokter.index')->with('success', 'Data berhasil dihapus.');
    }
}
