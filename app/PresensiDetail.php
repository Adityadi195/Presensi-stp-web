<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class PresensiDetail extends Model
{
    protected $guarded = [];

    public function presensi()
    {
        return $this->belongsTo(Presensi::class);
    }
}