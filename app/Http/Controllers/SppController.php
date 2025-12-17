<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Spp;
use App\Models\Rab;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SppController extends Controller
{
    // Menampilkan daftar SPP
    public function index(Request $request)
    {
        $user = auth()->user();
        $rab_id = $request->query('rab_id');

        $query = Spp::query();

        // Jika ada rab_id → filter
        if ($rab_id) {
            $query->where('rab_id', $rab_id);
        }

        // Filter berdasarkan role
        switch ($user->role) {

            case 'kaur':
                // Bendahara lihat semua
                break;

            case 'sekdes':
                // Kades fokus verifikasi & histori
                $query->whereIn('status', [
                    'menunggu_verifikasi',
                    'disetujui',
                    'ditolak'
                ]);
                break;

            case 'bendahara':
                // Kades fokus verifikasi & histori
                $query->whereIn('status', [
                    'menunggu_verifikasi',
                    'disetujui',
                    'ditolak',
                    'dibayar'
                ]);
                break;

            default:
                // Role lain tidak boleh lihat
                $query->whereRaw('1 = 0');
        }

        $spps = $query->orderBy('created_at', 'desc')->get();

        // Ambil RAB jika ada
        $rab = $rab_id ? Rab::find($rab_id) : null;

        return view('spp.index', compact('spps', 'rab'));
    }

    // Menampilkan form buat SPP baru
    public function create($rab_id)
    {
        $rab = Rab::findOrFail($rab_id);

        // Tahun sekarang
        $year = Carbon::now()->year;

        // Nomor SPP otomatis
        $lastSpp = Spp::whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->first();

        $nextNumber = $lastSpp
            ? str_pad(((int) substr($lastSpp->nomor_spp, -4)) + 1, 4, '0', STR_PAD_LEFT)
            : '0001';

        $nomorSpp = "SPP/$year/$nextNumber";

        // =========================
        // HITUNG SISA ANGGARAN
        // =========================

        $totalSpp = Spp::where('rab_id', $rab->id)
            ->whereIn('status', ['disetujui', 'menunggu']) // opsional
            ->sum('jumlah_diminta');

        $sisaAnggaran = $rab->jumlah_anggaran - $totalSpp;

        if ($sisaAnggaran < 0) {
            $sisaAnggaran = 0;
        }

        return view('spp.create', compact(
            'rab',
            'nomorSpp',
            'sisaAnggaran'
        ));
    }

    // Menyimpan SPP baru
    public function store(Request $request, $rab_id)
    {
        $rab = Rab::findOrFail($rab_id);

        $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
        ]);

        DB::transaction(function () use ($request, $rab_id) {

            $year = now()->year;

            $lastSpp = Spp::whereYear('created_at', $year)
                ->orderBy('id', 'desc')
                ->lockForUpdate()
                ->first();

            $nextNumber = $lastSpp
                ? str_pad(((int) substr($lastSpp->nomor_spp, -4)) + 1, 4, '0', STR_PAD_LEFT)
                : '0001';

            $nomorSpp = "SPP/$year/$nextNumber";

            Spp::create([
                'rab_id' => $rab_id,
                'nomor_spp' => $nomorSpp,
                'tanggal' => $request->tanggal,
                'jumlah_diminta' => $request->jumlah,
                'status' => 'menunggu_verifikasi',
            ]);
        });

        return redirect()
            ->route('spp.index', ['rab_id' => $rab_id])
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
