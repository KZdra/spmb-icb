<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk | {{ config('app.name', 'Laravel') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/icb.png') }}" type="image/x-icon">

</head>

<body class="bg-primary">
    @include('sweetalert::alert')

    <main class="container min-vh-100 d-flex justify-content-center align-items-center">
        <div class="p-4 bg-white rounded shadow-lg w-100" style="max-width: 500px;">
            <div class="header text-center mb-4">
                <img src="{{ asset('images/icb.png') }}" width="100" height="100" class="img-fluid mb-2">
                <h2 class="font-weight-bold">Login Siswa</h2>
            </div>
            <form action="{{route('siswa.masuk.post')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nis">NIS Siswa:</label>
                    <input type="text" class="form-control" id="nis" name="nis" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>
            </form>
        </div>
    </main>
</body>

@vite('resources/js/app.js')
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}" defer></script>

</html>
