<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Penyewaan;
use App\Models\Kontrak;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $customers = Customer::when($search, function ($query, $search) {
                return $query->where('nama', 'like', "%{$search}%")
                             ->orWhere('telepon', 'like', "%{$search}%")
                             ->orWhere('alamat', 'like', "%{$search}%");
            })
            ->orderBy('id', 'DESC')
            ->paginate(15)
            ->withQueryString();

        foreach ($customers as $customer) {
            $unitsList = [];
            $penyewaans = Penyewaan::where('customer_id', $customer->id)
                ->where('status', 'Disewa')
                ->with('unit')
                ->get();

            foreach ($penyewaans as $p) {
                if ($p->unit) {
                    $unitsList[$p->unit->id] = $p->unit->nama_alat . ' (' . $p->unit->kode_unit . ')';
                }
            }

            $kontraks = Kontrak::where('customer_id', $customer->id)
                ->where('status', 'Aktif')
                ->with('unit')
                ->get();

            foreach ($kontraks as $k) {
                if ($k->unit) {
                    $unitsList[$k->unit->id] = $k->unit->nama_alat . ' (' . $k->unit->kode_unit . ')';
                }
            }
            $customer->active_units_list = array_values($unitsList);
        }

        // Data untuk autocomplete
        $allCustomers = Customer::select('nama', 'telepon')->orderBy('nama', 'ASC')->get();

        return view('customers.index', compact('customers', 'search', 'allCustomers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'    => 'required|string|max:255',
            'telepon' => 'required|string|max:255',
            'alamat'  => 'required|string',
        ]);
        Customer::create($validated);
        return redirect()->route('customers.index')->with('success', 'Data pelanggan berhasil ditambahkan!');
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'nama'    => 'required|string|max:255',
            'telepon' => 'required|string|max:255',
            'alamat'  => 'required|string',
        ]);
        $customer->update($validated);
        return redirect()->route('customers.index')->with('success', 'Data pelanggan berhasil diperbarui!');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Data pelanggan berhasil dihapus!');
    }
}