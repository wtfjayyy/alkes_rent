<x-app-layout>
    <x-slot name="header">
        <h2 style="font-weight: 800; font-size: 1.5rem; color: #1e293b; margin: 0;">
            Catat Transaksi Keuangan Baru
        </h2>
        <p style="font-size: 0.813rem; color: #64748b; margin: 3px 0 0 0; font-weight: 500;">Formulir pencatatan pemasukan atau pengeluaran kas operasional.</p>
    </x-slot>

    <div style="padding: 40px 0;">
        <div style="max-width: 48rem; margin: 0 auto; padding: 0 1rem;">
            <div style="background: #ffffff; padding: 32px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                
                @if(session('error'))
                    <div style="background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; font-weight: 600; font-size: 0.875rem;">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('transaksi-keuangan.store') }}" method="POST">
                    @csrf
                    
                    <!-- Tanggal -->
                    <div style="margin-bottom: 20px;">
                        <label for="tanggal" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Tanggal Transaksi <span style="color: #dc2626;">*</span></label>
                        <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem; outline: none;" required>
                        @error('tanggal')
                            <span style="font-size: 0.75rem; color: #dc2626; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Jenis Transaksi (Masuk / Keluar) -->
                    <div style="margin-bottom: 20px;">
                        <label for="jenis_transaksi" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Jenis Arus Kas <span style="color: #dc2626;">*</span></label>
                        <select name="jenis_transaksi" id="jenis_transaksi" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem; background: #fff; outline: none;" required>
                            <option value="Masuk" {{ old('jenis_transaksi') == 'Masuk' ? 'selected' : '' }}>Dana Masuk (Pemasukan)</option>
                            <option value="Keluar" {{ old('jenis_transaksi') == 'Keluar' ? 'selected' : '' }}>Dana Keluar (Pengeluaran)</option>
                        </select>
                        @error('jenis_transaksi')
                            <span style="font-size: 0.75rem; color: #dc2626; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Nominal -->
                    <div style="margin-bottom: 20px;">
                        <label for="nominal" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Nominal (Rp) <span style="color: #dc2626;">*</span></label>
                        <input type="number" name="nominal" id="nominal" value="{{ old('nominal') }}" placeholder="Contoh: 150000" min="0" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem; outline: none;" required>
                        @error('nominal')
                            <span style="font-size: 0.75rem; color: #dc2626; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Status Verifikasi -->
                    <div style="margin-bottom: 20px;">
                        <label for="status_verifikasi" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Status Verifikasi <span style="color: #dc2626;">*</span></label>
                        <select name="status_verifikasi" id="status_verifikasi" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem; background: #fff; outline: none;" required>
                            <option value="Diverifikasi" {{ old('status_verifikasi') == 'Diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                            <option value="Belum Diverifikasi" {{ old('status_verifikasi') == 'Belum Diverifikasi' ? 'selected' : '' }}>Belum Diverifikasi</option>
                        </select>
                        @error('status_verifikasi')
                            <span style="font-size: 0.75rem; color: #dc2626; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Catatan -->
                    <div style="margin-bottom: 24px;">
                        <label for="catatan" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Catatan / Keterangan</label>
                        <textarea name="catatan" id="catatan" rows="3" placeholder="Contoh: Pembayaran sewa bulanan / Biaya perawatan alat..." style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem; outline: none; resize: vertical;">{{ old('catatan') }}</textarea>
                        @error('catatan')
                            <span style="font-size: 0.75rem; color: #dc2626; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 12px;">
                        <a href="{{ route('transaksi-keuangan.index') }}" style="padding: 10px 20px; background-color: #f1f5f9; color: #475569; border-radius: 8px; font-weight: 600; text-decoration: none; font-size: 0.875rem; display: inline-flex; align-items: center;">Batal</a>
                        <button type="submit" style="padding: 10px 20px; background-color: #059669; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 0.875rem; box-shadow: 0 4px 6px rgba(5,150,105,0.2);">Simpan Transaksi</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>