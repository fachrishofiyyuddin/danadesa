<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            Detail Laporan Realisasi
        </h2>
    </x-slot>

    <div class="p-6 space-y-6">

        {{-- INFO KEGIATAN --}}
        <div class="bg-white p-5 rounded shadow">
            <h3 class="font-semibold text-lg mb-2">
                {{ $rab->nama_kegiatan }}
            </h3>
            <p class="text-sm text-gray-600">
                Penanggung Jawab: {{ $rab->user->name ?? '-' }}
            </p>
            <p class="text-sm text-gray-600">
                Total Anggaran:
                <strong>
                    Rp {{ number_format($rab->jumlah_anggaran, 0, ',', '.') }}
                </strong>
            </p>
            <p class="text-sm text-gray-600">
                Total Realisasi:
                <strong class="text-green-600">
                    Rp {{ number_format($totalRealisasi, 0, ',', '.') }}
                </strong>
            </p>
        </div>

        {{-- DETAIL SPP --}}
        <div class="bg-white p-5 rounded shadow">
            <h4 class="font-semibold mb-3">Detail Pembayaran (SPP)</h4>

            <table class="w-full text-sm border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-2">No SPP</th>
                        <th class="border p-2">Tanggal</th>
                        <th class="border p-2">Jumlah</th>
                        <th class="border p-2">Metode</th>
                        <th class="border p-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rab->spps as $spp)
                        @foreach ($spp->pembayarans as $bayar)
                            <tr>
                                <td class="border p-2">{{ $spp->nomor_spp }}</td>
                                <td class="border p-2">{{ $bayar->tanggal }}</td>
                                <td class="border p-2">
                                    Rp {{ number_format($bayar->jumlah_dibayar, 0, ',', '.') }}
                                </td>
                                <td class="border p-2">{{ $bayar->metode }}</td>
                                <td class="border p-2 text-center">
                                    <span class="text-green-600 font-semibold">Dibayar</span>
                                </td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500 p-4">
                                Belum ada pembayaran
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <br>

        {{-- AKSI --}}
        <div class="flex justify-end">
            <a href="{{ route('laporan.pdf', $rab->id) }}" target="_blank"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Cetak (PDF)
            </a>
        </div>

    </div>
</x-app-layout>
