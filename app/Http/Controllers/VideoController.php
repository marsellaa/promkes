<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Dokter;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

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
        $dokters = Dokter::all();
        $dokters = Dokter::where('status','Aktif')->get();
        $users = User::all();
        return view('video.create', compact('dokters', 'users'));
    }

    public function store(Request $request)
    {
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
            $filePath = $file->storeAs('videos/original', $fileName);

            // Downscale video before saving
            $downscaledFileName = 'video_dokumentasi_' . $request->tgl . '_downscaled.' . $file->getClientOriginalExtension();
            $downscaledFilePath = 'videos/' . $downscaledFileName;

            FFMpeg::fromDisk('local')
                ->open('videos/original/' . $fileName)
                ->addFilter(function ($filters) {
                    $filters->resize(new \FFMpeg\Coordinate\Dimension(640, 480));
                })
                ->export()
                ->toDisk('public')
                ->inFormat(new \FFMpeg\Format\Video\X264())
                ->save($downscaledFilePath);

            $video->dokumentasi = $downscaledFileName;
            $video->save();
        }

        return redirect()->route('video.index')->with('success', 'Video berhasil disimpan.');
    }

    public function edit(Video $video)
    {
        $user = Auth::user();
        $dokters = Dokter::all();
        $users = User::all();
        return view('video.edit', compact('video', 'dokters', 'users'));
    }

    public function update(Request $request, Video $video)
    {
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
            $filePath = $file->storeAs('videos/original', $fileName);

            // Downscale video before saving
            $downscaledFileName = 'video_dokumentasi_' . $request->tgl . '_downscaled.' . $file->getClientOriginalExtension();
            $downscaledFilePath = 'videos/' . $downscaledFileName;

            FFMpeg::fromDisk('local')
                ->open('videos/original/' . $fileName)
                ->addFilter(function ($filters) {
                    $filters->resize(new \FFMpeg\Coordinate\Dimension(640, 480));
                })
                ->export()
                ->toDisk('public')
                ->inFormat(new \FFMpeg\Format\Video\X264())
                ->save($downscaledFilePath);

            $video->dokumentasi = $downscaledFileName;
            $video->save();
        }

        return redirect()->route('video.index')->with('success', 'Video berhasil diperbarui.');
    }

    public function destroy(Video $video)
    {
        if ($video->dokumentasi && Storage::exists('public/videos/' . $video->dokumentasi)) {
            Storage::delete('public/videos/' . $video->dokumentasi);
        }
        $video->delete();

        return redirect()->route('video.index')->with('success', 'Video berhasil dihapus.');
    }
}
