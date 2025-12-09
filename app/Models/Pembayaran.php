<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'spp_id',
        'tanggal',
        'jumlah_dibayar',
        'metode',
        'bukti'
    ];

    public function spp()
    {
        return $this->belongsTo(Spp::class);
    }
}
