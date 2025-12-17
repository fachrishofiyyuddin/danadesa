<?php

namespace App\Http\Controllers;

use App\Models\Rab;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Menampilkan daftar laporan realisasi
     * (otomatis dari RAB yang sudah dibayar)
     */
    public function index()
    {
        // Ambil RAB yang punya SPP dan sudah dibayar
        $rabs = Rab::with([
            'user',
            'spps.pembayarans'
        ])
            ->whereHas('spps', function ($q) {
                $q->where('status', 'dibayar');
            })
            ->latest()
            ->get();

        return view('laporan.index', compact('rabs'));
    }

    /**
     * Detail laporan per RAB
     */
    public function show($id)
    {
        $rab = Rab::with([
            'user',
            'spps.pembayarans'
        ])->findOrFail($id);

        $totalRealisasi = $rab->spps->sum(function ($spp) {
            return $spp->pembayarans->sum('jumlah_dibayar');
        });

        return view('laporan.show', compact('rab', 'totalRealisasi'));
    }

    public function pdf(Rab $rab)
    {
        $rab->load(['user', 'spps.pembayarans']);

        $totalRealisasi = $rab->spps->sum(
            fn($spp) => $spp->pembayarans->sum('jumlah_dibayar')
        );

        $pdf = Pdf::loadView('laporan.pdf', compact(
            'rab',
            'totalRealisasi'
        ));

        return $pdf->stream('laporan-' . $rab->id . '.pdf');
    }
}
