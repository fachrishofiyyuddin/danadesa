<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Rab;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function create($rab_id)
    {
        $rab = Rab::findOrFail($rab_id);
        return view('laporan.create', compact('rab'));
    }

    public function store(Request $request, $rab_id)
    {
        $request->validate([
            'file_laporan' => 'required|file|mimes:pdf',
            'keterangan' => 'nullable|string',
        ]);

        $path = $request->file('file_laporan')->store('laporan', 'public');

        Laporan::create([
            'rab_id' => $rab_id,
            'file_laporan' => $path,
            'keterangan' => $request->keterangan,
            'tanggal_upload' => now(),
        ]);

        return redirect()->route('rab.show', $rab_id)
            ->with('success', 'Laporan berhasil diupload');
    }
}
