<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Reservasi;
use App\Models\Customer;
use App\Models\Harga;

class ReservasiController extends Controller
{
    public function create(): View
    {
        $hargaList = Harga::laundry()->get()->keyBy('kode_layanan');

        return view('reservasi.create', [
            'hargaList' => $hargaList
        ]);
    }

   public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'            => 'required|string|max:100',
            'no_telp'         => 'required|string|max:20',
            'alamat_jemput'   => 'required|string',
            'jenis_layanan'   => 'required|string',
            'tipe_pemesanan'  => 'required|string',
            'tanggal_jemput'  => 'required|date',
            'jam_jemput'      => 'required',
            'jumlah_item'     => 'nullable|integer|min:1',
            'berat_cucian'    => 'nullable|numeric|min:0.1',
            'catatan_khusus'  => 'nullable|string',
        ]);

        $customer = Customer::firstOrCreate(
            ['no_telp' => $validated['no_telp']],
            [
                'nama_lengkap' => $validated['nama'],
                'alamat'       => $validated['alamat_jemput'],
            ]
        );

        // ==============================
        // HITUNG TOTAL HARGA (SAMA DENGAN PEMESANAN)
        // ==============================
        $layananDipilih = explode(',', $validated['jenis_layanan']);

        $berat  = (float) ($validated['berat_cucian'] ?? 0);
        $jumlah = (int) ($validated['jumlah_item'] ?? 0);

        $totalHarga = 0;

        foreach ($layananDipilih as $kode) {
            $harga = Harga::where('kode_layanan', $kode)
                ->where('is_active', true)
                ->first();

            if (!$harga) continue;

            // ❗ RESERVASI: HANYA PCS
            if ($harga->satuan === 'pcs' && $jumlah > 0) {
                $totalHarga += $harga->harga * $jumlah;
            }
        }


        // ==============================
        // SIMPAN RESERVASI
        // ==============================
        Reservasi::create([
            'id_cust'        => $customer->id_cust,
            'jenis_layanan'  => $validated['jenis_layanan'],
            'tipe_pemesanan' => $validated['tipe_pemesanan'],
            'tanggal_jemput' => $validated['tanggal_jemput'],
            'jam_jemput'     => $validated['jam_jemput'],
            'alamat_jemput'  => $validated['alamat_jemput'],
            'jumlah_item'    => $jumlah ?: null,
            'berat_cucian'   => $berat ?: null,
            'total_harga'    => $totalHarga,
            'catatan_khusus' => $validated['catatan_khusus'] ?? null,
        ]);

        return redirect()
            ->route('reservasi.create')
            ->with('success', 'Reservasi berhasil dikirim');
    }




}
