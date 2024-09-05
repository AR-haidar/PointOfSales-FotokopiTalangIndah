<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FOTOKOPI TALANG INDAH</title>

    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('login/style.css') }}" rel="stylesheet">

    <style>

    </style>


    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
</head>

<body class="d-flex justify-content-center">
    <div class="row">
        <div class="col">
            
            @if (session()->has('loginError'))
                <div class="alert shadow-lg  bg-danger text-light alert-dismissible fade show" role="alert"
                    style="width: 500px">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif


            <main class="text-center form-signin w-100 m-auto">
                <form action="/aksilogin" method="POST">
                    @csrf
                    <h1 class="h3 mb-3 fw-bold text-light">TALANG INDAH FOTOKOPI</h1>

                    <div class="form-floating">
                        <input type="text" name="username" class="form-control text-light" id="floatingInput"
                            placeholder="Username" required autofocus autocomplete="off">
                        <label for="floatingInput" class="text-light">Username</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control text-light"
                            id="floatingPassword" placeholder="Password" required>
                        <label for="floatingPassword" class="text-light">Password</label>
                    </div>
                    <button class="w-100 mt-2" type="submit">Masuk</button>
                    <p class="mt-5 mb-3 text-muted"> </p>
                </form>
            </main>
        </div>
    </div>

    @include('sweetalert::alert')
    <script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
