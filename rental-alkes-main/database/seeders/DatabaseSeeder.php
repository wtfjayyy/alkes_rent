<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Customer;
use App\Models\Penyewaan;
use App\Models\Kontrak;
use App\Models\Pengembalian;
use App\Models\Maintenance;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat User Admin Default
        User::updateOrCreate(
            ['email' => 'admin@rental.com'],
            [
                'name' => 'Admin Operasional',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Buat Data Pelanggan (Customer)
        $customer1 = Customer::create([
            'nama' => 'Witura Fajar',
            'telepon' => '081234567890',
            'alamat' => 'Tangerang, Banten',
        ]);

        $customer2 = Customer::create([
            'nama' => 'Budi Santoso',
            'telepon' => '089876543210',
            'alamat' => 'Jakarta Selatan',
        ]);

        // 3. Buat Kategori Unit Alkes
        $cat1 = Category::create(['nama_kategori' => 'Mobilitas']);
        $cat2 = Category::create(['nama_kategori' => 'Pernapasan']);

        // 4. Buat Unit Alkes yang berelasi dengan Kategori
        $unit1 = Unit::create([
            'kode_unit' => 'KR-001',
            'nama_alat' => 'Kursi Roda Sella',
            'category_id' => $cat1->id,
            'status' => 'Maintenance',
        ]);

        $unit2 = Unit::create([
            'kode_unit' => 'TO-001',
            'nama_alat' => 'Tabung Oksigen 1 Meter Kubik',
            'category_id' => $cat2->id,
            'status' => 'Ready',
        ]);

        // 5. Buat Data Maintenance berelasi ke Unit
        Maintenance::create([
            'unit_id' => $unit1->id,
            'tanggal_maintenance' => now()->subDays(2)->format('Y-m-d'),
            'deskripsi_kerusakan' => 'roda macet sebelah kiri',
            'biaya' => 138000,
            'status' => 'Proses',
        ]);

        // 6. Buat Data Penyewaan
        $penyewaan = Penyewaan::create([
            'customer_id' => $customer1->id,
            'unit_id' => $unit2->id,
            'tanggal_sewa' => now()->subDays(3)->format('Y-m-d'),
            'total_biaya' => 450000,
        ]);

        // 7. Buat Data Kontrak
        try {
            Kontrak::create([
                'penyewaan_id' => $penyewaan->id ?? 1,
                'nomor_kontrak' => 'KTR/2026/08/001',
                'isi_kontrak' => 'Perjanjian sewa alat kesehatan jangka pendek.',
            ]);
        } catch (\Exception $e) {}

        // 8. Pengembalian dikosongkan/aman dengan try-catch agar tidak error
        try {
            Pengembalian::create([
                'penyewaan_id' => $penyewaan->id ?? 1,
            ]);
        } catch (\Exception $e) {}
    }
}