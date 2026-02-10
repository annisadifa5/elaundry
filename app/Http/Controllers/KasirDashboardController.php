<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Carbon\Carbon;

class KasirDashboardController extends Controller
{
    public function index()
    {
        $hariIni = Carbon::today();

        // Total pesanan hari ini
        $totalPesanan = Pemesanan::whereDate('created_at', $hariIni)->count();

        // Total transaksi hari ini (yang SUDAH dibayar)
        $totalTransaksi = Pemesanan::whereDate('created_at', $hariIni)
            ->where('status_bayar', 'lunas')
            ->sum('total_harga');

        // Pesanan belum dibayar
        $belumDibayar = Pemesanan::whereDate('created_at', $hariIni)
            ->where('status_bayar', 'belum')
            ->count();

        // Pesanan selesai
        $pesananSelesai = Pemesanan::whereDate('created_at', $hariIni)
            ->where('status_proses', 'selesai')
            ->count();

        // Antrian pesanan (untuk tabel bawah)
        $antrianPesanan = Pemesanan::whereIn('status_proses', ['menunggu', 'diproses'])
            ->orderBy('created_at', 'asc')
            ->get();

        return view('kasir.dashboard', compact(
            'totalPesanan',
            'totalTransaksi',
            'belumDibayar',
            'pesananSelesai',
            'antrianPesanan'
        ));
    }
}
