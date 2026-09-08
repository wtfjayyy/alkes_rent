<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PenyewaanController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\KategoriUnitController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\KontrakController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\TransaksiKeuanganController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Group Route yang Membutuhkan Login (Auth)
Route::middleware(['auth'])->group(function () {
    
    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['verified'])->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Unit Alkes Resource Routes
    Route::resource('units', UnitController::class);

    // Customer / Pelanggan Resource Routes
    Route::resource('customers', CustomerController::class);

    // Penyewaan Custom Status, Invoice, Detail & Resource Routes
    Route::patch('penyewaans/{penyewaan}/status/{status}', [PenyewaanController::class, 'updateStatus'])->name('penyewaans.updateStatus');
    Route::get('/penyewaans/{penyewaan}/invoice', [PenyewaanController::class, 'invoice'])->name('penyewaans.invoice');
    Route::resource('penyewaans', PenyewaanController::class);

    // Route Kategori & Kategori Unit
    Route::resource('categories', CategoryController::class);
    Route::resource('kategori-units', KategoriUnitController::class);

    // Modul Transaksi & Lanjutan
    Route::resource('bookings', BookingController::class);
    Route::resource('kontraks', KontrakController::class);
    Route::resource('pengembalians', PengembalianController::class);

    // Route Maintenance (Menggunakan Resource + Custom Action Selesai)
    Route::resource('maintenances', MaintenanceController::class);
    Route::patch('maintenances/{id}/finish', [MaintenanceController::class, 'updateStatus'])->name('maintenances.finish');

    // Modul Transaksi Keuangan
    Route::resource('transaksi-keuangan', TransaksiKeuanganController::class);

});

require __DIR__.'/auth.php';

// Rute untuk Generate Akun Staff Operasional
Route::get('/generate-staff', function () {
    \App\Models\User::firstOrCreate(
        ['email' => 'staff@sahabathomecare.com'],
        [
            'name' => 'Staff Operasional',
            'password' => bcrypt('staff12345')
        ]
    );
    return 'Akun staff berhasil dibuat! Email: staff@sahabathomecare.com | Pass: staff12345';
});