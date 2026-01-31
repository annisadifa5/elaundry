<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;

class LacakController extends Controller
{
    public function index(Request $request)
    {
        $query = Pemesanan::query();

        if ($request->status) {
            $query->where('status_proses', $request->status);
        }

        $pemesanans = $query
            ->where('status_proses', '!=', 'selesai')
            ->orderBy('tanggal_masuk')
            ->get();

        return view('lacak.index', compact('pemesanans'));
    }

    public function next($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        $next = match ($pemesanan->status_proses) {
            'diterima'    => 'dicuci',
            'dicuci'      => 'dikeringkan',
            'dikeringkan' => 'disetrika',
            'disetrika'   => 'selesai',
            default       => null,
        };

        if (!$next) {
            return back();
        }

        $pemesanan->update([
            'status_proses' => $next,
        ]);

        return back();
    }

}
