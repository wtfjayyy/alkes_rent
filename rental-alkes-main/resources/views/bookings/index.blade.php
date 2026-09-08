<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.375rem; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.025em;">
            Manajemen Booking Unit
        </h2>
        <p style="font-size: 0.813rem; color: #64748b; margin: 3px 0 0 0; font-weight: 500;">Kelola antrean dan pesanan sewa alat kesehatan sebelum dikirim.</p>
    </x-slot>

    <!-- Tombol Tambah Booking diposisikan rapi di kanan atas, sejajar dengan header -->
    <div style="display: flex; justify-content: flex-end; margin-bottom: 24px;">
        <a href="{{ route('bookings.create') }}" style="background: #059669; color: #ffffff; padding: 10px 20px; border-radius: 10px; font-weight: 700; font-size: 0.875rem; text-decoration: none; box-shadow: 0 4px 6px rgba(5, 150, 105, 0.2); display: inline-flex; align-items: center; gap: 8px;">
            <span>+</span> Tambah Booking Baru
        </a>
    </div>

    @if(session('success'))
        <div style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 14px 20px; border-radius: 12px; margin-bottom: 24px; font-weight: 600; font-size: 0.875rem;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Card tabel lebar penuh dengan border radius 16px dan border rapi -->
    <div style="background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); overflow: hidden;">
        <div style="padding: 20px 24px; border-bottom: 1px solid #e2e8f0; font-size: 0.875rem; font-weight: 700; color: #334155; text-transform: uppercase; letter-spacing: 0.05em;">
            Daftar Booking Alat Kesehatan
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; color: #475569; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em;">
                        <th style="padding: 14px 24px;">No</th>
                        <th style="padding: 14px 24px;">Tgl Booking</th>
                        <th style="padding: 14px 24px;">Pelanggan</th>
                        <th style="padding: 14px 24px;">No WhatsApp</th>
                        <th style="padding: 14px 24px;">Unit Alkes</th>
                        <th style="padding: 14px 24px;">Tanggal Sewa</th>
                        <th style="padding: 14px 24px;">Catatan</th>
                        <th style="padding: 14px 24px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody style="font-size: 0.875rem; color: #334155;">
                    @forelse($bookings as $index => $booking)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 16px 24px; font-weight: 600; color: #64748b;">
                                {{ $index + 1 }}
                            </td>
                            
                            <!-- Menampilkan Tanggal Input/Booking otomatis -->
                            <td style="padding: 16px 24px; color: #475569; font-size: 0.813rem;">
                                {{ $booking->created_at ? $booking->created_at->format('d-m-Y') : '-' }}
                            </td>
                            
                            <td style="padding: 16px 24px; font-weight: 700; color: #0f172a;">
                                {{ optional($booking->customer)->name ?? optional($booking->customer)->nama ?? optional($booking->customer)->nama_lengkap ?? '-' }}
                            </td>
                            
                            <td style="padding: 16px 24px; font-family: monospace; color: #475569;">
                                {{ $booking->no_whatsapp }}
                            </td>

                            <td style="padding: 16px 24px;">
                                <div style="font-weight: 700; color: #0f172a;">{{ optional($booking->unit)->nama_alat ?? optional($booking->unit)->nama ?? '-' }}</div>
                                <div style="font-size: 0.75rem; font-family: monospace; color: #64748b; margin-top: 2px;">Kode: {{ optional($booking->unit)->kode_unit ?? '-' }}</div>
                            </td>

                            <td style="padding: 16px 24px; color: #475569;">
                                {{ $booking->estimasi_tgl_mulai }}
                            </td>

                            <td style="padding: 16px 24px; color: #64748b; max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $booking->catatan }}">
                                {{ $booking->catatan ?? '-' }}
                            </td>

                            <td style="padding: 16px 24px; text-align: center;">
                                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Yakin ingin menghapus data booking ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: #fef2f2; color: #dc2626; padding: 6px 12px; border-radius: 6px; font-weight: 600; font-size: 0.75rem; border: none; cursor: pointer;">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="padding: 32px; text-align: center; color: #64748b;">
                                Belum ada data booking. Silakan buat booking baru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>