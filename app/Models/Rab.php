<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rab extends Model
{
    protected $fillable = [
        'user_id',
        'nama_kegiatan',
        'deskripsi',
        'jumlah_anggaran',
        'status',
        'catatan_koreksi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function dpa()
    {
        return $this->hasOne(Dpa::class);
    }
    public function spps()
    {
        return $this->hasMany(Spp::class);
    }
    public function laporan()
    {
        return $this->hasOne(Laporan::class);
    }
}
