<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div>
                <h2 style="font-size: 1.625rem; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.03em;">
                    Dashboard Overview
                </h2>
                <p style="font-size: 0.875rem; color: #64748b; margin: 4px 0 0 0; font-weight: 500;">
                    Pusat kendali operasional dan pemantauan inventaris alat kesehatan secara <em style="color: #059669; font-style: normal; font-weight: 600;">real-time</em>.
                </p>
            </div>
        </div>
    </x-slot>

    <!-- Welcome Banner Modern -->
    <div style="background: linear-gradient(135deg, #022c22 0%, #064e3b 50%, #047857 100%); border-radius: 20px; padding: 40px; color: #ffffff; margin-bottom: 32px; position: relative; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(5, 150, 105, 0.2), 0 8px 10px -6px rgba(5, 150, 105, 0.15);">
        <div style="position: absolute; right: -60px; top: -60px; width: 280px; height: 280px; background: rgba(52, 211, 153, 0.1); border-radius: 50%; filter: blur(20px); pointer-events: none;"></div>
        <div style="position: absolute; right: 120px; bottom: -90px; width: 220px; height: 220px; background: rgba(255,255,255,0.04); border-radius: 50%; pointer-events: none;"></div>
        
        <div style="position: relative; z-index: 10; max-width: 700px;">
            <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(52, 211, 153, 0.15); backdrop-filter: blur(12px); padding: 6px 14px; border-radius: 9999px; font-size: 0.72rem; font-weight: 700; letter-spacing: 0.08em; margin-bottom: 18px; border: 1px solid rgba(52, 211, 153, 0.3);">
                <span style="width: 6px; height: 6px; border-radius: 50%; background: #34d399; display: inline-block; box-shadow: 0 0 8px #34d399;"></span>
                SISTEM AKTIF &bull; KODE UNIT TERGENERASI OTOMATIS
            </div>
            <h1 style="font-size: 2.35rem; font-weight: 800; margin: 0 0 12px 0; letter-spacing: -0.035em; line-height: 1.15; color: #ffffff;">
                Halo, Admin Sahabat! 👋
            </h1>
            <p style="font-size: 1.02rem; color: #cbd5e1; margin: 0 0 28px 0; line-height: 1.65; font-weight: 400;">
                Kelola penyewaan alat kesehatan, pantau ketersediaan stok secara akurat, dan pastikan seluruh unit siap melayani pasien dengan cepat.
            </p>
            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <a href="{{ route('units.create') ?? '#' }}" style="background: #ffffff; color: #064e3b; padding: 13px 24px; border-radius: 12px; font-weight: 700; font-size: 0.875rem; text-decoration: none; box-shadow: 0 4px 14px rgba(0,0,0,0.1); display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.background='#f8fafc';" onmouseout="this.style.transform='translateY(0)'; this.style.background='#ffffff';">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Unit Alkes
                </a>
                <a href="{{ route('units.index') ?? '#' }}" style="background: rgba(255, 255, 255, 0.1); color: #ffffff; padding: 13px 24px; border-radius: 12px; font-weight: 700; font-size: 0.875rem; text-decoration: none; border: 1px solid rgba(255, 255, 255, 0.2); backdrop-filter: blur(8px); display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(255, 255, 255, 0.2)'" onmouseout="this.style.background='rgba(255, 255, 255, 0.1)'">
                    Lihat Daftar Unit &rarr;
                </a>
            </div>
        </div>
    </div>

    <!-- Section 1: Ringkasan Inventaris & Penyewaan -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
        <h3 style="font-size: 0.75rem; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.08em; margin: 0;">Status Inventaris Utama</h3>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 32px;">
        
        <!-- Card 1: Total Unit -->
        <div style="background: #ffffff; border-radius: 18px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.01); display: flex; align-items: center; justify-content: space-between; transition: all 0.2s ease;" onmouseover="this.style.borderColor='#cbd5e1'; this.style.boxShadow='0 10px 20px -5px rgba(0,0,0,0.05)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.01)';">
            <div>
                <p style="font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin: 0 0 8px 0;">Total Unit Alkes</p>
                <h4 style="font-size: 2.25rem; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.03em;">{{ $totalUnit ?? 0 }}</h4>
                <span style="font-size: 0.75rem; color: #94a3b8; font-weight: 500; display: inline-block; margin-top: 6px;">Semua unit terdaftar di sistem</span>
            </div>
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; width: 52px; height: 52px; border-radius: 14px; color: #334155; display: flex; align-items: center; justify-content: center;">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
        </div>

        <!-- Card 2: Siap Sewa -->
        <div style="background: #ffffff; border-radius: 18px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.01); display: flex; align-items: center; justify-content: space-between; transition: all 0.2s ease;" onmouseover="this.style.borderColor='#a7f3d0'; this.style.boxShadow='0 10px 20px -5px rgba(5,150,105,0.05)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.01)';">
            <div>
                <p style="font-size: 0.75rem; font-weight: 700; color: #059669; text-transform: uppercase; letter-spacing: 0.06em; margin: 0 0 8px 0;">Unit Siap Sewa</p>
                <h4 style="font-size: 2.25rem; font-weight: 800; color: #059669; margin: 0; letter-spacing: -0.03em;">{{ $unitSiapSewa ?? 0 }}</h4>
                <span style="font-size: 0.75rem; color: #059669; font-weight: 600; display: inline-flex; align-items: center; gap: 4px; margin-top: 6px;">
                    <span style="width: 5px; height: 5px; background: #059669; border-radius: 50%;"></span> Tersedia untuk pasien
                </span>
            </div>
            <div style="background: #ecfdf5; border: 1px solid #a7f3d0; width: 52px; height: 52px; border-radius: 14px; color: #059669; display: flex; align-items: center; justify-content: center;">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>

        <!-- Card 3: Sedang Disewa (Disinkronkan dengan Total Kontrak) -->
        <div style="background: #ffffff; border-radius: 18px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.01); display: flex; align-items: center; justify-content: space-between; transition: all 0.2s ease;" onmouseover="this.style.borderColor='#fde68a'; this.style.boxShadow='0 10px 20px -5px rgba(217,119,6,0.05)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.01)';">
            <div>
                <p style="font-size: 0.75rem; font-weight: 700; color: #d97706; text-transform: uppercase; letter-spacing: 0.06em; margin: 0 0 8px 0;">Sedang Disewa</p>
                <h4 style="font-size: 2.25rem; font-weight: 800; color: #d97706; margin: 0; letter-spacing: -0.03em;">{{ $totalKontrak ?? 0 }}</h4>
                <span style="font-size: 0.75rem; color: #d97706; font-weight: 600; display: inline-flex; align-items: center; gap: 4px; margin-top: 6px;">
                    <span style="width: 5px; height: 5px; background: #d97706; border-radius: 50%;"></span> Digunakan di lokasi
                </span>
            </div>
            <div style="background: #fffbeb; border: 1px solid #fde68a; width: 52px; height: 52px; border-radius: 14px; color: #d97706; display: flex; align-items: center; justify-content: center;">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
    </div>

    <!-- Section 2: Ringkasan Data & Administrasi -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
        <h3 style="font-size: 0.75rem; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.08em; margin: 0;">Administrasi & Operasional</h3>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)); gap: 20px; margin-bottom: 32px;">
        
        <!-- Admin Card 1: Pelanggan -->
        <div style="background: #ffffff; border-radius: 18px; padding: 22px; border: 1px solid #e2e8f0; border-top: 4px solid #3b82f6; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.01); transition: transform 0.2s ease;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
            <p style="font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 8px 0;">Total Pelanggan</p>
            <div style="display: flex; align-items: baseline; gap: 8px;">
                <h4 style="font-size: 2rem; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.02em;">{{ $totalPelanggan ?? 0 }}</h4>
                <span style="font-size: 0.75rem; font-weight: 700; color: #3b82f6;">Orang</span>
            </div>
        </div>

        <!-- Admin Card 2: Booking -->
        <div style="background: #ffffff; border-radius: 18px; padding: 22px; border: 1px solid #e2e8f0; border-top: 4px solid #8b5cf6; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.01); transition: transform 0.2s ease;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
            <p style="font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 8px 0;">Data Booking</p>
            <div style="display: flex; align-items: baseline; gap: 8px;">
                <h4 style="font-size: 2rem; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.02em;">{{ $totalBooking ?? 0 }}</h4>
                <span style="font-size: 0.75rem; font-weight: 700; color: #8b5cf6;">Antrean</span>
            </div>
        </div>

        <!-- Admin Card 3: Kontrak Aktif -->
        <div style="background: #ffffff; border-radius: 18px; padding: 22px; border: 1px solid #e2e8f0; border-top: 4px solid #10b981; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.01); transition: transform 0.2s ease;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
            <p style="font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 8px 0;">Kontrak Aktif</p>
            <div style="display: flex; align-items: baseline; gap: 8px;">
                <h4 style="font-size: 2rem; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.02em;">{{ $totalKontrak ?? 0 }}</h4>
                <span style="font-size: 0.75rem; font-weight: 700; color: #10b981;">Berjalan</span>
            </div>
        </div>

        <!-- Admin Card 4: Maintenance -->
        <div style="background: #ffffff; border-radius: 18px; padding: 22px; border: 1px solid #e2e8f0; border-top: 4px solid #ef4444; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.01); transition: transform 0.2s ease;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
            <p style="font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 8px 0;">Maintenance</p>
            <div style="display: flex; align-items: baseline; gap: 8px;">
                <h4 style="font-size: 2rem; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.02em;">{{ $totalMaintenance ?? 0 }}</h4>
                <span style="font-size: 0.75rem; font-weight: 700; color: #ef4444;">Perbaikan</span>
            </div>
        </div>
    </div>

    <!-- Section 3: Rincian Sisa Stok Tersedia per Kategori -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
        <h3 style="font-size: 0.75rem; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.08em; margin: 0;">Sisa Stok Tersedia (Siap Sewa) Per Kategori</h3>
    </div>

    <div style="background: #ffffff; border-radius: 20px; border: 1px solid #e2e8f0; padding: 28px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.01);">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px;">
            @isset($stokPerKategori)
                @forelse($stokPerKategori as $stok)
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 20px; display: flex; align-items: center; justify-content: space-between; transition: all 0.2s ease;" onmouseover="this.style.borderColor='#cbd5e1'; this.style.background='#ffffff';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc';">
                        <div>
                            <span style="font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 6px;">{{ $stok->kategori ?? 'Umum' }}</span>
                            <span style="font-size: 1.75rem; font-weight: 800; color: #0f172a; letter-spacing: -0.02em;">{{ $stok->total }}</span>
                        </div>
                        
                        <!-- Logika Kondisional untuk Badge Stok -->
                        @if($stok->total > 0)
                            <div style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #059669; padding: 6px 12px; border-radius: 10px; font-size: 0.72rem; font-weight: 700; text-transform: uppercase;">
                                Tersedia
                            </div>
                        @else
                            <div style="background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; padding: 6px 12px; border-radius: 10px; font-size: 0.72rem; font-weight: 700; text-transform: uppercase;">
                                Habis
                            </div>
                        @endif
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 24px; color: #64748b; font-size: 0.875rem;">
                        Belum ada unit atau kategori yang tersedia saat ini.
                    </div>
                @endforelse
            @endisset
        </div>
    </div>
</x-app-layout>