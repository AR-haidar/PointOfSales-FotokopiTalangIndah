@extends('layouts.main')

@section('container')
    <div class="ms-1">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active ">Riwayat Pembelian</li>
            </ol>
        </nav>
        <h1 class="h3 mb-3 fw-bold">Riwayat Pembelian</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped w-100" id="tpenjualan">
                        <thead>
                            <tr class="table-primary">
                                <td>No</td>
                                <td>No Pembelian</td>
                                <td>No Bon</td>
                                <td>Suppiler</td>
                                <td>Total</td>
                                <td>Waktu</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($pembelian as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->no_pembelian }}</td>
                                    <td>{{ $data->no_bon }}</td>
                                    <td>{{ $data->supplier }}</td>
                                    <td>Rp. {{ number_format($data->total) }}</td>
                                    <td>{{ $data->waktu }}</td>
                                    <td>
                                        <a href="{{ url('/pembelian/' . $data->no_pembelian) }}"
                                            class="btn btn-primary btn-sm">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
