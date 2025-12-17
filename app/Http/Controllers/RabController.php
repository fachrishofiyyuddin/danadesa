<?php

namespace App\Http\Controllers;

use App\Models\Rab;
use Illuminate\Http\Request;

class RabController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        switch ($user->role) {

            case 'kaur':
                // KAUR: hanya RAB miliknya sendiri (semua status)
                $rabs = Rab::where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->get();
                break;

            case 'sekdes':
                $rabs = Rab::whereIn('status', ['cek_sekdes', 'disetujui'])
                    ->orderBy('created_at', 'desc')
                    ->get();
                break;


            case 'bendahara':
                $rabs = Rab::whereIn('status', [
                    'cek_bendahara',
                    'disetujui'
                ])
                    ->orderBy('created_at', 'desc')
                    ->get();
                break;


            case 'kades':
                // KEPALA DESA: hanya RAB yang perlu keputusan akhir
                $rabs = Rab::where('status', 'cek_kades')
                    ->orderBy('created_at', 'desc')
                    ->get();
                break;

            default:
                $rabs = collect();
        }

        return view('rab.index', compact('rabs'));
    }

    public function create()
    {
        return view('rab.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jumlah_anggaran' => 'required|numeric|min:0',
        ]);

        Rab::create([
            'user_id' => auth()->id(),
            'nama_kegiatan' => $request->nama_kegiatan,
            'deskripsi' => $request->deskripsi,
            'jumlah_anggaran' => $request->jumlah_anggaran,
            'status' => 'cek_sekdes'
        ]);

        return redirect()->route('rab.index')->with('success', 'RAB berhasil dibuat.');
    }

    public function show(Rab $rab)
    {
        return view('rab.show', compact('rab'));
    }

    public function edit(Rab $rab)
    {
        return view('rab.edit', compact('rab'));
    }

    public function update(Request $request, Rab $rab)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jumlah_anggaran' => 'required|numeric'
        ]);

        $rab->update($request->all());

        return redirect()->route('rab.index')->with('success', 'RAB berhasil diperbarui');
    }

    public function destroy(Rab $rab)
    {
        $rab->delete();

        return redirect()->route('rab.index')->with('success', 'RAB berhasil dihapus');
    }

    public function verifikasi(Rab $rab)
    {
        $user = auth()->user();

        switch ($user->role) {
            case 'sekdes':
                $rab->update(['status' => 'cek_bendahara']);
                $message = 'RAB diverifikasi Sekdes, lanjut ke Bendahara.';
                break;

            case 'bendahara':
                $rab->update(['status' => 'cek_kades']);
                $message = 'RAB diverifikasi Bendahara, lanjut ke Kepala Desa.';
                break;

            case 'kades':
                $rab->update(['status' => 'disetujui']);
                $message = 'RAB disetujui oleh Kepala Desa.';
                break;

            default:
                return back()->with('error', 'Anda tidak punya akses verifikasi.');
        }

        return back()->with('success', $message);
    }

    public function indexBendahara()
    {
        $rabs = Rab::all(); // bisa ditambahkan filter status jika mau
        return view('rab.index-bendahara', compact('rabs'));
    }



    public function tolak(Request $request, Rab $rab)
    {
        $rab->update([
            'status' => 'ditolak',
            'catatan_koreksi' => $request->catatan
        ]);

        return back()->with('error', 'RAB ditolak.');
    }
}
