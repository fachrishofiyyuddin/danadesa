<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Buat RAB Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('rab.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Nama Kegiatan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Kegiatan</label>
                            <input type="text" name="nama_kegiatan" placeholder="Contoh: Renovasi Lab Komputer"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                       focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea name="deskripsi" rows="3" placeholder="Tambahkan deskripsi kegiatan..."
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                       focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                        </div>

                        <!-- Jumlah Anggaran -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jumlah Anggaran</label>
                            <input type="number" name="jumlah_anggaran" placeholder="Contoh: 25000000"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                       focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                        </div>

                        <div class="flex justify-end">
                            <button
                                class="inline-flex items-center gap-2 px-5 py-2 bg-blue-600 text-white rounded-md 
           hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">

                                {{-- ICON SAVE --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path d="M17 7h-2V3H5v4H3v10h14V7zM7 5h6v2H7V5zm3 9a2 2 0 110-4 2 2 0 010 4z" />
                                </svg>

                                Simpan
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
