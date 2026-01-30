<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Reservasi;
use App\Models\Customer;

class ReservasiController extends Controller
{
    public function create(): View
    {
        return view('reservasi.create');
    }

    public function store(Request $request)
{
    // 1️⃣ Validasi (pakai nama DB)
    $validated = $request->validate([
        'nama'            => 'required|string|max:100',
        'no_telp'         => 'required|string|max:20',
        'alamat_jemput'   => 'required|string',
        'jenis_layanan'   => 'required|string',
        'tipe_pemesanan'  => 'required|string',
        'tanggal_jemput'  => 'required|date',
        'jam_jemput'      => 'required',
        'catatan_khusus'  => 'nullable|string',
    ]);

    // 2️⃣ Buat / ambil customer (WAJIB karena id_cust NOT NULL)
    $customer = Customer::firstOrCreate(
        ['no_telp' => $validated['no_telp']],
        [
            'nama'    => $validated['nama'],
            'alamat' => $validated['alamat_jemput'],
        ]
    );

    // 3️⃣ Simpan reservasi (SESUAI MODEL)
    Reservasi::create([
        'id_cust'         => $customer->id_cust,
        'jenis_layanan'   => $validated['jenis_layanan'],
        'tipe_pemesanan'  => $validated['tipe_pemesanan'],
        'tanggal_jemput'  => $validated['tanggal_jemput'],
        'jam_jemput'      => $validated['jam_jemput'],
        'alamat_jemput'   => $validated['alamat_jemput'],
        'catatan_khusus'  => $validated['catatan_khusus'] ?? null,
    ]);

    return redirect()
        ->route('reservasi.create')
        ->with('success', 'Reservasi berhasil dikirim 🎉');
}

}
