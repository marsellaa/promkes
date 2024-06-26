<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mitra;
use Illuminate\Support\Facades\Auth;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $mitra = Mitra::all();
        return view('mitra.index', compact('mitra'));
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

        return view('mitra.create');
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
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        Mitra::create($validatedData);

        return redirect()->route('mitra.index')->with('success', 'Data Mitra berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mitra $mitra)
    {
        // Implement if needed
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mitra $mitra)
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        return view('mitra.edit', compact('mitra'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mitra $mitra)
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        $mitra->update($validatedData);

        return redirect()->route('mitra.index')->with('success', 'Data Mitra berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mitra $mitra)
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $mitra->delete();

        return redirect()->route('mitra.index')->with('success', 'Data Mitra berhasil dihapus');
    }
}
