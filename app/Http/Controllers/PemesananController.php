<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Pemesanan;
use App\Models\HistoryPemesanan;
use App\Models\TrackPemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PemesananController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_cust'        => 'required|exists:customer,id_cust',
            'id_outlet'      => 'required|exists:outlet,id_outlet',
            'jenis_layanan'  => 'required|string',
            'tipe_pemesanan' => 'required|string',
            'berat_cucian'   => 'required|numeric|min:0.1',
            'jumlah_item'    => 'required|integer|min:1',
            'catatan_khusus' => 'nullable|string',
            'status_proses' =>  'diterima',

        ]);

        DB::beginTransaction();

        try {
            $pemesanan = Pemesanan::create([
                'no_order'        => 'ORD-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6)),
                'id_cust'         => $request->id_cust,
                'id_outlet'       => $request->id_outlet,
                'jenis_layanan'   => $request->jenis_layanan,
                'tipe_pemesanan'  => $request->tipe_pemesanan,
                'tanggal_masuk'   => now(),
                'berat_cucian'    => $request->berat_cucian,
                'jumlah_item'     => $request->jumlah_item,
                'catatan_khusus'  => $request->catatan_khusus,
            ]);

            HistoryPemesanan::create([
                'id_pemesanan'  => $pemesanan->id_pemesanan,
                'status'        => 'diterima',
                'jenis_layanan' => $pemesanan->jenis_layanan,
                'tipe_pemesanan'=> $pemesanan->tipe_pemesanan,
                'pembayaran'    => 'belum_bayar',
            ]);

            TrackPemesanan::create([
                'id_pemesanan'   => $pemesanan->id_pemesanan,
                'proses'         => 'diterima',
                'jenis_layanan'  => $pemesanan->jenis_layanan,
                'tanggal_mulai'  => now(),
            ]);

            DB::commit();
            return response()->json($pemesanan, 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function create()
    {
       $customer = Customer::firstOrCreate(
        ['id_user' => Auth::id()],
        [
            'nama' => Auth::user()->name,
            'no_telp' => '-',
            'alamat' => '-',
        ]
    );
    return view('pemesanan.create', compact('customer'));
    }

    public function show($id)
    {
        return Pemesanan::with([
            'customer',
            'outlet',
            'pembayaran',
            'historyPemesanan',
            'trackPemesanan'
        ])->findOrFail($id);
    }

    public function updateStatus(Request $request, $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        HistoryPemesanan::create([
            'id_pemesanan' => $id,
            'status' => $request->status,
            'jenis_layanan' => $pemesanan->jenis_layanan,
            'tipe_pemesanan' => $pemesanan->tipe_pemesanan,
        ]);

        $pemesanan->trackPemesanan()->update([
            'proses' => $request->status,
        ]);

        return response()->json(['message' => 'Status updated']);
    }
}
