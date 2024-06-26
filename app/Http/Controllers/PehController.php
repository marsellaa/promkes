<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peh;
use App\Models\Dokter;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;




class PehController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $dokter = Dokter::all();
        $peh = Peh::all();

        return view('peh.index', compact('peh'));
    }

    public function create()
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            return('peh.index');
        }
        
        $dokter = Dokter::all();
        $user = User::all();
        return view('peh.create', compact('dokter', 'user'));
    }

    

    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }


        $validatedData = $request->validate([
            'tgl' => 'required|date',
            'id_dokter' => 'required|exists:tb_dokter,id',
            'tema' => 'required|string',
            'status' => 'required|in:Y,T,P',
            'id_user' => 'required|exists:users,id',
            'jml_penonton' => 'required|integer',
        ]);

        Peh::create($validatedData);

        return redirect()->route('peh.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit(Peh $peh)
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            return back();
        
        }


        $dokter = Dokter::all();
        $user = User::all();

        return view('peh.edit', compact('peh', 'dokter', 'user'));
    }

    public function update(Request $request, Peh $peh)
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $validatedData = $request->validate([
            'tgl' => 'required|date',
            'id_dokter' => 'required|exists:tb_dokter,id',
            'tema' => 'required|string',
            'status' => 'required|in:Y,T,P',
            'id_user' => 'required|exists:users,id',
            'jml_penonton' => 'required|integer',
        ]);

        $peh->update($validatedData);

        return redirect()->route('peh.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Peh $peh, $id)
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            return back();
        }
        
        $peh = Peh::findOrFail($id);
        $peh->delete();

        return redirect()->route('peh.index')->with('success', 'Data berhasil dihapus.');
    }

    public function downloadPdf()
    {
        $peh = Peh::with(['dokter', 'user'])->get();

        $pdf = FacadePdf::loadView('peh.pdf', compact('peh'))->setPaper('a4', 'landscape');
        return $pdf-> download('peh-data.pdf');
    }
}
