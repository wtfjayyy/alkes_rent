<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Penyewaan;
use App\Models\Customer;
use App\Models\Booking;
use App\Models\Kontrak;
use App\Models\Maintenance;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung total unit secara akurat dari model Unit
        $totalUnit        = Unit::count();
        
        // 2. Sinkronisasi status unit
        $unitSiapSewa     = Unit::whereIn(DB::raw('LOWER(status)'), ['ready', 'siap sewa', 'tersedia'])->count();
        
        // Ambil hitungan maintenance langsung dari tabel Maintenance yang statusnya masih Proses (aktif)
        $totalMaintenance = Maintenance::whereIn(DB::raw('LOWER(status)'), ['proses', 'perbaikan', 'maintenance'])->count();
        
        // 3. Hitung unit yang sedang disewa
        $sedangDisewa     = Penyewaan::whereIn(DB::raw('LOWER(status)'), ['disewa', 'active', 'aktif', 'berjalan'])->count();
        
        // 4. Ringkasan data pelanggan
        $totalPelanggan   = Customer::count();
        
        // 5. Bypass error count bawaan
        $totalBooking     = Booking::count();
        $totalKontrak     = Kontrak::count();

        // 6. DASHBOARD STOK 0 JANGAN HILANG
        $stokPerKategori = Unit::with('category')
            ->get()
            ->groupBy(function($unit) {
                return $unit->category ? ($unit->category->nama_kategori ?? $unit->category->nama) : 'Kategori Lainnya';
            })
            ->map(function($group, $categoryName) {
                $readyCount = $group->filter(function($unit) {
                    return in_array(strtolower($unit->status), ['ready', 'siap sewa', 'tersedia']);
                })->count();

                return (object) [
                    'kategori' => $categoryName,
                    'total'    => $readyCount
                ];
            })
            ->values();

        return view('dashboard', compact(
            'totalUnit', 
            'unitSiapSewa', 
            'sedangDisewa', 
            'totalPelanggan', 
            'totalBooking', 
            'totalKontrak', 
            'totalMaintenance',
            'stokPerKategori'
        ));
    }
}