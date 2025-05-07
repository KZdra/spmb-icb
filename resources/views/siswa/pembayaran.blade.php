@extends('layouts.siswaLayout')
@section('title', 'DataDiri')
@section('content')
    <div class="container  d-flex flex-column  mt-3" style="min-height: 80vh">
        @if ($buktiIsExist == true)
            <h2>Status Pembayaran</h2>
        @endif
        @if ($buktiIsExist == false)
            <h2>Verifikasi Bukti Pembayaran</h2>
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Silahkan Lakukan Pembayaran Dibawah ini</h4>
                <p>
                <ul>
                    <li>Biaya SPP Sebesar Rp xxx.xxx</li>
                    <li>Biaya Masuk Sebesar Rp xxx.xxx</li>
                    <li>Biaya Bla Bla Sebesar Rp xxx.xxx</li>
                </ul>
                </p>
                <hr>
                <p class="mb-0">Transfer Ke Rekening Dibawah ini:</p>
                <p class="font-weight-bold mb-0">BRI : 6548742125 A.N SMKS ICB CINTA TEKNIKA</p>
                <p>Kirim Bukti Transfer Berbentuk File JPG/PNG Kedalam Form Dibawah Ini.</p>
            </div>
        @endif

        <div class="cardcont">
            @if ($buktiIsExist == false)
                <div class="card">
                    <h5 class="card-header bg-primary"><i class="fas fa-edit"></i>&nbsp;Form Pembayaran</h5>
                    <div class="card-body">
                        <form action="#" method="POST" enctype="multipart/form-data" id="target">
                            <div class="form-group">
                                <label for="bukti_pembayaran">Bukti Pembayaran:</label>
                                <input type="file" name="bukti_pembayaran" accept="image/*" id="bukti_pembayaran"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="payment_date">Tanggal Pembayaran:</label>
                                <input type="date" name="payment_date" id="payment_date" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="amount">Total Pembayaran:</label>
                                <input type="text" inputmode="numeric" name="amount" id="amount" class="form-control"
                                    placeholder="Contoh: 120000">
                            </div>

                            <button type="submit" class="btn btn-success">Kirim</button>
                        </form>
                    </div>
                </div>
            @endif
            @if ($buktiIsExist == true)
                <div class="card">
                    <h5 class="card-header bg-primary"><i class="fas fa-wallet"></i>&nbsp;Status Pembayaran</h5>
                    <div class="card-body">
                        @switch($dataBukti->status)
                            @case('Diverifikasi')
                                <div class="alert alert-success" role="alert">
                                    <h5 class="mb-0 font-weight-bold">
                                        <i class="fas fa-check"></i>&nbsp;&nbsp;Pembayaran Diverifikasi!
                                    </h5>
                                    <h5 class="mt-1 mb-0">Silahkan Tunggu Status Pendaftaran Di <br>Halaman Status Pendaftaran</h5>
                                    <a href="#" class="btn btn-primary text-decoration-none">Lihat Status Pendaftaran</a>
                                </div>
                            @break

                            @case('Ditolak')
                                <div class="alert alert-danger" role="alert">
                                    <h5 class="mb-0 font-weight-bold">
                                        <i class="fas fa-times"></i>&nbsp;&nbsp;Pembayaran DiTolak! <br>
                                        Karena : Tidak Valid!
                                    </h5>
                                    <h5 class="mt-1 mb-0">Silahkan Hubungi No Dibawah Ini <br>Untuk Input Ulang Bukti Pembayaran
                                    </h5>
                                    <h5>0895.597847514</h5>
                                </div>
                            @break

                            @default
                                <div class="alert alert-info" role="alert">
                                    <h5 class="mb-0 font-weight-bold">
                                        <i class="fas fa-info"></i>&nbsp;&nbsp;Pembayaran Sedang Dalam Proses Verifikasi!
                                    </h5>
                                    <a href="{{ route('siswa.dashboard') }}"
                                        class=" mt-2 btn btn-primary text-decoration-none">Kembali
                                        Ke
                                        Dashboard</a>

                                </div>
                        @endswitch
                    </div>
            @endif
        </div>
    </div>
    </div>
@endsection
@section('script')
    <script type="module">
        $(function() {

            $('#target').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Apa Kamu Yakin?",
                    text: "Data Yang Sudah Diinput Dan Di Upload Tidak Bisa Diubah Bila Sudah Dikirim!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Kirim!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = "{{ route('siswa.pembayaran.store') }}";
                        let method = "POST";
                        let formData = new FormData(this);
                        let bukti_pembayaran = $('#bukti_pembayaran')[0].files[0];
                        if (bukti_pembayaran) {
                            formData.append('bukti_pembayaran', bukti_pembayaran);
                            formData.append('amount', $('#amount').val())
                            formData.append('payment_date', $('#payment_date').val())
                        }
                        $.ajax({
                            url: url,
                            method: method,
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            },
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                setTimeout(function() {
                                    location
                                        .reload(); // Refresh halaman setelah berhasil
                                }, 2000);

                            },
                            error: function(res) {
                                console.log(res)
                                Swal.fire('Error', 'Terjadi kesalahan, coba lagi!',
                                    'error');
                            }
                        });
                    }
                });

            });

        });
    </script>
@endsection
