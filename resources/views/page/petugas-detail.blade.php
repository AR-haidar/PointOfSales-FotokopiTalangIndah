@extends('layouts.main')

@section('container')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/petugas') }}">Petugas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Petugas</li>
        </ol>
    </nav>
    {{-- <div class="mb-3 d-flex justify-content-between">
        <a href="{{ url('/petugas') }}" class="btn btn-primary ps-2">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                </svg>
            </span>
            Kembali
        </a>
    </div> --}}

    <div class="row g-2">

        {{-- Foto --}}
        <div class="col-3">
            <div class="card">
                <div class="card-header pb-0">
                    <h3 class="card-title mb-0 ">Ubah Foto</h3>
                </div>
                <hr class="mb-0">
                <div class="card-body">
                    <div class="mb-4">
                        @if ($data->pic)
                            <img class="img-preview img-fluid w-100" src="{{ asset('storage/' . $data->pic) }}"
                                alt="{{ $data->name }}">
                        @else
                            <img class="img-preview img-fluid w-100" src="{{ asset('img/profile_default.png') }}"
                                alt="{{ $data->name }}">
                        @endif
                    </div>
                    <form action="{{ url('/petugas/updatePic/' . $data->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="oldPic" value="{{ $data->pic }}">
                        <Input class="" name="pic" type="file" id="image" onchange="previewImage()" />
                        <button class="float-end btn btn-primary btn-sm mt-2" type="submit">Ganti Foto</button>
                    </form>

                    <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#hapusfoto">
                            Hapus Foto
                        </button>
                        <!-- Modal -->
                        <div class="modal modal-alert fade" data-bs-backdrop="static" tabindex="-1" role="dialog"
                            id="hapusfoto" style="margin-top: 100px;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content rounded-3 shadow w-75 m-auto"
                                    style="border-top:5px solid #dc3545">
                                    <div class="modal-body p-4 text-center">
                                        <div class="text-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60"
                                                fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                                                <path
                                                    d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z" />
                                                <path
                                                    d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z" />
                                            </svg>
                                        </div>
                                        <h4 class="mb-3 fw-bold mt-3">Hapus Foto?</h4>
                                        <p class="mb-0">
                                            Anda yakin akan menghapus foto?
                                        </p>
                                    </div>
                                    <form action="{{ url('petugas/deletePic/' . $data->id) }}" method="post">
                                        @csrf
                                        <div class="modal-footer flex-nowrap p-0">
                                            <div class="col-6 m-0 rounded-0 d-flex justify-content-center p-2">
                                                <button type="button"
                                                    class="btn fs-6 text-decoration-none col-6 m-0 w-100 border-1 border-secondary border-opacity-25 shadow-lg "
                                                    data-bs-dismiss="modal">
                                                    <strong>Batal</strong>
                                                </button>
                                            </div>
                                            <div class="col-6 m-0 rounded-0 d-flex justify-content-center p-2">
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

                </div>
            </div>
        </div>


        {{-- Kelola data --}}
        <div class="col-5">
            <div class="card">
                <div class="card-header pb-0">
                    <h3 class="card-title mb-0">Kelola Data</h3>
                </div>
                <hr>
                <div class="card-body pt-0">
                    <form action="{{ url('/petugas/update/' . $data->id) }}" method="POST">
                        @csrf
                        <label>Username</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                </svg>
                            </span>
                            <Input class="form-control" name="username" type="text" required
                                placeholder="Masukkan Username" value="{{ $data->username }}" />
                        </div>

                        <label>Nama Petugas</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                </svg>
                            </span>

                            <Input class="form-control" name="name" type="text" required
                                placeholder="Masukkan Nama Petugas" value="{{ $data->name }}" />
                        </div>

                        <label>Telepon</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                </svg>
                            </span>
                            <Input class="form-control" name="notelp" type="number" required
                                placeholder="Masukkan Telepon" value="{{ $data->notelp }}" />
                        </div>

                        <label>Posisi</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                </svg>
                            </span>
                            <select class="form-select" name="role" required>
                                <option value="Admin" @if ($data->role == 'Admin') {{ 'selected' }} @endif>
                                    Admin
                                </option>
                                <option value="Petugas" @if ($data->role == 'Petugas') {{ 'selected' }} @endif>
                                    Petugas
                                </option>
                            </select>
                        </div>
                        <button class="float-end btn btn-primary btn-sm mt-2" type="submit">Ubah Profil</button>
                    </form>
                </div>
            </div>
        </div>


        {{-- Ubah Password --}}
        <div class="col-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h3 class="card-title mb-0">Ubah Password</h3>
                </div>
                <hr>
                <div class="card-body pt-0">
                    <form action="/petugas/updatePW/{{ $data->id }}" method="POST">
                        @csrf
                        <label>Password</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
                                </svg>
                            </span>
                            <Input class="form-control" name="password" type="text" required
                                placeholder="Masukkan Password Baru" />
                        </div>
                        <button class="float-end btn btn-primary btn-sm mt-2" type="submit">Ganti Password</button>
                    </form>
                </div>
            </div>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger ps-2 float-end" data-bs-toggle="modal" data-bs-target="#hapus">
                <span>
                    <svg style="margin-top: -2px;" xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                        fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                        <path
                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                    </svg>
                </span>
                Hapus Data
            </button>
            <!-- Modal -->
            <div class="modal modal-alert fade" data-bs-backdrop="static" tabindex="-1" role="dialog" id="hapus"
                style="margin-top: 100px;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content rounded-3 shadow w-75 m-auto" style="border-top:5px solid #dc3545">
                        <div class="modal-body p-4 text-center">
                            <div class="text-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60"
                                    fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                                    <path
                                        d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z" />
                                    <path
                                        d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z" />
                                </svg>
                            </div>
                            <h4 class="mb-3 fw-bold mt-3">Hapus Data?</h4>
                            <p class="mb-0">
                                Anda yakin akan menghapus data ini?
                            </p>
                        </div>
                        <form action="{{ url('petugas/hapus/' . $data->id) }}" method="post">
                            @csrf
                            <div class="modal-footer flex-nowrap p-0">
                                <div class="col-6 m-0 rounded-0 d-flex justify-content-center p-2">
                                    <button type="button"
                                        class="btn fs-6 text-decoration-none col-6 m-0 w-100 border-1 border-secondary border-opacity-25 shadow-lg "
                                        data-bs-dismiss="modal">
                                        <strong>Batal</strong>
                                    </button>
                                </div>
                                <div class="col-6 m-0 rounded-0 d-flex justify-content-center p-2">
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
