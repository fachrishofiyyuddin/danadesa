<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Spp;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function create($spp_id)
    {
        $spp = Spp::findOrFail($spp_id);
        return view('pembayaran.create', compact('spp'));
    }

    public function store(Request $request, $spp_id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jumlah_dibayar' => 'required|numeric',
            'metode' => 'nullable|string',
        ]);

        Pembayaran::create([
            'spp_id' => $spp_id,
            'tanggal' => $request->tanggal,
            'jumlah_dibayar' => $request->jumlah_dibayar,
            'metode' => $request->metode,
        ]);

        return redirect()->route('rab.show', $spp_id)
            ->with('success', 'Pembayaran berhasil ditambahkan');
    }
}
