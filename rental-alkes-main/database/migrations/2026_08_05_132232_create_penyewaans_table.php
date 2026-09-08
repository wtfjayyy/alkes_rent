<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penyewaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');
            $table->date('tanggal_sewa');
            $table->date('tanggal_kembali')->nullable();
            $table->decimal('total_biaya', 12, 2);
            $table->enum('status', ['Disewa', 'Dikembalikan'])->default('Disewa');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penyewaans');
    }
};