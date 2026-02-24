@extends(
    auth()->user()->role === 'admin'
        ? 'layouts.dashboard'
        : 'layouts.dashboard_kasir'
)

@section('title', 'Data Pemesanan')

@section('content')

<h3 class="page-title">Data Pemesanan</h3>

<div class="btn-row">
    <a href="{{ route('pemesanan.create') }}" class="btn">
        + Tambah
    </a>   
</div>

{{-- FILTER TABS --}}
<div class="order-tabs">
    <a href="{{ route('pemesanan.index') }}"
       class="tab {{ !request('status') ? 'active' : '' }}">
        Semua Pesanan
    </a>

    <a href="{{ route('pemesanan.index', ['status' => 'proses']) }}"
       class="tab {{ request('status') == 'proses' ? 'active' : '' }}">
        Dalam Proses
    </a>

    <a href="{{ route('pemesanan.index', ['status' => 'selesai']) }}"
       class="tab {{ request('status') == 'selesai' ? 'active' : '' }}">
        Selesai
    </a>
</div>

<div class="card">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Order</th>
                <th>Nama</th>
                <th>No Telp</th>
                <th>Titik Lokasi</th>
                <th>Total Harga</th>
            </tr>
        </thead>

        <tbody>
            @forelse($pemesanans as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>

                    <td><strong>{{ $p->no_order }}</strong></td>

                    <td>{{ $p->customer->nama_lengkap ?? '-' }}</td>

                    <td>{{ $p->customer->no_telp ?? '-' }}</td>

                    <td>
                        @if($p->latitude && $p->longitude)
                            <a href="https://www.openstreetmap.org/?mlat={{ $p->latitude }}&mlon={{ $p->longitude }}"
                               target="_blank"
                               style="color:#16a39a; font-weight:600;">
                               Lihat Lokasi
                            </a>
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        Rp {{ number_format($p->total_harga,0,',','.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center; padding:20px;">
                        Tidak ada data
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection


@push('styles')
<style>

/* ===== ORDER TABS STYLE ===== */
.order-tabs {
    display: flex;
    gap: 25px;
    margin-bottom: 18px;
    border-bottom: 2px solid #e2e8f0;
    padding-bottom: 8px;
}

.order-tabs .tab {
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    color: #64748b;
    padding-bottom: 6px;
    position: relative;
}

.order-tabs .tab.active {
    color: #16a39a;
}

.order-tabs .tab.active::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -10px;
    width: 100%;
    height: 3px;
    background: #16a39a;
    border-radius: 3px;
}

/* Optional hover */
.order-tabs .tab:hover {
    color: #16a39a;
}

</style>
@endpush