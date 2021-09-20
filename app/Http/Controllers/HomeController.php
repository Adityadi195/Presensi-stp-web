<?php

namespace App\Http\Controllers;

use App\Presensi;
use Illuminate\Http\Request;
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
        return view('home', compact(['user','presensi']));
    }
    public function riwayathome(Request $request)
    {
        $request->validate(
            [
                'from' => ['required'],
                'to' => ['required'],
            ]
        );

        $riwayat = $request->user()->presensis()->with('detail')
            ->whereBetween(
                DB::raw('DATE(created_at)'),
                [
                    $request->from, $request->to
                ]
            )->get();

        return response()->json(
            [
                'message' => "list of presences by user",
                'data' => $riwayat,
            ],
            Response::HTTP_OK
        );
    }
}