<x-app-layout>
    <x-slot name="header">
        <h2 style="font-weight: 800; font-size: 1.5rem; color: #1e293b; margin: 0;">
            Tambah Unit Alat Kesehatan Baru
        </h2>
        <p style="font-size: 0.813rem; color: #64748b; margin: 3px 0 0 0; font-weight: 500;">Daftarkan inventaris unit alat kesehatan baru ke dalam sistem.</p>
    </x-slot>

    <div style="padding: 40px 0;">
        <div style="max-width: 48rem; margin: 0 auto; padding: 0 1rem;">
            <div style="background: #ffffff; padding: 32px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                
                <form action="{{ route('units.store') }}" method="POST">
                    @csrf
                    
                    <!-- Nama Alat / Unit -->
                    <div style="margin-bottom: 20px;">
                        <label for="nama_alat" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Nama Unit / Alat Kesehatan</label>
                        <input type="text" name="nama_alat" id="nama_alat" value="{{ old('nama_alat') }}" placeholder="Contoh: Tabung Oksigen 1m3 / Kursi Roda" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem;" required>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">
                        <!-- Kategori Alkes (Real Data dari Database) -->
                        <div>
                            <label for="category_id" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Kategori Alkes</label>
                            <select name="category_id" id="category_id" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem; background: #ffffff;" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Nomor Seri / Kode Unit -->
                        <div>
                            <label for="kode_unit" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Nomor Seri / Kode Unit</label>
                            <input type="text" name="kode_unit" id="kode_unit" value="{{ old('kode_unit') }}" placeholder="Contoh: OX-001-JKT" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem;" required>
                        </div>
                    </div>

                    <!-- Harga Sewa per Hari -->
                    <div style="margin-bottom: 24px;">
                        <label for="harga_sewa" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Harga Sewa per Hari (Rp)</label>
                        <input type="number" name="harga_sewa" id="harga_sewa" value="{{ old('harga_sewa') }}" placeholder="Contoh: 50000" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem;" required>
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 12px;">
                        <a href="{{ route('units.index') }}" style="padding: 10px 20px; background-color: #f1f5f9; color: #475569; border-radius: 8px; font-weight: 600; text-decoration: none; font-size: 0.875rem;">Batal</a>
                        <button type="submit" style="padding: 10px 20px; background-color: #059669; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 0.875rem;">Simpan Unit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>