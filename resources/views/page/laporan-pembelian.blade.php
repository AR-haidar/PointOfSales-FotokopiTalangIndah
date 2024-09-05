@extends('layouts.main')

@section('container')
    <h1 class="h3 mb-3 fw-bold  ">
        Laporan Pengeluaran</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title mb-0 ">Cari Data Pengeluaran</div>
                    <form action="{{ url('/laporan-pembelian/cari') }}" method="post">
                        <div class="mt-2 accordion d-flex">
                            @csrf
                            <table>
                                <tr>
                                    <td class="pe-3">Tanggal Awal</td>
                                    <td>
                                        @if (isset($sesAwal))
                                            <input class="form-control" type="date" name="tglawal" id="tglawal"
                                                value="{{ $sesAwal }}">
                                        @else
                                            <input class="form-control" type="date" name="tglawal" id="tglawal">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pe-3">Tanggal Akhir</td>

                                    <td>
                                        @if (isset($sesAkhir))
                                            <input class="form-control" type="date" name="tglakhir" id="tglakhir"
                                                value="{{ $sesAkhir }}">
                                        @else
                                            <input class="form-control" type="date" name="tglakhir" id="tglakhir">
                                        @endif
                                    </td>
                                </tr>
                            </table>
                            <div class="d-flex align-items-center ms-2">
                                <button type="submit" class="btn btn-primary me-2">Pilih</button>
                                <a href="/laporan-pembelian"
                                    class="btn btn-danger me-2 
                                    @if (!isset($sesAwal) || !isset($sesAkhir)) d-none @endif
                                    ">Batal
                                    Pilih</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a onclick="this.href='/cetak-laporan-pembelian/'+ document.getElementById('tglawal').value + '/' + document.getElementById('tglakhir').value"
                        class="btn btn-success 
                   @if (!isset($sesAwal) || !isset($sesAkhir)) disabled @endif
                   ">Cetak</a>

                    <h3 class="text-center fw-bold">Pengeluaran</h3>
                    <table class="table table-bordered table-hover table-striped w-100" id="tpembelian">
                        <thead>
                            <tr class="table-primary">
                                <td>No</td>
                                <td>Waktu</td>
                                <td>Barang</td>
                                <td>Harga Awal</td>
                                <td>Barang yang Masuk</td>
                                <td>Pengeluaran</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                                $totBarangMasuk = 0;
                                $totPengeluaran = 0;
                            @endphp
                            @foreach ($pengeluaran as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->waktu }}</td>
                                    <td>{{ $data->nama_barang }}</td>
                                    <td>Rp. {{ number_format($data->harga_awal) }}</td>
                                    <td>{{ $data->barangMasuk }}</td>
                                    <td>Rp. {{ number_format($data->pengeluaran) }}</td>
                                </tr>
                                @php
                                    $totBarangMasuk += $data->barangMasuk;
                                    $totPengeluaran += $data->pengeluaran;
                                @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-end fw-bold ">Total</td>
                                <td class="fw-bold">{{ $totBarangMasuk }}</td>
                                <td class="fw-bold ">Rp. {{ number_format($totPengeluaran) }}</td>
                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </div>


    </div>
@endsection
