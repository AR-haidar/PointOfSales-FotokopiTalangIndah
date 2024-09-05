<!DOCTYPE html>
<html>

<head>

    <title>Slip Pembayaran SPP</title>

    <link rel="shortcut icon" href="../../../../img/icon/smktip.png" type="image/x-icon">
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

    <style>
        body {
            font-family: monospace;
        }

        table {
            border-collapse: collapse;
        }

        .dashed {
            border: 2px dashed #000
        }
    </style>
</head>

<body onload="window.print();" onafterprint="window.location='{{ url('/kasir') }}'s">

{{-- <body> --}}
    <center>
        <h3>FOTOKOPI TALANG INDAH</h3>
        <p class="fs-6">Jln.Panembakan Utara No.75 RT 04 RW 06, Padasuka, CImahi Tengah, Cimahi</p>
    </center>
    {{-- <hr> --}}
    <table class="w-100 border-0 fs-5">
        @foreach ($head as $item)
            <tr>
                <td>Nomor Nota</td>
                <td align="right">{{ $item->no_penjualan }}</td>
            </tr>
            <tr>
                <td>Waktu</td>
                <td align="right">{{ $item->waktu }}</td>
            </tr>
            <tr>
                <td>Kasir</td>
                <td align="right">{{ Str::title($item->name) }}</td>
            </tr>
        @endforeach
    </table>
    <hr class="dashed">
    <table class="border-0 fs-5" border="" cellspacing="" cellpadding="3" width="100%">
        @foreach ($detail as $item)
            <tr>
                <td colspan="2">{{ $item->nama_barang }}</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>{{ $item->qty }} x Rp. {{ number_format($item->harga_jual) }}</td>
                <td>&nbsp;</td>
                <td align="right">Rp. {{ number_format($item->subtotal) }}</td>
            </tr>
        @endforeach
    </table>
    <hr class="dashed">
    <table class="w-100 fs-5">
        @foreach ($head as $item)
            <tr class="fw-bold ">
                <td align="left">Total </td>
                <td align="right">Rp. {{ number_format($item->total_pembelian) }} </td>
            <tr>
                <td align="left">Bayar </td>
                <td align="right">Rp. {{ number_format($item->pembayaran) }}</td>
            <tr>
                <td align="left">Kembali</td>
                <td align="right">Rp. {{ number_format($item->kembalian) }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
