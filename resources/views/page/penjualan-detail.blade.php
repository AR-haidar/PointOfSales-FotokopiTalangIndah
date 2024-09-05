@extends('layouts.main')

@section('container')
    <div class="ms-1">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/penjualan') }}">Riwayat Penjualan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Penjualan</li>
            </ol>
        </nav>

        <h1 class="h3 mb-3 fw-bold">Detail Penjualan</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body bg-white ">
                    @foreach ($penjualan as $item)
                        <table class="fs-5">
                            <tr>
                                <td class="pe-4">Nomor Nota</td>
                                <td>: {{ $item->no_penjualan }}</td>
                            </tr>
                            <tr>
                                <td>Petugas</td>
                                <td>: {{ Str::title($item->name) }}</td>
                            </tr>
                            <tr>
                                <td>Waktu</td>
                                <td>: {{ $item->waktu }}</td>
                            </tr>
                        </table>
                    @endforeach
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped w-100" id="tpenjualan_detail">
                        <thead>
                            <tr class="table-primary  ">
                                <td>No</td>
                                <td>No Penjualan</td>
                                <td>Barang</td>
                                <td>Harga Awal</td>
                                <td>Harga Jual</td>
                                <td>Kuantitas</td>
                                <td>subtotal</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                                $totalQty = 0;
                                $total = 0;
                            @endphp
                            @foreach ($penjualanDetail as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->no_penjualan }}</td>
                                    <td>{{ $data->nama_barang }}</td>
                                    <td>Rp. {{ number_format($data->harga_awal) }}</td>
                                    <td>Rp. {{ number_format($data->harga_jual) }}</td>
                                    <td>{{ $data->qty }}</td>
                                    <td>Rp. {{ number_format($data->subtotal) }}</td>
                                </tr>
                                @php
                                    $totalQty += $data->qty;
                                    $total += $data->subtotal;
                                @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="fw-bold ">
                                <td colspan="5" class="text-end">Total</td>
                                <td>{{ $totalQty }}</td>
                                <td>Rp. {{ number_format($total) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
