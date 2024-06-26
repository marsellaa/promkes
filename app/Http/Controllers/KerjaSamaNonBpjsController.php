<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KerjaSamaNonBpjs;
use App\Models\Mitra;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class KerjaSamaNonBpjsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $kerjasamaNonBpjs = KerjaSamaNonBpjs::all();
        return view('kerjasama_nonbpjs.index', compact('kerjasamaNonBpjs'));
    }

    public function create()
    {
        $mitras = Mitra::all();
        $users = User::all();
        return view('kerjasama_nonbpjs.create', compact('mitras', 'users'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $validatedData = $request->validate([
            'tgl_mulai' => 'required|date',
            'tgl_akhir' => 'required|date',
            'id_mitra' => 'required|exists:tb_mitra,id',
            'jenis_kerjasama' => 'required|string',
            'status' => 'required|in:Baru,Perpanjangan',
            'id_user' => 'required|exists:users,id',
            'no_telp_pic' => 'required|numeric|digits_between:1,15',
            'dokumentasi' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $periode = date('F Y', strtotime($request->tgl_mulai)); // Mendapatkan bulan dan tahun dari tgl_mulai

        $data = array_merge($validatedData, ['periode' => $periode]);

        $kerjaSamaNonBpjs = KerjaSamaNonBpjs::create($data);

        if ($request->hasFile('dokumentasi')) {
            $file = $request->file('dokumentasi');
            $filename = 'kerjasama_nonbpjs_dokumentasi_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/kerjasama_nonbpjs_dokumentasi'), $filename);
            $kerjaSamaNonBpjs->dokumentasi = $filename;
            $kerjaSamaNonBpjs->save();
        }

        return redirect()->route('kerjasama_nonbpjs.index')->with('success', 'Data Kerja Sama Non BPJS berhasil disimpan.');
    }

    public function edit(KerjaSamaNonBpjs $kerjasama_nonbpjs)
    {
        $mitras = Mitra::all();
        $users = User::all();
        return view('kerjasama_nonbpjs.edit', compact('kerjasama_nonbpjs', 'mitras', 'users'));
    }

    public function update(Request $request, KerjaSamaNonBpjs $kerjasama_nonbpjs)
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $validatedData = $request->validate([
            'tgl_mulai' => 'required|date',
            'tgl_akhir' => 'required|date',
            'id_mitra' => 'required|exists:tb_mitra,id',
            'jenis_kerjasama' => 'required|string',
            'status' => 'required|in:Baru,Perpanjangan',
            'id_user' => 'required|exists:users,id',
            'no_telp_pic' => 'required|numeric|digits_between:1,15',
            'dokumentasi' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $periode = date('F Y', strtotime($request->tgl_mulai)); // Mendapatkan bulan dan tahun dari tgl_mulai

        $data = array_merge($validatedData, ['periode' => $periode]);

        $kerjasama_nonbpjs->update($data);

        if ($request->hasFile('dokumentasi')) {
            $file = $request->file('dokumentasi');
            $filename = 'kerjasama_nonbpjs_dokumentasi_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/kerjasama_nonbpjs_dokumentasi'), $filename);
            $kerjasama_nonbpjs->dokumentasi = $filename;
            $kerjasama_nonbpjs->save();
        }

        return redirect()->route('kerjasama_nonbpjs.index')->with('success', 'Data Kerja Sama Non BPJS berhasil diperbarui.');
    }

    public function destroy(KerjaSamaNonBpjs $kerjasama_nonbpjs)
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        if ($kerjasama_nonbpjs->dokumentasi) {
            $file_path = public_path('uploads/kerjasama_nonbpjs_dokumentasi') . '/' . $kerjasama_nonbpjs->dokumentasi;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $kerjasama_nonbpjs->delete();

        return redirect()->route('kerjasama_nonbpjs.index')->with('success', 'Data Kerja Sama Non BPJS berhasil dihapus.');
    }
}
