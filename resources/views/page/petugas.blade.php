@extends('layouts.main')

@section('container')
    <div class="ms-1">

        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Petugas</li>
            </ol>
        </nav>
        <h1 class="h3 mb-3 fw-bold">Petugas</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">

                    <!-- Button trigger modal -->
                    <div class="d-flex justify-content-between mb-2">
                        <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#insert">
                            Tambah Data
                        </button>
                    </div>

                    <!-- Modal Insert -->
                    <div class="modal fade" id="insert" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-primary" data-bs-theme="dark">
                                    <h5 class="modal-title text-light fw-bold " id="exampleModalLabel">Tambah Data Petugas
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('/petugas/insert') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <table class="table">
                                            <tr>
                                                <td>
                                                    <h6>Username</h6>
                                                <td><Input class="form-control @error('username') is-invalid @enderror"
                                                        name="username" type="text" required
                                                        placeholder="Masukkan Username" value="{{ old('username') }}" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6>Nama Petugas</h6>
                                                <td>
                                                    <Input class="form-control @error('name') is-invalid @enderror"
                                                        name="name" type="text" required
                                                        placeholder="Masukkan Nama Petugas" value="{{ old('name') }}" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6>Telepon</h6>
                                                <td>
                                                    <Input class="form-control @error('notelp') is-invalid @enderror"
                                                        name="notelp" type="number" required
                                                        placeholder="Masukkan Telepon" value="{{ old('notelp') }}" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6>Password</h6>
                                                <td>
                                                    <Input
                                                        class="form-control bg-primary-subtle  @error('password') is-invalid @enderror"
                                                        type="text" required placeholder="Masukkan Password"
                                                        value="123" readonly />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6>Posisi</h6>
                                                <td>
                                                    <select class="form-select @error('posisi') is-invalid @enderror"
                                                        name="posisi" required>
                                                        <option disabled selected>Pilih Posisi</option>
                                                        <option value="Admin">Admin</option>
                                                        <option value="Petugas">Petugas</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6>Foto (Opsional)</h6>
                                                <td>
                                                    <img class="mx-auto img-preview img-fluid col-sm-5 mb-2">
                                                    <Input class="form-control @error('pic') is-invalid @enderror"
                                                        name="pic" type="file" id="image"
                                                        onchange="previewImage()" />
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
                    <table class="table table-bordered table-hover table-striped w-100" id="tpetugas">
                        <thead>
                            <tr class="table-primary">
                                <td data-searchable="false">No</td>
                                <td>Username</td>
                                <td>Nama</td>
                                <td>Nomor Telepon</td>
                                <td>Posisi</td>
                                <td data-searchable="false"></td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($users as $petugas)
                                <tr>
                                    <td>{{ $no++ . '.' }}</td>
                                    <td>{{ $petugas->username }}</td>
                                    <td>{{ $petugas->name }}</td>
                                    <td>{{ $petugas->notelp }}</td>
                                    <td>{{ $petugas->role }}</td>
                                    <td class="w-auto pe-0">
                                        <a href="{{ url('/petugas/' . $petugas->id) }}"
                                            class="btn btn-primary btn-sm">Detail</a>

                                        <button type="button" class="btn btn-sm btn-danger ps-2" data-bs-toggle="modal"
                                            data-bs-target="#hapus{{ $petugas->id }}">
                                            Hapus
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal modal-alert fade" data-bs-backdrop="static" tabindex="-1"
                                            role="dialog" id="hapus{{ $petugas->id }}" style="margin-top: 100px;">
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
                                                        <h4 class="mb-3 fw-bold mt-3">Hapus?</h4>
                                                        <p class="mb-0">
                                                            Anda yakin akan menghapus data ini?
                                                        </p>
                                                    </div>
                                                    <form action="{{ url('petugas/hapus/' . $petugas->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <div class="modal-footer flex-nowrap p-0">
                                                            <div
                                                                class="col-6 m-0 rounded-0 d-flex justify-content-center p-2">
                                                                <button type="button"
                                                                    class="btn fs-6 text-decoration-none col-6 m-0 w-100 border-1 border-secondary border-opacity-25 shadow-lg "
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
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        //Preview Image 
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');


            imgPreview.style.display = 'block';

            const oFReader = new FileReader;
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
