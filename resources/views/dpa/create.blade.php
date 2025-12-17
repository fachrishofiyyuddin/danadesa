<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Tambah DPA</h2>
    </x-slot>

    <div class="p-6 bg-white shadow rounded-lg">
        <form method="POST" action="{{ route('dpa.store', $rab->id) }}">
            @csrf

            <div class="mb-4">
                <label class="block font-medium">Nomor DPA</label>
                <input type="text" name="nomor_dpa" value="{{ $nomorDpa }}"
                    class="w-full border rounded p-2 bg-gray-100" readonly>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Tanggal Pengesahan</label>
                <input type="date" name="tanggal_pengesahan" value="{{ now()->toDateString() }}"
                    class="w-full border rounded p-2">
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                Simpan DPA
            </button>
        </form>
    </div>
</x-app-layout>
