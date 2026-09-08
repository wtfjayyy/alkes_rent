<x-app-layout>
    <x-slot name="header">
        <h2 style="font-weight: 800; font-size: 1.5rem; color: #1e293b; margin: 0;">
            Catat Maintenance Unit Alkes
        </h2>
        <p style="font-size: 0.813rem; color: #64748b; margin: 3px 0 0 0; font-weight: 500;">Pilih unit alkes yang ada di sistem untuk dicatat jadwal perbaikannya.</p>
    </x-slot>

    <div style="padding: 40px 0;">
        <div style="max-width: 48rem; margin: 0 auto; padding: 0 1rem;">
            <div style="background: #ffffff; padding: 32px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                
                <form action="{{ route('maintenances.store') }}" method="POST">
                    @csrf
                    
                    <!-- Pilihan Unit Alkes (Real dari Database Unit) -->
                    <div style="margin-bottom: 20px;">
                        <label for="unit_id" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Pilih Unit Alat Kesehatan</label>
                        <select name="unit_id" id="unit_id" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem; background: #ffffff;" required>
                            <option value="">-- Pilih Unit Alkes yang Tersedia --</option>
                            @isset($units)
                                @foreach($units as $unit)
                                    <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>
                                        {{ $unit->nama_alat }} (Kode: {{ $unit->kode_unit }}) - Status: {{ $unit->status }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                    </div>

                    <!-- Tanggal Maintenance -->
                    <div style="margin-bottom: 20px;">
                        <label for="tanggal_maintenance" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Tanggal Maintenance</label>
                        <input type="date" name="tanggal_maintenance" id="tanggal_maintenance" value="{{ date('Y-m-d') }}" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem;" required>
                    </div>

                    <!-- Deskripsi Kerusakan -->
                    <div style="margin-bottom: 20px;">
                        <label for="deskripsi_kerusakan" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Deskripsi Kerusakan / Kendala</label>
                        <textarea name="deskripsi_kerusakan" id="deskripsi_kerusakan" rows="3" placeholder="Contoh: Selang oksigen bocor / perlu kalibrasi ulang..." style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem;" required>{{ old('deskripsi_kerusakan') }}</textarea>
                    </div>

                    <!-- Biaya Perbaikan -->
                    <div style="margin-bottom: 24px;">
                        <label for="biaya" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Estimasi Biaya Perbaikan (Rp)</label>
                        <input type="number" name="biaya" id="biaya" value="{{ old('biaya') }}" placeholder="Contoh: 75000" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem;">
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 12px;">
                        <a href="{{ route('maintenances.index') }}" style="padding: 10px 20px; background-color: #f1f5f9; color: #475569; border-radius: 8px; font-weight: 600; text-decoration: none; font-size: 0.875rem;">Batal</a>
                        <button type="submit" style="padding: 10px 20px; background-color: #059669; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 0.875rem;">Simpan Catatan Maintenance</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>