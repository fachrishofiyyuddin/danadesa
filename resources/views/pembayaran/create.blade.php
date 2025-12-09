<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Tambah Pembayaran</h2>
    </x-slot>

    <div class="p-6 bg-white shadow rounded">
        <form method="POST" action="{{ route('pembayaran.store', $spp->id) }}">
            @csrf

            <div class="mb-4">
                <label>Tanggal Pembayaran</label>
                <input type="date" name="tanggal" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label>Jumlah Dibayar</label>
                <input type="number" name="jumlah_dibayar" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label>Metode</label>
                <input type="text" name="metode" class="w-full border p-2 rounded">
            </div>

            <button class="px-4 py-2 bg-blue-600 text-white rounded">
                Simpan Pembayaran
            </button>
        </form>
    </div>
</x-app-layout>
