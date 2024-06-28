<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partisipan;
use Illuminate\Support\Facades\Auth;

class PartisipanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $partisipan = Partisipan::all();
        return view('partisipan.index', compact('partisipan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('partisipan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        Partisipan::create($validatedData);

        return redirect()->route('partisipan.index')->with('success', 'Data Partisipan berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Partisipan $partisipan)
    {
        // Implement if needed
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partisipan $partisipan)
    {
        $user = Auth::user();
       
        return view('partisipan.edit', compact('partisipan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partisipan $partisipan)
    {
        
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        $partisipan->update($validatedData);

        return redirect()->route('partisipan.index')->with('success', 'Data Partisipan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partisipan $partisipan)
    {
        
        $partisipan->delete();

        return redirect()->route('partisipan.index')->with('success', 'Data Partisipan berhasil dihapus');
    }
}
