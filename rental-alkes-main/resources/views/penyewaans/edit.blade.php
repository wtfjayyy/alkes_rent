<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-slate-800 leading-tight">
                {{ __('Edit Transaksi Penyewaan') }}
            </h2>
            <a href="{{ route('penyewaans.show', $penyewaan->id) }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900 transition">
                &larr; Kembali ke Detail
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-xl border border-slate-200">
                <div class="p-8 md:p-10 text-slate-900">

                    <form action="{{ route('penyewaans.update', $penyewaan->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Pelanggan dengan jarak (space) yang lebih longgar & proporsional -->
                        <div class="mb-6">
                            <label for="customer_id" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2.5">Pelanggan</label>
                            <select name="customer_id" id="customer_id" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm px-4 py-3">
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ $penyewaan->customer_id == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Unit Alkes -->
                        <div class="mb-6">
                            <label for="unit_alkes_id" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2.5">Unit Alat Kesehatan</label>
                            <select name="unit_alkes_id" id="unit_alkes_id" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm px-4 py-3">
                                @foreach($units as $unit)
                                    <option value="{{ $unit->id }}" {{ $penyewaan->unit_alkes_id == $unit->id ? 'selected' : '' }}>
                                        {{ $unit->nama_alat }} ({{ $unit->kode_unit }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tanggal Sewa -->
                        <div class="mb-6">
                            <label for="tanggal_sewa" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2.5">Tanggal Sewa</label>
                            <input type="date" name="tanggal_sewa" id="tanggal_sewa" value="{{ $penyewaan->tanggal_sewa }}" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm px-4 py-3">
                        </div>

                        <!-- Total Biaya -->
                        <div class="mb-8">
                            <label for="total_biaya" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2.5">Total Biaya (Rp)</label>
                            <input type="number" name="total_biaya" id="total_biaya" value="{{ $penyewaan->total_biaya }}" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm px-4 py-3">
                        </div>

                        <!-- Tombol Aksi dengan Spasi Pemisah yang Elegan -->
                        <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                            <a href="{{ route('penyewaans.show', $penyewaan->id) }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-white border border-slate-300 text-slate-700 rounded-lg font-bold text-xs uppercase tracking-wider hover:bg-slate-50 transition shadow-sm whitespace-nowrap">
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