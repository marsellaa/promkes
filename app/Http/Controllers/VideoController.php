<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Dokter;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $videos = Video::with('dokter', 'user')->get();
        return view('video.index', compact('videos'));
    }

    public function create()
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $dokters = Dokter::all();
        $users = User::all();
        return view('video.create', compact('dokters', 'users'));
    }

    public function store(Request $request)
    {
    $user = Auth::user();
    if ($user->id_role !== 1) {
        abort(403, 'This action is unauthorized.');
    }

    $request->validate([
        'tgl' => 'required|date',
        'jenis_info' => 'required|string|max:255',
        'tema' => 'required|string|max:255',
        'id_dokter' => 'required|exists:tb_dokter,id',
        'id_user' => 'required|exists:users,id',
        'dokumentasi' => 'nullable|file|mimes:mp4,avi,mov|max:10240',
    ]);

    $video = Video::create($request->only(['tgl', 'jenis_info', 'tema', 'id_dokter', 'id_user']));

    if ($request->hasFile('dokumentasi')) {
        $file = $request->file('dokumentasi');
        $fileName = 'video_dokumentasi_' . $request->tgl . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/videos', $fileName);
        $video->dokumentasi = $fileName;
        $video->save();
    }

    return redirect()->route('video.index')->with('success', 'Video berhasil disimpan.');
    }
    public function edit(Video $video)
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $dokters = Dokter::all();
        $users = User::all();
        return view('video.edit', compact('video', 'dokters', 'users'));
    }

    public function update(Request $request, Video $video)
    {
    $user = Auth::user();
    if ($user->id_role !== 1) {
        abort(403, 'This action is unauthorized.');
    }

    $request->validate([
        'tgl' => 'required|date',
        'jenis_info' => 'required|string|max:255',
        'tema' => 'required|string|max:255',
        'id_dokter' => 'required|exists:tb_dokter,id',
        'id_user' => 'required|exists:users,id',
        'dokumentasi' => 'nullable|file|mimes:mp4,avi,mov|max:10240',
    ]);

    $video->update($request->only(['tgl', 'jenis_info', 'tema', 'id_dokter', 'id_user']));

    if ($request->hasFile('dokumentasi')) {
        if ($video->dokumentasi && Storage::exists('public/videos/' . $video->dokumentasi)) {
            Storage::delete('public/videos/' . $video->dokumentasi);
        }
        $file = $request->file('dokumentasi');
        $fileName = 'video_dokumentasi_' . $request->tgl . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/videos', $fileName);
        $video->dokumentasi = $fileName;
        $video->save();
    }

    return redirect()->route('video.index')->with('success', 'Video berhasil diperbarui.');
    }

    public function destroy(Video $video)
    {
        $user = Auth::user();
        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        if ($video->dokumentasi && Storage::exists('public/videos/' . $video->dokumentasi)) {
            Storage::delete('public/videos/' . $video->dokumentasi);
        }
        $video->delete();

        return redirect()->route('video.index')->with('success', 'Video berhasil dihapus.');
    }
}
