<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">
                Daftar DPA
            </h1>
        </div>

        {{-- TABLE CARD --}}
        <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-100">

            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="p-4 font-semibold text-gray-700">Nomor DPA</th>
                        <th class="p-4 font-semibold text-gray-700">Kegiatan</th>
                        <th class="p-4 font-semibold text-gray-700">Tanggal Pengesahan</th>
                        <th class="p-4 text-center font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse ($dpas as $dpa)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 font-medium text-gray-800">
                                {{ $dpa->nomor_dpa ?? '-' }}
                            </td>

                            <td class="p-4 text-gray-700">
                                {{ $dpa->rab->nama_kegiatan ?? '-' }}
                            </td>

                            <td class="p-4 text-gray-700">
                                {{ \Carbon\Carbon::parse($dpa->tanggal_pengesahan)->format('d-m-Y') }}
                            </td>

                            <td class="p-4 text-center">
                                <div class="flex justify-center gap-4">

                                    {{-- DETAIL --}}
                                    <a href="{{ route('dpa.show', $dpa) }}"
                                        class="text-blue-600 hover:underline font-semibold">
                                        Detail
                                    </a>

                                    {{-- HAPUS (opsional) --}}
                                    @if (auth()->user()->role === 'sekdes')
                                        <form action="{{ route('dpa.destroy', $dpa) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus DPA ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 hover:underline font-semibold">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif


                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-6 text-center text-gray-500">
                                Belum ada DPA
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

    </div>
</x-app-layout>
