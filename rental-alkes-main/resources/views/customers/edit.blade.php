<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-slate-800 leading-tight">
                {{ __('Edit Data Pelanggan') }}
            </h2>
            <a href="{{ route('customers.index') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900 transition">
                &larr; Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-xl border border-slate-200">
                <div class="p-8 md:p-10 text-slate-900">

                    <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nama Pelanggan -->
                        <div class="mb-6">
                            <label for="nama" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2.5">Nama Pelanggan</label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama', $customer->nama) }}" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm px-4 py-3" required>
                        </div>

                        <!-- No HP / Telepon -->
                        <div class="mb-6">
                            <label for="telepon" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2.5">No. HP / WhatsApp</label>
                            <!-- FIX POIN 1: Tambahkan maxlength 255 dan placeholder -->
                            <input type="text" name="telepon" id="telepon" value="{{ old('telepon', $customer->telepon) }}" maxlength="255" placeholder="Contoh: 0812xxx, 0857xxx (Bisa lebih dari 1 nomor)" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm px-4 py-3" required>
                        </div>

                        <!-- Alamat -->
                        <div class="mb-8">
                            <label for="alamat" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2.5">Alamat Lengkap</label>
                            <textarea name="alamat" id="alamat" rows="3" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm px-4 py-3" required>{{ old('alamat', $customer->alamat) }}</textarea>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                            <a href="{{ route('customers.index') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-white border border-slate-300 text-slate-700 rounded-lg font-bold text-xs uppercase tracking-wider hover:bg-slate-50 transition shadow-sm whitespace-nowrap">
                                Batal
                            </a>
                            
                            <button type="submit" class="inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 text-white rounded-lg font-bold text-xs uppercase tracking-wider hover:bg-blue-700 transition shadow-sm whitespace-nowrap">
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>