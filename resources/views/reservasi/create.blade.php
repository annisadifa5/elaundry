@extends('layouts.dashboard')

@section('title', 'Reservasi Laundio')

@section('content')
    <div class="page-title">Reservasi Laundio</div>

    <div class="card">
        <h4>Form Reservasi Laundio</h4>

        <form action="{{ route('reservasi.store') }}" method="POST">
    @csrf

    <div class="row">
        <input type="text" name="nama" placeholder="Nama" required>
        <input type="text" name="no_telp" placeholder="No. Telp" required>
    </div>

    <div class="row">
        <input type="text" name="alamat_jemput" placeholder="Alamat Jemput" required>
    </div>

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

        <input type="date" name="tanggal_pickup" required>
        <input type="time" name="jam_pickup" required>
    </div>

    <div class="row">
        <textarea name="catatan" placeholder="Catatan Khusus"></textarea>
    </div>

    <div class="row btn-row">
        <button type="submit" class="btn">Pickup Now</button>
    </div>
</form>

    </div>
@endsection
