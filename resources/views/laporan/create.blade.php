<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Upload Laporan</h2>
    </x-slot>

    <div class="p-6 bg-white shadow rounded">
        <form method="POST" enctype="multipart/form-data" action="{{ route('laporan.store', $rab->id) }}">
            @csrf

            <div class="mb-4">
                <label>File Laporan (PDF)</label>
                <input type="file" name="file_laporan" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label>Keterangan</label>
                <textarea name="keterangan" class="w-full border p-2 rounded"></textarea>
            </div>

            <button class="px-4 py-2 bg-blue-600 text-white rounded">
                Upload
            </button>
        </form>
    </div>
</x-app-layout>
