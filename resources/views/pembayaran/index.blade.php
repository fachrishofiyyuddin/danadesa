<x-app-layout>
    <div class="max-w-6xl mx-auto p-6 space-y-6">

        {{-- JUDUL --}}
        <h1 class="text-3xl font-bold text-gray-800">
            Data Pembayaran
        </h1>

        {{-- CARD TABLE --}}
        <div class="bg-white border rounded-lg shadow-sm overflow-hidden">

            <table class="w-full divide-y">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="p-4 text-left font-semibold">Tanggal</th>
                        <th class="p-4 text-left font-semibold">Nomor SPP</th>
                        <th class="p-4 text-left font-semibold">Jumlah Dibayar</th>
                        <th class="p-4 text-left font-semibold">Metode</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse ($pembayarans as $pembayaran)
                        <tr class="hover:bg-gray-50 transition">
                            {{-- TANGGAL --}}
                            <td class="p-4 text-gray-700">
                                {{ \Carbon\Carbon::parse($pembayaran->tanggal)->format('d M Y') }}
                            </td>

                            {{-- SPP --}}
                            <td class="p-4 font-medium text-gray-800">
                                {{ $pembayaran->spp->nomor_spp ?? '-' }}
                            </td>

                            {{-- JUMLAH --}}
                            <td class="p-4 font-semibold text-green-700">
                                Rp {{ number_format($pembayaran->jumlah_dibayar, 2, ',', '.') }}
                            </td>

                            {{-- METODE --}}
                            <td class="p-4">
                                <span
                                    class="px-3 py-1 rounded-full text-sm font-semibold
                                    {{ $pembayaran->metode ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $pembayaran->metode ?? 'Tidak Ada' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-6 text-center text-gray-500">
                                Belum ada data pembayaran.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

    </div>
</x-app-layout>
