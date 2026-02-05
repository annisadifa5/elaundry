@extends('layouts.dashboard')

@section('title', 'Reservasi Laundio')

@section('content')
<div class="page-title">Pemesanan Laundio</div>

<div class="card">
    <h4>Form Pemesanan Laundio</h4>

    <form method="POST" action="{{ route('pemesanan.store') }}">
        @csrf

        {{-- CUSTOMER --}}
        <div class="row">
            <input type="hidden" name="id_cust" value="{{ $customer->id_cust }}">
            <input type="hidden" name="id_outlet" value="1">

            <input type="text"
                name="nama"
                value="{{ $customer->nama }}"
                placeholder="Nama"
                readonly>

            <input type="text"
                name="no_telp"
                value="{{ $customer->no_telp }}"
                placeholder="No. Telp"
                readonly>
        </div>

        {{-- ALAMAT --}}
        <div class="row">
            <input type="text"
                name="alamat"
                value="{{ $customer->alamat }}"
                placeholder="Alamat"
                readonly>
        </div>

        {{-- LAYANAN --}}
        <div class="row">
            <select name="jenis_layanan" required>
                <option value="">Pilih Jenis Layanan</option>
                <option value="cuci">Cuci</option>
                <option value="setrika">Setrika</option>
                <option value="cuci_kering">Cuci Kering</option>
                <option value="cuci_setrika">Cuci Setrika</option>
                <option value="express">Express</option>
                <option value="sprei">Sprei</option>
                <option value="bed_cover">Bed Cover</option>
                <option value="boneka">Boneka</option>
                <option value="bantal">Bantal</option>
            </select>

            <select name="tipe_pemesanan" required>
                <option value="">Tipe Pemesanan</option>
                <option value="kiloan">Kiloan</option>
                <option value="satuan">Satuan</option>
            </select>

            <input type="number" name="berat_cucian" step="0.1" placeholder="Berat (Kg)">
        </div>

        {{-- JUMLAH --}}
        <div class="row">
            <input type="number" name="jumlah_item" placeholder="Jumlah Item">
        </div>

        {{-- CATATAN --}}
        <div class="row">
            <textarea name="catatan_khusus" placeholder="Catatan Khusus"></textarea>
        </div>

        <div class="row btn-row">
            <button class="btn">Pesan</button>
        </div>
    </form>
</div>
@endsection
