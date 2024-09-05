@extends('layouts.main')

@section('container')
    <div class="ms-1">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Home</li>
            </ol>
        </nav>
        <h1 class="h3 mb-3 fw-bold">Dashboard</h1>
    </div>

    <div class="row">
        <div class="col-12 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Pendapatan Bulan Ini</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-success bg-success bg-opacity-25">
                                            <i class="align-middle" data-feather="dollar-sign"></i>
                                        </div>
                                    </div>
                                </div>
                                {{-- @php
                                    $omset = 0;
                                    $barangTerjual = 0;
                                @endphp
                                @foreach ($pendapatan as $item)
                                    @php
                                        $omset += $item->pemasukan;
                                        $barangTerjual += $item->barangTerjual;
                                    @endphp
                                @endforeach --}}
                                <h1 class="mt-1 mb-3">Rp. {{ number_format($pendapatan1) }}</h1>
                                <div class="mb-0">
                                    <span class="text-muted">Keuntungan</span>
                                    <span class="text-success fw-bold"> <i class="mdi mdi-arrow-bottom-right"></i>  Rp. {{ number_format($laba1) }} </span>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Barang</h5>
                                    </div>

                                    <div class="col-auto">
                                        <a href="{{ url('/barang') }}" class="stat text-primary bg-primary bg-opacity-25">
                                            <i class="align-middle" data-feather="box"></i>
                                        </a>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{ DB::table('barang')->count() }}</h1>
                                <div class="mb-0">
                                    {{-- <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.25% </span> --}}
                                    <span class="text-muted">Jumlah Barang</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Pendapatan Seluruhnya</h5>
                                    </div>

                                    <div class="col-auto">
                                        <a href="{{ url('/laporan-penjualan') }}" class="stat text-warning bg-warning bg-opacity-25">
                                            <i class="align-middle" data-feather="dollar-sign"></i>
                                        </a>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">Rp. {{ number_format($pendapatan) }}</h1>
                                <div class="mb-0">
                                    <span class="text-muted">Keuntungan</span>
                                    <span class="text-success fw-bold"> <i class="mdi mdi-arrow-bottom-right"></i>Rp. {{ number_format($laba) }} </span>
                                </div>
                            </div>
                        </div>

                        <div class="card @if (auth()->user()->role != 'Admin') d-none @endif">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Petugas</h5>
                                    </div>

                                    <div class="col-auto">
                                        <a href="{{ url('/petugas') }}" class="stat text-danger bg-danger bg-opacity-25">
                                            <i class="align-middle" data-feather="users"></i>
                                        </a>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{ DB::table('users')->count() }}</h1>
                                <div class="mb-0">
                                    {{-- <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.25% </span> --}}
                                    <span class="text-muted">Total Petugas</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card flex-fill w-100">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Pemasukan</h5>
                    <div class="d-flex">
                        <select class="form-select w-100" name="tahun" id="year">
                            @php
                                $tahunNow = date('Y');
                            @endphp
                            @if (isset($tahun))
                                <option value="{{ $tahun }}">{{ $tahun }}</option>
                            @else
                                <option value="{{ $tahunNow }}" selected>{{ $tahunNow }}</option>
                            @endif
                            @for ($i = 2020; $i <= $tahunNow; $i++)
                                <option @if ($i == $tahunNow) class="bg-body-secondary fw-bold" @endif
                                    value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <a onclick="this.href='/dashboard/'+ document.getElementById('year').value"
                            class="btn btn-sm btn-primary d-flex align-items-center">Pilih</a>
                    </div>
                </div>

                <div class="card-body py-3">
                    <div class="chart chart-sm">
                        <canvas id="grafik-penjualan"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-12">
            <div class="card flex-fill w-100">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Pemasukan</h5>
                    <div class="d-flex">
                        <select class="form-select w-100" name="tahun" id="year">
                            @php
                                $tahunNow = date('Y');
                            @endphp
                            @if (isset($tahun))
                                <option value="{{ $tahun }}">{{ $tahun }}</option>
                            @else
                                <option value="{{ $tahunNow }}" selected>{{ $tahunNow }}</option>
                            @endif
                            @for ($i = 2020; $i <= $tahunNow; $i++)
                                <option @if ($i == $tahunNow) class="bg-body-secondary fw-bold" @endif
                                    value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <a onclick="this.href='/dashboard/'+ document.getElementById('year').value"
                            class="btn btn-sm btn-primary d-flex align-items-center">Pilih</a>
                    </div>
                </div>
                <div class="card-body py-3">
                    <div class="chart chart-sm">
                        <canvas id="grafik-penjualan"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    {{-- GRAFIK --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById("grafik-penjualan").getContext("2d");
            var gradient = ctx.createLinearGradient(0, 0, 0, 225);
            gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
            gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
            // Line chart
            new Chart(document.getElementById("grafik-penjualan"), {
                type: "line",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Juni", "Juli", "Agu",
                        "Sep", "Okt", "Nov", "Des"
                    ],
                    datasets: [{
                        label: "Pemasukan (Rp)",
                        fill: true,
                        backgroundColor: gradient,
                        borderColor: window.theme.primary,
                        data: [

                            @foreach ($data as $item)
                                {{ $item->total_pembelian }},
                            @endforeach

                        ]
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    tooltips: {
                        intersect: false
                    },
                    hover: {
                        intersect: true
                    },
                    plugins: {
                        filler: {
                            propagate: false
                        }
                    },
                    scales: {
                        xAxes: [{
                            reverse: true,
                            gridLines: {
                                color: "rgba(0,0,0,0.1)"
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                stepSize: {{ $dataMax / 4 }}
                            },
                            display: true,
                            borderDash: [3, 3],
                            gridLines: {
                                color: "rgba(0,0,0,0.1)"
                            }
                        }]
                    }
                }
            });
        });
    </script>
@endsection
