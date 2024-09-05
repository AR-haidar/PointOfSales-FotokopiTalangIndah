@extends('layouts.main')

@section('container')
    <h1 class="h3 mb-3 fw-bold  ">
        Laporan Pemasukan</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title mb-0 ">Cari Data Penjualan</div>
                    <form action="{{ url('/laporan-penjualan/cari') }}" method="post">
                        <div class="mt-2 accordion d-flex">
                            @csrf
                            <table>
                                {{-- <tr>
                                    <td class="pe-3">Bulan</td>
                                    <td>
                                        <select class="form-select" name="bulan" id="bulan" required>

                                            @php
                                                $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                                $jmlh_bulan = count($bulan);
                                                $bln = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
                                                $bulan_now = date('m');
                                            @endphp
                                            @if (isset($sesBulan))
                                                <option value="{{ $bln[$sesBulan - 1] }}" selected>
                                                    {{ $bulan[$sesBulan - 1] }}
                                                </option>
                                            @else
                                                <option disabled selected>Pilih Bulan</option>
                                            @endif
                                            @for ($i = 0; $i < $jmlh_bulan; $i++)
                                                <option
                                                    @if ($i == $bulan_now - 1) class="fw-bold bg-body-secondary " @endif
                                                    value="{{ $bln[$i] }}">{{ $bulan[$i] }}
                                                </option>
                                            @endfor
                                        </select>
                                    </td>

                                    <td class="ps-3 pe-3">Tahun</td>

                                    <td>
                                        <select class="form-select" name="tahun" id="tahun">
                                            @php
                                                $tahun = date('Y');
                                            @endphp
                                            @if (isset($sesTahun))
                                                <option value="{{ $sesTahun }}">{{ $sesTahun }}</option>
                                            @else
                                                <option disabled selected>Pilih Tahun</option>
                                            @endif
                                            @for ($i = 2020; $i <= $tahun; $i++)
                                                <option
                                                    @if ($i == $tahun) class="bg-body-secondary fw-bold" @endif
                                                    value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </td>
                                </tr> --}}
                                <tr>
                                    <td class="pe-3">Tanggal Awal</td>
                                    <td>
                                        @if (isset($sesAwal))
                                        <input class="form-control" type="date" name="tglawal" id="tglawal" value="{{ $sesAwal }}">
                                            
                                        @else
                                            
                                        <input class="form-control" type="date" name="tglawal" id="tglawal">
                                        @endif
                                    </td>
                                </tr><tr>
                                    <td class="pe-3">Tanggal Akhir</td>

                                    <td>
                                        @if (isset($sesAkhir))
                                            
                                        <input class="form-control" type="date" name="tglakhir" id="tglakhir" value="{{ $sesAkhir }}">
                                        @else
                                        <input class="form-control" type="date" name="tglakhir" id="tglakhir">
                                            
                                        @endif
                                    </td>
                                </tr>
                            </table>
                            <div class="d-flex align-items-center ms-2">
                                <button type="submit" class="btn btn-primary me-2">Pilih</button>
                                <a href="/laporan-penjualan"
                                    class="btn btn-danger me-2 
                                    @if (!isset($sesAwal) || !isset($sesAkhir)) d-none @endif
                                    ">Batal
                                    Pilih</a>
                            </div>
                            {{-- <form action="{{ url('/laporan/cari') }}" method="post">
                                @csrf
                            <table>
                                <tr>
                                    <td class="pe-3">Tanggal Awal</td>
                                    <td>
                                        <input class="form-control" type="date" name="tglawal" id="tglawal" oninput="autoFilldateA()">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pe-3">Tanggal Akhir</td>
                                    <td>
                                        <input class="form-control" type="date" name="tglakhir" id="tglakhir" oninput="autoFilldateB()">
                                    </td>
                                </tr>
                            </table>
                            <div class="d-flex align-items-center ms-1 mt-2 ">
                                <button type="submit" class="btn btn-primary me-2">Cari</button>
                                <a href="/laporan-penjualan" class="btn btn-warning me-2">Refresh</a>
                                <a onclick="this.href='/cetak-laporan-penjualan/'+ document.getElementById('tglawal').value + '/' + document.getElementById('tglakhir').value" target="_blank" class="btn btn-success">Cetak</a>
                            </div>
                        </form> --}}
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a onclick="this.href='/cetak-laporan-penjualan/'+ document.getElementById('tglawal').value + '/' + document.getElementById('tglakhir').value"
                         class="btn btn-success 
                        @if (!isset($sesAwal) || !isset($sesAkhir)) disabled @endif
                        ">Cetak</a>

                <h3 class="text-center fw-bold ">Pemasukan</h3>
                <table class="table table-bordered table-hover table-striped w-100" id="tpembelian">
                    <thead>
                        <tr class="table-primary">
                            <td>No</td>
                            <td>Waktu</td>
                            <td>Barang</td>
                            <td>Harga Jual</td>
                            <td>Barang yang Terjual</td>
                            <td>Pemasukan</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $noo = 1;
                            $totTerjual = 0;
                            $totPemasukan = 0;
                        @endphp
                        @foreach ($pemasukan as $data)
                            <tr>
                                <td>{{ $noo++ }}</td>
                                <td>{{ $data->waktu }}</td>
                                <td>{{ $data->nama_barang }}</td>
                                <td>Rp. {{ number_format($data->harga_jual) }}</td>
                                <td>{{ $data->barangTerjual }}</td>
                                <td>Rp. {{ number_format($data->pemasukan) }}</td>
                            </tr>
                            @php
                                $totTerjual += $data->barangTerjual;
                                $totPemasukan += $data->pemasukan;
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end fw-bold ">Total</td>
                            <td class="fw-bold">{{ $totTerjual }}</td>
                            <td class="fw-bold ">Rp. {{ number_format($totPemasukan) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

   
@endsection
