<?php

namespace App\Http\Controllers;

use App\Presensi;
use App\Http\Controllers\Controller;
use App\PresensiDetail;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PresensiController extends Controller
{
    /**
     * Construct
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'level']);
    }

    public function index(Request $request)
    {
        $pagination = 5;
        $presensi = Presensi::with(['detail'])->latest()->paginate($pagination);
        return view('pages.presensi.index', compact('presensi'))->with('i', ($request->input('page', 1)-1) * $pagination);
    }

    public function show($id)
    {
        $presensi = Presensi::with(['user', 'detail'])->findOrFail($id);
        return view('pages.presensi.show', compact('presensi'));
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $pagination = 5;
        $presensi = Presensi::where("user_id","LIKE","%$keyword%")
                ->paginate($pagination);
                $presensi->withPath('presensi');
                $presensi->appends($request->all);
                return view('pages.presensi.index', compact('presensi'));
    }

    public function cetakPertanggal($fromdate,$todate , Request $request ){
        $cetakPertanggal = Presensi::with(['user', 'detail'])->whereBetween('tgl',[$fromdate, $todate])->get();
        $html = view('pages.presensi.download-pdf', compact('cetakPertanggal'))->with('i', ($request->input('page', 1)-1));
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html );
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream();
    }
}
