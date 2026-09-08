<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Unit; // Jangan lupa import Model Unit
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        // Menambahkan relasi 'unit' agar bisa dipanggil jika dibutuhkan di tabel index
        $bookings = Booking::with(['customer', 'unit'])->latest()->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $customers = Customer::all();
        $units = Unit::all(); // Mengambil data unit alkes untuk pilihan di form
        
        return view('bookings.create', compact('customers', 'units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id'          => 'required|exists:customers,id',
            'no_whatsapp'          => 'required|string|max:20',
            'unit_id'              => 'required|exists:units,id', // Validasi unit alkes wajib dipilih
            'estimasi_tgl_mulai'   => 'required|date',
            'catatan'              => 'nullable|string',          // Validasi catatan tambahan
        ]);

        // Menyimpan data booking ke database
        Booking::create([
            'customer_id'        => $request->customer_id,
            'no_whatsapp'        => $request->no_whatsapp,
            'unit_id'            => $request->unit_id,
            'estimasi_tgl_mulai' => $request->estimasi_tgl_mulai,
            'catatan'            => $request->catatan,
            // Jika tabel bookings lu butuh estimasi_tgl_selesai, bisa disesuaikan atau diisi default
            'estimasi_tgl_selesai' => $request->estimasi_tgl_mulai, 
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil ditambahkan!');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dihapus!');
    }
}