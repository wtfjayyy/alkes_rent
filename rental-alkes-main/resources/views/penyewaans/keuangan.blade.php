<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.375rem; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.025em;">
            Laporan Transaksi Keuangan
        </h2>
        <p style="font-size: 0.813rem; color: #64748b; margin: 3px 0 0 0; font-weight: 500;">Rekapitulasi pemasukan dari seluruh transaksi sewa alat kesehatan.</p>
    </x-slot>

    <!-- Card Total Pendapatan -->
    <div style="background: linear-gradient(135deg, #022c22 0%, #064e3b 100%); border-radius: 16px; padding: 24px; color: #ffffff; margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 10px 15px -3px rgba(5, 150, 105, 0.15);">
        <div>
            <span style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: #34d399; display: block; margin-bottom: 6px;">Total Pendapatan Masuk</span>
            <h3 style="font-size: 2rem; font-weight: 800; margin: 0; letter-spacing: -0.02em;">
                Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}
            </h3>
        </div>
        <div style="background: rgba(255,255,255,0.1); padding: 14px; border-radius: 12px; font-size: 1.5rem;">
            💰
        </div>
    </div>

    <!-- Tabel Transaksi -->
    <div style="background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); overflow: hidden;">
        <div style="padding: 20px 24px; border-bottom: 1px solid #e2e8f0; font-size: 0.875rem; font-weight: 700; color: #334155; text-transform: uppercase; letter-spacing: 0.05em;">
            Riwayat Masuk Transaksi Sewa
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; color: #475569; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em;">
                        <th style="padding: 14px 20px;">No</th>
                        <th style="padding: 14px 20px;">Tanggal Sewa</th>
                        <th style="padding: 14px 20px;">Pelanggan</th>
                        <th style="padding: 14px 20px;">Unit Alkes</th>
                        <th style="padding: 14px 20px;">Nominal (Total Biaya)</th>
                        <th style="padding: 14px 20px;">Status</th>
                    </tr>
                </thead>
                <tbody style="font-size: 0.875rem; color: #334155;">
                    @isset($penyewaans)
                        @forelse($penyewaans as $index => $item)
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 16px 20px; font-weight: 600; color: #64748b;">
                                    {{ $penyewaans->firstItem() + $index }}
                                </td>
                                <td style="padding: 16px 20px; color: #475569;">
                                    {{ $item->tanggal_sewa }}
                                </td>
                                <td style="padding: 16px 20px; font-weight: 700; color: #334155;">
                                    {{ $item->customer->nama ?? 'Tanpa Nama' }}
                                </td>
                                <td style="padding: 16px 20px; color: #475569;">
                                    {{ $item->unit->nama_alat ?? 'Unit' }} <span style="font-size: 0.75rem; color: #94a3b8;">({{ $item->unit->kode_unit ?? '-' }})</span>
                                </td>
                                <td style="padding: 16px 20px; font-weight: 800; color: #059669;">
                                    Rp {{ number_format($item->total_biaya, 0, ',', '.') }}
                                </td>
                                <td style="padding: 16px 20px;">
                                    <span style="background: #ecfdf5; color: #059669; padding: 4px 10px; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; border: 1px solid #a7f3d0;">
                                        &bull; {{ $item->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="padding: 32px; text-align: center; color: #64748b;">Belum ada data transaksi keuangan yang tercatat.</td>
                            </tr>
                        @endforelse
                    @endisset
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if(isset($penyewaans) && method_exists($penyewaans, 'links'))
            <div style="padding: 16px 24px; border-top: 1px solid #e2e8f0; background: #f8fafc;">
                {{ $penyewaans->links() }}
            </div>
        @endif
    </div>
</x-app-layout>