<!DOCTYPE html>
<html>
<head>
    <title>Nota Laundry</title>

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
        <strong>LAUNDIO</strong><br>
        Jl. Contoh Alamat No.12<br>
        Semarang<br>
        0812-xxxx-xxxx
    </div>

    <div class="line"></div>

    <!-- INFO -->
    <div class="small">
        Order : {{ $pemesanan->no_order }}<br>
        Tanggal : {{ $pemesanan->tanggal_masuk }}<br>
        Pelanggan : {{ $pemesanan->customer->nama_lengkap }}
    </div>

    <div class="line"></div>

    <!-- ITEM -->
    <div class="row">
        <span>{{ $pemesanan->jenis_layanan }}</span>
        <span>Rp {{ number_format($pemesanan->total_harga,0,',','.') }}</span>
    </div>

    <div class="line"></div>

    <!-- TOTAL -->
    <div class="row">
        <strong>Total</strong>
        <strong>Rp {{ number_format($pemesanan->total_harga,0,',','.') }}</strong>
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
    link.download = 'nota-{{ $pemesanan->id_pemesanan }}.png';
    link.href = canvas.toDataURL();
    link.click();

    window.print();
});
</script>

</body>
</html>
