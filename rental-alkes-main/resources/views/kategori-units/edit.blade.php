<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.375rem; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.025em;">
            Edit Kategori Unit Alkes
        </h2>
        <p style="font-size: 0.813rem; color: #64748b; margin: 3px 0 0 0; font-weight: 500;">Perbarui informasi kelompok jenis alat kesehatan.</p>
    </x-slot>

    <div style="max-width: 700px; margin: 0 auto; background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); overflow: hidden;">
        <div style="padding: 20px 24px; border-bottom: 1px solid #e2e8f0; font-size: 0.875rem; font-weight: 700; color: #334155; text-transform: uppercase; letter-spacing: 0.05em;">
            Formulir Edit Kategori
        </div>

        <form action="{{ route('kategori-units.update', $kategoriUnit->id) }}" method="POST" style="padding: 24px;">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 0.875rem; font-weight: 700; color: #475569; margin-bottom: 8px;">Nama Kategori</label>
                <input type="text" name="nama_kategori" value="{{ old('nama_kategori', $kategoriUnit->nama_kategori) }}" required style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 0.875rem; color: #334155; outline: none;">
                @error('nama_kategori') <span style="color: #ef4444; font-size: 0.75rem; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; font-size: 0.875rem; font-weight: 700; color: #475569; margin-bottom: 8px;">Deskripsi (Opsional)</label>
                <textarea name="deskripsi" rows="3" style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 0.875rem; color: #334155; outline: none; resize: vertical;">{{ old('deskripsi', $kategoriUnit->deskripsi) }}</textarea>
                @error('deskripsi') <span style="color: #ef4444; font-size: 0.75rem; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
            </div>

            <div style="display: flex; gap: 12px; justify-content: flex-end; border-top: 1px solid #e2e8f0; padding-top: 20px;">
                <a href="{{ route('kategori-units.index') }}" style="background: #f1f5f9; color: #475569; padding: 10px 20px; border-radius: 8px; font-weight: 700; font-size: 0.875rem; text-decoration: none; display: inline-block;">
                    Batal
                </a>
                <button type="submit" style="background: #059669; color: #ffffff; padding: 10px 24px; border-radius: 8px; font-weight: 700; font-size: 0.875rem; border: none; cursor: pointer; box-shadow: 0 4px 6px rgba(5, 150, 105, 0.2);">
                    Perbarui Kategori
                </button>
            </div>
        </form>
    </div>
</x-app-layout>