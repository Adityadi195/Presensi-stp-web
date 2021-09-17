<?php

namespace App\Http\Controllers;

use App\Exports\PresensiExport;
use App\Presensi;
use App\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Request;

class PresensiController extends Controller
{
    /**
     * Construct
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth', 'level']);
    }

    public function index()
    {
        $presensi = Presensi::with(['user', 'detail'])->paginate(5);
        return view('pages.presensi.index', compact('presensi'));
    }

    public function show($id)
    {
        $presensi = Presensi::with(['user', 'detail'])->findOrFail($id);
        return view('pages.presensi.show', compact('presensi'));
    }
}
