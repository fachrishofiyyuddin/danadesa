<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Buat SPP</h2>
    </x-slot>

    <div class="p-6 bg-white rounded shadow">
        {{-- ALERT SUCCESS --}}
        @if (session('success'))
            <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 border border-green-300">
                {{ session('success') }}
            </div>
        @endif

        {{-- ALERT ERROR VALIDASI --}}
        @if ($errors->any())
            <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-800 border border-red-300">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('spp.store', $rab->id) }}">
            @csrf

            <div class="mb-4">
                <label>Nomor SPP</label>
                <input type="text" name="nomor_spp" value="{{ $nomorSpp }}"
                    class="w-full border p-2 rounded bg-gray-100" readonly>
            </div>


            <div class="mb-4">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label>Jumlah Diminta</label>
                <input type="number" name="jumlah" value="{{ $sisaAnggaran }}" max="{{ $sisaAnggaran }}"
                    min="1" class="w-full border p-2 rounded" required>
                <p class="text-sm text-gray-500 mt-1">
                    Sisa anggaran: <strong>Rp {{ number_format($sisaAnggaran, 0, ',', '.') }}</strong>
                </p>
            </div>

            <button class="px-4 py-2 bg-blue-600 text-white rounded">
                Simpan SPP
            </button>
        </form>
    </div>
</x-app-layout>
