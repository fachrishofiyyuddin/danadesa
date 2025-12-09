<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Buat SPP</h2>
    </x-slot>

    <div class="p-6 bg-white rounded shadow">
        <form method="POST" action="{{ route('spp.store', $rab->id) }}">
            @csrf

            <div class="mb-4">
                <label>Nomor SPP</label>
                <input type="text" name="nomor_spp" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label>Jumlah</label>
                <input type="number" name="jumlah" class="w-full border p-2 rounded">
            </div>

            <button class="px-4 py-2 bg-blue-600 text-white rounded">
                Simpan SPP
            </button>
        </form>
    </div>
</x-app-layout>
