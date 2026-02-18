@extends('layouts.dashboard_kasir')

@section('content')
<div class="container">
    <h3>Detail Reservasi</h3>

    <div class="card">
        <div class="card-body">

            <p><strong>No Reservasi:</strong> {{ $data->no_reservasi ?? '-' }}</p>

            <hr>

            <h4>Data Customer</h4>
            <p><strong>Nama:</strong> {{ $data->customer->nama_lengkap ?? '-' }}</p>
            <p><strong>No Telepon:</strong> {{ $data->customer->no_telp ?? '-' }}</p>
            <p><strong>Alamat Jemput:</strong> {{ $data->alamat_jemput ?? '-' }}</p>

            <hr>

            <h4>Detail Layanan</h4>
            <p><strong>Jenis Layanan:</strong> {{ $data->jenis_layanan ?? '-' }}</p>
            <p><strong>Jumlah Item:</strong> {{ $data->jumlah_item ?? 0 }}</p>
            <p><strong>Catatan Khusus:</strong> {{ $data->catatan_khusus ?? '-' }}</p>

            <hr>

            <h4>Jadwal Jemput</h4>
            <p><strong>Tanggal Jemput:</strong> 
                {{ \Carbon\Carbon::parse($data->tanggal_jemput)->format('d M Y') }}
            </p>
            <p><strong>Jam Jemput:</strong> {{ $data->jam_jemput }}</p>

            <hr>

            <h4>Pembayaran</h4>
            <p><strong>Total Harga:</strong> 
                Rp {{ number_format($data->total_harga ?? 0,0,',','.') }}
            </p>

            <hr>

            <h4>Status</h4>
            <p><strong>Status Proses:</strong> 
                {{ ucfirst($data->status_proses ?? 'menunggu') }}
            </p>
            <p><strong>Status Bayar:</strong> 
                {{ ucfirst($data->status_bayar ?? 'belum') }}
            </p>

            <br>

            <a href="{{ route('kasir.dashboard') }}" class="btn btn-secondary">
                Kembali
            </a>

        </div>
    </div>
</div>
@endsection
