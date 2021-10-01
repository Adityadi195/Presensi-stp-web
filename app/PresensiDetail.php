<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class PresensiDetail extends Model
{
    protected $guarded = [];
    protected $table = "presensi_details";
    protected $fillable = [
        'id','presensi_id','long','lat','lokasi','foto','type'];
    // public $timestamps = false;

    public function presensi()
    {
        return $this->hasMany(Presensi::class);
    }
}