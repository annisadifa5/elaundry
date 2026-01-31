@extends('layouts.dashboard')

@section('title', 'Lacak Pemesanan')

@section('content')
    <h3 class="page-title">Update Status Pemesanan Laundry</h3>

    <div class="card">
        {{-- FILTER --}}
        <form method="GET" action="{{ route('lacak.index') }}">
            <div class="row">
                <select name="status">
                    <option value="">Proses</option>
                    <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>
                        Diterima
                    </option>
                    <option value="dicuci" {{ request('status') == 'dicuci' ? 'selected' : '' }}>
                        Dicuci
                    </option>
                    <option value="dikeringkan" {{ request('status') == 'dikeringkan' ? 'selected' : '' }}>
                        Dikeringkan
                    </option>
                    <option value="disetrika" {{ request('status') == 'disetrika' ? 'selected' : '' }}>
                        Disetrika
                    </option>
                </select>

                <input type="date" name="from" value="{{ request('from') }}">
                <input type="date" name="to" value="{{ request('to') }}">


                <button class="btn" type="submit">Terapkan</button>
            </div>
        </form>

        {{-- TABLE --}}
        <div style="margin-top: 20px; overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>No. Order</th>
                        <th>Nama</th>
                        <th>Payment</th>
                        <th>Tipe</th>
                        <th>Jenis Layanan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($pemesanans as $p)
                <tr>
                    <td>{{ $p->no_order }}</td>
                    <td>{{ $p->customer->nama ?? '-' }}</td>
                    <td>-</td>
                    <td>{{ $p->tipe_pemesanan }}</td>
                    <td>{{ $p->jenis_layanan }}</td>
                    <td class="aksi">
                    <form method="POST" action="{{ route('lacak.next', $p->id_pemesanan) }}">
                        @csrf

                        @if ($p->status_proses === 'disetrika')
                            <button title="Selesaikan Pesanan" class="selesai">Selesai</button>
                        @else
                            <button title="Next Proses">Next</button>
                        @endif

                    </form>
                </td>

                </tr>
                @empty
                <tr>
                    <td colspan="6">Tidak ada data</td>
                </tr>
                @endforelse
                </tbody>

            </table>
        </div>
    </div>

    {{-- STYLE KHUSUS TABLE --}}
    <style>
        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .table thead {
            background: #16a39a;
            color: white;
        }

        .table th,
        .table td {
            padding: 10px 12px;
            text-align: left;
        }

        .table tbody tr {
            border-bottom: 1px solid #e2e8f0;
        }

        .table tbody tr:hover {
            background: #f1f9f9;
        }

        .aksi button {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin-right: 6px;
        }

        .aksi button:hover {
            opacity: 0.7;
        }

        .aksi button.selesai {
            color: #16a39a;
            font-weight: bold;
        }
    </style>
@endsection
