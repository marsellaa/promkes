<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InfoDanKomplain;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class InfoDanKomplainController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $infoKomplains = InfoDanKomplain::all();
        return view('infodankomplain.index', compact('infoKomplains'));
    }

    public function create()
    {
        $user = Auth::user();

        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $users = User::all();
        return view('infodankomplain.create', compact('users'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $validatedData = $request->validate([
            'tgl' => 'required|date',
            'jenis_berita' => 'required|in:Informasi,Komplain',
            'media_sosial' => 'required|in:Instagram,Facebook,TikTok',
            'isi_berita' => 'required|string',
            'kelompok' => 'required|in:Layanan,Parkir,Pembayaran,Dokter,Pendaftaran,Hasil Pemeriksaan',
            'id_user' => 'required|exists:users,id'
        ]);

        InfoDanKomplain::create($validatedData);

        return redirect()->route('infodankomplain.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $user = Auth::user();

        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $infoKomplain = InfoDanKomplain::findOrFail($id);
        $users = User::all();
        return view('infodankomplain.edit', compact('infoKomplain', 'users'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $validatedData = $request->validate([
            'tgl' => 'required|date',
            'jenis_berita' => 'required|in:Informasi,Komplain',
            'media_sosial' => 'required|in:Instagram,Facebook,TikTok',
            'isi_berita' => 'required|string',
            'kelompok' => 'required|in:Layanan,Parkir,Pembayaran,Dokter,Pendaftaran,Hasil Pemeriksaan',
            'id_user' => 'required|exists:users,id'
        ]);

        $infoKomplain = InfoDanKomplain::findOrFail($id);
        $infoKomplain->update($validatedData);

        return redirect()->route('infodankomplain.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = Auth::user();

        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $infoKomplain = InfoDanKomplain::findOrFail($id);
        $infoKomplain->delete();

        return redirect()->route('infodankomplain.index')->with('success', 'Data berhasil dihapus.');
    }
}
