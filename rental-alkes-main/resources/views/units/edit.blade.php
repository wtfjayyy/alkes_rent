<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.375rem; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.025em;">
            Edit Unit Alat Kesehatan
        </h2>
        <p style="font-size: 0.813rem; color: #64748b; margin: 3px 0 0 0; font-weight: 500;">Perbarui informasi lengkap inventaris unit alkes.</p>
    </x-slot>

    <div style="max-width: 700px; margin: 0 auto; background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); overflow: hidden;">
        <div style="padding: 20px 24px; border-bottom: 1px solid #e2e8f0; font-size: 0.875rem; font-weight: 700; color: #334155; text-transform: uppercase; letter-spacing: 0.05em;">
            Formulir Edit Unit
        </div>

        <form action="{{ route('units.update', $unit->id) }}" method="POST" style="padding: 24px;">
            @csrf
            @method('PUT')

            <!-- Kategori Unit -->
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 0.875rem; font-weight: 700; color: #475569; margin-bottom: 8px;">Kategori Unit</label>
                <select name="category_id" required style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 0.875rem; color: #334155; outline: none; background: #fff;">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ (old('category_id', $unit->category_id) == $cat->id) ? 'selected' : '' }}>
                            {{ $cat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <span style="color: #ef4444; font-size: 0.75rem; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
            </div>

            <!-- Kode Unit -->
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 0.875rem; font-weight: 700; color: #475569; margin-bottom: 8px;">No. Seri / Kode Unit</label>
                <input type="text" name="kode_unit" value="{{ old('kode_unit', $unit->kode_unit) }}" required style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 0.875rem; color: #334155; outline: none;">
                @error('kode_unit') <span style="color: #ef4444; font-size: 0.75rem; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
            </div>

            <!-- Nama Alat -->
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 0.875rem; font-weight: 700; color: #475569; margin-bottom: 8px;">Nama Alat / Unit</label>
                <input type="text" name="nama_alat" value="{{ old('nama_alat', $unit->nama_alat) }}" required style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 0.875rem; color: #334155; outline: none;">
                @error('nama_alat') <span style="color: #ef4444; font-size: 0.75rem; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
            </div>

            <!-- Status Ketersediaan -->
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 0.875rem; font-weight: 700; color: #475569; margin-bottom: 8px;">Status Ketersediaan</label>
                <select name="status" required style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 0.875rem; color: #334155; outline: none; background: #fff;">
                    <option value="Ready" {{ (old('status', $unit->status) == 'Ready') ? 'selected' : '' }}>Ready / Tersedia</option>
                    <option value="Disewa" {{ (old('status', $unit->status) == 'Disewa') ? 'selected' : '' }}>Disewa</option>
                    <option value="Maintenance" {{ (old('status', $unit->status) == 'Maintenance') ? 'selected' : '' }}>Maintenance</option>
                </select>
                @error('status') <span style="color: #ef4444; font-size: 0.75rem; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
            </div>

            <!-- Tombol Aksi -->
            <div style="display: flex; gap: 12px; justify-content: flex-end; border-top: 1px solid #e2e8f0; padding-top: 20px;">
                <a href="{{ route('units.index') }}" style="background: #f1f5f9; color: #475569; padding: 10px 20px; border-radius: 8px; font-weight: 700; font-size: 0.875rem; text-decoration: none; display: inline-block;">
                    Batal
                </a>
                <button type="submit" style="background: #059669; color: #ffffff; padding: 10px 24px; border-radius: 8px; font-weight: 700; font-size: 0.875rem; border: none; cursor: pointer; box-shadow: 0 4px 6px rgba(5, 150, 105, 0.2);">
                    Perbarui Unit
                </button>
            </div>
        </form>
    </div>
</x-app-layout>