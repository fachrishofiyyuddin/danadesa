<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Daftar SPP</h1>

            {{-- Tombol tambah SPP hanya muncul jika rab_id ada --}}
            @if ((auth()->user()->role === 'kaur' || auth()->user()->role === 'bendahara') && request('rab_id'))
                <a href="{{ route('spp.create', ['rab_id' => request('rab_id')]) }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                    <span class="text-lg">＋</span>
                    Tambah SPP
                </a>
            @endif
        </div>

        {{-- CARD TABLE --}}
        <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-100">

            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="p-4 font-semibold text-gray-700">Nomor SPP</th>
                        <th class="p-4 font-semibold text-gray-700">Jumlah Diminta</th>
                        <th class="p-4 font-semibold text-gray-700">Status</th>
                        <th class="p-4 text-center font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse ($spps as $spp)
                        @php
                            $colors = [
                                'menunggu_verifikasi' => 'bg-yellow-100 text-yellow-700',
                                'ditolak' => 'bg-red-100 text-red-700',
                                'disetujui' => 'bg-green-100 text-green-700',
                            ];
                        @endphp

                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 text-gray-800 font-medium">
                                {{ $spp->nomor_spp ?? '-' }}
                            </td>
                            <td class="p-4 text-gray-700">
                                Rp {{ number_format($spp->jumlah_diminta, 2, ',', '.') }}
                            </td>
                            <td class="p-4">
                                <span
                                    class="px-3 py-1 rounded-full text-sm font-semibold {{ $colors[$spp->status] ?? '' }}">
                                    {{ strtoupper(str_replace('_', ' ', $spp->status)) }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                <div class="flex justify-center gap-4">

                                    {{-- DETAIL --}}
                                    <a href="{{ route('spp.show', $spp) }}"
                                        class="text-blue-600 hover:underline font-semibold">
                                        Detail
                                    </a>

                                    {{-- HAPUS --}}
                                    @if (
                                        (auth()->user()->role === 'bendahara' && $spp->status === 'menunggu_verifikasi') ||
                                            (auth()->user()->role === 'kaur' && $spp->status === 'ditolak'))
                                        @if (Route::has('spp.destroy'))
                                            <form action="{{ route('spp.destroy', $spp) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus SPP ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:underline font-semibold">Hapus</button>
                                            </form>
                                        @endif
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500">
                                Tidak ada SPP untuk RAB ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

    </div>
</x-app-layout>
