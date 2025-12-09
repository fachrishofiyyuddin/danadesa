<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dpa extends Model
{
    protected $fillable = [
        'rab_id',
        'nomor_dpa',
        'tanggal_diterbitkan'
    ];

    public function rab()
    {
        return $this->belongsTo(Rab::class);
    }
}
