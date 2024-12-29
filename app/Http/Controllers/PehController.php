<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peh;
use App\Models\Dokter;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReportMail;
use App\Models\HealthTalk;

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

    public function create(Request $request)
{
    $user = Auth::user();
    
    // Ambil parameter filter dari query string
    $spesialisasi = $request->query('spesialisasi', '');
    //$spesialisasi_pengganti = $request->query('spesialisasi_pengganti', '');  // Ambil spesialisasi pengganti


    // Filter dokter berdasarkan spesialisasi jika ada
    if ($spesialisasi) {
        $dokter = Dokter::where('spesialisasi', $spesialisasi)->get();
    } else {
        $dokter = Dokter::where('status','Aktif')->get();
    }

    // if ($spesialisasi_pengganti) {
    //     $dokter_pengganti = Dokter::where('spesialisasi', $spesialisasi_pengganti)->get();
    // } else {
    //     $dokter_pengganti = Dokter::all();  // Menampilkan semua dokter jika spesialisasi_pengganti kosong
    // }

    $user = User::all();
    return view('peh.create', compact('dokter', 'user', 'spesialisasi'));
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
            'jam' => 'nullable|string',  // Validasi kolom jam
            'narasumber_pengganti' => 'nullable|exists:tb_dokter,id',  // Validasi kolom narasumber pengganti
            'host' => 'nullable|string', 
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
            'jam' => 'nullable|string',  // Validasi kolom jam
            'narasumber_pengganti' => 'nullable|exists:tb_dokter,id',  // Validasi kolom narasumber pengganti
            'host' => 'nullable|string', 
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

    public function sendReport(Request $request)
    {
    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'email' => 'required|email'
    ]);

    // Fetch data
    $peh = Peh::whereBetween('tgl', [$request->start_date, $request->end_date])
        ->with(['dokter', 'user'])
        ->get();

    // Generate PDF
    $pdf = FacadePdf::loadView('peh.report', [
        'peh' => $peh,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date
    ]);

    // Send email with PDF attachment
    Mail::to($request->email)->send(new ReportMail($pdf->output(), $request->start_date, $request->end_date));

    return redirect()->route('peh.index')->with('success', 'Laporan berhasil dikirim.');
    }
}