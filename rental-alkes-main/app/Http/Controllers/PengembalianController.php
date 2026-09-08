<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengembalian;

class PengembalianController extends Controller
{
    public function index()
    {
        // 1. Ambil data pengembalian untuk tabel (pagination 10 data)
        $pengembalians = Pengembalian::latest()->paginate(10);

        // 2. Hitung Grand Total Saldo Kas Berjalan dari seluruh data
        $totalPemasukan = Pengembalian::where('catatan', 'LIKE', '%[JENIS: Masuk]%')->sum('denda');
        $totalPengeluaran = Pengembalian::where('catatan', 'LIKE', '%[JENIS: Keluar]%')->sum('denda');
        $grandTotalBersih = $totalPemasukan - $totalPengeluaran;

        // 3. Kirim data ke view pengembalians.index
        return view('pengembalians.index', compact('pengembalians', 'grandTotalBersih'));
    }

    public function create()
    {
        return view('pengembalians.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'penyewaan_id'    => 'required|exists:penyewaans,id',
            'tanggal_kembali' => 'required|date',
            'kondisi_unit'    => 'required|string',
            'denda'           => 'required|numeric|min:0',
            'catatan'         => 'nullable|string',
        ]);

        Pengembalian::create($request->all());

        return redirect()->route('pengembalians.index')
            ->with('success', 'Data pengembalian berhasil dicatat!');
    }

    public function destroy($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->delete();

        return redirect()->route('pengembalians.index')
            ->with('success', 'Data transaksi berhasil dihapus!');
    }
}