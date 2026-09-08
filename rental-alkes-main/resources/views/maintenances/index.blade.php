<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
            <div>
                <h2 style="font-size: 1.375rem; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.025em;">
                    Manajemen Maintenance Alkes
                </h2>
                <p style="font-size: 0.813rem; color: #64748b; margin: 3px 0 0 0; font-weight: 500;">Pantau jadwal perbaikan, status kerusakan, dan riwayat maintenance unit.</p>
            </div>
            
            <a href="{{ route('maintenances.create') }}" style="background: #059669; color: #ffffff; padding: 9px 16px; border-radius: 10px; font-weight: 700; font-size: 0.813rem; text-decoration: none; box-shadow: 0 4px 6px rgba(5, 150, 105, 0.2); display: inline-flex; align-items: center; gap: 6px;">
                <span>+</span> Catat Maintenance Baru
            </a>
        </div>
    </x-slot>

    @if(session('success'))
        <div style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 14px 20px; border-radius: 12px; margin-bottom: 24px; font-weight: 600; font-size: 0.875rem;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); overflow: hidden;">
        
        <!-- Filter & Search Section -->
        <div style="padding: 20px 24px; border-bottom: 1px solid #e2e8f0; background: #f8fafc;">
            <form action="{{ route('maintenances.index') }}" method="GET" style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap; margin: 0;">
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari alat, kode, atau kerusakan..." style="padding: 8px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.813rem; background: #ffffff; flex: 1; min-width: 240px;" autocomplete="off">
                
                <select name="category_id" style="padding: 8px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.813rem; background: #ffffff; color: #334155; min-width: 180px; cursor: pointer;">
                    <option value="">-- Semua Kategori --</option>
                    @foreach($categories ?? [] as $cat)
                        <option value="{{ $cat->id }}" {{ (isset($categoryId) && $categoryId == $cat->id) ? 'selected' : '' }}>
                            {{ $cat->nama ?? $cat->nama_kategori ?? '-' }}
                        </option>
                    @endforeach
                </select>

                <div style="display: flex; gap: 8px;">
                    <button type="submit" style="background: #334155; color: #ffffff; padding: 8px 16px; border-radius: 8px; font-weight: 600; font-size: 0.813rem; border: none; cursor: pointer;">
                        Cari & Filter
                    </button>
                    @if((isset($search) && $search) || (isset($categoryId) && $categoryId))
                        <a href="{{ route('maintenances.index') }}" style="background: #e2e8f0; color: #475569; padding: 8px 12px; border-radius: 8px; font-weight: 600; font-size: 0.813rem; text-decoration: none; display: inline-flex; align-items: center;">Reset</a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Tabel Data -->
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; color: #475569; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em;">
                        <th style="padding: 14px 20px; width: 50px;">No</th>
                        <th style="padding: 14px 20px;">Unit Alat / Kode</th>
                        <th style="padding: 14px 20px;">Kategori</th>
                        <th style="padding: 14px 20px;">Tanggal</th>
                        <th style="padding: 14px 20px; max-width: 320px;">Deskripsi Kerusakan</th>
                        <th style="padding: 14px 20px;">Biaya</th>
                        <th style="padding: 14px 20px;">Status</th>
                        <th style="padding: 14px 20px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody style="font-size: 0.875rem; color: #334155;">
                    @forelse($maintenances ?? [] as $index => $item)
                        <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                            
                            <td style="padding: 16px 20px; font-weight: 600; color: #64748b;">
                                {{ method_exists($maintenances, 'firstItem') ? $maintenances->firstItem() + $index : $index + 1 }}
                            </td>

                            <td style="padding: 16px 20px;">
                                <div style="font-weight: 700; color: #0f172a; line-height: 1.3;">{{ $item->unit->nama_alat ?? '-' }}</div>
                                <div style="font-size: 0.75rem; color: #64748b; font-family: monospace; margin-top: 2px;">{{ $item->unit->kode_unit ?? '-' }}</div>
                            </td>

                            <td style="padding: 16px 20px;">
                                <span style="background: #f1f5f9; color: #475569; padding: 4px 8px; border-radius: 6px; font-size: 0.7rem; font-weight: 700; border: 1px solid #e2e8f0; display: inline-block;">
                                    {{ $item->unit->category->nama ?? $item->unit->category->nama_kategori ?? 'UMUM' }}
                                </span>
                            </td>

                            <td style="padding: 16px 20px; color: #475569; font-family: monospace; font-size: 0.813rem; white-space: nowrap;">
                                {{ $item->tanggal_maintenance ?? '-' }}
                            </td>

                            <td style="padding: 16px 20px; color: #475569; max-width: 320px; font-size: 0.813rem; line-height: 1.4;">
                                <div style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;" title="{{ $item->deskripsi_kerusakan }}">
                                    {{ $item->deskripsi_kerusakan ?? '-' }}
                                </div>
                            </td>

                            <td style="padding: 16px 20px; font-weight: 700; color: #0f172a; white-space: nowrap;">
                                Rp {{ number_format($item->biaya ?? 0, 0, ',', '.') }}
                            </td>

                            <td style="padding: 16px 20px; white-space: nowrap;">
                                @php
                                    $isSelesai = strtolower($item->status ?? '') == 'selesai';
                                @endphp
                                <span style="background: {{ $isSelesai ? '#ecfdf5' : '#fefce8' }}; color: {{ $isSelesai ? '#047857' : '#ca8a04' }}; padding: 4px 10px; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; border: 1px solid {{ $isSelesai ? '#a7f3d0' : '#fef08a' }}; display: inline-flex; align-items: center; gap: 4px;">
                                    &bull; {{ ucfirst($item->status ?? 'Proses') }}
                                </span>
                            </td>

                            <td style="padding: 16px 20px; text-align: center; white-space: nowrap;">
                                <div style="display: flex; gap: 6px; justify-content: center; align-items: center;">
                                    @if(!$isSelesai)
                                        <form action="{{ route('maintenances.finish', $item->id) }}" method="POST" style="margin: 0;">
                                            @csrf @method('PATCH')
                                            <button type="submit" style="background: #f0fdf4; color: #166534; padding: 5px 10px; border-radius: 6px; font-weight: 600; font-size: 0.75rem; border: 1px solid #bbf7d0; cursor: pointer;">Selesai</button>
                                        </form>
                                    @endif
                                    
                                    <form action="{{ route('maintenances.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data maintenance ini?');" style="margin: 0;">
                                        @csrf @method('DELETE')
                                        <button type="submit" style="background: #fef2f2; color: #dc2626; padding: 5px 10px; border-radius: 6px; font-weight: 600; font-size: 0.75rem; border: 1px solid #fecaca; cursor: pointer;">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="padding: 40px; text-align: center; color: #64748b;">
                                Belum ada data riwayat maintenance atau perbaikan unit.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if(isset($maintenances) && method_exists($maintenances, 'links') && $maintenances->hasPages())
            <div style="padding: 16px 24px; border-top: 1px solid #e2e8f0; background: #f8fafc;">
                {{ $maintenances->links() }}
            </div>
        @endif
    </div>
</x-app-layout>