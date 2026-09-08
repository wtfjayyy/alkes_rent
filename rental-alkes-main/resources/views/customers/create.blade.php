<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Tambah Pelanggan Baru') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 p-8">
                
                <form action="{{ route('customers.store') }}" method="POST">
                    @csrf

                    <div class="space-y-6">
                        <div>
                            <label for="nama" class="block font-semibold text-sm text-gray-700 mb-2">Nama Lengkap Pasien / Keluarga</label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required 
                                class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm py-2.5 px-3" placeholder="Contoh: Budi Santoso">
                            @error('nama') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="telepon" class="block font-semibold text-sm text-gray-700 mb-2">No. Telepon / WhatsApp</label>
                            <!-- FIX POIN 1: Tambahkan maxlength 255 dan ubah placeholder -->
                            <input type="text" name="telepon" id="telepon" value="{{ old('telepon') }}" required maxlength="255"
                                class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm py-2.5 px-3" placeholder="Contoh: 0812xxx, 0857xxx (Bisa lebih dari 1 nomor)">
                            @error('telepon') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="alamat" class="block font-semibold text-sm text-gray-700 mb-2">Alamat Lengkap di Palembang</label>
                            <textarea name="alamat" id="alamat" rows="3" required 
                                class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm py-2.5 px-3" placeholder="Contoh: Jl. Jend. Sudirman No. 123, Palembang">{{ old('alamat') }}</textarea>
                            @error('alamat') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-8 pt-4 border-t border-gray-100 space-x-4">
                        <a href="{{ route('customers.index') }}" class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-50 font-semibold text-sm transition">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm shadow transition">
                            Simpan Pelanggan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>