<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Presensi extends Model
{
    protected $guarded = [];
    // use HasFactory;
    protected $table = "presensis";
    protected $primaryKey = "id";
    protected $fillable = [
        'id','user_id','status','tgl','jammasuk','jamkeluar','jamkerja'];
    // public $timestamps = false;

    public function scopeCountPresensi($query, $status)
    {
        return $query->whereDate('created_at', Carbon::now())
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