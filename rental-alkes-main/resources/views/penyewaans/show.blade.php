<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-slate-800 leading-tight">
                {{ __('Detail Transaksi Penyewaan') }}
            </h2>
            <a href="{{ route('penyewaans.index') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900 transition">
                &larr; Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="py-12" x-data="{ deleteModal: false }">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-xl border border-slate-200">
                <div class="p-8 text-slate-900">
                    
                    <!-- Header Nota / Status -->
                    <div class="flex justify-between items-start border-b border-slate-100 pb-6 mb-6">
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">ID Transaksi</p>
                            <h3 class="text-2xl font-extrabold text-slate-800 mt-1">#TRX-{{ str_pad($penyewaan->id, 4, '0', STR_PAD_LEFT) }}</h3>
                            <p class="text-sm text-slate-500 mt-1">Tanggal Sewa: <span class="font-semibold text-slate-700">{{ \Carbon\Carbon::parse($penyewaan->tanggal_sewa)->translatedFormat('d F Y') }}</span></p>
                        </div>
                        
                        <div class="flex-shrink-0">
                            @if($penyewaan->status == 'Disewa')
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200 shadow-sm whitespace-nowrap">
                                    <span class="w-2 h-2 rounded-full bg-amber-500 mr-2 animate-pulse"></span>
                                    Sedang Disewa
                                </span>
                            @else
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 shadow-sm whitespace-nowrap">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 mr-2"></span>
                                    Sudah Dikembalikan
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Informasi Pelanggan & Unit -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 bg-slate-50 p-6 rounded-xl border border-slate-100">
                        <div>
                            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Informasi Pelanggan</h4>
                            <p class="text-base font-bold text-slate-800">{{ $penyewaan->customer->nama ?? '-' }}</p>
                            <p class="text-sm text-slate-600 mt-1">No. HP / WA: <span class="font-semibold">{{ $penyewaan->customer->no_hp ?? '-' }}</span></p>
                            <p class="text-sm text-slate-600 mt-0.5">Alamat: {{ $penyewaan->customer->alamat ?? '-' }}</p>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Alat Kesehatan Disewa</h4>
                            <p class="text-base font-bold text-slate-800">{{ $penyewaan->unit->nama_alat ?? '-' }}</p>
                            <p class="text-sm text-slate-600 mt-1">Kode Unit: <span class="font-semibold font-mono bg-white px-2 py-0.5 rounded border border-slate-200">{{ $penyewaan->unit->kode_unit ?? '-' }}</span></p>
                        </div>
                    </div>

                    <!-- Total Biaya -->
                    <div class="flex justify-between items-center bg-blue-50/50 border border-blue-100 p-6 rounded-xl mb-8">
                        <div>
                            <p class="text-sm font-bold text-slate-600">Total Biaya Sewa</p>
                            <p class="text-xs text-slate-400 mt-0.5">Status Pembayaran: <span class="text-emerald-600 font-bold">LUNAS</span></p>
                        </div>
                        <div class="text-right">
                            <span class="text-2xl font-extrabold text-blue-700">Rp {{ number_format($penyewaan->total_biaya, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex flex-wrap items-center justify-end gap-3 pt-6 border-t border-slate-100">
                        
                        <!-- Cetak Invoice -->
                        <a href="{{ route('penyewaans.invoice', $penyewaan->id) }}" target="_blank" class="inline-flex items-center justify-center px-4 py-2.5 bg-blue-600 text-white rounded-lg font-bold text-xs uppercase tracking-wider hover:bg-blue-700 transition shadow-sm">
                            <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                            Cetak Nota
                        </a>

                        <!-- Edit Data -->
                        <a href="{{ route('penyewaans.edit', $penyewaan->id) }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-indigo-50 text-indigo-600 border border-indigo-200 rounded-lg font-bold text-xs uppercase tracking-wider hover:bg-indigo-100 transition shadow-sm">
                            <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            Edit
                        </a>

                        <!-- Tombol Hapus -->
                        <button @click="deleteModal = true" type="button" class="inline-flex items-center justify-center px-4 py-2.5 bg-rose-50 text-rose-600 border border-rose-200 rounded-lg font-bold text-xs uppercase tracking-wider hover:bg-rose-100 transition shadow-sm">
                            <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            Hapus
                        </button>

                    </div>

                </div>
            </div>
        </div>

        <!-- MODAL HAPUS DENGAN KONTROL LEBAR MUTLAK (FIX MELAR) -->
        <div x-show="deleteModal" style="display: none; position: fixed; inset: 0; z-index: 9999; background-color: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px); align-items: center; justify-content: center; padding: 1rem;" class="flex">
            
            <div @click.away="deleteModal = false" style="width: 420px; max-width: 90vw; background-color: #ffffff; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); border: 1px solid #f1f5f9;">
                
                <div style="display: flex; align-items: flex-start; gap: 1rem;">
                    <div style="flex-shrink: 0; display: flex; align-items: center; justify-content: center; height: 3rem; width: 3rem; border-radius: 9999px; background-color: #ffe4e6; color: #e11d48;">
                        <svg style="height: 1.5rem; width: 1.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    
                    <div style="flex: 1;">
                        <h3 style="font-size: 1.125rem; font-weight: 800; color: #1e293b; margin: 0;">Hapus Data Transaksi</h3>
                        <p style="font-size: 0.875rem; color: #64748b; margin-top: 0.25rem; line-height: 1.5;">Yakin ingin menghapus transaksi <strong style="color: #334155;">#TRX-{{ str_pad($penyewaan->id, 4, '0', STR_PAD_LEFT) }}</strong> ini? Tindakan ini bersifat permanen.</p>
                    </div>
                </div>

                <div style="margin-top: 1.5rem; display: flex; align-items: center; justify-content: flex-end; gap: 0.75rem; padding-top: 1rem; border-top: 1px solid #f1f5f9;">
                    <button @click="deleteModal = false" type="button" style="padding: 0.625rem 1rem; background-color: #ffffff; border: 1px solid #cbd5e1; color: #334155; border-radius: 0.5rem; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; cursor: pointer;">
                        Batal
                    </button>
                    
                    <form action="{{ route('penyewaans.destroy', $penyewaan->id) }}" method="POST" style="display: inline; margin: 0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="padding: 0.625rem 1rem; background-color: #e11d48; color: #ffffff; border-radius: 0.5rem; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; border: none; cursor: pointer;">
                            Ya, Hapus
                        </button>
                    </form>
                </div>

            </div>
        </div>

    </div>
</x-app-layout>