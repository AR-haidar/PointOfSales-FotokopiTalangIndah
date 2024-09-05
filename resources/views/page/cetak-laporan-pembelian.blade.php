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

    {{-- <body> --}}
    <h2 style="text-align: center">LAPORAN<b><br />FOTOKOPI TALANG INDAH</b></h2>
    <hr />
    <h3 style="text-align: center">Periode {{ $Awal }} Sampai {{ $Akhir }}</h3>
    Laporan ini dicetak oleh : {{ Str::title(auth()->user()->name) }}
    <h4>Pengeluaran</h4>
    <table border="1" cellpadding="6" width="100%">
        <tr>
            <th>No.</th>
            <th>Barang</th>
            <th>Harga Awal</th>
            <th>Barang Masuk</th>
            <th>Pengeluaran</th>
        </tr>
        @php
            $no = 1;
            $no = 1;
            $totBarangMasuk = 0;
            $totPengeluaran = 0;
        @endphp
        @foreach ($pengeluaran as $item)
            <tr>
                <td align="">{{ $no++ }} </td>
                <td align="">{{ $item->nama_barang }}</td>
                <td align="">Rp. {{ number_format($item->harga_awal) }} </td>
                <td align="">{{ $item->barangMasuk }} </td>
                <td align="">Rp. {{ number_format($item->pengeluaran) }} </td>
            </tr>
            @php
                $totBarangMasuk += $item->barangMasuk;
                $totPengeluaran += $item->pengeluaran;
            @endphp
        @endforeach
        <tr>
            <td colspan="3" align="right"><b>Total</b></td>
            <td align=""><b> {{ $totBarangMasuk }}</b></td>
            <td align=""><b> Rp. {{ number_format($totPengeluaran) }}</b></td>
        </tr>
    </table>

    {{-- <h4>Pemasukan</h4>
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
    <hr>
    <h4>Stok Barang yang Menipis</h4>
    <table border="1" cellpadding="6" width="100%">
        <tr>
            <th>No.</th>
            <th>Barang</th>
            <th>Stok</th>
        </tr>
        @forelse ($stok as $item)
            <tr>
                <td align="">{{ $no++ }} </td>
                <td align="">{{ $item->nama_barang }}</td>
                <td align="">{{ $item->stok }} </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" style="padding: 15px">
                    <center>
                        Tidak ada barang yang stoknya menipis
                    </center>
                </td>
            </tr>
        @endforelse
    </table> --}}
</body>

</html>
