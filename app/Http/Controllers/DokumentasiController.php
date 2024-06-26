<?php

namespace App\Http\Controllers;

use App\Models\Dokumentasi;
use Illuminate\Http\Request;

class DokumentasiController extends Controller
{
    public function index()
    {
        $dokumentasi = Dokumentasi::all();
        return view('dokumentasi.index', compact('dokumentasi'));
    }

    public function create()
    {
        return view('dokumentasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_file' => 'required|string|max:255',
            'tipe_file' => 'required|in:Gambar,Video,Dokumen',
        ]);

        Dokumentasi::create($request->all());

        return redirect()->route('dokumentasi.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit(Dokumentasi $dokumentasi)
    {
        return view('dokumentasi.edit', compact('dokumentasi'));
    }

    public function update(Request $request, Dokumentasi $dokumentasi)
    {
        $request->validate([
            'nama_file' => 'required|string|max:255',
            'tipe_file' => 'required|in:Gambar,Video,Dokumen',
        ]);

        $dokumentasi->update($request->all());

        return redirect()->route('dokumentasi.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Dokumentasi $dokumentasi)
    {
        $dokumentasi->delete();

        return redirect()->route('dokumentasi.index')->with('success', 'Data berhasil dihapus.');
    }
}
