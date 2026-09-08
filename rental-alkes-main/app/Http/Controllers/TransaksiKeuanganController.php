<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Penyewaan;
use App\Models\Customer;
use App\Models\Unit;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class TransaksiKeuanganController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $transaksis = Pengembalian::when(filled($search), function ($query) use ($search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('catatan', 'like', "%{$search}%")
                      ->orWhere('tanggal_kembali', 'like', "%{$search}%")
                      ->orWhere('denda', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalPemasukan = Pengembalian::where('catatan', 'LIKE', '%[JENIS: Masuk]%')->sum('denda');
        $totalPengeluaran = Pengembalian::where('catatan', 'LIKE', '%[JENIS: Keluar]%')->sum('denda');
        $grandTotalBersih = $totalPemasukan - $totalPengeluaran;

        return view('transaksi.index', compact('transaksis', 'grandTotalBersih', 'totalPemasukan', 'totalPengeluaran', 'search'));
    }

    public function create()
    {
        return view('transaksi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal'           => 'required|date',
            'jenis_transaksi'   => 'required|in:Masuk,Keluar',
            'nominal'           => 'required|numeric|min:0',
            'status_verifikasi' => 'required|in:Diverifikasi,Belum Diverifikasi',
            'catatan'           => 'nullable|string',
        ]);

        $keteranganFull = "[JENIS: " . $request->jenis_transaksi . "] [" . $request->status_verifikasi . "] " . $request->catatan;

        try {
            $penyewaan = Penyewaan::first();
            if (!$penyewaan) {
                $customer = Customer::first();
                if (!$customer) {
                    $customer = new Customer();
                    $customer->nama = 'Umum / Kas';
                    $customer->save();
                }
                $unit = Unit::first();
                if (!$unit) {
                    $unit = new Unit();
                    $unit->nama_alat = 'Operasional';
                    $unit->kode_unit = 'OPS-01';
                    $unit->save();
                }
                $penyewaan = new Penyewaan();
                $penyewaan->customer_id = $customer->id;
                $penyewaan->unit_id = $unit->id;
                $penyewaan->tanggal_sewa = now();
                $penyewaan->total_biaya = 0;
                $penyewaan->status = 'Disewa';
                $penyewaan->save();
            }

            Pengembalian::create([
                'penyewaan_id'    => $penyewaan->id,
                'tanggal_kembali' => $request->tanggal,
                'kondisi_unit'    => 'Baik',
                'denda'           => $request->nominal,
                'catatan'         => $keteranganFull,
            ]);

            // DIARAHKAN KE ROUTE TRANSAKSI KEUANGAN
            return redirect()->route('transaksi-keuangan.index')
                ->with('success', 'Laporan transaksi keuangan berhasil dicatat!');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memproses transaksi: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $transaksi = Pengembalian::findOrFail($id);
        $transaksi->delete();
        
        // DIARAHKAN KE ROUTE TRANSAKSI KEUANGAN
        return redirect()->route('transaksi-keuangan.index')->with('success', 'Data transaksi berhasil dihapus!');
    }
}