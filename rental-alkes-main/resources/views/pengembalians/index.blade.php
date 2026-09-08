<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.375rem; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.025em;">
            Laporan Transaksi Keuangan
        </h2>
        <p style="font-size: 0.813rem; color: #64748b; margin: 3px 0 0 0; font-weight: 500;">Catatan pemasukan dan pengeluaran operasional sesuai tanggal.</p>
    </x-slot>

    @if(session('success'))
        <div style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 14px 20px; border-radius: 12px; margin-bottom: 24px; font-weight: 600; font-size: 0.875rem;">
            {{ session('success') }}
        </div>
    @endif

    <!-- KOTAK TOTAL KEUANGAN -->
    <div style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border-radius: 16px; padding: 24px; margin-bottom: 24px; color: #ffffff; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); display: flex; justify-content: space-between; align-items: center;">
        <div>
            <p style="margin: 0 0 8px 0; font-size: 0.875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">Total Saldo Kas Berjalan</p>
            <h3 style="margin: 0; font-size: 2.25rem; font-weight: 800; color: #10b981; letter-spacing: -0.025em;">
                Rp {{ number_format($grandTotalBersih ?? 0, 0, ',', '.') }}
            </h3>
        </div>
        <div style="background: rgba(255, 255, 255, 0.1); width: 64px; height: 64px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
            💰
        </div>
    </div>

    <!-- TABEL DATA -->
    <div style="background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); overflow: hidden;">
        
        <!-- Header Card: Judul, Search Bar, & Tombol Tambah -->
        <div style="padding: 20px 24px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; gap: 16px; flex-wrap: wrap;">
            <div style="font-size: 0.875rem; font-weight: 700; color: #334155; text-transform: uppercase; letter-spacing: 0.05em; white-space: nowrap;">
                Riwayat Arus Kas & Transaksi
            </div>

            <div style="display: flex; gap: 10px; align-items: center; justify-content: flex-end;">
                <!-- Form Pencarian mengarah ke URL aktif (pengembalians.index) -->
                <form action="{{ route('pengembalians.index') }}" method="GET" style="display: flex; gap: 6px; align-items: center; margin: 0;">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari catatan / nominal..." style="padding: 7px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.813rem; background: #ffffff; width: 220px;" autocomplete="off">
                    <button type="submit" style="background: #334155; color: #ffffff; padding: 7px 12px; border-radius: 8px; font-weight: 600; font-size: 0.813rem; border: none; cursor: pointer;">Cari</button>
                    @if(isset($search) && $search)
                        <a href="{{ route('pengembalians.index') }}" style="background: #f1f5f9; color: #475569; padding: 7px 10px; border-radius: 8px; font-weight: 600; font-size: 0.813rem; text-decoration: none;">Reset</a>
                    @endif
                </form>

                <!-- Tombol Catat Transaksi Baru (Sesuaikan rute ini dengan yang aktif di web.php lu, kalau error ganti jadi pengembalians.create) -->
                <a href="{{ url('transaksi-keuangan/create') }}" style="background: #059669; color: #ffffff; padding: 7px 14px; border-radius: 8px; font-weight: 700; font-size: 0.813rem; text-decoration: none; box-shadow: 0 4px 6px rgba(5, 150, 105, 0.2); display: inline-flex; align-items: center; gap: 6px; white-space: nowrap;">
                    <span>+</span> Catat Transaksi Baru
                </a>
            </div>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; color: #475569; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em;">
                        <th style="padding: 14px 24px;">No</th>
                        <th style="padding: 14px 24px;">Tanggal</th>
                        <th style="padding: 14px 24px;">Jenis & Nominal (Dana)</th>
                        <th style="padding: 14px 24px;">Status Verifikasi</th>
                        <th style="padding: 14px 24px;">Catatan</th>
                        <th style="padding: 14px 24px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody style="font-size: 0.875rem; color: #334155;">
                    @isset($pengembalians)
                        @forelse($pengembalians as $index => $item)
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 16px 24px; font-weight: 600; color: #64748b;">
                                    {{ $pengembalians->firstItem() + $index }}
                                </td>
                                
                                <td style="padding: 16px 24px; color: #0f172a; font-family: monospace; font-weight: 600;">
                                    {{ $item->tanggal_kembali ?? '-' }}
                                </td>

                                <td style="padding: 16px 24px;">
                                    @php
                                        $catatanFull = $item->catatan ?? '';
                                        $isMasuk = str_contains($catatanFull, '[JENIS: Masuk]');
                                    @endphp
                                    <div style="font-weight: 700; color: {{ $isMasuk ? '#059669' : '#dc2626' }};">
                                        {{ $isMasuk ? 'Dana Masuk (+)' : 'Dana Keluar (-)' }} Rp {{ number_format($item->denda ?? 0, 0, ',', '.') }}
                                    </div>
                                </td>

                                <td style="padding: 16px 24px;">
                                    @php
                                        $isVerified = str_contains($catatanFull, 'Diverifikasi');
                                    @endphp
                                    <span style="background: {{ $isVerified ? '#ecfdf5' : '#fefce8' }}; color: {{ $isVerified ? '#047857' : '#ca8a04' }}; padding: 4px 10px; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; border: 1px solid {{ $isVerified ? '#a7f3d0' : '#fef08a' }};">
                                        &bull; {{ $isVerified ? 'Diverifikasi' : 'Belum Diverifikasi' }}
                                    </span>
                                </td>

                                <td style="padding: 16px 24px; color: #64748b;">
                                    {{ trim(preg_replace('/\[JENIS:\s*(Masuk|Keluar)\]|\[(.*?)\]/', '', $catatanFull)) ?: '-' }}
                                </td>

                                <td style="padding: 16px 24px; text-align: center;">
                                    <form action="{{ route('pengembalians.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus catatan transaksi ini?');" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: #fef2f2; color: #dc2626; padding: 6px 12px; border-radius: 6px; font-weight: 600; font-size: 0.75rem; border: none; cursor: pointer;">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="padding: 32px; text-align: center; color: #64748b;">Belum ada catatan laporan transaksi keuangan.</td>
                            </tr>
                        @endforelse
                    @endisset
                </tbody>
            </table>
        </div>

        <!-- Tombol Navigasi Halaman -->
        @if(isset($pengembalians) && method_exists($pengembalians, 'links'))
            <div style="padding: 16px 24px; border-top: 1px solid #e2e8f0; background: #f8fafc;">
                {{ $pengembalians->links() }}
            </div>
        @endif
    </div>
</x-app-layout>