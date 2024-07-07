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
        $peh = Peh::orderBy('tgl', 'desc')->get();

        return view('peh.index', compact('peh'));
    }

    public function create()
    {
        $user = Auth::user();
        
        $dokter = Dokter::all();
        $user = User::all();
        return view('peh.create', compact('dokter', 'user'));
    }



    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'tgl' => 'required|date',
            'id_dokter' => 'required|exists:tb_dokter,id',
            'tema' => 'required|string',
            'status' => 'required|in:Y,T,P',
            'id_user' => 'required|exists:users,id',
            'jml_penonton' => 'required|integer|min:0',
        ]);

        Peh::create($validatedData);

        return redirect()->route('peh.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit(Peh $peh)
    {
        $user = Auth::user();
        

        $dokter = Dokter::all();
        $user = User::all();

        return view('peh.edit', compact('peh', 'dokter', 'user'));
    }

    public function update(Request $request, Peh $peh)
    {
        $validatedData = $request->validate([
            'tgl' => 'required|date',
            'id_dokter' => 'required|exists:tb_dokter,id',
            'tema' => 'required|string',
            'status' => 'required|in:Y,T,P',
            'id_user' => 'required|exists:users,id',
            'jml_penonton' => 'required|integer|min:0',
        ]);

        $peh->update($validatedData);

        return redirect()->route('peh.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Peh $peh, $id)
    {

        $peh = Peh::findOrFail($id);
        $peh->delete();

        return redirect()->route('peh.index')->with('success', 'Data berhasil dihapus.');
    }

    public function downloadPdf(Request $request)
    {
        $start_date = $request->get('start_date', date('Y-m-d'));
        $end_date = $request->get('end_date', date('Y-m-d'));

        $peh = Peh::with(['dokter', 'user'])->whereBetween('tgl',[$start_date,$end_date])->get();
        $pdf = FacadePdf::loadView('peh.pdf', compact('peh','start_date','end_date'))->setPaper('a4', 'landscape');
        return $pdf-> download('peh-data.pdf');
    }
}
