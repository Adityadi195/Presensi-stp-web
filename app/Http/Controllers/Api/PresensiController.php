<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Presensi;
use App\Traits\FotoStorage;
use DateTime;
use DateTimeZone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PresensiController extends Controller
{
    use FotoStorage;

    /**
     * Store presence status
     * @param Request $request
     * @return JsonResponse|void
     * @throws InvalidFormatException
     * @throws BindingResolutionException
     */
    public function store(Request $request)
    {
        $request->validate([
            'long' => ['required'],
            'lat' => ['required'],
            'lokasi' => ['required'],
            'type' => ['in:in,out', 'required'],
            'foto' => ['required']
        ]);

        $foto = $request->file('foto');
        $presensiType = $request->type;
        $userPresensiToday = $request->user()
            ->presensis()
            ->whereDate('created_at', Carbon::now())
            ->first();
                $timezone = 'Asia/Jakarta';
                $date = new DateTime('now', new DateTimeZone($timezone)); 
                $tanggal = $date->format('Y-m-d');
                $localtime = $date->format('H:i:s');

        if ($presensiType == 'in') {
            if (! $userPresensiToday) {
                
                $presensi = $request
                    ->user()
                    ->presensis()
                    ->create(
                        [
                            'status' => false,
                            'keterangan' => 'masuk',
                            'tgl' => $tanggal,
                            'jammasuk' => $localtime
                        ]
                    );
                    
                $presensi->detail()->create(
                    [
                        'type' => 'in',
                        'long' => $request->long,
                        'lat' => $request->lat,
                        'foto' => $this->uploadFoto($foto, $request->user()->nama, 'presensi'),
                        'lokasi' => $request->lokasi
                        ]
                );

                return response()->json(
                    [
                        'message' => 'Absen Masuk Berhasil'
                    ],
                    Response::HTTP_CREATED
                );
            }

            // else show user has been checked in
            return response()->json(
                [
                    'message' => 'Telah Melakukan Absen',
                ],
                Response::HTTP_OK
            );
        }

        if ($presensiType == 'out') {
            if ($userPresensiToday) {

                if ($userPresensiToday->status) {
                    return response()->json(
                        [
                            'message' => 'Telah Melakukan Absen Pulang',
                        ],
                        Response::HTTP_OK
                    );
                }

                $userPresensiToday->update(
                   $dt=[
                        'status' => true,
                        'keterangan' => 'pulang',
                        'jamkeluar' => $localtime,
                        'jamkerja' => date('i', strtotime($localtime) - strtotime($userPresensiToday->jammasuk))
                    ]
                );
                if ($userPresensiToday->jamkeluar == ""){
                    $userPresensiToday->update($dt);
                }

                $userPresensiToday->detail()->create(
                    [
                        'type' => 'out',
                        'long' => $request->long,
                        'lat' => $request->lat,
                        'foto' => $this->uploadFoto($foto, $request->user()->nama, 'presensi'),
                        'lokasi' => $request->lokasi
                    ]
                );

                return response()->json(
                    [
                        'message' => 'Absen Pulang Berhasil'
                    ],
                    Response::HTTP_CREATED
                );
            }

            return response()->json(
                [
                    'message' => 'Silakan lakukan Absen Masuk terlebih dahulu',
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
            
        }
    }

    /**
     * Get List Presences by User
     * @param Request $request
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function riwayat(Request $request)
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