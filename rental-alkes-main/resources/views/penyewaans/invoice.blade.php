<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Penyewaan - #INV-{{ str_pad($penyewaan->id, 5, '0', STR_PAD_LEFT) }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* CSS Khusus buat nge-print biar rapi dan sembunyiin tombol */
        @media print {
            @page { margin: 0; }
            body { margin: 1.5cm; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans text-gray-800">
    
    <div class="max-w-4xl mx-auto bg-white p-10 mt-10 shadow-xl print:shadow-none print:mt-0 print:p-0">
        
        <!-- Header Perusahaan -->
        <div class="flex justify-between items-start border-b-2 border-gray-200 pb-6 mb-6">
            <div>
                <h1 class="text-4xl font-extrabold text-blue-700 tracking-tight">INVOICE</h1>
                <p class="text-lg font-semibold mt-1">Sahabat Homecare Palembang</p>
                <p class="text-sm text-gray-500">Layanan Sewa Alat Kesehatan</p>
            </div>
            <div class="text-right">
                <p class="text-xl font-bold text-gray-800">#INV-{{ str_pad($penyewaan->id, 5, '0', STR_PAD_LEFT) }}</p>
                <p class="text-sm text-gray-500 mt-1">Tanggal Sewa: <br> 
                    <span class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($penyewaan->tanggal_sewa)->translatedFormat('d F Y') }}</span>
                </p>
            </div>
        </div>

        <!-- Info Pelanggan & Status -->
        <div class="flex justify-between mb-8">
            <div>
                <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Informasi Pelanggan:</h3>
                <p class="font-bold text-lg text-gray-800">{{ $penyewaan->customer->nama ?? '-' }}</p>
                <p class="text-gray-600">No. WhatsApp: {{ $penyewaan->customer->no_hp ?? '-' }}</p>
                <p class="text-gray-600 w-2/3">Alamat: {{ $penyewaan->customer->alamat ?? '-' }}</p>
            </div>
            <div class="text-right">
                <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Status Pembayaran:</h3>
                <!-- Sesuai aturan SRS: Pembayaran dilakukan lunas -->
                <div class="inline-block border-2 border-green-600 text-green-700 px-4 py-1 text-lg font-extrabold uppercase tracking-widest rounded shadow-sm transform -rotate-2">
                    LUNAS
                </div>
            </div>
        </div>

        <!-- Tabel Detail Unit -->
        <table class="w-full text-left border-collapse mb-8">
            <thead>
                <tr class="bg-gray-100 border-y-2 border-gray-200 text-gray-700">
                    <th class="py-3 px-4 font-bold text-sm uppercase tracking-wider">Kode Unit</th>
                    <th class="py-3 px-4 font-bold text-sm uppercase tracking-wider">Nama Alat Kesehatan</th>
                    <th class="py-3 px-4 text-right font-bold text-sm uppercase tracking-wider">Subtotal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <tr>
                    <td class="py-4 px-4 font-medium text-gray-800">{{ $penyewaan->unit->kode_unit ?? '-' }}</td>
                    <td class="py-4 px-4 font-medium text-gray-800">{{ $penyewaan->unit->nama_alat ?? '-' }}</td>
                    <td class="py-4 px-4 text-right font-semibold text-gray-900">Rp {{ number_format($penyewaan->total_biaya, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Total Biaya -->
        <div class="flex justify-end mb-12">
            <div class="w-1/2">
                <div class="flex justify-between items-center border-t-4 border-gray-800 pt-4">
                    <span class="font-bold text-xl text-gray-800">TOTAL BIAYA:</span>
                    <span class="font-extrabold text-2xl text-blue-700">Rp {{ number_format($penyewaan->total_biaya, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Tanda Tangan -->
        <div class="flex justify-between mt-16 text-center">
            <div class="w-1/3">
                <p class="text-gray-600 mb-16">Penyewa,</p>
                <p class="font-bold text-gray-800 border-b border-gray-400 pb-1">{{ $penyewaan->customer->nama ?? '..........................' }}</p>
            </div>
            <div class="w-1/3">
                <p class="text-gray-600 mb-16">Hormat Kami,</p>
                <p class="font-bold text-gray-800 border-b border-gray-400 pb-1">Sahabat Homecare</p>
            </div>
        </div>

        <!-- Tombol Aksi (Tidak akan ikut terprint) -->
        <div class="mt-16 text-center no-print pb-10">
            <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                🖨️ Cetak / Simpan PDF
            </button>
            <button onclick="window.close()" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-8 rounded-lg shadow-lg ml-4 transition-transform transform hover:scale-105">
                Tutup Jendela
            </button>
        </div>

    </div>

    <!-- Script auto-print saat halaman baru dibuka -->
    <script>
        window.onload = function() {
            setTimeout(() => {
                window.print();
            }, 500);
        }
    </script>
</body>
</html>