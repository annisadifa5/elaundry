<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Pemesanan;
use App\Models\HistoryPemesanan;
use App\Models\TrackPemesanan;
use App\Models\Harga;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PemesananController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
        'nama_lengkap'   => 'required|string|max:255',
        'no_telp'        => 'required|string|max:20',
        'alamat'         => 'required|string',
        'id_outlet'      => 'required|exists:outlet,id_outlet',
        'jenis_layanan'  => 'required|string',
        // 'tipe_pemesanan' => 'required|string',
        'berat_cucian'   => 'required|numeric|min:0.1',
        'jumlah_item'    => 'required|integer|min:1',
        'catatan_khusus' => 'nullable|string',
    ]);

        DB::beginTransaction();

        try {
                $customer = Customer::firstOrCreate(
                    ['no_telp' => $request->no_telp],
                    [
                        'nama_lengkap' => $request->nama_lengkap,
                        'alamat'       => $request->alamat,
                    ]
                );

                // ambil layanan jadi array
                $layananDipilih = explode(',', $request->jenis_layanan);

                $berat  = (float) $request->berat_cucian;
                $jumlah = (int) $request->jumlah_item;

                $hargaKg  = 0;
                $hargaPcs = 0;

                foreach ($layananDipilih as $kode) {
                    $harga = Harga::where('kode_layanan', $kode)
                        ->where('is_active', true)
                        ->first();

                    if (!$harga) continue;

                    if ($harga->satuan === 'kg') {
                        $hargaKg += $harga->harga;
                    }

                    if ($harga->satuan === 'pcs') {
                        $hargaPcs += $harga->harga;
                    }
                }

                $totalHarga = 0;

                if ($berat > 0) {
                    $totalHarga += $hargaKg * $berat;
                }

                if ($jumlah > 0) {
                    $totalHarga += $hargaPcs * $jumlah;
                }


                $pemesanan = Pemesanan::create([
                'no_order'        => 'ORD-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6)),
                'id_cust'         => $customer->id_cust,
                'id_outlet'       => $request->id_outlet,
                'jenis_layanan'   => $request->jenis_layanan,
                // 'tipe_pemesanan'  => $request->tipe_pemesanan,
                'tanggal_masuk'   => now(),
                'berat_cucian'    => $request->berat_cucian,
                'jumlah_item'     => $request->jumlah_item,
                'total_harga'     => $totalHarga,
                'catatan_khusus'  => $request->catatan_khusus,
            ]);

            HistoryPemesanan::create([
                'id_pemesanan'  => $pemesanan->id_pemesanan,
                'status'        => 'diterima',
                'jenis_layanan' => $pemesanan->jenis_layanan,
                // 'tipe_pemesanan'=> $pemesanan->tipe_pemesanan,
                'pembayaran'    => 'belum_bayar',
            ]);

            TrackPemesanan::create([
                'id_pemesanan'   => $pemesanan->id_pemesanan,
                'proses'         => 'diterima',
                'jenis_layanan'  => $pemesanan->jenis_layanan,
                'tanggal_mulai'  => now(),
            ]);

            DB::commit();
            return redirect()->route('pemesanan.create')
                         ->with('success', 'Pemesanan berhasil dibuat');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    

    public function create()
    {
        $hargaList = Harga::laundry()->get();

        return view('pemesanan.create', compact('hargaList'));
    }

    public function show($id)
    {
            $pemesanan = Pemesanan::with([
            'customer',
            'outlet',
            'pembayaran',
            'historyPemesanan',
            'trackPemesanan'
        ])->findOrFail($id);

        return view('pemesanan.show', compact('pemesanan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        HistoryPemesanan::create([
            'id_pemesanan' => $id,
            'status' => $request->status,
            'jenis_layanan' => $pemesanan->jenis_layanan,
            // 'tipe_pemesanan' => $pemesanan->tipe_pemesanan,
        ]);

        $pemesanan->trackPemesanan()->update([
            'proses' => $request->status,
        ]);

        return response()->json(['message' => 'Status updated']);
    }

    public function estimasi(Request $request)
    {
        $layananDipilih = explode(',', $request->jenis_layanan);

        $berat  = (float) $request->berat_cucian;
        $jumlah = (int) $request->jumlah_item;

        $hargaKg  = 0;
        $hargaPcs = 0;

        foreach ($layananDipilih as $kode) {
            $harga = Harga::where('kode_layanan', $kode)
                ->where('is_active', true)
                ->first();

            if (!$harga) continue;

            if ($harga->satuan === 'kg') {
                $hargaKg += $harga->harga;
            }

            if ($harga->satuan === 'pcs') {
                $hargaPcs += $harga->harga;
            }
        }

        $total = 0;

        if ($berat > 0) {
            $total += $hargaKg * $berat;
        }

        if ($jumlah > 0) {
            $total += $hargaPcs * $jumlah;
        }

        return response()->json([
            'total' => $total,
            'formatted' => 'Rp ' . number_format($total, 0, ',', '.'),
        ]);
    }



}
