<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.375rem; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.025em;">
            Tambah Booking Unit Manual
        </h2>
        <p style="font-size: 0.813rem; color: #64748b; margin: 3px 0 0 0; font-weight: 500;">Catat antrean atau pesanan sewa alat kesehatan baru secara manual.</p>
    </x-slot>

    <!-- TAMBAHKAN CSS SELECT2 DI SINI -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Custom CSS biar Select2 Estetik & Presisi */
        .select2-container .select2-selection--single {
            height: 42px !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 8px !important;
            display: flex;
            align-items: center;
            background-color: #ffffff !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            padding-left: 12px !important;
            padding-right: 40px !important;
            color: #334155 !important;
            font-size: 0.875rem !important;
            line-height: 40px !important;
            font-weight: 400 !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px !important;
            right: 8px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__clear {
            position: absolute !important;
            right: 30px !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
            margin: 0 !important;
            color: #ef4444 !important;
            font-size: 18px !important;
            font-weight: bold !important;
        }
        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #059669 !important; /* Warna hijau senada dengan tombol */
            box-shadow: 0 0 0 1px #059669 !important;
        }
    </style>

    <div style="padding: 10px 0 40px 0;">
        <div style="max-width: 48rem; margin: 0 auto;">
            <div style="background: #ffffff; padding: 32px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
                
                @if(session('error'))
                    <div style="background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; font-weight: 600; font-size: 0.875rem;">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    
                    <!-- Pilihan Customer DENGAN SELECT2 -->
                    <div style="margin-bottom: 20px;">
                        <label for="customer_id" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Pelanggan <span style="color: #dc2626;">*</span></label>
                        <select name="customer_id" id="customer_id" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem; background: #fff;" required>
                            <option value="">-- Pilih Pelanggan --</option>
                            @isset($customers)
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" data-phone="{{ $customer->no_hp ?? $customer->telepon ?? $customer->whatsapp ?? $customer->no_whatsapp ?? '' }}">
                                        {{ $customer->name ?? $customer->nama ?? $customer->nama_lengkap ?? 'Pelanggan #' . $customer->id }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                    </div>

                    <!-- No WhatsApp -->
                    <div style="margin-bottom: 20px;">
                        <label for="no_whatsapp" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">No WhatsApp <span style="color: #dc2626;">*</span></label>
                        <input type="text" name="no_whatsapp" id="no_whatsapp" value="{{ old('no_whatsapp') }}" placeholder="Contoh: 081234567890" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem;" required>
                    </div>

                    <!-- Jenis / Unit Alkes DENGAN SELECT2 -->
                    <div style="margin-bottom: 20px;">
                        <label for="unit_id" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Jenis / Unit Alkes <span style="color: #dc2626;">*</span></label>
                        <select name="unit_id" id="unit_id" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem; background: #fff;" required>
                            <option value="">-- Pilih Unit Alkes --</option>
                            @isset($units)
                                @foreach($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->nama_alat ?? $unit->nama ?? 'Unit' }} (Kode: {{ $unit->kode_unit ?? '-' }})</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>

                    <!-- Tanggal Mau Sewa -->
                    <div style="margin-bottom: 20px;">
                        <label for="estimasi_tgl_mulai" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Tanggal Mau Sewa <span style="color: #dc2626;">*</span></label>
                        <input type="date" name="estimasi_tgl_mulai" id="estimasi_tgl_mulai" value="{{ old('estimasi_tgl_mulai') }}" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem;" required>
                    </div>

                    <!-- Catatan Tambahan -->
                    <div style="margin-bottom: 24px;">
                        <label for="catatan" style="display: block; font-size: 0.875rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Catatan Tambahan</label>
                        <textarea name="catatan" id="catatan" rows="3" placeholder="Tuliskan catatan atau keperluan khusus..." style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem; resize: vertical;"></textarea>
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 12px;">
                        <a href="{{ route('bookings.index') }}" style="padding: 10px 20px; background-color: #f1f5f9; color: #475569; border-radius: 8px; font-weight: 600; text-decoration: none; font-size: 0.875rem;">Batal</a>
                        <button type="submit" style="padding: 10px 20px; background-color: #059669; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 0.875rem; box-shadow: 0 4px 6px rgba(5,150,105,0.2);">Simpan Booking</button>
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
            $('#customer_id').select2({
                placeholder: "Ketik nama pelanggan untuk mencari...",
                allowClear: true,
                width: '100%'
            });
            
            // Inisialisasi Select2 untuk Unit Alkes
            $('#unit_id').select2({
                placeholder: "Ketik nama unit alat untuk mencari...",
                allowClear: true,
                width: '100%'
            });

            // Script Auto-Fill No WhatsApp diconvert ke jQuery agar sinkron dengan Select2
            $('#customer_id').on('change', function() {
                const phone = $(this).find(':selected').data('phone') || '';
                $('#no_whatsapp').val(phone);
            });
        });
    </script>
</x-app-layout>