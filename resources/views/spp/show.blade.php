<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 space-y-6 text-[17px]">

        {{-- JUDUL --}}
        <h1 class="text-3xl font-bold text-gray-800">
            SPP: {{ $spp->nomor_spp ?? '-' }}
        </h1>

        {{-- CARD DETAIL --}}
        <div class="bg-white border rounded-lg shadow-sm p-6 space-y-5">

            <div>
                <p class="text-base text-gray-600">Nomor SPP</p>
                <p class="text-lg text-gray-800 leading-relaxed">{{ $spp->nomor_spp ?? '-' }}</p>
            </div>

            <div>
                <p class="text-base text-gray-600">Jumlah Diminta</p>
                <p class="text-2xl font-bold text-green-700">
                    Rp {{ number_format($spp->jumlah_diminta, 2, ',', '.') }}
                </p>
            </div>

            <div>
                <p class="text-base text-gray-600 mb-2">Status</p>
                <span
                    class="px-4 py-2 rounded text-base font-semibold
                    @if ($spp->status == 'menunggu_verifikasi') bg-yellow-100 text-yellow-700
                    @elseif($spp->status == 'ditolak') bg-red-100 text-red-700
                    @elseif($spp->status == 'disetujui') bg-green-100 text-green-700 @endif
                ">
                    {{ strtoupper(str_replace('_', ' ', $spp->status)) }}
                </span>
            </div>

            @if ($spp->catatan ?? false)
                <div>
                    <p class="text-base text-gray-600">Catatan Koreksi</p>
                    <p class="text-lg text-red-600 bg-red-50 border border-red-200 p-3 rounded">
                        {{ $spp->catatan }}
                    </p>
                </div>
            @endif

            <div>
                <p class="text-base text-gray-600">RAB Terkait</p>
                <p class="text-lg text-gray-800">{{ $spp->rab->nama_kegiatan ?? '-' }}</p>
            </div>

        </div>

        {{-- LOGIC ROLE --}}
        @php
            $role = auth()->user()->role;
            $status = $spp->status;
        @endphp

        {{-- AREA AKSI --}}
        @if (
            ($role === 'sekdes' && $status === 'menunggu_verifikasi') ||
                ($role === 'bendahara' && $status === 'menunggu_verifikasi') ||
                ($role === 'kades' && $status === 'menunggu_verifikasi'))
            <div class="bg-white border rounded-lg shadow-sm p-6 space-y-5">

                <h2 class="text-2xl font-semibold text-gray-800">
                    @if ($role === 'sekdes')
                        Verifikasi Sekdes
                    @elseif ($role === 'bendahara')
                        Verifikasi Bendahara
                    @elseif ($role === 'kades')
                        Persetujuan Kepala Desa
                    @endif
                </h2>

                <div class="flex flex-col md:flex-row gap-4 text-lg">

                    {{-- TOMBOL SETUJUI --}}
                    <form method="POST" action="{{ route('spp.verifikasi', $spp) }}">
                        @csrf
                        <button
                            class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg text-lg font-semibold">
                            ✔ Setujui
                        </button>
                    </form>

                    {{-- TOMBOL TOLAK --}}
                    <form method="POST" action="{{ route('spp.tolak', $spp) }}" class="flex gap-3 w-full md:w-auto">
                        @csrf
                        <input type="text" name="catatan" class="border rounded-lg p-3 flex-1 md:w-72 text-base"
                            placeholder="Catatan penolakan...">

                        <button
                            class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg text-lg font-semibold">
                            ✖ Tolak
                        </button>
                    </form>

                </div>
            </div>
        @endif

    </div>
</x-app-layout>
