@extends('layouts.dashboard_kasir')

@section('title', 'Dashboard Kasir')

@section('content')
<h3 class="page-title">Dashboard Kasir</h3>

{{-- ================= RINGKASAN HARI INI ================= --}}
<div class="stats-grid">
    <div class="stat-card">
        <p>Pesanan Hari Ini</p>
        <h2>{{ $totalPesanan }}</h2>
    </div>

    <div class="stat-card">
        <p>Total Transaksi Hari Ini</p>
        <h2>Rp {{ number_format($totalTransaksi,0,',','.') }}</h2>
    </div>

    <div class="stat-card">
        <p>Belum Dibayar</p>
        <h2>{{ $belumDibayar }}</h2>
    </div>

    <div class="stat-card">
        <p>Pesanan Selesai</p>
        <h2>{{ $pesananSelesai }}</h2>
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
            @foreach ($antrianPesanan as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->customer->nama_lengkap }}</td>
                <td>{{ $item->layanan }}</td>
                <td>Rp {{ number_format($item->total,0,',','.') }}</td>
                <td>
                    <span class="badge {{ $item->status == 'selesai' ? 'selesai' : '' }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
                <td class="aksi">
                    <a href="{{ route('lacak.show', $item->id) }}" class="icon-btn">Detail</a>
                    <a href="{{ route('nota.cetak', $item->id) }}" class="icon-btn">Nota</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<style>
    .stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 30px;
}

.stat-card {
    background: #f9fdff;
    border: 1px solid #dbeafe;
    border-radius: 12px;
    padding: 20px;
}

.stat-card p {
    font-size: 13px;
    color: #64748b;
    margin-bottom: 6px;
}

.stat-card h2 {
    margin: 0;
    color: #0b2c4d;
    font-size: 22px;
    font-weight: 700;
}
</style>
@endsection
