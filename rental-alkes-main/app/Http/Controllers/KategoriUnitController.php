<?php

namespace App\Http\Controllers;

use App\Models\KategoriUnit;
use Illuminate\Http\Request;

class KategoriUnitController extends Controller
{
    public function index()
    {
        $kategoriUnits = KategoriUnit::all();
        return view('kategori-units.index', compact('kategoriUnits'));
    }

    public function create()
    {
        return view('kategori-units.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        KategoriUnit::create($request->all());

        return redirect()->route('kategori-units.index')->with('success', 'Kategori unit berhasil ditambahkan.');
    }

    public function edit(KategoriUnit $kategoriUnit)
    {
        return view('kategori-units.edit', compact('kategoriUnit'));
    }

    public function update(Request $request, KategoriUnit $kategoriUnit)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kategoriUnit->update($request->all());

        return redirect()->route('kategori-units.index')->with('success', 'Kategori unit berhasil diperbarui.');
    }

    public function destroy(KategoriUnit $kategoriUnit)
    {
        $kategoriUnit->delete();

        return redirect()->route('kategori-units.index')->with('success', 'Kategori unit berhasil dihapus.');
    }
}