<?php

namespace App\Http\Controllers;

use App\Models\Dpa;
use App\Models\Rab;
use Illuminate\Http\Request;

class DpaController extends Controller
{
    public function index()
    {
        $dpas = Dpa::with('rab')->latest()->get();
        return view('dpa.index', compact('dpas'));
    }

    public function create(Rab $rab)
    {
        // hanya sekdes
        if (auth()->user()->role !== 'sekdes') {
            abort(403);
        }

        // RAB harus disetujui
        if ($rab->status !== 'disetujui') {
            abort(403, 'RAB belum disetujui');
        }

        // generate nomor DPA
        $tahun = now()->year;

        $lastDpa = \App\Models\Dpa::whereYear('created_at', $tahun)
            ->latest('id')
            ->first();

        $urutan = $lastDpa ? intval(substr($lastDpa->nomor_dpa, -4)) + 1 : 1;

        $nomorDpa = 'DPA/' . $tahun . '/' . str_pad($urutan, 4, '0', STR_PAD_LEFT);

        return view('dpa.create', compact('rab', 'nomorDpa'));
    }


    public function store(Request $request, Rab $rab)
    {
        $request->validate([
            'nomor_dpa' => 'required',
            'tanggal_pengesahan' => 'required|date',
        ]);

        Dpa::create([
            'rab_id' => $rab->id,
            'nomor_dpa' => $request->nomor_dpa,
            'tanggal_pengesahan' => $request->tanggal_pengesahan,
        ]);

        return redirect()
            ->route('dpa.index')
            ->with('success', 'DPA berhasil dibuat');
    }


    public function show(Dpa $dpa)
    {
        $dpa->load('rab');
        return view('dpa.show', compact('dpa'));
    }

    public function destroy(Dpa $dpa)
    {
        $dpa->delete();

        return redirect()
            ->route('dpa.index')
            ->with('success', 'DPA berhasil dihapus');
    }
}
