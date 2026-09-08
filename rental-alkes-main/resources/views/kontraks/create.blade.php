<x-app-layout>
    <x-slot name="header">
        <h2 style="font-weight: 800; font-size: 1.5rem; color: #1e293b; margin: 0;">
            Buat Kontrak Unit Baru
        </h2>
    </x-slot>

    <!-- TAMBAHKAN CSS SELECT2 DI SINI -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Penyesuaian style Select2 agar matching dengan desain Tailwind/Bawaan kamu */
        .select2-container .select2-selection--single {
            height: 42px !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 8px !important;
            display: flex;
            align-items: center;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px !important;
        }
    </style>

    <div style="padding: 40px 0;">
        <div style="max-width: 48rem; margin: 0 auto; padding: 0 1rem;">
            <div style="background: #ffffff; padding: 32px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                
                <!-- PENANGKAP ERROR VALIDASI -->
                @if ($errors->any())
                    <div style="background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; padding: 16px; border-radius: 12px; margin-bottom: 24px;">
                        <strong style="font-size: 0.875rem;">Gagal menyimpan kontrak! Periksa kembali isian Anda:</strong>
                        <ul style="margin: 8px 0 0 0; padding-left: 20px; font-size: 0.813rem; font-weight: 600;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- END PENANGKAP ERROR -->

                <form action="{{ route('kontraks.store') }}" method="POST">
                    @csrf
                    
                    <!-- Nomor Kontrak Otomatis -->
                    <div style="margin-bottom: 20px;">
                        <label for="no_kontrak" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Nomor Kontrak (Auto)</label>
                        <input type="text" name="no_kontrak" id="no_kontrak" value="{{ $no_kontrak }}" readonly style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; background-color: #f8fafc; border-radius: 8px; font-size: 0.875rem; font-weight: 600;" required>
                    </div>

                    <!-- Pilihan Customer DENGAN SELECT2 -->
                    <div style="margin-bottom: 20px;">
                        <label for="customer_id" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Pelanggan</label>
                        <!-- Tambahkan id="pelanggan-select" pada tag select ini -->
                        <select name="customer_id" id="pelanggan-select" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem;" required>
                            <option value="">Pilih Pelanggan</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Pilihan Unit Alkes DENGAN SELECT2 JUGA (Opsional, biar sekalian estetik) -->
                    <div style="margin-bottom: 20px;">
                        <label for="unit_id" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Unit Alkes</label>
                        <select name="unit_id" id="unit-select" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem;" required>
                            <option value="">Pilih Unit Alkes</option>
                            @foreach($units as $unit)
                                <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>{{ $unit->nama_alat }} ({{ $unit->kode_unit }})</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tanggal Mulai -->
                    <div style="margin-bottom: 20px;">
                        <label for="tanggal_mulai" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai') }}" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem;" required>
                    </div>

                    <!-- Tanggal Selesai -->
                    <div style="margin-bottom: 20px;">
                        <label for="tanggal_selesai" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai') }}" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem;" required>
                    </div>

                    <!-- Status Kontrak -->
                    <div style="margin-bottom: 24px;">
                        <label for="status" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Status Kontrak</label>
                        <select name="status" id="status" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem;" required>
                            <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="Dibatalkan" {{ old('status') == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>

                    <!-- Status Payment -->
                    <div style="margin-bottom: 24px;">
                        <label for="status_payment" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Status Pembayaran</label>
                        <select name="status_payment" id="status_payment" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem;" required>
                            <option value="Belum Lunas" {{ old('status_payment') == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                            <option value="Lunas" {{ old('status_payment') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                        </select>
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 12px;">
                        <a href="{{ route('kontraks.index') }}" style="padding: 10px 20px; background-color: #f1f5f9; color: #475569; border-radius: 8px; font-weight: 600; text-decoration: none; font-size: 0.875rem;">Batal</a>
                        <button type="submit" style="padding: 10px 20px; background-color: #2563eb; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 0.875rem;">Simpan Kontrak</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- TAMBAHKAN JQUERY & SCRIPT SELECT2 DI SINI -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi Select2 untuk Pelanggan
            $('#pelanggan-select').select2({
                placeholder: "Ketik nama pelanggan untuk mencari...",
                allowClear: true,
                width: '100%'
            });
            
            // Inisialisasi Select2 untuk Unit Alkes (Opsional tapi direkomendasikan)
            $('#unit-select').select2({
                placeholder: "Ketik nama unit alat untuk mencari...",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
</x-app-layout>