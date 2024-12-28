<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $akun = User::whereBetween('id_role', [1, 3])->with('role')->get();
    
        return view('users.index',[
            'akun'=>$akun
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'id_role' => 'required|integer',
            'password' => 'required|string|min:8',
            'phone_number' => 'nullable|numeric|digits_between:1,13'
        ]);

        // $validatedData['password'] =  bcrypt($validatedData['password']);

        $user = User::create($validatedData);
        
        return redirect()->route('akun.index')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $akun = User::find($id);
        return view('users.edit',[
            'akun' => $akun
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $akun = User::find($id);
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email,' . $akun->id,
            'id_role' => 'required|integer',
            'password' => 'nullable|string|min:8',
            'phone_number' => 'nullable|numeric|digits_between:1,13' 
        ]);

        // if (!empty($validatedData['password'])) {
        //     $validatedData['password'] = Hash::make($validatedData['password']);
        // } else {
        //     $validatedData['password'] = $akun->password;
        // }

        $akun->update($validatedData);
        return redirect()->route('akun.index')->with('success', 'Akun telah berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $akun = User::findOrFail($id);
        $nama = $akun->name;

        $akun->delete();

        return redirect()->route('akun.index')->with('success', "Akun $nama berhasil dihapus.");
    }
}
