<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.375rem; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.025em;">
            Detail Unit Alat Kesehatan
        </h2>
        <p style="font-size: 0.813rem; color: #64748b; margin: 3px 0 0 0; font-weight: 500;">Informasi lengkap inventaris unit alkes.</p>
    </x-slot>

    <div style="padding: 10px 0 40px 0;">
        <div style="max-width: 48rem; margin: 0 auto;">
            <!-- Main Card -->
            <div style="background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); overflow: hidden;">
                <!-- Header Card -->
                <div style="padding: 20px 24px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                    <h3 style="font-size: 0.875rem; font-weight: 800; color: #334155; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">
                        Informasi Unit #{{ $unit->kode_unit ?? '-' }}
                    </h3>
                    
                    @php
                        $status = trim($unit->status ?? 'Ready');
                        $statusLower = strtolower($status);
                        $colors = [
                            'ready' => ['#ecfdf5', '#047857', '#10b981'],
                            'disewa' => ['#eff6ff', '#1d4ed8', '#3b82f6'],
                            'default' => ['#fef2f2', '#b91c1c', '#ef4444']
                        ];
                        $c = array_key_exists($statusLower, $colors) ? $colors[$statusLower] : $colors['default'];
                    @endphp
                    <span style="display: inline-flex; align-items: center; gap: 6px; background: {{ $c[0] }}; color: {{ $c[1] }}; padding: 4px 12px; border-radius: 9999px; font-size: 0.75rem; font-weight: 700;">
                        <span style="width: 6px; height: 6px; border-radius: 50%; background: {{ $c[2] }};"></span>
                        {{ ucfirst($status) }}
                    </span>
                </div>

                <!-- Body Content -->
                <div style="padding: 24px;">
                    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 16px; margin-bottom: 16px;">
                        <div style="color: #64748b; font-weight: 600; font-size: 0.875rem;">Nama Alat</div>
                        <div style="color: #0f172a; font-weight: 700; font-size: 0.875rem;">{{ $unit->nama_alat ?? '-' }}</div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 16px; margin-bottom: 16px;">
                        <div style="color: #64748b; font-weight: 600; font-size: 0.875rem;">Kategori</div>
                        <div style="color: #334155; font-size: 0.875rem;">{{ optional($unit->category)->nama_kategori ?? 'Umum' }}</div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 16px; margin-bottom: 16px;">
                        <div style="color: #64748b; font-weight: 600; font-size: 0.875rem;">Kode Unit</div>
                        <div style="color: #334155; font-size: 0.875rem; font-family: monospace;">{{ $unit->kode_unit ?? '-' }}</div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 16px; margin-bottom: 16px;">
                        <div style="color: #64748b; font-weight: 600; font-size: 0.875rem;">Harga Sewa</div>
                        <div style="color: #059669; font-weight: 700; font-size: 0.875rem;">Rp {{ number_format($unit->harga_sewa ?? 0, 0, ',', '.') }}</div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 16px;">
                        <div style="color: #64748b; font-weight: 600; font-size: 0.875rem;">Keterangan</div>
                        <div style="color: #334155; font-size: 0.875rem; line-height: 1.6;">{{ $unit->deskripsi ?? 'Tidak ada keterangan tambahan.' }}</div>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div style="padding: 20px 24px; background: #f8fafc; border-top: 1px solid #e2e8f0; display: flex; justify-content: flex-end; gap: 12px;">
                    <a href="{{ route('units.index') }}" style="padding: 10px 16px; background: #ffffff; border: 1px solid #e2e8f0; color: #475569; border-radius: 8px; font-weight: 600; font-size: 0.875rem; text-decoration: none;">Kembali</a>
                    <a href="{{ route('units.edit', $unit->id) }}" style="padding: 10px 16px; background: #2563eb; color: white; border-radius: 8px; font-weight: 600; font-size: 0.875rem; text-decoration: none;">Edit Data</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>