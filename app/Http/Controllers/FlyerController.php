<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flyer;
use App\Models\Dokter;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FlyerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $flyers = Flyer::with('dokter', 'user')->get();
        return view('flyer.index', compact('flyers'));
    }

    public function create()
    {
        $user = Auth::user();
        
        $dokters = Dokter::all();
        $dokters = Dokter::where('status','Aktif')->get();
        $users = User::all();
        return view('flyer.create', compact('dokters', 'users'));
    }

    public function store(Request $request)
    {
        

        $request->validate([
            'tgl' => 'required|date',
            'jenis_info' => 'required|string|max:255',
            'tema' => 'required|string|max:255',
            'id_dokter' => 'required|exists:tb_dokter,id',
            'id_user' => 'required|exists:users,id',
            'dokumentasi' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        $flyer = Flyer::create($request->only(['tgl', 'jenis_info', 'tema', 'id_dokter', 'id_user']));

        if ($request->hasFile('dokumentasi')) {
            $file = $request->file('dokumentasi');
            $fileName = 'flyer_dokumentasi_' . $request->tgl . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/flyers', $fileName);
            $flyer->dokumentasi = $fileName;
            $flyer->save();
        }

        return redirect()->route('flyer.index')->with('success', 'Flyer berhasil disimpan.');
    }

    public function edit(Flyer $flyer)
    {
        $user = Auth::user();
        

        $dokters = Dokter::all();
        $users = User::all();
        return view('flyer.edit', compact('flyer', 'dokters', 'users'));
    }

    public function update(Request $request, Flyer $flyer)
    {
        

        $request->validate([
            'tgl' => 'required|date',
            'jenis_info' => 'required|string|max:255',
            'tema' => 'required|string|max:255',
            'id_dokter' => 'required|exists:tb_dokter,id',
            'id_user' => 'required|exists:users,id',
            'dokumentasi' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        $flyer->update($request->only(['tgl', 'jenis_info', 'tema', 'id_dokter', 'id_user']));

        if ($request->hasFile('dokumentasi')) {
            if ($flyer->dokumentasi && Storage::exists('public/flyers/' . $flyer->dokumentasi)) {
                Storage::delete('public/flyers/' . $flyer->dokumentasi);
            }
            $file = $request->file('dokumentasi');
            $fileName = 'flyer_dokumentasi_' . $request->tgl . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/flyers', $fileName);
            $flyer->dokumentasi = $fileName;
            $flyer->save();
        }

        return redirect()->route('flyer.index')->with('success', 'Flyer berhasil diperbarui.');
    }

    public function destroy(Flyer $flyer)
    {
        

        if ($flyer->dokumentasi && Storage::exists('public/flyers/' . $flyer->dokumentasi)) {
            Storage::delete('public/flyers/' . $flyer->dokumentasi);
        }
        $flyer->delete();

        return redirect()->route('flyer.index')->with('success', 'Flyer berhasil dihapus.');
    }
}
