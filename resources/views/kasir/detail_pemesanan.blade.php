@extends('layouts.dashboard_kasir')

@section('content')
<div class="container">
    <h3>Detail Pemesanan</h3>

    <div class="card">
        <div class="card-body">

            <p><strong>No Order:</strong> {{ $data->no_order }}</p>

            <hr>

            <h4>Data Customer</h4>
            <p><strong>Nama:</strong> {{ $data->customer->nama_lengkap ?? '-' }}</p>
            <p><strong>No Telepon:</strong> {{ $data->customer->no_telp ?? '-' }}</p>
            <p><strong>Alamat:</strong> {{ $data->customer->alamat ?? '-' }}</p>

            <hr>

            <h4>Detail Pesanan</h4>
            <p><strong>Outlet:</strong> {{ $data->outlet->nama_outlet ?? '-' }}</p>
            <p><strong>Jenis Layanan:</strong> {{ $data->jenis_layanan }}</p>
            <p><strong>Berat Cucian:</strong> {{ $data->berat_cucian }} Kg</p>
            <p><strong>Jumlah Item:</strong> {{ $data->jumlah_item }}</p>
            <p><strong>Catatan:</strong> {{ $data->catatan_khusus ?? '-' }}</p>

            <hr>

            <h4>Status</h4>
            <p><strong>Status Proses:</strong> {{ ucfirst($data->status_proses) }}</p>
            <p><strong>Status Bayar:</strong> {{ ucfirst($data->status_bayar) }}</p>

            <hr>

            <h4>Pembayaran</h4>
            <p><strong>Total Harga:</strong> 
                Rp {{ number_format($data->total_harga,0,',','.') }}
            </p>

            <p><strong>Tanggal Masuk:</strong> 
                {{ \Carbon\Carbon::parse($data->tanggal_masuk)->format('d M Y H:i') }}
            </p>

            <br>

            <a href="{{ route('kasir.dashboard') }}" class="btn btn-secondary">
                Kembali
            </a>

        </div>
    </div>
</div>
@endsection
