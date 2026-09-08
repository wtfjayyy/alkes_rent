<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Tambah Kategori Unit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl border border-gray-100 p-6 lg:p-8">
                
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nama Kategori</label>
                        <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}" required class="shadow appearance-none border rounded w-full py-2.5 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contoh: Alat Bantu Jalan">
                        @error('nama_kategori') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi (Opsional)</label>
                        <textarea name="deskripsi" rows="3" class="shadow appearance-none border rounded w-full py-2.5 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Keterangan tambahan kategori...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center justify-end space-x-3">
                        <a href="{{ route('categories.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-semibold transition">Batal</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-semibold shadow transition">Simpan Kategori</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>