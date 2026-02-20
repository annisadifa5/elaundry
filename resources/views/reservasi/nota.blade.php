<!DOCTYPE html>
<html>
<head>
    <title>Nota Reservasi Laundry</title>

    <style>
        body{
            font-family: monospace;
            font-size:12px;
        }

        #nota{
            width:80mm;
            padding:8px;
        }

        .center{ text-align:center; }

        .line{
            border-top:1px dashed #000;
            margin:6px 0;
        }

        .row{
            display:flex;
            justify-content:space-between;
            margin:2px 0;
        }

        .small{ font-size:11px; }
        .bold{ font-weight:bold; }

        @media print {
            body{ margin:0; }
        }
    </style>
</head>

<body>

<div id="nota">

    <!-- HEADER -->
    <div class="center">
        <strong>{{ $reservasi->outlet->nama_outlet ?? 'LAUNDIO' }}</strong><br>

        {{ $reservasi->outlet->jalan ?? '' }}<br>
        {{ $reservasi->outlet->kelurahan ?? '' }},
        {{ $reservasi->outlet->kecamatan ?? '' }}<br>
        {{ $reservasi->outlet->kota_kab ?? '' }},
        {{ $reservasi->outlet->provinsi ?? '' }}
        {{ $reservasi->outlet->kode_pos ?? '' }}<br>

        Telp: {{ $reservasi->outlet->no_telp ?? '-' }}
    </div>

    <div class="line"></div>

    <!-- INFO RESERVASI -->
    <div class="small">
        Reservasi : RSV-{{ $reservasi->id_reservasi }}<br>
        Tanggal   : {{ $reservasi->tanggal_jemput }}<br>
        Jam       : {{ $reservasi->jam_jemput }}<br>
        Pelanggan : {{ $reservasi->customer->nama_lengkap ?? $reservasi->nama_lengkap }}<br>
        No. HP    : {{ $reservasi->customer->no_telp ?? $reservasi->no_telp ?? '-' }}<br>
        Alamat    : {{ $reservasi->alamat_jemput ?? '-' }}
    </div>

    <div class="line"></div>

    <!-- DETAIL LAYANAN -->
    <div class="center bold small">Detail Layanan</div>

    <div class="line"></div>

    @php
        use App\Models\Harga;

        $layananList = explode(',', $reservasi->jenis_layanan);
        $qty = $reservasi->jumlah_item ?? 1;
        $grandTotal = 0;
    @endphp

    @foreach($layananList as $kode)

        @php
            $harga = Harga::where('kode_layanan',$kode)->first();
            $nama  = $harga->nama_layanan ?? ucwords(str_replace('_',' ',$kode));
            $satuan = $harga->satuan ?? 'pcs';
            $hargaSatuan = $harga->harga ?? 0;

            $totalItem = $hargaSatuan * $qty;
            $grandTotal += $totalItem;
        @endphp

        <div class="row">
            <span>{{ $nama }}</span>
        </div>

        <div class="row small">
            <span>{{ $qty }} {{ $satuan }} × {{ number_format($hargaSatuan,0,',','.') }}</span>
            <span>Rp {{ number_format($totalItem,0,',','.') }}</span>
        </div>

    @endforeach

    @if(!empty($reservasi->jumlah_item))
    <div class="row small">
        <span>Jumlah Item</span>
        <span>{{ $reservasi->jumlah_item }} pcs</span>
    </div>
    @endif

    <div class="line"></div>

    <!-- SUBTOTAL -->
    <div class="row">
        <span>Subtotal</span>
        <span>Rp {{ number_format($grandTotal,0,',','.') }}</span>
    </div>

    <div class="line"></div>

    <!-- TOTAL -->
    <div class="row">
        <strong>Total</strong>
        <strong>Rp {{ number_format($grandTotal,0,',','.') }}</strong>
    </div>

    <div class="line"></div>

    <!-- STATUS -->
    <div class="small">
        Status : Menunggu Pickup
    </div>

    <div class="line"></div>

    <!-- FOOTER -->
    <div class="center small">
        Terima kasih telah mempercayakan cucian Anda 🙏 <br>
        Bersih Tak Kenal Waktu <br>
        Simpan nota ini<br><br>

        Jam Operasional : 08.00 - 21.00<br>
        WA : {{ $reservasi->outlet->no_telp ?? '-' }}
    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
<script>
html2canvas(document.querySelector("#nota")).then(canvas => {
    let link = document.createElement('a');
    link.download = 'nota-reservasi-{{ $reservasi->id_reservasi }}.png';
    link.href = canvas.toDataURL();
    link.click();

    window.print();
});
</script>

</body>
</html>
