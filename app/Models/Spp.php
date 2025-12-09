<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    protected $fillable = [
        'rab_id',
        'nomor_spp',
        'jumlah_diminta',
        'status'
    ];

    public function rab()
    {
        return $this->belongsTo(Rab::class);
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
