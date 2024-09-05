@extends('layouts.main')

@section('container')
    <div class="ms-1">

        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kasir</li>
            </ol>
        </nav>
        <h1 class="h3 mb-3 fw-bold">Kasir</h1>
    </div>

    <div class="row g-2">
        <div class="col-7">
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <table class="table table-bordered table-hover table-striped w-100" id="tpetugas">
                            <thead>
                                <tr class="table-borderless">
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
                                        <td>{{ $data->id_barang }}</td>
                                        <td>{{ $data->nama_barang }}</td>
                                        <td>{{ $data->harga_jual }}</td>
                                        <td>{{ $data->stok }}</td>
                                        <td>
                                            <form action="{{ url('toKeranjang/' . $data->id) }}" method="post">
                                                @csrf
                                                <button
                                                    class="btn btn-sm @if ($data->stok <= 0) {{ 'btn-outline-warning disabled' }} @else {{ 'btn-warning ' }} @endif">
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
                <form action="/resetKeranjang" method="post">
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
                                                <form class="d-flex" action="{{ url('/refreshKeranjang/' . $cart->id) }}"
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
                                                    {{-- <div class="w-100">
                                                    <div class="float-end fw-bold fs-4">
                                                        Rp. {{ number_format($cart->subtotal) }}
                                                    </div>
                                                </div> --}}

                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mt-2">
                                            <div class="">Rp. {{ number_format($cart->harga_jual) }}</div>

                                            <div class="d-flex">
                                                <button class="btn btn-sm btn-warning ps-1 pe-1">
                                                    <i class="align-middle" data-feather="refresh-ccw"></i>
                                                </button>
                                                </form>
                                                <form action="{{ url('/hapusKeranjang/' . $cart->id) }}" method="post">
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
                                    <form action="/bayar" method="POST" target="_blank">
                                        @csrf
                                        <input class="d-none" type="text" name="total" id="total"
                                            value="{{ $total }}">
                                </td>
                            </tr>
                            <tr class="fs-5">
                                <td class="w-50">Bayar</td>
                                <td class="float-end "><input type="number" id="bayar" name="bayar"
                                        class="form-control float-end w-75" placeholder="Bayar" oninput="hitungKembali()"
                                        autocomplete="off" required>
                                </td>
                            </tr>
                            <tr class="fs-5">
                                <td class="w-50">Kembali</td>
                                <td class="float-end ">
                                    <input type="text" id="kembali" name="kembali" class="form-control float-end w-75"
                                        placeholder="Kembali" autocomplete="off" value="0" readonly>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="border-top p-2">

                        <button type="submit" class="btn btn-primary float-end" onclick="refresh()">Bayar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function refresh() {
            setTimeout('location.reload(true);', 100);
        }
    </script>
@endsection
