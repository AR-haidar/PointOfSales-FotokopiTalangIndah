<!DOCTYPE html>
<html>

<head>

    <title>Laporan Pembayaran</title>

    <link rel="shortcut icon" href="../../../../img/icon/smktip.png" type="image/x-icon">

    <style>
        body {
            font-family: arial;
        }

        table {
            border-collapse: collapse;
        }
    </style>
</head>

<body onafterprint="window.location='{{ '/laporan-penjualan' }}'" onload="window.print();">

    <h2 style="text-align: center">LAPORAN PEMASUKAN<b><br />FOTOKOPI TALANG INDAH</b></h2>
    <hr />
    @php
        $bln = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    @endphp
    {{-- <h3 style="text-align: center">Periode Bulan {{ $bln[$bulan - 1] . ' ' . $tahun }}</h3> --}}
    <h3 style="text-align: center">Periode {{ $Awal }} Sampai {{ $Akhir }}</h3>
    Laporan ini dicetak oleh : {{ Str::title(auth()->user()->name) }}



    <h4>Pemasukan</h4>
    <table border="1" cellpadding="6" width="100%">
        <tr>
            <th>No.</th>
            <th>Barang</th>
            <th>Harga Awal</th>
            <th>Harga Jual</th>
            <th>Barang Terjual</th>
            <th>Pemasukan</th>
        </tr>
        @php
            $no = 1;
            $totBarangTerjual = 0;
            $totPemasukan = 0;
            $hargaawal = 0;
            $hargajual = 0;
        @endphp
        @foreach ($pemasukan as $item)
            <tr>
                <td align="">{{ $no++ }} </td>
                <td align="">{{ $item->nama_barang }}</td>
                <td align="">Rp. {{ number_format($item->harga_awal) }} </td>
                <td align="">Rp. {{ number_format($item->harga_jual) }} </td>
                <td align="">{{ $item->barangTerjual }} </td>
                <td align="">Rp. {{ number_format($item->pemasukan) }} </td>
            </tr>
            @php
                $totBarangTerjual += $item->barangTerjual;
                $totPemasukan += $item->pemasukan;

                $hargaawal += $item->harga_awal * $item->barangTerjual;
                $hargajual += $item->harga_jual * $item->barangTerjual;
            @endphp
        @endforeach
        <tr>
            <td colspan="4" align="right"><b>Total</b></td>
            <td align=""><b> {{ $totBarangTerjual }}</b></td>
            <td align=""><b> Rp. {{ number_format($totPemasukan) }}</b></td>
        </tr>
    </table>

    <h4>Keuntungan Penjualan = Rp. {{ number_format($hargajual - $hargaawal) }}</h4>

</body>

</html>