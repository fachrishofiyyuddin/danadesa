<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Laporan Realisasi Kegiatan
        </h2>
    </x-slot>

    <div class="p-6 bg-white rounded shadow">
        @if ($rabs->isEmpty())
            <div class="text-center text-gray-500 py-10">
                Belum ada laporan realisasi.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-left text-sm">
                            <th class="border p-3">No</th>
                            <th class="border p-3">Nama Kegiatan</th>
                            <th class="border p-3">Penanggung Jawab</th>
                            <th class="border p-3">Anggaran</th>
                            <th class="border p-3">Realisasi</th>
                            <th class="border p-3 text-center">Status</th>
                            <th class="border p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rabs as $index => $rab)
                            @php
                                $realisasi = $rab->spps->sum(function ($spp) {
                                    return $spp->pembayarans->sum('jumlah_dibayar');
                                });
                            @endphp
                            <tr class="text-sm">
                                <td class="border p-3">{{ $index + 1 }}</td>
                                <td class="border p-3 font-medium">
                                    {{ $rab->nama_kegiatan }}
                                </td>
                                <td class="border p-3">
                                    {{ $rab->user->name ?? '-' }}
                                </td>
                                <td class="border p-3">
                                    Rp {{ number_format($rab->jumlah_anggaran, 0, ',', '.') }}
                                </td>
                                <td class="border p-3">
                                    Rp {{ number_format($realisasi, 0, ',', '.') }}
                                </td>
                                <td class="border p-3 text-center">
                                    <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                        Selesai
                                    </span>
                                </td>
                                <td class="border p-3 text-center">
                                    <a href="{{ route('laporan.show', $rab->id) }}"
                                        class="text-blue-600 hover:underline">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
