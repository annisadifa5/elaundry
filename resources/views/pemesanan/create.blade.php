@extends('layouts.dashboard')

@section('title', 'Reservasi Laundio')

@section('content')
<div class="page-title">Pemesanan Laundio</div>

<div class="card">
    <h4>Form Pemesanan Laundio</h4>

    @if ($errors->any())
        <div style="color:red; margin-bottom:10px">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="form-pemesanan" method="POST" action="{{ route('pemesanan.store') }}">
        @csrf

        {{-- CUSTOMER --}}
        <div class="row">
            <input type="hidden" name="id_outlet" value="2">

            <input type="text" name="nama_lengkap" placeholder="Nama Customer" required>
            <input type="text" name="no_telp" placeholder="No Telepon" required>
        </div>

        {{-- ALAMAT --}}
        <div class="row">
            <textarea name="alamat" placeholder="Alamat" required></textarea>
        </div>

        {{-- JENIS LAYANAN --}}
        <div class="form-group">
            <div style="display:flex;flex-wrap:wrap;gap:8px;align-items:center;">

                {{-- DROPDOWN --}}
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

                {{-- CHIP RESULT --}}
                <div id="layanan-chip-wrapper" style="display:flex;gap:6px;flex-wrap:wrap;"></div>

                <input type="hidden" name="jenis_layanan" id="jenis_layanan_input">
            </div>
        </div>

        {{-- TIPE + BERAT + JUMLAH --}}
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


           <div class="row" style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                <input type="number" id="berat_cucian" name="berat_cucian" step="0.1" placeholder="Berat Cucian (Kg)">
                <input type="number" id="jumlah_item" name="jumlah_item" placeholder="Kuantitas">
            </div>

            <div class="row">
                <strong>Total Harga: </strong>
                <span id="total_harga">Rp 0</span>
            </div>

            <input type="hidden" name="total_harga" id="total_harga_input">


            {{-- CATATAN --}}
            <div class="row">
                <textarea name="catatan_khusus" placeholder="Catatan Khusus"></textarea>
            </div>

            <div class="row btn-row">
                <button class="btn">Pesan</button>
            </div>
    </form>
</div>

<div id="successModal" class="modal-overlay" style="display:none">
    <div class="modal-box">
        <div class="check-icon">✔</div>
        <h3>Berhasil 🎉</h3>
        <p>Pemesanan berhasil dibuat</p>

        <div style="display:flex;gap:10px;justify-content:center;margin-top:20px">
            <button onclick="closeModal()" class="btn-secondary">Tutup</button>
            <a id="btnNota" class="btn-primary" target="_blank">Unduh Nota</a>
        </div>
    </div>
</div>

<script>
    const hargaList = @json($hargaList);
</script>
{{-- chip jenis layanan --}}
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
        chip.innerHTML = `${text} <span onclick="hapusLayanan('${value}', this)">×</span>`;
        chipWrapper.appendChild(chip);

        this.value = '';
        estimasiHarga();
    });

    function hapusLayanan(value, el) {
        layananDipilih = layananDipilih.filter(v => v !== value);
        hiddenInput.value = layananDipilih.join(',');
        el.parentElement.remove();
        estimasiHarga();
    }
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        document.getElementById('berat_cucian')
            .addEventListener('input', estimasiHarga);

        document.getElementById('jumlah_item')
            .addEventListener('input', estimasiHarga);
    });
</script>


{{-- harga --}}
<script>
    function estimasiHarga() {
        console.log('ESTIMASI DIKLIK');

        const formData = new FormData();
        formData.append('jenis_layanan', document.getElementById('jenis_layanan_input').value);
        formData.append('berat_cucian', document.getElementById('berat_cucian').value || 0);
        formData.append('jumlah_item', document.getElementById('jumlah_item').value || 0);
        formData.append('_token', '{{ csrf_token() }}');

        fetch('/pemesanan/estimasi', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: new URLSearchParams({
                jenis_layanan: document.getElementById('jenis_layanan_input').value,
                berat_cucian: document.getElementById('berat_cucian').value || 0,
                jumlah_item: document.getElementById('jumlah_item').value || 0
            })
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById('total_harga').innerText = data.formatted;
            document.getElementById('total_harga_input').value = data.total;
        });
    }
</script>
<!-- nota -->
<script>
document.getElementById('form-pemesanan').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = this;
    const formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    })
    .then(res => res.json())
    .then(res => {
        if (res.success) {
            document.getElementById('successModal').style.display = 'flex';

            // arahkan tombol nota
            document.getElementById('btnNota')
                .href = `/pemesanan/${res.id}/nota`;
        }
    })
    .catch(err => {
        alert('Terjadi kesalahan');
    });
});

function closeModal() {
    document.getElementById('successModal').style.display = 'none';
}
</script>

<style>
.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.4);
    display:flex;
    align-items:center;
    justify-content:center;
    z-index:9999;
}
.modal-box {
    background: #fff;
    padding: 32px;
    border-radius: 16px;
    width: 100%;
    max-width: 480px;   /* desktop */
    min-height: 260px;
    text-align: center;
}
.check-icon {
    font-size:48px;
    color:#22c55e;
}
.btn-primary {
    background:#22c55e;
    color:white;
    padding:10px 16px;
    border-radius:8px;
    text-decoration:none;
}
.btn-secondary {
    background:#e5e7eb;
    padding:10px 16px;
    border-radius:8px;
}
</style>

@endsection
