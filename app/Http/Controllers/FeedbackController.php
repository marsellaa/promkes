<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Pertanyaan;
use App\Models\Jawaban;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

    

        $feedbacks = Feedback::with('jawaban.pertanyaan', 'user')->get();
        return view('feedback.index', compact('feedbacks'));
    }

    public function create()
    {
        $user = Auth::user();

        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $pertanyaans = Pertanyaan::all();
        $users = User::all();
        return view('feedback.create', compact('pertanyaans', 'users'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $validatedData = $request->validate([
            'tgl' => 'required|date',
            'nama_pasien' => 'required|string|max:255',
            'akun_ig' => 'nullable|string|max:255',
            'akun_fb' => 'nullable|string|max:255',
            'akun_tiktok' => 'nullable|string|max:255',
            'masukan' => 'nullable|string',
            'id_user' => 'required|exists:users,id',
            'pertanyaan.*' => 'nullable|exists:tb_pertanyaan,id',
            'jawaban.*' => 'nullable|string'
        ]);

        $feedback = Feedback::create($validatedData);

        foreach ($request->pertanyaan as $key => $id_pertanyaan) {
            if ($id_pertanyaan && $request->jawaban[$key]) {
                Jawaban::create([
                    'id_feedback' => $feedback->id,
                    'id_pertanyaan' => $id_pertanyaan,
                    'jawaban' => $request->jawaban[$key],
                ]);
            }
        }

        return redirect()->route('feedback.index')->with('success', 'Feedback berhasil disimpan.');
    }

    public function edit($id)
    {
        $user = Auth::user();

        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $feedback = Feedback::with('jawaban')->findOrFail($id);
        $pertanyaans = Pertanyaan::all();
        $users = User::all();
        return view('feedback.edit', compact('feedback', 'pertanyaans', 'users'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $validatedData = $request->validate([
            'tgl' => 'required|date',
            'nama_pasien' => 'required|string|max:255',
            'akun_ig' => 'nullable|string|max:255',
            'akun_fb' => 'nullable|string|max:255',
            'akun_tiktok' => 'nullable|string|max:255',
            'masukan' => 'nullable|string',
            'id_user' => 'required|exists:users,id',
            'pertanyaan.*' => 'nullable|exists:tb_pertanyaan,id',
            'jawaban.*' => 'nullable|string'
        ]);

        $feedback = Feedback::findOrFail($id);
        $feedback->update($validatedData);

        $feedback->jawaban()->delete();

        foreach ($request->pertanyaan as $key => $id_pertanyaan) {
            if ($id_pertanyaan && $request->jawaban[$key]) {
                Jawaban::create([
                    'id_feedback' => $feedback->id,
                    'id_pertanyaan' => $id_pertanyaan,
                    'jawaban' => $request->jawaban[$key],
                ]);
            }
        }

        return redirect()->route('feedback.index')->with('success', 'Feedback berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = Auth::user();

        if ($user->id_role !== 1) {
            abort(403, 'This action is unauthorized.');
        }

        $feedback = Feedback::findOrFail($id);
        $feedback->jawaban()->delete();
        $feedback->delete();

        return redirect()->route('feedback.index')->with('success', 'Feedback berhasil dihapus.');
    }
}
