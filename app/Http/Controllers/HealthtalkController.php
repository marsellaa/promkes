<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HealthTalk;
use App\Models\Dokter;
use App\Models\User;
use App\Models\Mitra;
use App\Models\Partisipan;
use Illuminate\Support\Facades\Auth;

class HealthTalkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        

        $healthtalks = HealthTalk::with(['dokter', 'user', 'mitras', 'partisipans'])->get();
        return view('healthtalk.index', compact('healthtalks'));
    }

    public function create()
    {
        $user = Auth::user();

        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $dokters = Dokter::all();
        $users = User::all();
        $mitras = Mitra::all();
        $partisipans = Partisipan::all();
        return view('healthtalk.create', compact('dokters', 'users', 'mitras', 'partisipans'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $request->validate([
            'tgl' => 'required|date',
            'id_dokter' => 'required|exists:tb_dokter,id',
            'tema_ht' => 'required|string|max:255',
            'status' => 'required|in:Y,T,P',
            'id_user' => 'required|exists:users,id',
            'mitras' => 'required|array',
            'mitras.*' => 'exists:tb_mitra,id',
            'partisipans' => 'required|array',
            'partisipans.*' => 'exists:tb_partisipan,id',
        ]);

        $healthtalk = HealthTalk::create($request->only(['tgl', 'id_dokter', 'tema_ht', 'status', 'id_user']));
        if ($request->has('mitras')) {
            $healthtalk->mitras()->attach($request->mitras);
        }
        if ($request->has('partisipan')) {
            $healthtalk->partisipans()->attach($request->partisipan);
        }
        $healthtalk->mitras()->sync($request->mitras);
        $healthtalk->partisipans()->sync($request->partisipans);

        return redirect()->route('healthtalk.index')->with('success', 'Health Talk berhasil disimpan.');
    }

    public function edit($id)
    {
        $user = Auth::user();

        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $healthtalk = HealthTalk::with(['mitras', 'partisipans'])->findOrFail($id);
        $dokters = Dokter::all();
        $users = User::all();
        $mitras = Mitra::all();
        $partisipans = Partisipan::all();
        return view('healthtalk.edit', compact('healthtalk', 'dokters', 'users', 'mitras', 'partisipans'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $validatedData = $request->validate([
            'tgl' => 'required|date',
            'id_dokter' => 'required|exists:tb_dokter,id',
            'tema_ht' => 'required|string|max:255',
            'status' => 'required|in:Y,T,P',
            'id_user' => 'required|exists:users,id',
            'mitras' => 'required|array',
            'mitras.*' => 'exists:tb_mitra,id',
            'partisipans' => 'required|array',
            'partisipans.*' => 'exists:tb_partisipan,id',
        ]);

        $healthtalk = HealthTalk::findOrFail($id);
        $healthtalk->update($validatedData);
        $healthtalk->mitras()->sync($request->mitras);
        $healthtalk->partisipans()->sync($request->partisipans);

        return redirect()->route('healthtalk.index')->with('success', 'Health Talk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = Auth::user();

        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $healthtalk = HealthTalk::findOrFail($id);
        $healthtalk->mitras()->detach();
        $healthtalk->partisipans()->detach();
        $healthtalk->delete();

        return redirect()->route('healthtalk.index')->with('success', 'Health Talk berhasil dihapus.');
    }
}
