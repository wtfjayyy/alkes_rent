<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Unit;
use App\Models\Category;
use App\Models\KategoriUnit;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $categoryId = $request->input('category_id');

        // Query maintenance dengan pencarian text & filter dropdown kategori
        $maintenances = Maintenance::with(['unit.category'])
            ->when($search, function ($query, $search) {
                return $query->where('deskripsi_kerusakan', 'like', "%{$search}%")
                             ->orWhereHas('unit', function ($q) use ($search) {
                                 $q->where('nama_alat', 'like', "%{$search}%")
                                   ->orWhere('kode_unit', 'like', "%{$search}%");
                             });
            })
            ->when($categoryId, function ($query, $categoryId) {
                return $query->whereHas('unit', function ($q) use ($categoryId) {
                    $q->where('category_id', $categoryId);
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Ambil data kategori untuk dropdown filter (aman untuk model Category maupun KategoriUnit)
        $categories = class_exists(Category::class) ? Category::all() : KategoriUnit::all();

        return view('maintenances.index', compact('maintenances', 'search', 'categoryId', 'categories'));
    }

    public function create()
    {
        $units = Unit::all();
        return view('maintenances.create', compact('units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'unit_id'             => 'required|exists:units,id',
            'tanggal_maintenance' => 'required|date',
            'deskripsi_kerusakan' => 'required|string',
            'biaya'               => 'nullable|numeric',
        ]);

        Maintenance::create([
            'unit_id'             => $request->unit_id,
            'tanggal_maintenance' => $request->tanggal_maintenance,
            'deskripsi_kerusakan' => $request->deskripsi_kerusakan,
            'biaya'               => $request->biaya ?? 0,
            'status'              => 'Proses',
        ]);

        $unit = Unit::find($request->unit_id);
        if ($unit) {
            $unit->status = 'Maintenance';
            $unit->save();
        }

        return redirect()->route('maintenances.index')
            ->with('success', 'Catatan maintenance berhasil dicatat!');
    }

    public function updateStatus($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        $maintenance->status = 'Selesai';
        $maintenance->save();

        $unit = Unit::find($maintenance->unit_id);
        if ($unit) {
            $unit->status = 'Ready';
            $unit->save();
        }

        return redirect()->route('maintenances.index')
            ->with('success', 'Perbaikan unit selesai dan unit kini sudah Ready kembali!');
    }

    public function destroy($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        
        if ($maintenance->status === 'Proses') {
            $unit = Unit::find($maintenance->unit_id);
            if ($unit) {
                $unit->status = 'Ready';
                $unit->save();
            }
        }
        
        $maintenance->delete();

        return redirect()->route('maintenances.index')
            ->with('success', 'Data maintenance berhasil dihapus!');
    }
}