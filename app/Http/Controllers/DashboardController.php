<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Karyawan;
use App\Models\Pemesanan;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        // =====================
        // 1️⃣ SUMMARY DASHBOARD
        // =====================
        $jumlahCustomer = Customer::count();
        $jumlahKaryawan = Karyawan::count();
        $totalPemesanan = Pemesanan::count();

        $totalPemasukan = Pemasukan::whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->sum('jumlah');

        $totalPengeluaran = Pengeluaran::whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->sum('jumlah');

        $labaBersih = $totalPemasukan - $totalPengeluaran;

        // =====================
        // 2️⃣ DATA GRAFIK
        // =====================

        // Label bulan (Jan - Des)
        $bulan = [
            'Jan','Feb','Mar','Apr','Mei','Jun',
            'Jul','Agu','Sep','Okt','Nov','Des'
        ];

        // ---- Pemasukan per bulan (Line Chart)
        $pemasukanBulanan = Pemasukan::select(
                DB::raw('MONTH(tanggal) as bulan'),
                DB::raw('SUM(jumlah) as total')
            )
            ->whereYear('tanggal', $tahunIni)
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        // ---- Pengeluaran per bulan (Line Chart)
        $pengeluaranBulanan = Pengeluaran::select(
                DB::raw('MONTH(tanggal) as bulan'),
                DB::raw('SUM(jumlah) as total')
            )
            ->whereYear('tanggal', $tahunIni)
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        // ---- Customer laundry per bulan (Bar Chart)
        // asumsi: 1 pemesanan = 1 customer datang
        $customerBulanan = Pemesanan::select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('created_at', $tahunIni)
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        // =====================
        // 3️⃣ RAPIN DATA (12 BULAN, BIAR GA BOLOK)
        // =====================
        $dataPemasukan = [];
        $dataPengeluaran = [];
        $dataCustomer = [];

        for ($i = 1; $i <= 12; $i++) {
            $dataPemasukan[]   = $pemasukanBulanan[$i] ?? 0;
            $dataPengeluaran[] = $pengeluaranBulanan[$i] ?? 0;
            $dataCustomer[]    = $customerBulanan[$i] ?? 0;
        }

        // =====================
        // 4️⃣ KIRIM KE VIEW
        // =====================
        return view('dashboard', compact(
            'jumlahCustomer',
            'jumlahKaryawan',
            'totalPemesanan',
            'totalPemasukan',
            'totalPengeluaran',
            'labaBersih',
            'bulan',
            'dataPemasukan',
            'dataPengeluaran',
            'dataCustomer'
        ));
    }
}
