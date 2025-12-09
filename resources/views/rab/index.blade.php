<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Daftar RAB</h1>
        </div>

        {{-- CARD TABLE --}}
        <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-100">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="p-4 font-semibold text-gray-700">Nama Kegiatan</th>
                        <th class="p-4 font-semibold text-gray-700">Jumlah</th>
                        <th class="p-4 font-semibold text-gray-700">Status</th>
                        <th class="p-4 text-center font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach ($rabs as $rab)
                        @php
                            $colors = [
                                'draft' => 'bg-gray-100 text-gray-700',
                                'cek_sekdes' => 'bg-yellow-100 text-yellow-700',
                                'cek_bendahara' => 'bg-blue-100 text-blue-700',
                                'cek_kades' => 'bg-purple-100 text-purple-700',
                                'ditolak' => 'bg-red-100 text-red-700',
                                'disetujui' => 'bg-green-100 text-green-700',
                            ];
                        @endphp

                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 text-gray-800 font-medium">{{ $rab->nama_kegiatan }}</td>
                            <td class="p-4 text-gray-700">Rp {{ number_format($rab->jumlah_anggaran) }}</td>
                            <td class="p-4">
                                <span
                                    class="px-3 py-1 rounded-full text-sm font-semibold {{ $colors[$rab->status] ?? '' }}">
                                    {{ strtoupper(str_replace('_', ' ', $rab->status)) }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                <div class="flex justify-center gap-4">

                                    {{-- DETAIL --}}
                                    <a href="{{ route('rab.show', $rab) }}"
                                        class="text-blue-600 hover:underline font-semibold">
                                        Detail
                                    </a>

                                    {{-- LIHAT / TAMBAH SPP --}}
                                    <a href="{{ route('spp.index', ['rab_id' => $rab->id]) }}"
                                        class="text-green-600 hover:underline font-semibold">
                                        SPP
                                    </a>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
