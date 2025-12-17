<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Tambah Pembayaran</h2>
    </x-slot>

    <div class="p-6 bg-white shadow rounded space-y-6">

        {{-- INFO SPP --}}
        <div class="border rounded-lg p-4 bg-gray-50">
            <p class="text-sm text-gray-600">Pembayaran untuk</p>

            <p class="text-lg font-semibold text-gray-800">
                Nomor SPP: {{ $spp->nomor_spp }}
            </p>

            <p class="text-sm text-gray-700">
                RAB: {{ $spp->rab->nama_kegiatan }}
            </p>

            <p class="text-sm text-gray-700">
                Jumlah SPP:
                <strong>
                    Rp {{ number_format($spp->jumlah_diminta, 0, ',', '.') }}
                </strong>
            </p>
        </div>

        {{-- ALERT ERROR --}}
        @if ($errors->any())
            <div class="p-4 rounded-lg bg-red-100 text-red-800 border border-red-300">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- ALERT SUCCESS --}}
        @if (session('success'))
            <div class="p-4 rounded-lg bg-green-100 text-green-800 border border-green-300">
                {{ session('success') }}
            </div>
        @endif

        {{-- FORM --}}
        <form method="POST" action="{{ route('pembayaran.store', $spp->id) }}">
            @csrf

            <div class="mb-4">
                <label class="block font-medium">Tanggal Pembayaran</label>
                <input type="date" name="tanggal" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Jumlah Dibayar</label>
                <input type="number" name="jumlah_dibayar" class="w-full border p-2 rounded"
                    placeholder="Masukkan jumlah pembayaran" max="{{ $spp->jumlah_diminta }}" min="1" required>
                <p class="text-sm text-gray-500 mt-1">
                    Maksimal: <strong>Rp {{ number_format($spp->jumlah_diminta, 0, ',', '.') }}</strong>
                </p>
            </div>


            <div class="mb-4">
                <label class="block font-medium mb-1">Metode Pembayaran</label>
                <select name="metode" class="w-full border p-2 rounded" required>
                    <option value="">-- Pilih Metode --</option>
                    <option value="Tunai">Tunai</option>
                    <option value="Transfer">Transfer</option>
                    <option value="Giro">Giro</option>
                </select>
            </div>


            <button class="px-4 py-2 bg-blue-600 text-white rounded">
                Simpan Pembayaran
            </button>
        </form>

    </div>
</x-app-layout>
