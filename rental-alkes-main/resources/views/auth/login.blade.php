<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In - CV. Sahabat Homecare Palembang</title>
    <!-- FAVICON CUSTOM KESEHATAN -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🏥</text></svg>">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }
        @keyframes pulseGlow {
            0% { transform: scale(1); opacity: 0.4; }
            50% { transform: scale(1.08); opacity: 0.7; }
            100% { transform: scale(1); opacity: 0.4; }
        }
        .glow-circle {
            animation: pulseGlow 8s ease-in-out infinite;
        }
    </style>
</head>
<body style="background-color: #042f24; color: #0f172a; overflow-x: hidden;">
    <div style="min-height: 100vh; display: flex; width: 100vw; background: #ffffff;">
        
        <!-- LEFT SIDE: IMMERSIVE BRANDING BANNER -->
        <div style="flex: 1.2; background: linear-gradient(135deg, #022c22 0%, #064e3b 50%, #047857 100%); padding: 64px; color: #ffffff; display: flex; flex-direction: column; justify-content: space-between; position: relative; overflow: hidden;">
            
            <!-- Ambient Background Glow Elements -->
            <div class="glow-circle" style="position: absolute; width: 500px; height: 500px; background: rgba(52, 211, 153, 0.15); border-radius: 50%; top: -150px; right: -150px; filter: blur(60px); pointer-events: none;"></div>
            <div style="position: absolute; width: 350px; height: 350px; background: rgba(16, 185, 129, 0.1); border-radius: 50%; bottom: -100px; left: -100px; filter: blur(50px); pointer-events: none;"></div>
            
            <!-- Top Branding Header -->
            <div style="display: flex; align-items: center; gap: 16px; z-index: 10;">
                <div style="display: flex; align-items: center; justify-content: center; width: 52px; height: 52px; background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 14px; backdrop-filter: blur(12px); box-shadow: 0 8px 32px rgba(0,0,0,0.15); font-size: 1.6rem;">
                    🏥
                </div>
                <div>
                    <div style="font-size: 1.05rem; font-weight: 800; letter-spacing: -0.01em; color: #ffffff;">CV. Sahabat Homecare Palembang</div>
                    <div style="font-size: 0.75rem; color: #a7f3d0; font-weight: 500; letter-spacing: 0.02em; margin-top: 2px;">Pusat Homecare & Rental Alkes</div>
                </div>
            </div>

            <!-- Central Hero Content -->
            <div style="z-index: 10; max-width: 540px; margin: auto 0;">
                <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(52, 211, 153, 0.12); border: 1px solid rgba(52, 211, 153, 0.3); padding: 6px 14px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; color: #34d399; text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 24px; backdrop-filter: blur(8px);">
                    <span style="width: 6px; height: 6px; background: #34d399; border-radius: 50%; display: inline-block;"></span> 
                    Enterprise Operational System v1.0
                </div>
                <h1 style="font-size: 3rem; font-weight: 800; letter-spacing: -0.035em; line-height: 1.15; margin-bottom: 20px; color: #ffffff;">
                    Sistem Rental Alat Kesehatan Profesional.
                </h1>
                <p style="font-size: 1.05rem; color: #cbd5e1; line-height: 1.7; font-weight: 400;">
                    Kelola inventaris unit alkes, transaksi penyewaan, kontrak aktif, pemeliharaan, hingga data pelanggan dengan presisi tinggi dan efisiensi penuh dalam satu kendali terpadu.
                </p>
            </div>

            <!-- Footer Meta -->
            <div style="font-size: 0.8rem; color: #94a3b8; border-top: 1px solid rgba(255, 255, 255, 0.1); padding-top: 24px; z-index: 10; display: flex; justify-content: space-between; align-items: center;">
                <span>&copy; 2026 CV. Sahabat Homecare Palembang. All rights reserved.</span>
                <span style="color: #34d399; font-weight: 600; font-size: 0.75rem;">Secure Access Portal</span>
            </div>
        </div>

        <!-- RIGHT SIDE: MODERN CLEAN LOGIN FORM -->
        <div style="width: 540px; padding: 60px 56px; display: flex; flex-direction: column; justify-content: center; background: #ffffff; box-shadow: -15px 0 40px rgba(0, 0, 0, 0.03); z-index: 10;">
            
            <div style="margin-bottom: 36px;">
                <div style="width: 48px; height: 48px; background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; margin-bottom: 18px; box-shadow: 0 4px 12px rgba(5,150,105,0.08);">
                    🔐
                </div>
                <h2 style="font-size: 1.85rem; font-weight: 800; color: #0f172a; letter-spacing: -0.03em; margin-bottom: 8px;">
                    Selamat Datang! 👋
                </h2>
                <p style="font-size: 0.92rem; color: #64748b; font-weight: 400;">
                    Masukkan kredensial akun admin Anda untuk mengakses sistem.
                </p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div style="margin-bottom: 20px; padding: 12px 16px; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 10px; font-size: 0.85rem; color: #16a34a; font-weight: 600;">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address Field -->
                <div style="margin-bottom: 22px;">
                    <label for="email" style="display: block; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; color: #475569; margin-bottom: 8px;">
                        Email Kantor / Admin
                    </label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="admin@sahabathomecare.com"
                        style="width: 100%; padding: 14px 18px; font-size: 0.95rem; border: 1.5px solid #e2e8f0; border-radius: 12px; outline: none; transition: all 0.25s ease; background-color: #f8fafc; color: #0f172a;"
                        onfocus="this.style.borderColor='#059669'; this.style.backgroundColor='#ffffff'; this.style.boxShadow='0 0 0 4px rgba(5,150,105,0.08)';"
                        onblur="this.style.borderColor='#e2e8f0'; this.style.backgroundColor='#f8fafc'; this.style.boxShadow='none';"
                    />
                    @error('email')
                        <span style="display: block; margin-top: 6px; font-size: 0.78rem; color: #dc2626; font-weight: 500;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Field -->
                <div style="margin-bottom: 22px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                        <label for="password" style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; color: #475569;">
                            Password
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" style="font-size: 0.78rem; font-weight: 600; color: #059669; text-decoration: none; transition: color 0.15s;" onmouseover="this.style.color='#047857'" onmouseout="this.style.color='#059669'">
                                Lupa password?
                            </a>
                        @endif
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••"
                        style="width: 100%; padding: 14px 18px; font-size: 0.95rem; border: 1.5px solid #e2e8f0; border-radius: 12px; outline: none; transition: all 0.25s ease; background-color: #f8fafc; color: #0f172a;"
                        onfocus="this.style.borderColor='#059669'; this.style.backgroundColor='#ffffff'; this.style.boxShadow='0 0 0 4px rgba(5,150,105,0.08)';"
                        onblur="this.style.borderColor='#e2e8f0'; this.style.backgroundColor='#f8fafc'; this.style.boxShadow='none';"
                    />
                    @error('password')
                        <span style="display: block; margin-top: 6px; font-size: 0.78rem; color: #dc2626; font-weight: 500;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me Checkbox -->
                <div style="display: flex; align-items: center; margin-bottom: 28px;">
                    <label for="remember_me" style="display: inline-flex; align-items: center; cursor: pointer;">
                        <input id="remember_me" type="checkbox" name="remember" style="width: 17px; height: 17px; border: 1.5px solid #cbd5e1; border-radius: 5px; color: #059669; accent-color: #059669; cursor: pointer;">
                        <span style="margin-left: 10px; font-size: 0.88rem; color: #475569; font-weight: 500;">Ingat perangkat ini</span>
                    </label>
                </div>

                <!-- Action Button -->
                <div>
                    <button type="submit" style="width: 100%; padding: 15px 20px; background: linear-gradient(135deg, #065f46 0%, #059669 100%); color: #ffffff; font-weight: 700; font-size: 0.88rem; text-transform: uppercase; letter-spacing: 0.08em; border-radius: 12px; border: none; cursor: pointer; box-shadow: 0 6px 20px rgba(5,150,105,0.3); transition: all 0.25s ease;"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 25px rgba(5,150,105,0.4)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 6px 20px rgba(5,150,105,0.3)';"
                    >
                        Masuk ke Sistem
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>