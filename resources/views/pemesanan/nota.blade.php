<!DOCTYPE html>
<html>
<head>
    <title>Nota Laundry</title>
    <style>
        body {
            font-family: monospace;
        }

        #nota {
            width: 58mm;
            padding: 10px;
            border: 1px dashed #000;
        }
    </style>
</head>
<body>

<div id="nota">
    <center>
        <strong>LAUNDIO</strong><br>
        Nota Pemesanan
    </center>
    <hr>

    Nama: {{ $pemesanan->customer->nama }} <br>
    Layanan: {{ $pemesanan->jenis_layanan }} <br>
    Tipe: {{ $pemesanan->tipe_pemesanan }} <br>
    Berat: {{ $pemesanan->berat_cucian }} Kg <br>
    Jumlah: {{ $pemesanan->jumlah_item }} <br>

    <hr>
    <center>Terima Kasih 🙏</center>
</div>

{{-- SCRIPT PNG --}}
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
<script>
    html2canvas(document.querySelector("#nota")).then(canvas => {
        let link = document.createElement('a');
        link.download = 'nota-{{ $pemesanan->id_pemesanan }}.png';
        link.href = canvas.toDataURL();
        link.click();

        // optional auto print
        window.print();
    });
</script>

</body>
</html>
