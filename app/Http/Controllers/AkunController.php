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
        $akun = User::whereBetween('id_role',[1,2])->get();
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
        $validatedData= $request->validate([
            'name'=> 'required|string',
            'email'=>'required|string',
            'id_role'=>'required|string',
            'password'=>'required|string',
            'phone_number'=>'required|integer'
        ]);

        User::create($validatedData);
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
            'akun'=>$akun
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $akun = User::find($id);
        $validatedData= $request->validate([
            'name'=> 'required|string',
            'email'=>'required|string',
            'id_role'=>'required|string',
            'password'=>'required|string',
            'phone_number' => 'required|string'
        ]);

        $akun->name = $validatedData['name'];
        $akun->email = $validatedData['email'];
        $akun->id_role = $validatedData['id_role'];
        $akun->password = Hash::make($validatedData['password']);
        $akun->phone_number = $validatedData['phone_number'];
        $akun->update($validatedData);
        return redirect()->route('akun.index')->with('success', 'Akun Telah berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $akun = User::findOrFail($id);
        $nama = $akun->name;

        $akun->delete();

        return redirect()->route('nama_route_yang_diinginkan')->with('success', "Akun $nama berhasil dihapus.");
    }
}
