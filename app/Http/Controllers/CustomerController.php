<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Tampilkan data customer
     */
    public function index()
    {
        $customers = Customer::latest()->get();
        return view('manajemen.customer.index', compact('customers'));
    }

    /**
     * Form tambah customer
     */
    public function create()
    {
        return view('manajemen.customer.create');
    }

    /**
     * Simpan data customer
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'alamat'       => 'required|string',
            'no_telp'      => 'required|string|max:20',
            'lokasi'       => 'nullable|string',
            'email'        => 'nullable|email',
        ]);

        Customer::create([
            'nama_lengkap' => $request->nama_lengkap,
            'alamat'       => $request->alamat,
            'no_telp'      => $request->no_telp,
            'lokasi'       => $request->lokasi,
            'email'        => $request->email,
        ]);

        return redirect()
            ->route('manajemen.customer.index')
            ->with('success', 'Customer berhasil ditambahkan');
    }

    /**
     * Form edit customer
     */
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('manajemen.customer.edit', compact('customer'));
    }

    /**
     * Update data customer
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'alamat'       => 'required|string',
            'no_telp'      => 'required|string|max:20',
            'lokasi'       => 'nullable|string',
            'email'        => 'nullable|email',
        ]);

        $customer->update([
            'nama_lengkap' => $request->nama_lengkap,
            'alamat'       => $request->alamat,
            'no_telp'      => $request->no_telp,
            'lokasi'       => $request->lokasi,
            'email'        => $request->email,
        ]);

        return redirect()
            ->route('manajemen.customer.index')
            ->with('success', 'Customer berhasil diperbarui');
    }

    /**
     * Hapus customer
     */
    public function destroy($id)
    {
        Customer::findOrFail($id)->delete();

        return redirect()
            ->route('manajemen.customer.index')
            ->with('success', 'Customer berhasil dihapus');
    }
}
