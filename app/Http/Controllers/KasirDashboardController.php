<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Reservasi;
use Carbon\Carbon;

class KasirDashboardController extends Controller
{
    public function index()
    {
        $hariIni = Carbon::today();

        // ================= TOTAL PESANAN HARI INI =================
        $totalPemesanan = Pemesanan::whereDate('created_at', $hariIni)->count();
        $totalReservasi = Reservasi::whereDate('created_at', $hariIni)->count();

        $totalPesanan = $totalPemesanan + $totalReservasi;

        // ================= TOTAL TRANSAKSI HARI INI =================
        $totalTransaksiPemesanan = Pemesanan::whereDate('created_at', $hariIni)
            ->where('status_bayar', 'lunas')
            ->sum('total_harga');

        $totalTransaksiReservasi = Reservasi::whereDate('created_at', $hariIni)
            ->where('status_bayar', 'lunas')
            ->sum('total_harga');

        $totalTransaksi = $totalTransaksiPemesanan + $totalTransaksiReservasi;

        // ================= BELUM DIBAYAR =================
        $belumDibayar = 
            Pemesanan::whereDate('created_at', $hariIni)
                ->where('status_bayar', 'belum')
                ->count()
            +
            Reservasi::whereDate('created_at', $hariIni)
                ->where('status_bayar', 'belum')
                ->count();

        // ================= PESANAN SELESAI =================
        $pesananSelesai =
            Pemesanan::whereDate('created_at', $hariIni)
                ->where('status_proses', 'selesai')
                ->count()
            +
            Reservasi::whereDate('created_at', $hariIni)
                ->where('status_proses', 'selesai')
                ->count();

        // ================= ANTRIAN =================
        $antrianPemesanan = Pemesanan::whereIn('status_proses', ['menunggu', 'diproses'])
            ->orderBy('created_at', 'asc')
            ->get();

        $antrianReservasi = Reservasi::whereIn('status_proses', ['menunggu', 'diproses'])
            ->orderBy('created_at', 'asc')
            ->get();

        // Tambahkan label tipe
        $antrianPemesanan->map(function ($item) {
            $item->tipe = 'Pemesanan';
            return $item;
        });

        $antrianReservasi->map(function ($item) {
            $item->tipe = 'Reservasi';
            return $item;
        });

        // Gabungkan
        $antrianPesanan = $antrianPemesanan
            ->merge($antrianReservasi)
            ->sortBy('created_at');

        return view('kasir.dashboard', compact(
            'totalPesanan',
            'totalTransaksi',
            'belumDibayar',
            'pesananSelesai',
            'antrianPesanan'
        ));
    }

    public function showPemesanan($id)
    {
        $data = Pemesanan::with(['customer','outlet'])
            ->findOrFail($id);

        return view('kasir.detail_pemesanan', compact('data'));
    }

    public function showReservasi($id)
    {
        $data = Reservasi::with(['customer'])
            ->findOrFail($id);

        return view('kasir.detail_reservasi', compact('data'));
    }

}
