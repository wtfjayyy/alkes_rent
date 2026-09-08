<x-app-layout>
    <x-slot name="header">
        <h2 style="font-weight: 800; font-size: 1.5rem; color: #1e293b; margin: 0;">
            Catat Transaksi Keuangan Baru
        </h2>
    </x-slot>

    <div style="padding: 40px 0;">
        <div style="max-width: 48rem; margin: 0 auto; padding: 0 1rem;">
            <div style="background: #ffffff; padding: 32px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                
                <form action="{{ route('pengembalians.store') }}" method="POST">
                    @csrf
                    
                    <!-- Tanggal -->
                    <div style="margin-bottom: 20px;">
                        <label for="tanggal" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Tanggal Transaksi</label>
                        <input type="date" name="tanggal" id="tanggal" value="{{ date('Y-m-d') }}" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem;" required>
                    </div>

                    <!-- Jenis Transaksi (Masuk / Keluar) -->
                    <div style="margin-bottom: 20px;">
                        <label for="jenis_transaksi" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Jenis Arus Kas</label>
                        <select name="jenis_transaksi" id="jenis_transaksi" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem;" required>
                            <option value="Masuk">Dana Masuk (Pemasukan)</option>
                            <option value="Keluar">Dana Keluar (Pengeluaran)</option>
                        </select>
                    </div>

                    <!-- Nominal -->
                    <div style="margin-bottom: 20px;">
                        <label for="nominal" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Nominal (Rp)</label>
                        <input type="number" name="nominal" id="nominal" placeholder="Contoh: 150000" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem;" required>
                    </div>

                    <!-- Status Verifikasi -->
                    <div style="margin-bottom: 20px;">
                        <label for="status_verifikasi" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Status Verifikasi</label>
                        <select name="status_verifikasi" id="status_verifikasi" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem;" required>
                            <option value="Diverifikasi">Diverifikasi</option>
                            <option value="Belum Diverifikasi">Belum Diverifikasi</option>
                        </select>
                    </div>

                    <!-- Catatan -->
                    <div style="margin-bottom: 24px;">
                        <label for="catatan" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Catatan / Keterangan</label>
                        <textarea name="catatan" id="catatan" rows="3" placeholder="Contoh: Pembayaran sewa bulanan / Biaya perawatan alat..." style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem;"></textarea>
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 12px;">
                        <a href="{{ route('pengembalians.index') }}" style="padding: 10px 20px; background-color: #f1f5f9; color: #475569; border-radius: 8px; font-weight: 600; text-decoration: none; font-size: 0.875rem;">Batal</a>
                        <button type="submit" style="padding: 10px 20px; background-color: #059669; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 0.875rem;">Simpan Transaksi</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>