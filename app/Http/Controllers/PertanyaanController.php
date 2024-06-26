<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pertanyaan;
use Illuminate\Support\Facades\Auth;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $pertanyaan = Pertanyaan::all();
        return view('pertanyaan.index', compact('pertanyaan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        return view('pertanyaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $validatedData = $request->validate([
            'pertanyaan' => 'required|string',
        ]);

        Pertanyaan::create($validatedData);

        return redirect()->route('pertanyaan.index')->with('success', 'Data pertanyaan berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pertanyaan $pertanyaan)
    {
        // Implement if needed
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pertanyaan $pertanyaan)
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        return view('pertanyaan.edit', compact('pertanyaan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Pertanyaan $pertanyaan)
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $validatedData = $request->validate([
            'pertanyaan' => 'required|string',
        ]);

        $pertanyaan->update($validatedData);

        return redirect()->route('pertanyaan.index')->with('success', 'Data pertanyaan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pertanyaan $pertanyaan)
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $pertanyaan->delete();

        return redirect()->route('pertanyaan.index')->with('success', 'Data pertanyaan berhasil dihapus');
    }
}
