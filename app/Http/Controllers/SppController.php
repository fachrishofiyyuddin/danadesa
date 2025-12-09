<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use App\Models\Rab;
use Illuminate\Http\Request;

class SppController extends Controller
{
    // Menampilkan daftar SPP
    public function index(Request $request)
    {
        $rab_id = $request->query('rab_id');
        if ($rab_id) {
            $spps = Spp::where('rab_id', $rab_id)->get();
        } else {
            $spps = collect(); // kosong kalau belum pilih RAB
        }

        return view('spp.index', compact('spps'));
    }


    // Menampilkan form buat SPP baru
    public function create($rab_id)
    {
        $rab = Rab::findOrFail($rab_id);
        return view('spp.create', compact('rab'));
    }

    // Menyimpan SPP baru
    public function store(Request $request, $rab_id)
    {
        $request->validate([
            'nomor_spp' => 'required',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
        ]);

        Spp::create([
            'rab_id' => $rab_id,
            'nomor_spp' => $request->nomor_spp,
            'tanggal' => $request->tanggal,
            'jumlah_diminta' => $request->jumlah,
        ]);

        return redirect()->route('rab.show', $rab_id)
            ->with('success', 'SPP berhasil ditambahkan');
    }

    // Menampilkan detail SPP
    public function show(Spp $spp)
    {
        // Load RAB terkait
        $spp->load('rab');
        return view('spp.show', compact('spp'));
    }

    public function verifikasi(Spp $spp)
    {
        $user = auth()->user();

        // Hanya role tertentu bisa verifikasi
        if (!in_array($user->role, ['sekdes', 'bendahara', 'kades'])) {
            return back()->with('error', 'Anda tidak punya akses verifikasi.');
        }

        $spp->update(['status' => 'disetujui']); // bisa sesuaikan alur role jika ingin multi-level
        return back()->with('success', 'SPP berhasil disetujui.');
    }

    public function tolak(Request $request, Spp $spp)
    {
        $user = auth()->user();

        if (!in_array($user->role, ['sekdes', 'bendahara', 'kades'])) {
            return back()->with('error', 'Anda tidak punya akses menolak.');
        }

        $spp->update([
            'status' => 'ditolak',
            'catatan' => $request->catatan
        ]);

        return back()->with('success', 'SPP berhasil ditolak.');
    }

    public function destroy(Spp $spp)
    {
        $spp->delete();
        return redirect()->route('spp.index')->with('success', 'SPP berhasil dihapus.');
    }

    public function daftarRab()
    {
        // Ambil RAB yang aktif/berhubungan dengan bendahara
        $rabs = Rab::all(); // Bisa ditambahkan filter sesuai kebutuhan
        return view('spp.rab-list', compact('rabs'));
    }
}
