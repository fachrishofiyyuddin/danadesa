<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Daftar RAB</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($rabs as $rab)
                <a href="{{ route('spp.index', ['rab_id' => $rab->id]) }}"
                    class="bg-white p-4 shadow-sm border rounded-lg hover:shadow-md block">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $rab->nama_kegiatan }}</h3>
                    <p class="text-gray-600 text-sm">Total Anggaran: Rp
                        {{ number_format($rab->total_anggaran, 2, ',', '.') }}</p>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
