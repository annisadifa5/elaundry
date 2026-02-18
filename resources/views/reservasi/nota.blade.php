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
            width:58mm;
            padding:6px;
        }

        .center{
            text-align:center;
        }

        .line{
            border-top:1px dashed #000;
            margin:6px 0;
        }

        .row{
            display:flex;
            justify-content:space-between;
        }

        .small{
            font-size:11px;
        }

        @media print {
            body{
                margin:0;
            }
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

        {{ $reservasi->outlet->no_telp ?? '' }}
    </div>


    <div class="line"></div>

    <!-- INFO -->
    <div class="small">
        Reservasi : RSV-{{ $reservasi->id_reservasi }}<br>
        Tanggal   : {{ $reservasi->tanggal_jemput }}<br>
        Jam       : {{ $reservasi->jam_jemput }}<br>
        Pelanggan : {{ $reservasi->customer->nama_lengkap }}
    </div>

    <div class="line"></div>

    <!-- ITEM -->
    <div class="row">
        <span>{{ $reservasi->jenis_layanan }}</span>
        <span>Rp {{ number_format($reservasi->total_harga,0,',','.') }}</span>
    </div>

    @if($reservasi->jumlah_item)
    <div class="small">
        Qty : {{ $reservasi->jumlah_item }} pcs
    </div>
    @endif

    <div class="line"></div>

    <!-- TOTAL -->
    <div class="row">
        <strong>Total</strong>
        <strong>Rp {{ number_format($reservasi->total_harga,0,',','.') }}</strong>
    </div>

    <div class="line"></div>

    <!-- FOOTER -->
    <div class="center small">
        Terima kasih 🙏<br>
        Simpan nota ini
    </div>

</div>


<!-- AUTO DOWNLOAD PNG -->
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
