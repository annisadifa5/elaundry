@extends('layouts.dashboard')

@section('title', 'Reservasi Laundio')

@section('content')
<div class="page-title">Reservasi Laundio</div>

<div class="card">
    <h4>Form Reservasi Laundio</h4>

    <form action="{{ route('reservasi.store') }}" method="POST">
        @csrf

        {{-- NAMA & TELP --}}
        <div class="row">
            <input type="text" name="nama" placeholder="Nama" required>
            <input type="text" name="no_telp" placeholder="No. Telp" required>
        </div>

        {{-- ALAMAT --}}
        <div class="row">
            <textarea name="alamat_jemput" placeholder="Alamat Jemput" required></textarea>
        </div>

        {{-- JENIS LAYANAN --}}
        <div class="form-group">
            <div style="display:flex;flex-wrap:wrap;gap:8px;align-items:center;">
                <select id="layanan-select" style="min-width:200px;">
                    <option value="">Jenis Layanan</option>
                    <option value="cuci">Cuci</option>
                    <option value="setrika">Setrika</option>
                    <option value="cuci_kering">Cuci Kering</option>
                    <option value="cuci_setrika">Cuci + Setrika</option>
                    <option value="express">Express</option>
                    <option value="sprei">Sprei</option>
                    <option value="bed_cover">Bed Cover</option>
                    <option value="boneka">Boneka</option>
                    <option value="bantal">Bantal</option>
                </select>

                <div id="layanan-chip-wrapper"
                     style="display:flex;gap:6px;flex-wrap:wrap;"></div>
            </div>

            {{-- hidden untuk controller --}}
            <input type="hidden" name="jenis_layanan" id="jenis_layanan_input">
        </div>

        {{-- TIPE PEMESANAN --}}
        {{-- <div class="form-group">
            <div style="display:flex;flex-wrap:wrap;gap:8px;align-items:center;">
                <select id="tipe-select" style="min-width:200px;">
                    <option value="">Tipe Pemesanan</option>
                    <option value="kiloan">Kiloan</option>
                    <option value="satuan">Satuan</option>
                </select>

                <div id="tipe-chip-wrapper"
                    style="display:flex;gap:6px;flex-wrap:wrap;"></div>
            </div>

            <input type="hidden" name="tipe_pemesanan" id="tipe_pemesanan_input">
        </div> --}}

        {{-- TANGGAL & JAM --}}
        <div class="row" style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
            <input type="date" name="tanggal_jemput" required>
            <input type="time" name="jam_jemput" required>
        </div>


        {{-- JUMLAH ITEM --}}
        <div class="row">
            <input type="number" name="jumlah_item" placeholder="Kuantitas">
        </div>

        <div class="row">
            <strong>Total Harga:</strong>
            <span id="total-harga">Rp 0</span>
        </div>

        <input type="hidden" name="total_harga" id="total_harga_input">


        {{-- CATATAN --}}
        <div class="row">
            <textarea name="catatan_khusus" placeholder="Catatan Khusus"></textarea>
        </div>

        <div class="row btn-row">
            <button type="submit" class="btn">Pickup Now</button>
        </div>
    </form>
</div>

<script>
const select = document.getElementById('layanan-select');
const chipWrapper = document.getElementById('layanan-chip-wrapper');
const hiddenInput = document.getElementById('jenis_layanan_input');

let layananDipilih = [];

select.addEventListener('change', function () {
    const value = this.value;
    const text = this.options[this.selectedIndex].text;

    if (!value || layananDipilih.includes(value)) {
        this.value = '';
        return;
    }

    layananDipilih.push(value);
    hiddenInput.value = layananDipilih.join(',');

    const chip = document.createElement('div');
    chip.className = 'chip';
    chip.innerHTML = `${text} <span onclick="removeLayanan('${value}', this)">×</span>`;
    chipWrapper.appendChild(chip);

    this.value = '';
});

function removeLayanan(value, el) {
    layananDipilih = layananDipilih.filter(v => v !== value);
    hiddenInput.value = layananDipilih.join(',');
    el.parentElement.remove();
}
</script>

<script>
const hargaList = @json($hargaList);
</script>

<script>
    function hitungTotal() {
        let total = 0;
        const jumlah = parseInt(document.querySelector('[name="jumlah_item"]')?.value || 0);

        layananDipilih.forEach(kode => {
            const data = hargaList[kode];
            if (!data) return;

            // reservasi hanya satuan (pcs)
            if (data.satuan === 'pcs') {
                total += data.harga * jumlah;
            }
        });

        document.getElementById('total-harga').innerText =
            'Rp ' + total.toLocaleString('id-ID');

        document.getElementById('total_harga_input').value = total;
    }

    document.addEventListener('change', hitungTotal);
    document.addEventListener('keyup', hitungTotal);
</script>

{{-- Alert Tidak bisa hitung harga satuan KG --}}
<script>
    function cekLayananKg() {
        let adaKg = false;

        layananDipilih.forEach(kode => {
            const data = hargaList[kode];
            if (data && data.satuan === 'kg') {
                adaKg = true;
            }
        });

        if (adaKg) {
            alert('⚠️ Reservasi belum mendukung layanan kiloan (kg).\nSilakan lakukan pemesanan langsung.');
        }
    }

    // panggil saat pilih / hapus layanan
    select.addEventListener('change', cekLayananKg);
</script>


@endsection
