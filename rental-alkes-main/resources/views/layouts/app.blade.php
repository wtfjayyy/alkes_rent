<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'CV. Sahabat Homecare Palembang - Pusat Homecare & Rental Alkes' }}</title>

        <!-- FAVICON CUSTOM KESEHATAN -->
        <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🏥</text></svg>">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body style="font-family: 'Inter', sans-serif; background-color: #f8fafc; margin: 0; padding: 0;" class="antialiased">
        <div style="display: flex; min-height: 100vh;">
            
            <!-- SIDEBAR KIRI (Branding CV. Sahabat Homecare Palembang) -->
            <aside style="width: 270px; background: linear-gradient(180deg, #04382c 0%, #064e3b 50%, #065f46 100%); color: white; display: flex; flex-direction: column; position: fixed; top: 0; bottom: 0; left: 0; z-index: 50; box-shadow: 4px 0 20px rgba(0,0,0,0.08);">
                
                <div style="padding: 22px 18px; display: flex; align-items: center; gap: 10px; border-bottom: 1px solid rgba(255,255,255,0.08);">
                    <img src="{{ asset('images/logo-sahabat.png') }}" alt="Logo" style="height: 38px; width: auto; object-fit: contain; background: white; border-radius: 8px; padding: 2px;">
                    <div>
                        <div style="font-size: 0.82rem; font-weight: 800; letter-spacing: -0.01em; color: #ffffff; line-height: 1.2;">CV. Sahabat Homecare</div>
                        <div style="font-size: 0.65rem; color: #a7f3d0; font-weight: 500; margin-top: 2px;">Pusat Homecare & Rental Alkes</div>
                    </div>
                </div>

                <div style="padding: 20px 16px; flex: 1; overflow-y: auto; display: flex; flex-direction: column; gap: 4px;">
                    <div style="font-size: 0.65rem; font-weight: 800; color: #6ee7b7; text-transform: uppercase; letter-spacing: 0.1em; padding: 0 12px 8px 12px;">Menu Utama</div>

                    <a href="{{ route('dashboard') }}" style="display: flex; align-items: center; gap: 12px; padding: 12px 14px; border-radius: 10px; font-size: 0.875rem; font-weight: 600; text-decoration: none; color: {{ request()->routeIs('dashboard') ? '#ffffff' : '#a7f3d0' }}; background: {{ request()->routeIs('dashboard') ? 'rgba(255,255,255,0.15)' : 'transparent' }}; border-left: {{ request()->routeIs('dashboard') ? '4px solid #34d399' : '4px solid transparent' }};">
                        <span style="font-size: 1.1rem;">📊</span> Dashboard
                    </a>
                    <a href="{{ route('units.index') }}" style="display: flex; align-items: center; gap: 12px; padding: 12px 14px; border-radius: 10px; font-size: 0.875rem; font-weight: 600; text-decoration: none; color: {{ request()->routeIs('units*') ? '#ffffff' : '#a7f3d0' }}; background: {{ request()->routeIs('units*') ? 'rgba(255,255,255,0.15)' : 'transparent' }}; border-left: {{ request()->routeIs('units*') ? '4px solid #34d399' : '4px solid transparent' }};">
                        <span style="font-size: 1.1rem;">📦</span> Unit Alkes & Kategori
                    </a>
                    <a href="{{ route('customers.index') }}" style="display: flex; align-items: center; gap: 12px; padding: 12px 14px; border-radius: 10px; font-size: 0.875rem; font-weight: 600; text-decoration: none; color: {{ request()->routeIs('customers*') ? '#ffffff' : '#a7f3d0' }}; background: {{ request()->routeIs('customers*') ? 'rgba(255,255,255,0.15)' : 'transparent' }}; border-left: {{ request()->routeIs('customers*') ? '4px solid #34d399' : '4px solid transparent' }};">
                        <span style="font-size: 1.1rem;">👥</span> Pelanggan
                    </a>

                    <div style="font-size: 0.65rem; font-weight: 800; color: #6ee7b7; text-transform: uppercase; letter-spacing: 0.1em; padding: 16px 12px 8px 12px;">Transaksi & Operasional</div>

                    <a href="{{ route('penyewaans.index') }}" style="display: flex; align-items: center; gap: 12px; padding: 12px 14px; border-radius: 10px; font-size: 0.875rem; font-weight: 600; text-decoration: none; color: {{ request()->routeIs('penyewaans*') ? '#ffffff' : '#a7f3d0' }}; background: {{ request()->routeIs('penyewaans*') ? 'rgba(255,255,255,0.15)' : 'transparent' }}; border-left: {{ request()->routeIs('penyewaans*') ? '4px solid #34d399' : '4px solid transparent' }};">
                        <span style="font-size: 1.1rem;">📋</span> Penyewaan
                    </a>

                    <!-- MENU BARU: BOOKING UNIT -->
                    <a href="{{ route('bookings.index') }}" style="display: flex; align-items: center; gap: 12px; padding: 12px 14px; border-radius: 10px; font-size: 0.875rem; font-weight: 600; text-decoration: none; color: {{ request()->routeIs('bookings*') ? '#ffffff' : '#a7f3d0' }}; background: {{ request()->routeIs('bookings*') ? 'rgba(255,255,255,0.15)' : 'transparent' }}; border-left: {{ request()->routeIs('bookings*') ? '4px solid #34d399' : '4px solid transparent' }};">
                        <span style="font-size: 1.1rem;">📌</span> Booking Unit
                    </a>

                    <a href="{{ route('kontraks.index') }}" style="display: flex; align-items: center; gap: 12px; padding: 12px 14px; border-radius: 10px; font-size: 0.875rem; font-weight: 600; text-decoration: none; color: {{ request()->routeIs('kontraks*') ? '#ffffff' : '#a7f3d0' }}; background: {{ request()->routeIs('kontraks*') ? 'rgba(255,255,255,0.15)' : 'transparent' }}; border-left: {{ request()->routeIs('kontraks*') ? '4px solid #34d399' : '4px solid transparent' }};">
                        <span style="font-size: 1.1rem;">📄</span> Kontrak Aktif
                    </a>
                    <a href="{{ route('pengembalians.index') }}" style="display: flex; align-items: center; gap: 12px; padding: 12px 14px; border-radius: 10px; font-size: 0.875rem; font-weight: 600; text-decoration: none; color: {{ request()->routeIs('pengembalians*') ? '#ffffff' : '#a7f3d0' }}; background: {{ request()->routeIs('pengembalians*') ? 'rgba(255,255,255,0.15)' : 'transparent' }}; border-left: {{ request()->routeIs('pengembalians*') ? '4px solid #34d399' : '4px solid transparent' }};">
                        <span style="font-size: 1.1rem;">💰</span> Transaksi Keuangan
                    </a>
                    <a href="{{ route('maintenances.index') }}" style="display: flex; align-items: center; gap: 12px; padding: 12px 14px; border-radius: 10px; font-size: 0.875rem; font-weight: 600; text-decoration: none; color: {{ request()->routeIs('maintenances*') ? '#ffffff' : '#a7f3d0' }}; background: {{ request()->routeIs('maintenances*') ? 'rgba(255,255,255,0.15)' : 'transparent' }}; border-left: {{ request()->routeIs('maintenances*') ? '4px solid #34d399' : '4px solid transparent' }};">
                        <span style="font-size: 1.1rem;">🛠️</span> Maintenance
                    </a>
                </div>

                <!-- USER PROFILE & PROFESSIONAL LOGOUT BUTTON -->
                <div style="padding: 16px; border-top: 1px solid rgba(255,255,255,0.08); background: rgba(0,0,0,0.2);">
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <div>
                            <div style="font-size: 0.813rem; font-weight: 700; color: #ffffff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ Auth::user()->name ?? 'Admin Operasional' }}</div>
                            <div style="font-size: 0.7rem; color: #6ee7b7; font-weight: 500;">Super Administrator</div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); color: #fca5a5; padding: 9px 12px; border-radius: 8px; font-size: 0.813rem; font-weight: 600; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(239, 68, 68, 0.3)'; this.style.color='#ffffff';" onmouseout="this.style.background='rgba(239, 68, 68, 0.15)'; this.style.color='#fca5a5';">
                                <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                Keluar Sistem
                            </button>
                        </form>
                    </div>
                </div>
            </aside>

            <!-- KONTEN UTAMA -->
            <div style="margin-left: 270px; flex: 1; display: flex; flex-direction: column; min-height: 100vh;">
                
                <!-- TOP HEADER -->
                <header style="background: #ffffff; border-bottom: 1px solid #e2e8f0; padding: 18px 40px; position: sticky; top: 0; z-index: 40; display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                        <div>
                            {{ $header ?? '' }}
                        </div>
                        
                        <div style="background: #ecfdf5; border: 1px solid #a7f3d0; padding: 8px 16px; border-radius: 10px; font-size: 0.813rem; font-weight: 700; color: #065f46; display: flex; align-items: center; gap: 10px;">
                            <span>📅 {{ now()->format('d-m-Y') }}</span>
                            <span style="color: #34d399; opacity: 0.6;">|</span>
                            <span>⏰ <span id="realtime-clock">{{ now()->format('H:i:s') }}</span> WIB</span>
                        </div>

                    </div>
                </header>

                <!-- BODY CONTENT -->
                <main style="flex: 1; padding: 36px 40px;">
                    {{ $slot }}
                </main>

                <!-- FOOTER -->
                <footer style="padding: 20px 40px; text-align: center; font-size: 0.75rem; color: #64748b; border-top: 1px solid #e2e8f0; background: #ffffff;">
                    CV. Sahabat Homecare Palembang &bull; v1.0 - 2026
                </footer>
            </div>

        </div>

        <!-- SCRIPT UNTUK JAM REAL-TIME -->
        <script>
            function updateClock() {
                const now = new Date();
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');
                const clockElement = document.getElementById('realtime-clock');
                if (clockElement) {
                    clockElement.textContent = hours + ':' + minutes + ':' + seconds;
                }
            }
            setInterval(updateClock, 1000);
            updateClock();
        </script>
    </body>
</html>