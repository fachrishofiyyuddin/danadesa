<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">

        @php
            $role = auth()->user()->role;
        @endphp

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Daftar RAB</h1>

            {{-- TOMBOL TAMBAH (SELain Bendahara) --}}
            @if ($role !== 'bendahara' && $role !== 'kades')
                <a href="{{ route('rab.create') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white 
                rounded-lg hover:bg-blue-700 transition font-semibold">

                    {{-- ICON PLUS --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" />
                    </svg>

                    Tambah RAB
                </a>
            @endif
        </div>



        {{-- CARD TABLE --}}
        <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-100">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="p-4 font-semibold text-gray-700">Nama Kegiatan</th>
                        <th class="p-4 font-semibold text-gray-700">Jumlah</th>
                        <th class="p-4 font-semibold text-gray-700">Status</th>
                        <th class="p-4 text-center font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach ($rabs as $rab)
                        @php
                            $colors = [
                                'draft' => 'bg-gray-200 text-gray-800',
                                'cek_sekdes' => 'bg-yellow-200 text-yellow-800',
                                'cek_bendahara' => 'bg-blue-200 text-blue-800',
                                'cek_kades' => 'bg-purple-200 text-purple-800',
                                'disetujui' => 'bg-green-200 text-green-800',
                                'ditolak' => 'bg-red-200 text-red-800',
                            ];
                        @endphp
                        @php
                            $labels = [
                                'draft' => 'Draft (Belum Dikirim)',
                                'cek_sekdes' => 'Verifikasi Sekdes',
                                'cek_bendahara' => 'Verifikasi Bendahara',
                                'cek_kades' => 'Persetujuan Kepala Desa',
                                'disetujui' => 'Disetujui (Final)',
                                'ditolak' => 'Ditolak (Perlu Perbaikan)',
                            ];
                        @endphp


                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 text-gray-800 font-medium">{{ $rab->nama_kegiatan }}</td>
                            <td class="p-4 text-gray-700">Rp {{ number_format($rab->jumlah_anggaran) }}</td>
                            <td class="p-4">
                                <span
                                    class="px-3 py-1 rounded-full text-sm font-semibold {{ $colors[$rab->status] ?? '' }}">
                                    {{ $labels[$rab->status] ?? '-' }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                @php
                                    $role = auth()->user()->role;
                                @endphp

                                <div class="flex justify-center gap-4">

                                    {{-- DETAIL (bukan KAUR) --}}
                                    @if ($role !== 'kaur')
                                        <a href="{{ route('rab.show', $rab) }}"
                                            class="text-blue-600 hover:underline font-semibold">
                                            Detail
                                        </a>
                                    @endif

                                    {{-- BUAT DPA (KHUSUS SEKDES, RAB DISUTUJUI & DPA BELUM ADA) --}}
                                    @if ($role === 'sekdes' && $rab->status === 'disetujui' && !$rab->dpa)
                                        <a href="{{ route('dpa.create', $rab->id) }}"
                                            class="text-indigo-600 hover:underline font-semibold">
                                            Buat DPA
                                        </a>
                                    @endif

                                    {{-- STATUS DPA UNTUK SEKDES --}}
                                    @if ($role === 'sekdes' && $rab->status === 'disetujui' && $rab->dpa)
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full
               bg-green-100 text-green-800 text-sm font-semibold">
                                            ✔ DPA Sudah Dibuat
                                        </span>
                                    @endif


                                    {{-- SPP / Status DPA --}}
                                    @if ($role === 'kaur' && $rab->status === 'disetujui')
                                        @if ($rab->dpa)
                                            {{-- DPA SUDAH ADA → BOLEH AJUKAN SPP --}}
                                            <a href="{{ route('spp.index', ['rab_id' => $rab->id]) }}"
                                                class="text-green-600 hover:underline font-semibold">
                                                Ajukan SPP
                                            </a>
                                        @else
                                            {{-- DPA BELUM ADA --}}
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full
            bg-yellow-100 text-yellow-800 text-sm font-semibold">
                                                ⏳ Menunggu DPA (Sekdes)
                                            </span>
                                        @endif
                                    @endif

                                    {{-- SPP / Status DPA --}}
                                    @if ($role === 'bendahara' && $rab->status === 'disetujui')
                                        @if ($rab->dpa)
                                            {{-- DPA SUDAH ADA → BOLEH AJUKAN SPP --}}
                                            <a href="{{ route('spp.index', ['rab_id' => $rab->id]) }}"
                                                class="text-green-600 hover:underline font-semibold">
                                                Cek SPP
                                            </a>
                                        @else
                                            {{-- DPA BELUM ADA --}}
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full
            bg-yellow-100 text-yellow-800 text-sm font-semibold">
                                                ⏳ Menunggu DPA (Sekdes)
                                            </span>
                                        @endif
                                    @endif




                                    {{-- HAPUS (KAUR & masih draft) --}}
                                    @if ($role === 'kaur' && $rab->status === 'draft')
                                        <form action="{{ route('rab.destroy', $rab) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus RAB ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="text-red-600 hover:underline font-semibold">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
