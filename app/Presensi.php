<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Presensi extends Model
{
    protected $guarded = [];
    // public $timestamps = false;

    public function scopeCountPresensi($query, $status)
    {
        return $query->whereDate('created_at', Carbon::today())
            ->where('status', $status)->count();

    }

    public function detail()
    {
        return $this->hasMany(PresensiDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}