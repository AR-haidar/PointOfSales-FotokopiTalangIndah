<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>{{ $title }} | TALANG INDAH</title>

    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('datatables/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('datatables/datatables.min.css') }}" rel="stylesheet" />

    <script src="{{ asset('datatables/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('datatables/datatables.min.js') }}"></script>

    <link href="{{ asset('page/css/app.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">

        @include('partials.sidebar')

        <div class="main">

            @include('partials.header')

            
            <main class="content">
                <div class="container p-0">

                    @yield('container')

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
