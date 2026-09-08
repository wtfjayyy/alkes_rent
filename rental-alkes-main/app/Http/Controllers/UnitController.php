<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Category;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $units = Unit::with('category')
            ->when($search, function ($query, $search) {
                return $query->where('nama_alat', 'like', "%{$search}%")
                             ->orWhere('kode_unit', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('units.index', compact('units', 'search'));
    }

    public function show(Unit $unit)
    {
        return view('units.show', compact('unit'));
    }

    public function create()
    {
        $categories = Category::all();
        
        return view('units.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat'   => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'kode_unit'   => 'required|string|unique:units,kode_unit',
            'harga_sewa'  => 'required|numeric|min:0',
        ]);

        Unit::create([
            'nama_alat'   => $request->nama_alat,
            'category_id' => $request->category_id,
            'kode_unit'   => $request->kode_unit,
            'harga_sewa'  => $request->harga_sewa,
            'status'      => 'Ready',
        ]);

        return redirect()->route('units.index')
            ->with('success', 'Unit alkes baru berhasil ditambahkan!');
    }

    public function edit(Unit $unit)
    {
        $categories = Category::all();
        return view('units.edit', compact('unit', 'categories'));
    }

    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'nama_alat'   => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'kode_unit'   => 'required|string|unique:units,kode_unit,' . $unit->id,
            'harga_sewa'  => 'required|numeric|min:0',
        ]);

        $unit->update([
            'nama_alat'   => $request->nama_alat,
            'category_id' => $request->category_id,
            'kode_unit'   => $request->kode_unit,
            'harga_sewa'  => $request->harga_sewa,
        ]);

        return redirect()->route('units.index')
            ->with('success', 'Data unit alkes berhasil diperbarui!');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();
        return redirect()->route('units.index')
            ->with('success', 'Unit alkes berhasil dihapus!');
    }
}