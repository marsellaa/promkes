<?php

namespace App\Http\Controllers;

use App\Models\DonorDarah;
use App\Models\Feedback;
use App\Models\Flyer;
use App\Models\User;
use App\Models\Mitra;
use App\Models\Peh;
use App\Models\HealthTalk;
use App\Models\InfoDanKomplain;
use App\Models\KerjaSamaNonBpjs;
use App\Models\KjMitra;
use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    $users = User::count();
    $mitras = Mitra::count();
    $peh = Peh::count();
    $healthtalk = HealthTalk::count();
    $donordarah = DonorDarah::count();
    $feedback = Feedback::count();
    $infodankomplain = InfoDanKomplain::count();
    $kjmitra = KjMitra::count();
    $kerjasamanonbjps = KerjaSamaNonBpjs::count();
    $flyer = Flyer::count();
    $video = Video::count();
    


    // Data PEH
    $totalPeh = Peh::count();
    $pehYa = Peh::where('status', 'Y')->count();
    $pehTidak = Peh::where('status', 'T')->count();
    $pehPending = Peh::where('status', 'P')->count();
    $pehYaPercentage = $totalPeh > 0 ? ($pehYa / $totalPeh) * 100 : 0;
    $pehTidakPercentage = $totalPeh > 0 ? ($pehTidak / $totalPeh) * 100 : 0;
    $pehPendingPercentage = $totalPeh > 0 ? ($pehPending / $totalPeh) * 100 : 0;

    // Data HealthTalk
    $totalHealthTalk = HealthTalk::count();
    $healthTalkYa = HealthTalk::where('status', 'Y')->count();
    $healthTalkTidak = HealthTalk::where('status', 'T')->count();
    $healthTalkPending= HealthTalk::where('status', 'P')->count();
    $healthTalkYaPercentage = $totalHealthTalk > 0 ? ($healthTalkYa / $totalHealthTalk) * 100 : 0;
    $healthTalkTidakPercentage = $totalHealthTalk > 0 ? ($healthTalkTidak / $totalHealthTalk) * 100 : 0;
    $healthTalkPendingPercentage = $totalHealthTalk > 0 ? ($healthTalkPending / $totalHealthTalk) * 100 : 0;

    $currentMonth = \Carbon\Carbon::now()->month;
        $pehCountThisMonth = Peh::whereMonth('tgl', $currentMonth)->count();

    $widget = [
        'users' => $users,
        'mitras' => $mitras,
        'peh' => $peh,
        'healthtalk' => $healthtalk,
        'donordarah' => $donordarah,
        'feedback' => $feedback,
        'infodankomplain' => $infodankomplain,
        'kjmitra' => $kjmitra,
        'kerjasamanonbpjs' => $kerjasamanonbjps,
        'flyer' => $flyer,
        'video' => $video,
        'pehYaPercentage' => $pehYaPercentage,
        'pehTidakPercentage' => $pehTidakPercentage,
        'pehPendingPercentage' => $pehPendingPercentage,
        'healthTalkYaPercentage' => $healthTalkYaPercentage,
        'healthTalkTidakPercentage' => $healthTalkTidakPercentage,
        'healthTalkPendingPercentage' => $healthTalkPendingPercentage,
        'pehCountThisMonth' => $pehCountThisMonth,
        // ...
    ];

    return view('home', compact('widget'));

    }
}