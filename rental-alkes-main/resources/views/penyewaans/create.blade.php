<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.375rem; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.025em;">
            Tambah Transaksi Penyewaan
        </h2>
        <p style="font-size: 0.813rem; color: #64748b; margin: 3px 0 0 0; font-weight: 500;">Catat transaksi sewa alat kesehatan baru ke dalam sistem.</p>
    </x-slot>

    <div style="padding: 10px 0 40px 0;">
        <div style="max-width: 48rem; margin: 0 auto;">
            <div style="background: #ffffff; padding: 32px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
                
                @if(session('error'))
                    <div style="background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; font-weight: 600; font-size: 0.875rem;">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('penyewaans.store') }}" method="POST">
                    @csrf
                    
                    <!-- Pilih Pelanggan -->
                    <div style="margin-bottom: 20px;">
                        <label for="customer_id" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Pilih Pelanggan <span style="color: #dc2626;">*</span></label>
                        <select name="customer_id" id="customer_id" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem; background: #fff;" required>
                            <option value="">-- Pilih Pelanggan --</option>
                            @isset($customers)
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name ?? $customer->nama ?? $customer->nama_lengkap ?? 'Pelanggan #' . $customer->id }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>

                    <!-- Pilih Unit Alkes -->
                    <div style="margin-bottom: 20px;">
                        <label for="unit_id" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Pilih Unit Alkes (Tersedia) <span style="color: #dc2626;">*</span></label>
                        <select name="unit_id" id="unit_id" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem; background: #fff;" required>
                            <option value="">-- Pilih Unit Alkes --</option>
                            @isset($units)
                                @foreach($units as $unit)
                                    <!-- Menyimpan data harga sewa unit ke atribut data-harga -->
                                    <option value="{{ $unit->id }}" data-harga="{{ $unit->harga ?? $unit->harga_sewa ?? $unit->biaya ?? 0 }}">
                                        {{ $unit->nama_alat ?? $unit->nama ?? 'Unit' }} (Kode: {{ $unit->kode_unit ?? '-' }})
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                    </div>

                    <!-- Tanggal Sewa -->
                    <div style="margin-bottom: 20px;">
                        <label for="tanggal_sewa" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Tanggal Sewa <span style="color: #dc2626;">*</span></label>
                        <input type="date" name="tanggal_sewa" id="tanggal_sewa" value="{{ old('tanggal_sewa') }}" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem;" required>
                    </div>

                    <!-- Total Biaya -->
                    <div style="margin-bottom: 24px;">
                        <label for="total_biaya" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Total Biaya (Rp) <span style="color: #dc2626;">*</span></label>
                        <input type="number" name="total_biaya" id="total_biaya" value="{{ old('total_biaya') }}" placeholder="Contoh: 150000" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem;" required>
                    </div>

                    <!-- Tombol Aksi -->
                    <div style="display: flex; justify-content: flex-end; gap: 12px;">
                        <a href="{{ route('penyewaans.index') }}" style="padding: 10px 20px; background-color: #f1f5f9; color: #475569; border-radius: 8px; font-weight: 600; text-decoration: none; font-size: 0.875rem;">Batal</a>
                        <button type="submit" style="padding: 10px 20px; background-color: #059669; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 0.875rem; box-shadow: 0 4px 6px rgba(5,150,105,0.2);">Simpan Transaksi</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Script JavaScript untuk Auto-Fill Harga Sewa Berdasarkan Pilihan Unit Alkes -->
    <script>
        document.getElementById('unit_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const harga = selectedOption.getAttribute('data-harga') || '';
            document.getElementById('total_biaya').value = harga;
        });
    </script>
</x-app-layout>