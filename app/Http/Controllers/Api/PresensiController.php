<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\FotoStorage;
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
            ->whereDate('created_at', Carbon::today())
            ->first();

        if ($presensiType == 'in') {
            if (! $userPresensiToday) {
                $presensi = $request
                    ->user()
                    ->presensis()
                    ->create(
                        [
                            'status' => false
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
                        'message' => 'Success'
                    ],
                    Response::HTTP_CREATED
                );
            }

            // else show user has been checked in
            return response()->json(
                [
                    'message' => 'User has been checked in',
                ],
                Response::HTTP_OK
            );
        }

        if ($presensiType == 'out') {
            if ($userPresensiToday) {

                if ($userPresensiToday->status) {
                    return response()->json(
                        [
                            'message' => 'User has been checked out',
                        ],
                        Response::HTTP_OK
                    );
                }

                $userPresensiToday->update(
                    [
                        'status' => true
                    ]
                );

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
                        'message' => 'Berhasil'
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
