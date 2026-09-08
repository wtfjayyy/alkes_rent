<?php

namespace App\Http\Controllers;

use App\Models\Kontrak;
use App\Models\Customer;
use App\Models\Unit;
use App\Models\Penyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class KontrakController extends Controller
{
    private function ensurePaymentColumnExists()
    {
        if (!Schema::hasColumn('kontraks', 'status_pembayaran')) {
            Schema::table('kontraks', function ($table) {
                $table->string('status_pembayaran')->default('Belum Lunas');
            });
        }
    }

    public function index(Request $request)
    {
        $this->ensurePaymentColumnExists(); // Otomatis buat kolom kalau belum ada

        $kategori_id = $request->input('kategori_id');
        $kategoris = DB::table('categories')->get();

        $query = Kontrak::with(['customer', 'unit'])->latest();

        if ($kategori_id) {
            $query->whereHas('unit', function($q) use ($kategori_id) {
                $q->where('category_id', $kategori_id);
            });
        }

        $kontraks = $query->paginate(10)->appends($request->all());

        return view('kontraks.index', compact('kontraks', 'kategoris', 'kategori_id'));
    }

    public function create()
    {
        $customers = Customer::all();
        $units = Unit::all();
        
        $latest = Kontrak::latest()->first();
        $number = $latest ? $latest->id + 1 : 1;
        $no_kontrak = 'KTR-' . date('Ymd') . '-' . str_pad($number, 4, '0', STR_PAD_LEFT);

        return view('kontraks.create', compact('customers', 'units', 'no_kontrak'));
    }

    public function store(Request $request)
    {
        $this->ensurePaymentColumnExists();

        $request->validate([
            'no_kontrak'      => 'required|string|unique:kontraks,no_kontrak',
            'customer_id'     => 'required|exists:customers,id',
            'unit_id'         => 'required|exists:units,id',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status'          => 'required|in:Aktif,Selesai,Dibatalkan',
            'status_payment'  => 'required|in:Lunas,Belum Lunas',
        ]);

        $statusBayar = $request->status_payment ?? 'Belum Lunas';

        $kontrak = Kontrak::create([
            'no_kontrak'        => $request->no_kontrak,
            'customer_id'       => $request->customer_id,
            'unit_id'           => $request->unit_id,
            'tanggal_mulai'     => $request->tanggal_mulai,
            'tanggal_selesai'   => $request->tanggal_selesai,
            'status'            => $request->status,
            'status_pembayaran' => $statusBayar, 
        ]);

        if (strtolower($request->status) === 'aktif') {
            Unit::where('id', $request->unit_id)->update(['status' => 'Disewa']);
            
            if (Schema::hasColumn('customers', 'status')) {
                Customer::where('id', $request->customer_id)->update(['status' => 'Aktif']);
            }
        }

        return redirect()->route('kontraks.index')->with('success', 'Kontrak berhasil dibuat dan status tersinkronisasi!');
    }

    public function edit(Kontrak $kontrak)
    {
        $customers = Customer::all();
        $units = Unit::all();
        
        return view('kontraks.edit', compact('kontrak', 'customers', 'units'));
    }

    public function update(Request $request, Kontrak $kontrak)
    {
        $this->ensurePaymentColumnExists();

        $request->validate([
            'no_kontrak'      => 'required|string|unique:kontraks,no_kontrak,' . $kontrak->id,
            'customer_id'     => 'required|exists:customers,id',
            'unit_id'         => 'required|exists:units,id',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status'          => 'required|in:Aktif,Selesai,Dibatalkan',
            'status_payment'  => 'required|in:Lunas,Belum Lunas',
        ]);

        $oldUnitId = $kontrak->unit_id;
        $oldCustomerId = $kontrak->customer_id;
        
        $statusBayar = $request->status_payment ?? 'Belum Lunas';

        $kontrak->update([
            'no_kontrak'        => $request->no_kontrak,
            'customer_id'       => $request->customer_id,
            'unit_id'           => $request->unit_id,
            'tanggal_mulai'     => $request->tanggal_mulai,
            'tanggal_selesai'   => $request->tanggal_selesai,
            'status'            => $request->status,
            'status_pembayaran' => $statusBayar, 
        ]);

        if (strtolower($request->status) === 'aktif') {
            Unit::where('id', $request->unit_id)->update(['status' => 'Disewa']);
            
            if (Schema::hasColumn('customers', 'status')) {
                Customer::where('id', $request->customer_id)->update(['status' => 'Aktif']);
            }
        } else {
            Unit::where('id', $oldUnitId)->update(['status' => 'Ready']);
            
            if (Schema::hasColumn('customers', 'status')) {
                $cekKontrakLain = Kontrak::where('customer_id', $oldCustomerId)
                    ->where('status', 'Aktif')
                    ->where('id', '!=', $kontrak->id)
                    ->exists();
                
                if (!$cekKontrakLain) {
                    Customer::where('id', $oldCustomerId)->update(['status' => 'Tidak Aktif']);
                }
            }
        }

        return redirect()->route('kontraks.index')->with('success', 'Data Kontrak & Sinkronisasi status berhasil diperbarui!');
    }

    public function destroy(Kontrak $kontrak)
    {
        $customerId = $kontrak->customer_id;

        if ($kontrak->unit_id) {
            Unit::where('id', $kontrak->unit_id)->update(['status' => 'Ready']);
        }

        $kontrak->delete();

        if (Schema::hasColumn('customers', 'status') && $customerId) {
            $cekKontrakLain = Kontrak::where('customer_id', $customerId)->where('status', 'Aktif')->exists();
            if (!$cekKontrakLain) {
                Customer::where('id', $customerId)->update(['status' => 'Tidak Aktif']);
            }
        }

        return redirect()->route('kontraks.index')->with('success', 'Kontrak berhasil dihapus dan status disesuaikan!');
    }
}