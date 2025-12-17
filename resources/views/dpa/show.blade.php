<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 space-y-6">

        {{-- HEADER --}}
        <h1 class="text-3xl font-bold text-gray-800">
            Detail DPA
        </h1>

        {{-- CARD DETAIL --}}
        <div class="bg-white border rounded-lg shadow-sm p-6 space-y-5">

            <div>
                <p class="text-sm text-gray-500">Nomor DPA</p>
                <p class="text-lg font-semibold text-gray-800">
                    {{ $dpa->nomor_dpa ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Tanggal Pengesahan</p>
                <p class="text-lg text-gray-800">
                    {{ \Carbon\Carbon::parse($dpa->tanggal_pengesahan)->format('d F Y') }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Kegiatan (RAB)</p>
                <p class="text-lg text-gray-800">
                    {{ $dpa->rab->nama_kegiatan ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Total Anggaran RAB</p>
                <p class="text-2xl font-bold text-green-700">
                    Rp {{ number_format($dpa->rab->jumlah_anggaran, 0, ',', '.') }}
                </p>
            </div>

        </div>

        {{-- AKSI --}}
        <div class="flex gap-4">

            <a href="{{ route('rab.show', $dpa->rab->id) }}"
                class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded text-gray-700 font-semibold">
                ← Kembali ke RAB
            </a>

            @if (auth()->user()->role === 'kaur')
                <a href="{{ route('dpa.edit', $dpa) }}"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded font-semibold">
                    Edit DPA
                </a>
            @endif

        </div>

    </div>
</x-app-layout>
