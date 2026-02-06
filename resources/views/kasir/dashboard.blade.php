@extends('layouts.dashboard_kasir')

@section('title', 'Dashboard Kasir')

@section('content')
<h3 class="page-title">Dashboard Kasir</h3>

{{-- ================= RINGKASAN HARI INI ================= --}}
<div class="grid grid-4 mb-4">
    <div class="card">
        <small>Pesanan Hari Ini</small>
        <h2>12</h2>
    </div>

    <div class="card">
        <small>Total Transaksi Hari Ini</small>
        <h2>Rp 540.000</h2>
    </div>

    <div class="card">
        <small>Belum Dibayar</small>
        <h2>3</h2>
    </div>

    <div class="card">
        <small>Pesanan Selesai</small>
        <h2>7</h2>
    </div>
</div>

{{-- ================= QUICK ACTION ================= --}}
<div class="card mb-4">
    <h4>Quick Action</h4>
    <div style="display:flex;gap:10px;flex-wrap:wrap">
        <a href="#" class="btn">🧾 Cetak Nota</a>
        <a href="#" class="btn">🔄 Update Status</a>
        <a href="#" class="btn">🔍 Cari Pesanan</a>
    </div>
</div>

{{-- ================= ANTRIAN PESANAN ================= --}}
<div class="card">
    <h4>Antrian Pesanan</h4>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Layanan</th>
                <th>Total</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>1</td>
                <td>Annisa</td>
                <td>Sprei</td>
                <td>Rp 49.000</td>
                <td>
                    <span class="badge warning">Menunggu</span>
                </td>
                <td>
                    <button class="btn-sm">Bayar</button>
                    <button class="btn-sm">Ubah Status</button>
                    <a href="#" class="btn-sm">Nota</a>
                </td>
            </tr>

            <tr>
                <td>2</td>
                <td>Difa</td>
                <td>Cuci</td>
                <td>Rp 35.000</td>
                <td>
                    <span class="badge info">Diproses</span>
                </td>
                <td>
                    <button class="btn-sm">Detail</button>
                    <button class="btn-sm">Ubah Status</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
