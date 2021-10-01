<?php

namespace App\Http\Controllers;

use App\Presensi;
use Illuminate\Support\Facades\DB;


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
        $user = DB::table('users')->count();
        $presensi = DB::table('presensis')->count();
        $alpha = $user - $presensi;
        return view('home', compact(['user','presensi','alpha']));   
    }
    public function indexpresensi()
    {
        $presensi = Presensi::with(['user', 'detail'])->paginate(5);
        return view('home');
    }
}