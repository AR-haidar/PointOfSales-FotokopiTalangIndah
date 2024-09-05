<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ISI APA WEH</title>

    {{-- ini bootstrap kamu --}}
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    
</head>
<style>
    body {
        height: 100vh;
    }

    .card {
        /* Ukuran Kartu KTP */
        width: 323.52px;
        height: 204.01px;
        /* width: 8.65cm;
        height: 5.398cm; */
    }

    hr{
        border-style: dashed;
      border-width: 2px; /* Sesuaikan dengan ketebalan garis yang diinginkan */
      width: 50%; /* Sesuaikan dengan lebar garis yang diinginkan */
      margin: 20px auto;
    }
</style>

<body class="d-flex justify-content-center align-items-center bg-white text-black">
    <div class="card bg-white px-3 py-2 border border-2 border-dark rounded-2">
        <div class="head d-flex justify-content-between">
            <img src="{{ asset('woi.jpeg') }}" alt="" style="width: 1cm">
            <div class="text-center mt-1">
                <div class="text-center fw-bold" style="font-size: 12px">KARTU ANGGOTA PERPUSTAKAAN</div>
                <div class="fw-bolder" style="font-size: 12px">SMP NEGERI 3 BATUJAJAR</div>
            </div>
            <img src="{{ asset('woe.jpeg') }}" alt="" style="width: 1cm">
        </div>
        <hr class="mt-2">
        <div class="body row">
            <div class="col-4">
                <div class="d-flex justify-content-center align-items-center border border-1 border-dark"
                    style="width: 2cm; height: 3cm">
                    2x3
                </div>
            </div>
            <div class="col-8">
                <div class="">
                    <table style="font-size: 11px">
                        <tr>
                            <td class="pe-4">NIS</td>
                            <td class="pe-3">:</td>
                            <td>1289381293</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>Hesti</td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>:</td>
                            <td>XII RPL B</td>
                        </tr>
                    </table>
                </div>
                <div class="mt-2">
                    <table class="float-end me-4" style="font-size: 8px">
                        <tr>
                            <td>Kepala Sekolah</td>
                        </tr>
                        <tr>
                            <td class="py-0">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="py-0">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Kepala Sekolah</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
