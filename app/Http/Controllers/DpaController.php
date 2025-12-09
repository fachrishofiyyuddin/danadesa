<?php

namespace App\Http\Controllers;

use App\Models\Dpa;
use App\Models\Rab;
use Illuminate\Http\Request;

class DpaController extends Controller
{
    public function create($rab_id)
    {
        $rab = Rab::findOrFail($rab_id);
        return view('dpa.create', compact('rab'));
    }

    public function store(Request $request, $rab_id)
    {
        $request->validate([
            'nomor_dpa' => 'required',
            'tanggal_pengesahan' => 'required|date',
            'nilai_dpa' => 'required|numeric',
        ]);

        Dpa::create([
            'rab_id' => $rab_id,
            'nomor_dpa' => $request->nomor_dpa,
            'tanggal_pengesahan' => $request->tanggal_pengesahan,
            'nilai_dpa' => $request->nilai_dpa,
        ]);

        return redirect()->route('rab.show', $rab_id)
            ->with('success', 'DPA berhasil dibuat');
    }
}
