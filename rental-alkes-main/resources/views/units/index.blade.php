<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.375rem; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.025em;">
            Manajemen Unit Alkes
        </h2>
        <p style="font-size: 0.813rem; color: #64748b; margin: 3px 0 0 0; font-weight: 500;">Kelola ketersediaan, kategori, dan status unit alat kesehatan.</p>
    </x-slot>

    <!-- Tombol Kelola Kategori di sebelah tombol Tambah Unit -->
    <div style="display: flex; justify-content: flex-end; gap: 12px; margin-bottom: 24px;">
        <a href="{{ route('categories.index') }}" style="background: #ffffff; color: #334155; padding: 10px 20px; border-radius: 10px; font-weight: 700; font-size: 0.875rem; text-decoration: none; border: 1px solid #cbd5e1; box-shadow: 0 1px 2px rgba(0,0,0,0.05); display: inline-flex; align-items: center; gap: 8px;">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
            Kelola Kategori
        </a>
        <a href="{{ route('units.create') }}" style="background: #059669; color: #ffffff; padding: 10px 20px; border-radius: 10px; font-weight: 700; font-size: 0.875rem; text-decoration: none; box-shadow: 0 4px 6px rgba(5, 150, 105, 0.2); display: inline-flex; align-items: center; gap: 8px;">
            <span>+</span> Tambah Unit Baru
        </a>
    </div>

    @if(session('success'))
        <div style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 14px 20px; border-radius: 12px; margin-bottom: 24px; font-weight: 600; font-size: 0.875rem;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); overflow: hidden;">
        <div style="padding: 20px 24px; border-bottom: 1px solid #e2e8f0; font-size: 0.875rem; font-weight: 700; color: #334155; text-transform: uppercase; letter-spacing: 0.05em;">
            Daftar Unit Alat Kesehatan
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; color: #475569; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em;">
                        <th style="padding: 14px 24px;">No</th>
                        <th style="padding: 14px 24px;">Nama Alat</th>
                        <th style="padding: 14px 24px;">Kategori</th>
                        <th style="padding: 14px 24px;">Kode Unit</th>
                        <th style="padding: 14px 24px;">Status</th>
                        <th style="padding: 14px 24px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody style="font-size: 0.875rem; color: #334155;">
                    @isset($units)
                        @forelse($units as $index => $unit)
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <!-- Nomor urut akurat mengikuti halaman pagination -->
                                <td style="padding: 16px 24px; font-weight: 600; color: #64748b;">
                                    {{ ($units->currentPage() - 1) * $units->perPage() + $index + 1 }}
                                </td>
                                
                                <td style="padding: 16px 24px; font-weight: 700; color: #0f172a;">
                                    {{ $unit->nama_alat }}
                                </td>

                                <!-- Nampilin nama kategori dengan fallback yang aman -->
                                <td style="padding: 16px 24px; color: #475569;">
                                    {{ $unit->category->nama ?? $unit->category->nama_kategori ?? '-' }}
                                </td>

                                <td style="padding: 16px 24px; color: #475569; font-family: monospace;">
                                    {{ $unit->kode_unit }}
                                </td>

                                <td style="padding: 16px 24px;">
                                    @if($unit->status == 'Ready')
                                        <span style="background: #f0fdf4; color: #166534; padding: 4px 10px; border-radius: 6px; font-size: 0.75rem; font-weight: 700; border: 1px solid #bbf7d0;">Ready</span>
                                    @elseif($unit->status == 'Disewa')
                                        <span style="background: #eff6ff; color: #1e40af; padding: 4px 10px; border-radius: 6px; font-size: 0.75rem; font-weight: 700; border: 1px solid #bfdbfe;">Disewa</span>
                                    @else
                                        <span style="background: #fef2f2; color: #991b1b; padding: 4px 10px; border-radius: 6px; font-size: 0.75rem; font-weight: 700; border: 1px solid #fecaca;">Maintenance</span>
                                    @endif
                                </td>

                                <td style="padding: 16px 24px; text-align: center;">
                                    <div style="display: flex; gap: 8px; justify-content: center;">
                                        <a href="{{ route('units.show', $unit->id) }}" style="background: #f8fafc; color: #475569; padding: 6px 12px; border-radius: 6px; font-weight: 600; font-size: 0.75rem; text-decoration: none; border: 1px solid #cbd5e1;">Detail</a>
                                        <a href="{{ route('units.edit', $unit->id) }}" style="background: #eff6ff; color: #2563eb; padding: 6px 12px; border-radius: 6px; font-weight: 600; font-size: 0.75rem; text-decoration: none;">Edit</a>
                                        
                                        <form action="{{ route('units.destroy', $unit->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus unit ini?');" style="margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background: #fef2f2; color: #dc2626; padding: 6px 12px; border-radius: 6px; font-weight: 600; font-size: 0.75rem; border: none; cursor: pointer;">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="padding: 32px; text-align: center; color: #64748b;">Belum ada data unit alkes yang terdaftar.</td>
                            </tr>
                        @endforelse
                    @endisset
                </tbody>
            </table>
        </div>

        <!-- TOMBOL PAGINATION -->
        <div style="padding: 16px 24px; border-top: 1px solid #e2e8f0; background: #f8fafc;">
            {{ $units->links() }}
        </div>
    </div>
</x-app-layout>