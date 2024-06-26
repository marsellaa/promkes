<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KjMitra;
use App\Models\Mitra;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class KjMitraController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $kjmitras = KjMitra::all();

        return view('kjmitra.index', compact('kjmitras'));
    }

    public function create()
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            return redirect()->route('kjmitra.index');
        }

        $mitras = Mitra::all();
        $users = User::all();

        return view('kjmitra.create', compact('mitras', 'users'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $validatedData = $request->validate([
            'tgl' => 'required|date',
            'id_mitra' => 'required|exists:tb_mitra,id',
            'tujuan' => 'required|string',
            'id_user' => 'required|exists:users,id',
            'dokumentasi' => 'nullable|file|mimes:jpeg,png,jpg,mp4,pdf,docx',
        ]);

        if ($request->hasFile('dokumentasi')) {
            $file = $request->file('dokumentasi');
            $filename = 'kjmitra_dokumentasi_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/kjmitra_dokumentasi'), $filename);
            $validatedData['dokumentasi'] = $filename;
        }

        KjMitra::create($validatedData);

        return redirect()->route('kjmitra.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit(KjMitra $kjmitra)
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            return back();
        }

        $mitras = Mitra::all();
        $users = User::all();

        return view('kjmitra.edit', compact('kjmitra', 'mitras', 'users'));
    }

    public function update(Request $request, KjMitra $kjmitra)
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $validatedData = $request->validate([
            'tgl' => 'required|date',
            'id_mitra' => 'required|exists:tb_mitra,id',
            'tujuan' => 'required|string',
            'id_user' => 'required|exists:users,id',
            'dokumentasi' => 'nullable|file|mimes:jpeg,png,jpg,mp4,pdf,docx',
        ]);

        if ($request->hasFile('dokumentasi')) {
            $file = $request->file('dokumentasi');
            $filename = 'kjmitra_dokumentasi_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/kjmitra_dokumentasi'), $filename);
            $validatedData['dokumentasi'] = $filename;
        }

        $kjmitra->update($validatedData);

        return redirect()->route('kjmitra.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(KjMitra $kjmitra)
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            return back();
        }

        if ($kjmitra->dokumentasi) {
            $filePath = public_path('uploads/kjmitra_dokumentasi/' . $kjmitra->dokumentasi);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $kjmitra->delete();

        return redirect()->route('kjmitra.index')->with('success', 'Data berhasil dihapus.');
    }
}
