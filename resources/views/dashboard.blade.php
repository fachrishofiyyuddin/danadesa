<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard — {{ ucfirst(auth()->user()->role) }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Welcome Box Breeze Style --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-800">
                    <h1 class="text-xl font-semibold">
                        Welcome, {{ auth()->user()->name }} 👋
                    </h1>
                    <p class="text-gray-600">Pelatihan Sistem Informasi Pengelolaan Dana Desa di Desa Kandangmas
                        Kabupaten Kudus</p>
                </div>
            </div>

            {{-- Menu Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                {{-- KAUR / KEPALA SEKSI --}}
                @if (in_array(auth()->user()->role, ['kaur', 'kepala_seksi']))
                    <a href="{{ route('rab.index') }}"
                        class="bg-white p-4 shadow-sm hover:shadow-md border rounded-lg block">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Kelola RAB</h3>
                        <p class="text-gray-600 text-sm">
                            Buat dan kelola RAB kegiatan.
                        </p>
                    </a>
                @endif

                {{-- SEKRETARIS DESA --}}
                @if (auth()->user()->role === 'sekdes')
                    <a href="{{ route('rab.index') }}"
                        class="bg-white p-4 shadow-sm hover:shadow-md border rounded-lg block">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Verifikasi RAB</h3>
                        <p class="text-gray-600 text-sm">
                            Verifikasi data RAB dari Kaur.
                        </p>
                    </a>
                @endif

                {{-- BENDAHARA --}}
                @if (auth()->user()->role === 'bendahara')
                    <a href="{{ route('rab.index') }}"
                        class="bg-white p-4 shadow-sm hover:shadow-md border rounded-lg block">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Daftar RAB</h3>
                        <p class="text-gray-600 text-sm">
                            Pilih RAB untuk membuat atau melihat SPP.
                        </p>
                    </a>

                    <a href="{{ route('spp.index') }}"
                        class="bg-white p-4 shadow-sm hover:shadow-md border rounded-lg block">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Kelola SPP</h3>
                        <p class="text-gray-600 text-sm">
                            Proses verifikasi SPP.
                        </p>
                    </a>

                    <a href="{{ route('pembayaran.index') }}"
                        class="bg-white p-4 shadow-sm hover:shadow-md border rounded-lg block">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Pembayaran</h3>
                        <p class="text-gray-600 text-sm">
                            Input dan monitoring pembayaran.
                        </p>
                    </a>
                @endif


                {{-- KEPALA DESA --}}
                @if (auth()->user()->role === 'kepala_desa')
                    <a href="{{ route('rab.index') }}"
                        class="bg-white p-4 shadow-sm hover:shadow-md border rounded-lg block">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Persetujuan RAB</h3>
                        <p class="text-gray-600 text-sm">
                            Menyetujui atau menolak RAB.
                        </p>
                    </a>

                    <a href="{{ route('laporan.index') }}"
                        class="bg-white p-4 shadow-sm hover:shadow-md border rounded-lg block">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Laporan Realisasi</h3>
                        <p class="text-gray-600 text-sm">
                            Cek laporan anggaran desa.
                        </p>
                    </a>
                @endif

            </div>
        </div>
    </div>

</x-app-layout>
