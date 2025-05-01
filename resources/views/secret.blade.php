<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Akun Siswa | {{ config('app.name', 'Laravel') }}</title>

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
                <h2 class="font-weight-bold">Data Siswa Untuk Login</h2>
            </div>
            <div class="">
                <h5>Nama Siswa :</h5>
                <h2 class="font-weight-bold">{{$dataSis->nama}}</h2>
                <h5>Nis Siswa :</h5>
                <h2 class="font-weight-bold">{{ $dataSis->nis }}</h2>
                <h5>Password :</h5>
                <h2 class="font-weight-bold">{{ $dataSis->rawPass }}</h2>
            </div>
            <p>-----------------------------------------------------------------------------------------</p>
            <div class="">
                <p>Silahkan Simpan Data Ini Untuk Login di SPMB!
                    Screenshot Atau Salin Dengan Menekan Tombol Salin Dibawah ini
                </p>
                <button class="btn btn-success w-100" id="copyBtn" data-nis="{{ $dataSis->nis }}"
                    data-password="{{ $dataSis->rawPass }}">
                    <i class="fa fa-clone"></i> Salin
                </button>
            </div>
            <a class="btn btn-success w-100 mt-2" href="{{route('siswa.masuk')}}">
                <i class="fa fa-sign-in-alt"></i>Login
            </a>
        </div>
    </main>
</body>

@vite('resources/js/app.js')
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}" defer></script>
<script type="module">
    $(document).ready(function() {
        $('#copyBtn').on('click', function() {
            const nis = $(this).data('nis')
            const password = $(this).data('password')
            const copyText = `Nis : ${nis} , Password: ${password}`;

            if (navigator.clipboard) {
                navigator.clipboard.writeText(copyText)
                    .then(() => {
                        SwalHelper.showSuccess('Sukses Di Salin')
                        // alert('Copied to clipboard!');
                    })
                    .catch(err => {
                        SwalHelper.showError('Failed to copy: ' + err)
                        // alert('Failed to copy: ' + err);
                        console.log(err)
                    });
            } else {
                // Fallback for older browsers
                const tempInput = $("<textarea>");
                $("body").append(tempInput);
                tempInput.val(copyText).select();
                document.execCommand("copy");
                tempInput.remove();
                SwalHelper.showSuccess('Sukses Di Salin')
            }
        });
    })
</script>

</html>
