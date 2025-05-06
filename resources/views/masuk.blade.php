@extends('layouts.siswaLayout')
@section('title', 'Masuk')
@section('content')
    <main class="container min-vh-100 d-flex justify-content-center align-items-center">
        <div class="p-4 bg-white rounded shadow-lg w-100" style="max-width: 500px;">
            <div class="header text-center mb-4">
                <img src="{{ asset('images/icb.png') }}" width="100" height="100" class="img-fluid mb-2">
                <h2 class="font-weight-bold">Login Siswa</h2>
            </div>
            <form action="{{ route('siswa.masuk.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email Siswa:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
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
@endsection

