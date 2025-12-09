<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Tambah DPA</h2>
    </x-slot>

    <div class="p-6 bg-white shadow rounded-lg">
        <form method="POST" action="{{ route('dpa.store', $rab->id) }}">
            @csrf

            <div class="mb-4">
                <label class="block font-medium">Nomor DPA</label>
                <input type="text" name="nomor_dpa" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block font-medium">Tanggal Pengesahan</label>
                <input type="date" name="tanggal_pengesahan" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block font-medium">Nilai DPA</label>
                <input type="number" name="nilai_dpa" class="w-full border rounded p-2">
            </div>

            <button class="px-4 py-2 bg-blue-600 text-white rounded">
                Simpan DPA
            </button>
        </form>
    </div>
</x-app-layout>
