<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonorDarah;
use App\Models\Mitra;
use App\Models\Partisipan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DonorDarahController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $donorDarahs = DonorDarah::with(['mitra', 'partisipans', 'user'])->get();
        return view('donordarah.index', compact('donorDarahs'));
    }
    

    public function create()
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $mitras = Mitra::all();
        $partisipans = Partisipan::all();
        $users = User::all();
        return view('donordarah.create', compact('mitras', 'partisipans', 'users'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $request->validate([
            'tgl' => 'required|date',
            'status' => 'required|in:Y,T,P',
            'jml_partisipan' => 'required|integer',
            'jml_donor' => 'required|integer',
            'id_user' => 'required|exists:users,id',
            'id_mitra' => 'required|exists:tb_mitra,id',
            'partisipan' => 'nullable|array',
            'partisipan.*' => 'exists:tb_partisipan,id',
            'dokumentasi' => 'nullable|file|mimes:jpg,jpeg,png,mp4,avi,pdf,doc,docx|max:20480',
        ]);

        $donorDarah = DonorDarah::create($request->only(['tgl', 'status', 'jml_partisipan', 'jml_donor', 'id_user', 'id_mitra']));

        if ($request->has('partisipan')) {
            $donorDarah->partisipans()->attach($request->partisipan);
        }

        if ($request->hasFile('dokumentasi')) {
            $file = $request->file('dokumentasi');
            $fileName = 'donordarah_dokumentasi_' . $request->tgl . '_' . $file->getClientOriginalExtension();
            $file->storeAs('public/dokumentasi', $fileName);
            $donorDarah->dokumentasi = $fileName;
            $donorDarah->save();
        }

        return redirect()->route('donordarah.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit(DonorDarah $donordarah)
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $mitras = Mitra::all();
        $partisipans = Partisipan::all();
        $users = User::all();
        return view('donordarah.edit', compact('donordarah', 'mitras', 'partisipans', 'users'));
    }

    public function update(Request $request, DonorDarah $donordarah)
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $request->validate([
            'tgl' => 'required|date',
            'status' => 'required|in:Y,T,P',
            'jml_partisipan' => 'required|integer',
            'jml_donor' => 'required|integer',
            'id_user' => 'required|exists:users,id',
            'id_mitra' => 'required|exists:tb_mitra,id',
            'partisipan' => 'nullable|array',
            'partisipan.*' => 'exists:tb_partisipan,id',
            'dokumentasi' => 'nullable|file|mimes:jpg,jpeg,png,mp4,avi,pdf,doc,docx|max:20480',
        ]);

        $donordarah->update($request->only(['tgl', 'status', 'jml_partisipan', 'jml_donor', 'id_user', 'id_mitra']));

        if ($request->has('partisipan')) {
            $donordarah->partisipans()->sync($request->partisipan);
        }

        if ($request->hasFile('dokumentasi')) {
            if ($donordarah->dokumentasi && Storage::exists('public/dokumentasi/' . $donordarah->dokumentasi)) {
                Storage::delete('public/dokumentasi/' . $donordarah->dokumentasi);
            }
            $file = $request->file('dokumentasi');
            $fileName = 'donordarah_dokumentasi_' . $request->tgl . '_' . $file->getClientOriginalExtension();
            $file->storeAs('public/dokumentasi', $fileName);
            $donordarah->dokumentasi = $fileName;
        }

        $donordarah->save();

        return redirect()->route('donordarah.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(DonorDarah $donordarah)
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        if ($donordarah->dokumentasi && Storage::exists('public/dokumentasi/' . $donordarah->dokumentasi)) {
            Storage::delete('public/dokumentasi/' . $donordarah->dokumentasi);
        }
        $donordarah->partisipans()->detach();
        $donordarah->delete();

        return redirect()->route('donordarah.index')->with('success', 'Data berhasil dihapus.');
    }
}
