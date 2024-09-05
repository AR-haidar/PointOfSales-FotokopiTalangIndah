<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Profil | TALANG INDAH</title>

    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('datatables/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('datatables/datatables.min.css') }}" rel="stylesheet" />

    <script src="{{ asset('datatables/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('datatables/datatables.min.js') }}"></script>

    <link href="{{ asset('page/css/app.css') }}" rel="stylesheet" />
</head>

<body>
        <div class="wrapper">

            <div class="main">

                @include('partials.header')

                <main class="content">
                    <div class="container p-0">

                        <table class="table table-hover table-striped" id="histori">
                            <thead>
                                <tr class="table-primary">
                                    <td>No</td>
                                    <td>Pic</td>
                                    <td>Nama Petugas</td>
                                    <td>Login Pada</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($data as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        @if ($data->pic)
                                        <td><img src="{{ asset('storage/' . $data->pic) }}" alt="{{ $data->name }}" style="width: 50px; height: 50px;"></td>
                                            
                                        @else
                                        <td><img src="{{ asset('img/profile_default.png') }}" alt="{{ $data->name }}" style="width: 50px; height: 50px;"></td>
                                            
                                        @endif
                                        <td><a href="{{ url('/petugas/'.$data->user_id) }}">{{ $data->name }}</a></td>
                                        <td>{{ $data->login_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </main>

                @include('partials.footer')

            </div>
        </div>

        @include('sweetalert::alert')
        <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('page/js/app.js') }}"></script>

        <script src="{{ asset('script/myjs.js') }}" type="text/javascript"></script>
        <script src="{{ asset('script/datatables.js') }}" type="text/javascript"></script>
</body>

</html>
