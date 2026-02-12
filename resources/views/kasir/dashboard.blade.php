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
            @forelse ($antrianPesanan as $item)
            
            <tr>
                <td>{{ $loop->iteration }}</td>
            <td>{{ $item->customer->nama_lengkap ?? '-' }}</td>
            <td>{{ $item->jenis_layanan ?? '-' }}</td>
            <td>Rp {{ number_format($item->total_harga,0,',','.') }}</td>
                <td>
                    <span class="badge">
                        {{ ucfirst($item->status_proses ?? 'menunggu') }}
                    </span>
                </td>
                <td class="aksi">
                    <!-- NOTA DAN DETAIL -->
                     <div style="display:flex;gap:6px;">
                        @if(isset($item->id_pemesanan))
                            <a href="{{ route('kasir.pemesanan.show', $item->id_pemesanan) }}" 
                            class="icon-btn" title="Detail">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <a href="{{ route('pemesanan.nota', $item->id_pemesanan) }}" 
                            class="icon-btn" title="Nota" target="_blank">
                                <i class="fa-solid fa-book"></i>
                            </a>

                        @elseif(isset($item->id_reservasi))
                            <a href="{{ route('kasir.reservasi.show', $item->id_reservasi) }}" 
                            class="icon-btn" title="Detail">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <a href="{{ route('reservasi.nota', $item->id_reservasi) }}" 
                            class="icon-btn" title="Nota" target="_blank">
                                <i class="fa-solid fa-book"></i>
                            </a>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center; color:#64748b;">
                    Tidak ada antrian hari ini
                </td>
            </tr>
            @endforelse
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

.icon-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 8px;
    background: #f3f4f6;
    color: #374151;
    text-decoration: none;
    transition: 0.2s;
}

.icon-btn:hover {
    background: #e67800;
    color: white;
}

</style>
@endsection
