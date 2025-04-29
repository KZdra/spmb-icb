<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <link rel="shortcut icon" href="{{asset('images/icb.png')}}" type="image/x-icon">
    <style>
        @media (max-width: 768px) {
            /* Aturan CSS untuk layar dengan lebar <= 768px */
            .ilustration img {
              display: none;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow px-5">
        <a class="navbar-brand" href="#">SPMB ICB-Teknika</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <!-- Hapus <ul> dan <li> untuk menghilangkan menu -->
            <div class="ml-auto">
                <!-- Tombol Daftar -->
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"
                    style="padding: 10px 20px;">Masuk</button>
            </div>
        </div>
    </nav>
    <section class="mx-auto p-3 ">
        <div class="d-flex justify-content-center">
            <div class="typo p-5 my-auto">
                <h2 class="font-weight-bold">Raih masa depanmu di Portal SPMB-Teknika <br>
                    <h3 class="font-weight-light"> Belum memiliki akun SPMB ? Daftar segera di sini.</h3>
                    <a href="#" class="btn btn-primary">Daftar</a>
                    <hr>
                    <h3 class="font-weight-light"> Sudah punya akun SPMB ? Masuk di sini.</h3>
                    <a href="#" class="btn btn-outline-primary">Masuk</a>
            </div>
            <div class="ilustration">
                <img src="{{ asset('images/1.svg') }}"width="500" height="500" alt="">
            </div>
        </div>
    </section>
</body>
@vite('resources/js/app.js')
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}" defer></script>

</html>
