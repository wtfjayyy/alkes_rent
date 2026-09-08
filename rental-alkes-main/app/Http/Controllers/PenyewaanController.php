<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use App\Models\Kontrak;
use App\Models\Customer;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class PenyewaanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $modelToUse = class_exists(Kontrak::class) && Schema::hasTable('kontraks') ? Kontrak::class : Penyewaan;

        $penyewaans = $modelToUse::with(['customer', 'unit'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('customer', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })->orWhereHas('unit', function ($q) use ($search) {
                    $q->where('nama_alat', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Mapping otomatis agar total biaya dan tanggal sewa konsisten dibaca dari berbagai variasi kolom database
        $penyewaans->getCollection()->transform(function ($item) {
            $item->total_biaya = $item->total_biaya ?? $item->total_harga ?? $item->biaya ?? $item->harga ?? 0;
            $item->tanggal_sewa = $item->tanggal_sewa ?? $item->tanggal_mulai ?? ($item->created_at ? $item->created_at->format('Y-m-d') : '-');
            return $item;
        });

        return view('penyewaans.index', compact('penyewaans', 'search'));
    }

    public function create()
    {
        $customers = Customer::all();
        $units = Unit::all();
        return view('penyewaans.create', compact('customers', 'units'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id'   => 'required|exists:customers,id',
            'unit_id'       => 'required|exists:units,id',
            'tanggal_sewa'  => 'required|date',
            'total_biaya'   => 'nullable|numeric',
        ]);

        $validated['status'] = 'Aktif';
        $validated['total_biaya'] = $request->total_biaya ?? 0;

        if (class_exists(Kontrak::class) && Schema::hasTable('kontraks')) {
            $validated['no_kontrak'] = 'KTR-' . date('Ymd') . '-' . rand(1000, 9999);
            Kontrak::create($validated);
        } else {
            Penyewaan::create($validated);
        }

        Unit::where('id', $request->unit_id)->update(['status' => 'Disewa']);

        return redirect()->route('penyewaans.index')->with('success', 'Data penyewaan & booking berhasil dicatat!');
    }

    public function edit($id)
    {
        $penyewaan = class_exists(Kontrak::class) && Schema::hasTable('kontraks') ? Kontrak::findOrFail($id) : Penyewaan::findOrFail($id);
        $customers = Customer::all();
        $units = Unit::all();
        
        return view('penyewaans.edit', compact('penyewaan', 'customers', 'units'));
    }

    public function update(Request $request, $id)
    {
        $penyewaan = class_exists(Kontrak::class) && Schema::hasTable('kontraks') ? Kontrak::findOrFail($id) : Penyewaan::findOrFail($id);
        
        $request->validate([
            'customer_id'   => 'required|exists:customers,id',
            'unit_id'       => 'required|exists:units,id',
            'tanggal_sewa'  => 'required|date',
            'total_biaya'   => 'nullable|numeric',
        ]);

        // AMBIL ID UNIT LAMA SEBELUM DI-UPDATE
        $unitLamaId = $penyewaan->unit_id;

        $penyewaan->update([
            'customer_id'   => $request->customer_id,
            'unit_id'       => $request->unit_id,
            'tanggal_sewa'  => $request->tanggal_sewa,
            'total_biaya'   => $request->total_biaya ?? 0,
        ]);

        // BUG FIX: KEMBALIKAN STATUS UNIT LAMA JADI TERSEDIA JIKA UNIT DIGANTI
        if ($unitLamaId != $request->unit_id) {
            Unit::where('id', $unitLamaId)->update(['status' => 'Tersedia']);
        }
        // PASTIKAN UNIT BARU STATUSNYA JADI DISEWA
        Unit::where('id', $request->unit_id)->update(['status' => 'Disewa']);

        return redirect()->route('penyewaans.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $penyewaan = class_exists(Kontrak::class) && Schema::hasTable('kontraks') ? Kontrak::findOrFail($id) : Penyewaan::findOrFail($id);
        $penyewaan->delete();
        
        return redirect()->route('penyewaans.index')->with('success', 'Data berhasil dihapus!');
    }

    public function invoice($id)
    {
        $penyewaan = class_exists(Kontrak::class) && Schema::hasTable('kontraks') ? Kontrak::with(['customer', 'unit'])->findOrFail($id) : Penyewaan::with(['customer', 'unit'])->findOrFail($id);
        return view('penyewaans.invoice', compact('penyewaan'));
    }

    public function show($id)
    {
        $penyewaan = class_exists(Kontrak::class) && Schema::hasTable('kontraks') ? Kontrak::with(['customer', 'unit'])->findOrFail($id) : Penyewaan::with(['customer', 'unit'])->findOrFail($id);
        return view('penyewaans.show', compact('penyewaan'));
    }
}