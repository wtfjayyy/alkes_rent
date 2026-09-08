<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.375rem; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.025em;">
            Manajemen Penyewaan & Booking
        </h2>
        <p style="font-size: 0.813rem; color: #64748b; margin: 3px 0 0 0; font-weight: 500;">Kelola transaksi rental alat kesehatan, status sewa, dan cetak invoice.</p>
    </x-slot>

    <!-- Tombol Buat Penyewaan Baru -->
    <div style="display: flex; justify-content: flex-end; margin-bottom: 24px;">
        <a href="{{ route('penyewaans.create') }}" style="background: #059669; color: #ffffff; padding: 10px 20px; border-radius: 10px; font-weight: 700; font-size: 0.875rem; text-decoration: none; box-shadow: 0 4px 6px rgba(5, 150, 105, 0.2); display: inline-flex; align-items: center; gap: 8px;">
            <span>+</span> Buat Penyewaan Baru
        </a>
    </div>

    @if(session('success'))
        <div style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 14px 20px; border-radius: 12px; margin-bottom: 24px; font-weight: 600; font-size: 0.875rem;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); overflow: hidden;">
        <div style="padding: 20px 24px; border-bottom: 1px solid #e2e8f0; font-size: 0.875rem; font-weight: 700; color: #334155; text-transform: uppercase; letter-spacing: 0.05em;">
            Daftar Transaksi Penyewaan
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; color: #475569; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em;">
                        <th style="padding: 14px 24px;">No</th>
                        <th style="padding: 14px 24px;">Pelanggan</th>
                        <th style="padding: 14px 24px;">Unit Alat</th>
                        <th style="padding: 14px 24px;">Tgl Sewa</th>
                        <th style="padding: 14px 24px;">Total Biaya</th>
                        <th style="padding: 14px 24px;">Status</th>
                        <th style="padding: 14px 24px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody style="font-size: 0.875rem; color: #334155;">
                    @forelse($penyewaans ?? [] as $index => $item)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 16px 24px; font-weight: 600; color: #64748b;">
                                {{ method_exists($penyewaans, 'firstItem') ? $penyewaans->firstItem() + $index : $index + 1 }}
                            </td>
                            <td style="padding: 16px 24px; font-weight: 600; color: #0f172a;">
                                {{ $item->customer->nama ?? '-' }}
                            </td>
                            <td style="padding: 16px 24px; color: #334155;">
                                {{ $item->unit->nama_alat ?? '-' }}
                            </td>
                            <td style="padding: 16px 24px; font-family: monospace; color: #334155;">
                                {{ $item->tanggal_sewa }}
                            </td>
                            <td style="padding: 16px 24px; font-weight: 600; color: #0f172a;">
                                Rp {{ number_format($item->total_biaya ?? 0, 0, ',', '.') }}
                            </td>
                            <td style="padding: 16px 24px;">
                                <span style="background: #ecfdf5; color: #047857; padding: 4px 10px; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; border: 1px solid #a7f3d0;">
                                    &bull; {{ ucfirst($item->status ?? 'Disewa') }}
                                </span>
                            </td>
                            <td style="padding: 16px 24px; text-align: center;">
                                <div style="display: flex; justify-content: center; gap: 6px;">
                                    <a href="{{ route('penyewaans.show', $item->id) }}" style="background: #f1f5f9; color: #334155; padding: 6px 10px; border-radius: 6px; font-weight: 600; font-size: 0.75rem; text-decoration: none;">Detail</a>
                                    <a href="{{ route('penyewaans.invoice', $item->id) }}" style="background: #eff6ff; color: #1d4ed8; padding: 6px 10px; border-radius: 6px; font-weight: 600; font-size: 0.75rem; text-decoration: none;">Invoice</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="padding: 32px; text-align: center; color: #64748b;">
                                Belum ada data transaksi penyewaan. Silakan klik tombol <b>"+ Buat Penyewaan Baru"</b> di atas untuk mencatat transaksi rental pertama.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(isset($penyewaans) && method_exists($penyewaans, 'links'))
            <div style="padding: 16px 24px; border-top: 1px solid #e2e8f0; background: #f8fafc;">
                {{ $penyewaans->links() }}
            </div>
        @endif
    </div>
</x-app-layout>