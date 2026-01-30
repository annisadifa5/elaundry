<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function store(Request $request)
    {
        return Pembayaran::create([
            'id_pemesanan' => $request->id_pemesanan,
            'metode' => $request->metode,
            'jumlah' => $request->jumlah,
            'status' => 'paid',
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update(['status' => $request->status]);

        return response()->json(['message' => 'Payment status updated']);
    }
}
