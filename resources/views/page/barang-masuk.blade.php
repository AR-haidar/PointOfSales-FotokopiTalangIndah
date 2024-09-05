@extends('layouts.main')

@section('container')
    <div class="ms-1">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Barang Masuk</li>
            </ol>
        </nav>
        <h1 class="h3 fw-bold">Barang Masuk</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="d-flex align-items-center" action="{{ url('/session') }}" method="post">
                        @csrf
                        <table>
                            <tr>
                                <td>
                                    <h5 class="mt-1">Nomor Bon</h5>
                                </td>
                                <td class="d-flex">
                                    <input class="form-control ms-2 @error('nobon') is-invalid @enderror" type="text"
                                        placeholder="Isi No Bon" id="nobonA" name="nobon" oninput="autoFillnobonB()"
                                        required value="@if (isset($nobon)) {{ $nobon }} @endif">
                                    {{-- <button type="submit" class="btn btn-sm btn-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                            <path
                                                d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022" />
                                        </svg>
                                    </button> --}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5 class="mt-1">Supplier</h5>
                                </td>
                                <td class="d-flex ">
                                    <input class="form-control ms-2 @error('supplier') {{ 'is-invalid ' }} @enderror"
                                        type="text" placeholder="Isi Supplier" id="supplierA" name="supplier"
                                        oninput="autoFillsupplierB()"
                                        value="@if (isset($supplier)) {{ $supplier }} @endif">
                                    {{-- <button type="submit" class="btn btn-sm btn-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                            <path
                                                d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022" />
                                        </svg>
                                    </button> --}}
                                </td>
                            </tr>
                        </table>

                        <button type="submit" class="btn btn-success ms-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-check-lg" viewBox="0 0 16 16">
                                <path
                                    d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-2">
        <div class="col-7">
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <table class="table table-bordered table-hover table-striped w-100" id="tpetugas">
                            <thead>
                                <tr class="table-borderless">
                                    <td>No</td>
                                    <td>Kode Barang</td>
                                    <td>Nama Barang</td>
                                    <td>Harga</td>
                                    <td>Stok</td>
                                    <td data-searchable="false"></td>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($barang as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->id_barang }}</td>
                                        <td>{{ $data->nama_barang }}</td>
                                        <td>{{ number_format($data->harga_awal) }}</td>
                                        <td>{{ $data->stok }}</td>
                                        <td>
                                            <form action="{{ url('toKeranjang2/' . $data->id) }}" method="post">
                                                @csrf
                                                <button class="btn btn-sm btn-warning">
                                                    <i class="align-middle" data-feather="shopping-cart"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        {{-- Cart --}}
        <div class="col-5">
            <div class="card">
                <form action="/resetKeranjang2" method="post">
                    @csrf
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title mb-0">Keranjang</h5>
                        <button class="btn btn-sm btn-outline-danger" type="submit">Reset</button>
                    </div>
                </form>
                <div class="card-body pt-0">
                    <div class="row gy-2 mb-2">
                        @php
                            $total = 0;
                        @endphp
                        @forelse ($keranjang as $cart)
                            <div class="col-12">
                                <div class="pt-1 pb-0 ps-2 pe-2">
                                    <div class="">

                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <div class="fw-bold w-100 fs-4">{{ Str::title($cart->nama_barang) }}</div>
                                            <div class="w-100 d-flex justify-content-end">
                                                <form class="d-flex" action="{{ url('/refreshKeranjang2/' . $cart->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <button
                                                        class="btn btn-sm btn-outline-secondary fw-bold fs-5 me-1 ps-2 pe-2"
                                                        onclick="kurangKuantitas('quantity{{ $cart->id }}')"
                                                        type="button">
                                                        -
                                                    </button>

                                                    <input class="text-center border-0 pe-1 ps-1"
                                                        id="quantity{{ $cart->id }}" name="qty"
                                                        style="width: 35px; outline: none; margin: 0 -1px" type="text"
                                                        value="{{ $cart->qty }}" autocomplete="off">

                                                    <button
                                                        class="btn btn-sm btn-outline-secondary fw-bold fs-5 ms-1 ps-2 pe-2"
                                                        onclick="tambahKuantitas('quantity{{ $cart->id }}')"
                                                        type="button">
                                                        +
                                                    </button>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mt-2">
                                            <div class="">Rp. {{ number_format($cart->harga_awal) }}</div>

                                            <div class="d-flex">
                                                <button class="btn btn-sm btn-warning ps-1 pe-1">
                                                    <i class="align-middle" data-feather="refresh-ccw"></i>
                                                </button>
                                                </form>
                                                <form action="{{ url('/hapusKeranjang2/' . $cart->id) }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger ps-1 pe-1 ms-1">
                                                        <i class="align-middle" data-feather="trash-2"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <hr class="mb-2">
                            </div>
                            @php
                                $total += $cart->subtotal;
                            @endphp
                        @empty
                            <div class="w-100 border-top border-bottom p-4">
                                <h5 class="text-center text-secondary opacity-50">Keranjang Kosong</h5>
                            </div>
                        @endforelse
                    </div>
                    <div class="d-flex justify-content-between mb-3 ps-1 pe-1">
                        <table class="p-0 w-100">
                            <tr class="fw-bold fs-4">
                                <td class="w-25">Total</td>
                                <td class="float-end ">Rp. {{ number_format($total) }}
                                    <form action="/bayar2" method="POST">
                                        @csrf
                                        <input class="d-none" type="text" name="total" id="total"
                                            value="{{ $total }}">
                                </td>
                            </tr>
                            {{-- <tr class="fs-5">
                                <td class="w-50">Bayar</td>
                                <td class="float-end "><input type="number" id="bayar" name="bayar"
                                        class="form-control float-end w-75" placeholder="Bayar" oninput="hitungKembali()"
                                        autocomplete="off" required>
                                </td>
                            </tr>
                            <tr class="fs-5">
                                <td class="w-50">Kembali</td>
                                <td class="float-end ">
                                    <input type="text" id="kembali" name="kembali"
                                        class="form-control float-end w-75" placeholder="Kembali" autocomplete="off"
                                        value="0" readonly>
                                </td>
                            </tr> --}}
                            <tr class="fs-5 d-none">
                                <td class="w-50"> </td>
                                <td class="float-end ">
                                    <input type="text" id="nobonB" name="nobon"
                                        class="form-control float-end w-75" autocomplete="off" readonly
                                        value="@if (isset($nobon)) {{ $nobon }} @endif">
                                </td>
                            </tr>
                            <tr class="fs-5 d-none">
                                <td class="w-50"> </td>
                                <td class="float-end ">
                                    <input type="text" id="supplierB" name="supplier"
                                        class="form-control float-end w-75" autocomplete="off" readonly
                                        value="@if (isset($supplier)) {{ $supplier }} @endif">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="p-2">
                        <button type="submit" class="btn btn-primary float-end">Masukkan Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- </div> --}}
    @endsection
