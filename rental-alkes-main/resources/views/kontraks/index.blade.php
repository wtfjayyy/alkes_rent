<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.375rem; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.025em;">
            Manajemen Kontrak Aktif
        </h2>
        <p style="font-size: 0.813rem; color: #64748b; margin: 3px 0 0 0; font-weight: 500;">Kelola surat perjanjian dan masa berlaku kontrak sewa alat kesehatan.</p>
    </x-slot>

    <!-- BAGIAN YANG BERUBAH: Ditambah Form Filter Kategori di sebelah tombol -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 16px;">
        
        <form action="{{ route('kontraks.index') }}" method="GET" style="display: flex; gap: 8px; align-items: center; background: #ffffff; padding: 6px 12px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
            <span style="font-size: 0.875rem; font-weight: 600; color: #475569;">Filter Unit:</span>
            <select name="kategori_id" style="padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem; min-width: 180px; outline: none; background: #f8fafc; font-weight: 500; color: #0f172a;">
                <option value="">Semua Kategori</option>
                @isset($kategoris)
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat->id }}" {{ (isset($kategori_id) && $kategori_id == $kat->id) ? 'selected' : '' }}>
                            {{ $kat->nama ?? $kat->nama_kategori ?? 'Kategori ' . $kat->id }}
                        </option>
                    @endforeach
                @endisset
            </select>
            <button type="submit" style="background: #334155; color: white; padding: 8px 16px; border: none; border-radius: 8px; font-weight: 600; font-size: 0.875rem; cursor: pointer; transition: 0.2s;">Cari</button>
            
            @if(request('kategori_id'))
                <a href="{{ route('kontraks.index') }}" style="color: #ef4444; text-decoration: none; font-size: 0.75rem; font-weight: 700; margin-left: 4px; padding: 6px 10px; background: #fef2f2; border-radius: 6px;">✕ Reset</a>
            @endif
        </form>

        <a href="{{ route('kontraks.create') }}" style="background: #059669; color: #ffffff; padding: 10px 20px; border-radius: 10px; font-weight: 700; font-size: 0.875rem; text-decoration: none; box-shadow: 0 4px 6px rgba(5, 150, 105, 0.2); display: inline-flex; align-items: center; gap: 8px;">
            <span>+</span> Buat Kontrak Baru
        </a>
    </div>
    <!-- END BAGIAN BERUBAH -->

    @if(session('success'))
        <div style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 14px 20px; border-radius: 12px; margin-bottom: 24px; font-weight: 600; font-size: 0.875rem;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); overflow: hidden;">
        <div style="padding: 20px 24px; border-bottom: 1px solid #e2e8f0; font-size: 0.875rem; font-weight: 700; color: #334155; text-transform: uppercase; letter-spacing: 0.05em;">
            Daftar Kontrak Sewa Alkes
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; color: #475569; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em;">
                        <th style="padding: 14px 20px;">No</th>
                        <th style="padding: 14px 20px;">No. Kontrak</th>
                        <th style="padding: 14px 20px;">Pelanggan</th>
                        <th style="padding: 14px 20px;">Unit Alat & Kode</th>
                        <th style="padding: 14px 20px;">Mulai - Selesai</th>
                        <th style="padding: 14px 20px;">Sisa Durasi</th>
                        <th style="padding: 14px 20px;">Payment</th>
                        <th style="padding: 14px 20px;">Status</th>
                        <th style="padding: 14px 20px; text-align: center;">No. Telepon / WhatsApp</th>
                        <th style="padding: 14px 20px; text-align: center;">Kelola</th>
                    </tr>
                </thead>
                <tbody style="font-size: 0.875rem; color: #334155;">
                    @isset($kontraks)
                        @forelse($kontraks as $index => $kontrak)
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 16px 20px; font-weight: 600; color: #64748b;">
                                    {{ $kontraks->firstItem() + $index }}
                                </td>
                                
                                <td style="padding: 16px 20px; font-weight: 700; color: #0f172a; font-family: monospace;">
                                    {{ $kontrak->no_kontrak }}
                                </td>

                                <td style="padding: 16px 20px; font-weight: 700; color: #334155;">
                                    {{ $kontrak->customer->nama ?? 'Tanpa Nama' }}
                                </td>

                                <td style="padding: 16px 20px; color: #475569;">
                                    <div style="font-weight: 600;">{{ $kontrak->unit->nama_alat ?? 'Unit Alkes' }}</div>
                                    <div style="font-size: 0.75rem; font-family: monospace; color: #94a3b8; margin-top: 2px;">
                                        Kode: {{ $kontrak->unit->kode_unit ?? '-' }}
                                    </div>
                                </td>

                                <td style="padding: 16px 20px; color: #475569; font-size: 0.813rem;">
                                    {{ $kontrak->tanggal_mulai }} s/d <br><span style="font-weight: 600; color: #0f172a;">{{ $kontrak->tanggal_selesai }}</span>
                                </td>

                                <td style="padding: 16px 20px;">
                                    @php
                                        $sisaHari = 0;
                                        if($kontrak->tanggal_selesai) {
                                            $tglSelesai = \Carbon\Carbon::parse($kontrak->tanggal_selesai)->startOfDay();
                                            $tglSekarang = \Carbon\Carbon::now()->startOfDay();
                                            $sisaHari = $tglSekarang->diffInDays($tglSelesai, false);
                                        }

                                        $color = '#334155';
                                        $fontWeight = '600';
                                        $textDurasi = $sisaHari . ' Hari';

                                        if($sisaHari < 0) {
                                            $color = '#dc2626';
                                            $fontWeight = '800';
                                            $textDurasi = 'Lewat ' . abs($sisaHari) . ' Hari';
                                        } elseif ($sisaHari <= 3) {
                                            $color = '#ef4444';
                                            $fontWeight = '800';
                                            $textDurasi = 'Sisa ' . $sisaHari . ' Hari';
                                        } else {
                                            $textDurasi = 'Sisa ' . $sisaHari . ' Hari';
                                        }
                                    @endphp
                                    <span style="color: {{ $color }}; font-weight: {{ $fontWeight }};">
                                        {{ $textDurasi }}
                                    </span>
                                </td>

                                <td style="padding: 16px 20px;">
                                    @php
                                        $payment = $kontrak->status_payment ?? $kontrak->status_pembayaran ?? 'Belum Lunas';
                                        $isLunas = strtolower($payment) == 'lunas';
                                    @endphp
                                    <span style="background: {{ $isLunas ? '#ecfdf5' : '#fef2f2' }}; color: {{ $isLunas ? '#059669' : '#dc2626' }}; padding: 4px 10px; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; border: 1px solid {{ $isLunas ? '#a7f3d0' : '#fecaca' }};">
                                        {{ $payment }}
                                    </span>
                                </td>

                                <td style="padding: 16px 20px;">
                                    @php
                                        $status = $kontrak->status ?? 'Aktif';
                                        $isAktif = strtolower($status) == 'aktif';
                                    @endphp
                                    <span style="background: {{ $isAktif ? '#ecfdf5' : '#f1f5f9' }}; color: {{ $isAktif ? '#059669' : '#475569' }}; padding: 4px 10px; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; border: 1px solid {{ $isAktif ? '#a7f3d0' : '#cbd5e1' }};">
                                        &bull; {{ $status }}
                                    </span>
                                </td>

                                <td style="padding: 16px 20px; text-align: center; font-weight: 600; color: #334155; font-size: 0.813rem;">
                                    {{ $kontrak->customer->no_hp ?? $kontrak->customer->no_telp ?? $kontrak->customer->no_wa ?? $kontrak->customer->telepon ?? '-' }}
                                </td>

                                <td style="padding: 16px 20px; text-align: center;">
                                    <div style="display: flex; gap: 6px; justify-content: center;">
                                        <a href="{{ route('kontraks.edit', $kontrak->id) }}" style="background: #f0fdf4; color: #16a34a; padding: 6px 10px; border-radius: 6px; font-weight: 600; font-size: 0.75rem; text-decoration: none; border: 1px solid #bbf7d0;">Edit</a>

                                        <form action="{{ route('kontraks.destroy', $kontrak->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data kontrak ini?');" style="margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background: #fef2f2; color: #dc2626; padding: 6px 10px; border-radius: 6px; font-weight: 600; font-size: 0.75rem; border: none; cursor: pointer;">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" style="padding: 32px; text-align: center; color: #64748b;">Belum ada data kontrak aktif yang tercatat.</td>
                            </tr>
                        @endforelse
                    @endisset
                </tbody>
            </table>
        </div>

        @if(isset($kontraks) && method_exists($kontraks, 'links'))
            <div style="padding: 16px 24px; border-top: 1px solid #e2e8f0; background: #f8fafc;">
                {{ $kontraks->links() }}
            </div>
        @endif
    </div>
</x-app-layout>