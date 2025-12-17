<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Spp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Pembayaran::with('spp');

        // optional filter by spp_id
        if ($request->has('spp_id')) {
            $query->where('spp_id', $request->spp_id);
        }

        $pembayarans = $query->latest()->get();

        return view('pembayaran.index', compact('pembayarans'));
    }


    public function create($spp_id)
    {
        $spp = Spp::with('rab')->findOrFail($spp_id);

        // 🔐 role check
        if (auth()->user()->role !== 'bendahara') {
            abort(403, 'Tidak punya akses');
        }

        // 🔐 status check
        if ($spp->status !== 'disetujui') {
            abort(403, 'SPP belum disetujui');
        }

        return view('pembayaran.create', compact('spp'));
    }

    public function store(Request $request, $spp_id)
    {
        $spp = Spp::findOrFail($spp_id);

        // 🔐 ROLE CHECK
        if (auth()->user()->role !== 'bendahara') {
            return back()->withErrors('Tidak punya akses melakukan pembayaran');
        }

        // 🔐 STATUS CHECK
        if ($spp->status !== 'disetujui') {
            return back()->withErrors('SPP belum disetujui');
        }

        // 🔐 CEGAH BAYAR ULANG
        if ($spp->status === 'dibayar') {
            return back()->withErrors('SPP sudah dibayar');
        }

        // ✅ VALIDASI: WAJIB LUNAS
        $request->validate([
            'tanggal' => 'required|date',
            'jumlah_dibayar' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) use ($spp) {
                    if ($value != $spp->jumlah_diminta) {
                        $fail('Jumlah pembayaran harus sama dengan jumlah SPP (wajib lunas).');
                    }
                },
            ],
            'metode' => 'required|string',
        ]);

        DB::transaction(function () use ($request, $spp) {

            // 1️⃣ SIMPAN PEMBAYARAN
            Pembayaran::create([
                'spp_id' => $spp->id,
                'tanggal' => $request->tanggal,
                'jumlah_dibayar' => $request->jumlah_dibayar,
                'metode' => $request->metode,
            ]);

            // 2️⃣ UPDATE STATUS SPP → DIBAYAR
            $spp->update([
                'status' => 'dibayar',
            ]);
        });

        return redirect()
            ->route('spp.index', ['rab_id' => $spp->rab_id])
            ->with('success', 'SPP berhasil dibayar (LUNAS)');
    }
}
