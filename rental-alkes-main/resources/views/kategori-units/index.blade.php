<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.375rem; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.025em;">
            Manajemen Kategori Unit Alkes
        </h2>
        <p style="font-size: 0.813rem; color: #64748b; margin: 3px 0 0 0; font-weight: 500;">Kelola kelompok dan jenis alat kesehatan.</p>
    </x-slot>

    <!-- Tombol Aksi Header (Kembali & Tambah) -->
    <div style="display: flex; justify-content: flex-end; gap: 12px; margin-bottom: 24px;">
        <a href="{{ route('units.index') }}" style="background: #f1f5f9; color: #334155; padding: 10px 20px; border-radius: 10px; font-weight: 700; font-size: 0.875rem; text-decoration: none; border: 1px solid #cbd5e1; display: inline-flex; align-items: center; gap: 8px;">
            &larr; Kembali ke Unit Alkes
        </a>
        <a href="{{ route('kategori-units.create') }}" style="background: #059669; color: #ffffff; padding: 10px 20px; border-radius: 10px; font-weight: 700; font-size: 0.875rem; text-decoration: none; box-shadow: 0 4px 6px rgba(5, 150, 105, 0.2); display: inline-flex; align-items: center; gap: 8px;">
            <span>+</span> Tambah Kategori Baru
        </a>
    </div>

    @if(session('success'))
        <div style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 14px 20px; border-radius: 12px; margin-bottom: 24px; font-weight: 600; font-size: 0.875rem;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); overflow: hidden;">
        <div style="padding: 20px 24px; border-bottom: 1px solid #e2e8f0; font-size: 0.875rem; font-weight: 700; color: #334155; text-transform: uppercase; letter-spacing: 0.05em;">
            Daftar Kategori Unit
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; color: #475569; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em;">
                        <th style="padding: 14px 24px;">No</th>
                        <th style="padding: 14px 24px;">Nama Kategori</th>
                        <th style="padding: 14px 24px;">Deskripsi</th>
                        <th style="padding: 14px 24px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody style="font-size: 0.875rem; color: #334155;">
                    @isset($kategoriUnits)
                        @forelse($kategoriUnits as $index => $item)
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 16px 24px; font-weight: 600; color: #64748b;">{{ $index + 1 }}</td>
                                <td style="padding: 16px 24px; font-weight: 700; color: #0f172a;">{{ $item->nama_kategori }}</td>
                                <td style="padding: 16px 24px; color: #64748b;">{{ $item->deskripsi ?? '-' }}</td>
                                <td style="padding: 16px 24px; text-align: center;">
                                    <div style="display: flex; gap: 8px; justify-content: center;">
                                        <a href="{{ route('kategori-units.edit', $item->id) }}" style="background: #eff6ff; color: #2563eb; padding: 6px 12px; border-radius: 6px; font-weight: 600; font-size: 0.75rem; text-decoration: none;">Edit</a>
                                        <form action="{{ route('kategori-units.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');" style="margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background: #fef2f2; color: #dc2626; padding: 6px 12px; border-radius: 6px; font-weight: 600; font-size: 0.75rem; border: none; cursor: pointer;">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="padding: 32px; text-align: center; color: #64748b;">Belum ada data kategori unit yang terdaftar.</td>
                            </tr>
                        @endforelse
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>