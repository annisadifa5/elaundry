<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;

class LacakController extends Controller
{
    public function index(Request $request)
    {
        // QUERY UTAMA (TABLE)
        $query = Pemesanan::with('customer');

        if ($request->status) {
            $query->where('status_proses', $request->status);
        }

        if ($request->from && $request->to) {
            $query->whereBetween('tanggal_masuk', [
                $request->from,
                $request->to
            ]);
        }

        $pemesanans = $query
            ->orderBy('tanggal_masuk')
            ->get();

        // =========================
        // DATA MINI DASHBOARD
        // =========================
        $trackingCount = [
            'diterima'     => Pemesanan::where('status_proses', 'diterima')->count(),
            'dicuci'       => Pemesanan::where('status_proses', 'dicuci')->count(),
            'dikeringkan'  => Pemesanan::where('status_proses', 'dikeringkan')->count(),
            'disetrika'    => Pemesanan::where('status_proses', 'disetrika')->count(),
            'selesai'      => Pemesanan::where('status_proses', 'selesai')->count(),
        ];

        // 🔥 TOTAL SEMUA PESANAN
        $total = array_sum($trackingCount);

        // 🔥 HITUNG PERSENTASE
        $persen = [
            'diterima'     => $total ? round($trackingCount['diterima'] / $total * 100) : 0,
            'dicuci'       => $total ? round($trackingCount['dicuci'] / $total * 100) : 0,
            'dikeringkan'  => $total ? round($trackingCount['dikeringkan'] / $total * 100) : 0,
            'disetrika'    => $total ? round($trackingCount['disetrika'] / $total * 100) : 0,
            'selesai'      => $total ? round($trackingCount['selesai'] / $total * 100) : 0,
        ];

        return view('lacak.index', compact('pemesanans', 'trackingCount', 'persen'));
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
