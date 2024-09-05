@extends('layouts.main')

@section('container')
    <div class="ms-1">

        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Barang</li>
            </ol>
        </nav>
        <h1 class="h3 mb-3 fw-bold">Barang</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">

                    <!-- Button Modal Insert -->
                    <div class="d-flex justify-content-between mb-2 @if (auth()->user()->role != 'Admin') d-none @endif">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                            Tambah Data
                        </button>

                    </div>
                    <!-- Modal Insert -->
                    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-primary" data-bs-theme="dark">
                                    <h5 class="modal-title text-light fw-bold " id="exampleModalLabel">Tambah Data Barang
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/barang/insert" method="POST">
                                        @csrf
                                        <table class="table">
                                            <tr>
                                                <td>
                                                    <h6>Kode Barang</h6>
                                                <td><Input class="form-control @error('id_barang') is-invalid @enderror"
                                                        name="id_barang" type="text" required
                                                        placeholder="Masukkan ID Barang" autofocus
                                                        value="{{ old('id_barang') }}" autocomplete="off" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6>Nama Barang</h6>
                                                <td>
                                                    <Input class="form-control @error('nama_barang') is-invalid @enderror"
                                                        name="nama_barang" type="text" required
                                                        placeholder="Masukkan Nama Barang"
                                                        value="{{ old('nama_barang') }}" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6>Harga Awal</h6>
                                                <td>
                                                    <Input class="form-control @error('harga_awal') is-invalid @enderror"
                                                        name="harga_awal" type="number" required
                                                        placeholder="Masukkan Harga Awal" value="{{ old('harga_awal') }}" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6>Harga Jual</h6>
                                                <td>
                                                    <Input class="form-control @error('harga_jual') is-invalid @enderror"
                                                        name="harga_jual" type="number" required
                                                        placeholder="Masukkan Harga Jual" value="{{ old('harga_jual') }}" />
                                                </td>
                                            </tr>
                                        </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover w-100" id="tbarang">
                        <thead>
                            <tr class="table-primary">
                                <td data-searchable="false">No</td>
                                <td>Kode Barang</td>
                                <td>Nama Barang</td>
                                <td>Harga Awal</td>
                                <td>Harga Jual</td>
                                <td>Stok</td>
                                <td data-searchable="false" class="@if (auth()->user()->role != 'Admin') d-none @endif">Aksi
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($barang as $data)
                                <tr class="@if ($data->stok <= 20) fw-bold table-danger @endif">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->id_barang }}</td>
                                    <td>{{ $data->nama_barang }}</td>
                                    <td>{{ $data->harga_awal }}</td>
                                    <td>{{ $data->harga_jual }}</td>
                                    <td class="@if ($data->stok <= 20) fw-bold text-danger @endif">
                                        {{ $data->stok }}</td>
                                    <th
                                        class="d-flex justify-content-center @if (auth()->user()->role != 'Admin') d-none @endif">
                                        {{-- <div class="">
                                            <a class="btn btn-primary btn-sm " href="#">Restok</a>
                                        </div>
                                        <div class="">
                                            <a class="btn btn-success btn-sm " href="#">Detail</a>
                                        </div> --}}

                                        <!-- Button Modal Edit -->
                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-warning btn-sm me-2"
                                                data-bs-toggle="modal" data-bs-target="#edit{{ $data->id }}">
                                                Edit
                                            </button>
                                        </div>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="edit{{ $data->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary" data-bs-theme="dark">
                                                        <h5 class="modal-title text-light fw-bold " id="exampleModalLabel">
                                                            Ubah Data Barang
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="/barang/{{ $data->id }}}" method="POST">
                                                            @csrf
                                                            <Input type="hidden" name="id"
                                                                value="{{ $data->id }}" />
                                                            <table class="table">
                                                                <tr>
                                                                    <td>
                                                                        <h6>Kode Barang</h6>
                                                                    <td><Input class="form-control disabled"
                                                                            name="id_barang" type="text" required
                                                                            placeholder="Masukkan ID Barang"
                                                                            value="{{ $data->id_barang }}" readonly />
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <h6>Nama Barang</h6>
                                                                    <td>
                                                                        <Input class="form-control" name="nama_barang"
                                                                            type="text" required
                                                                            placeholder="Masukkan Nama Barang"
                                                                            value="{{ $data->nama_barang }}" />
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <h6>Harga Awal</h6>
                                                                    <td>
                                                                        <Input class="form-control" name="harga_awal"
                                                                            type="number" required id="a"
                                                                            placeholder="Masukkan Harga Awal"
                                                                            value="{{ $data->harga_awal }}"
                                                                            oninput="validateInput()" />
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <h6>Harga Jual</h6>
                                                                    <td>
                                                                        <Input class="form-control" name="harga_jual"
                                                                            type="number" required
                                                                            placeholder="Masukkan Harga Jual"
                                                                            value="{{ $data->harga_jual }}" />
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- @method('DELETE') --}}
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#hapus{{ $data->id }}">Hapus</button>

                                        <div class="modal modal-alert fade" data-bs-backdrop="static" tabindex="-1"
                                            role="dialog" id="hapus{{ $data->id }}" style="margin-top: 100px;">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content rounded-3 shadow w-75 m-auto"
                                                    style="border-top:5px solid #dc3545">
                                                    <div class="modal-body p-4 text-center">
                                                        <div class="text-danger">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="60"
                                                                height="60" fill="currentColor"
                                                                class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z" />
                                                                <path
                                                                    d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z" />
                                                            </svg>
                                                        </div>
                                                        <h4 class="mb-3 fw-bold mt-3">Hapus barang?</h4>
                                                        <p class="mb-0">
                                                            Anda yakin akan menghapus barang?
                                                        </p>
                                                    </div>
                                                    <form action="{{ url('barang/hapus/' . $data->id) }}" method="get">
                                                        @csrf
                                                        <div class="modal-footer flex-nowrap p-0">
                                                            <div
                                                                class="col-6 m-0 rounded-0 d-flex justify-content-center p-2">
                                                                <button type="button"
                                                                    class="btn btn-light fs-6 text-decoration-none col-6 m-0 w-100 border-1 border-secondary border-opacity-25 shadow-lg "
                                                                    data-bs-dismiss="modal">
                                                                    <strong>Batal</strong>
                                                                </button>
                                                            </div>
                                                            <div
                                                                class="col-6 m-0 rounded-0 d-flex justify-content-center p-2">
                                                                <button type="submit"
                                                                    class="btn btn-danger fs-6 text-decoration-none col-6 m-0 w-100">
                                                                    <strong>Hapus</strong>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

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
