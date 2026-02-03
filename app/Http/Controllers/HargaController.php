<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use Illuminate\Http\Request;

class HargaController extends Controller
{
    /**
     * Tampilkan daftar harga
     */
    public function index(Request $request)
    {
        $query = Harga::query();

        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        $harga = $query->orderBy('kategori')
                       ->orderBy('nama_layanan')
                       ->get();

        return view('manajemen.harga.index', compact('harga'));
    }

    /**
     * Form tambah harga
     */
    public function create()
    {
        return view('manajemen.harga.create');
    }

    /**
     * Simpan data harga
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori'     => 'required|in:laundry,jasa',
            'kode_layanan' => 'required|string|max:100',
            'nama_layanan' => 'required|string|max:255',
            'satuan'       => 'required|in:kg,pcs,km',
            'harga'        => 'required|integer|min:0',
            'jarak'        => 'nullable|integer|min:1',
            'is_optional'  => 'nullable|boolean',
            'is_active'    => 'nullable|boolean',
            'keterangan'   => 'nullable|string',
        ]);

        // 🔥 NORMALISASI DATA
        $isJasa = $request->kategori === 'jasa';

        Harga::create([
            'kategori'     => $request->kategori,
            'kode_layanan' => $request->kode_layanan,
            'nama_layanan' => $request->nama_layanan,
            'satuan'       => $isJasa ? 'km' : $request->satuan,
            'harga'        => $request->harga,
            'jarak'        => $isJasa ? $request->jarak : null,
            'is_optional'  => $isJasa ? ($request->is_optional ?? false) : false,
            'is_active'    => $request->is_active ?? true,
            'keterangan'   => $request->keterangan,
        ]);

        return redirect()
            ->route('manajemen.harga.index')
            ->with('success', 'Data harga berhasil ditambahkan');
    }

    /**
     * Form edit harga
     */
    public function edit($id)
    {
        $harga = Harga::findOrFail($id);
        return view('manajemen.harga.edit', compact('harga'));
    }

    /**
     * Update data harga
     */
    public function update(Request $request, $id)
    {
        $harga = Harga::findOrFail($id);

        $request->validate([
            'kategori'     => 'required|in:laundry,jasa',
            'kode_layanan' => 'required|string|max:100',
            'nama_layanan' => 'required|string|max:255',
            'satuan'       => 'required|in:kg,pcs,km',
            'harga'        => 'required|integer|min:0',
            'jarak'        => 'nullable|integer|min:1',
            'is_optional'  => 'nullable|boolean',
            'is_active'    => 'nullable|boolean',
            'keterangan'   => 'nullable|string',
        ]);

        $isJasa = $request->kategori === 'jasa';

        $harga->update([
            'kategori'     => $request->kategori,
            'kode_layanan' => $request->kode_layanan,
            'nama_layanan' => $request->nama_layanan,
            'satuan'       => $isJasa ? 'km' : $request->satuan,
            'harga'        => $request->harga,
            'jarak'        => $isJasa ? $request->jarak : null,
            'is_optional'  => $isJasa ? ($request->is_optional ?? false) : false,
            'is_active'    => $request->is_active ?? true,
            'keterangan'   => $request->keterangan,
        ]);

        return redirect()
            ->route('manajemen.harga.index')
            ->with('success', 'Data harga berhasil diperbarui');
    }

    /**
     * Hapus data harga
     */
    public function destroy($id)
    {
        Harga::findOrFail($id)->delete();

        return redirect()
            ->route('manajemen.harga.index')
            ->with('success', 'Data harga berhasil dihapus');
    }
}
