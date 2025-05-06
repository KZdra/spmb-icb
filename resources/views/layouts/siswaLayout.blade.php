<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Laravel'))</title>


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/icb.png') }}" type="image/x-icon">

</head>

<body>
    @include('sweetalert::alert')
    <nav class="navbar sticky-top  navbar-expand-lg navbar-light bg-light shadow px-5">
        @auth
            <a class="navbar-brand" href="{{ route('siswa.dashboard') }}">SPMB ICB-Teknika</a>
        @endauth

        @guest
            <a class="navbar-brand" href="/">SPMB ICB-Teknika</a>
        @endguest

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <!-- Hapus <ul> dan <li> untuk menghilangkan menu -->
            <div class="ml-auto">
                @guest
                    @if (request()->is('siswa/login'))
                        <a class="btn btn-outline-success my-2 my-sm-0" href="{{ route('siswa.daftar') }}"
                            style="padding: 10px 20px;">Daftar</a>
                    @else
                        <!-- Tombol Daftar -->
                        <a class="btn btn-outline-primary my-2 my-sm-0" href="{{ route('siswa.masuk') }}"
                            style="padding: 10px 20px;">Masuk</a>
                    @endif
                @endguest

                @auth
                    <form id="logout-form" action="{{ route('siswa.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                        <i class="fas fa-user"></i> {{ __(auth_user()->nama) }}
                    </a>
                @endauth

            </div>
        </div>
    </nav>

    @yield('content')

    <footer class=" shadow-lg bg-primary text-start text-lg-start mt-5">
        <div class="text-start p-3 shadow-lg bg-white text-muted">
            © {{ date('Y') }} Teknika-Dev. All rights reserved.
        </div>
    </footer>

</body>
@vite('resources/js/app.js')
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}" defer></script>
@yield('script')

</html>
