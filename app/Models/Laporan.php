<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = [
        'rab_id',
        'isi_laporan',
        'bukti_realiasi',
        'status'
    ];

    public function rab()
    {
        return $this->belongsTo(Rab::class);
    }
}
