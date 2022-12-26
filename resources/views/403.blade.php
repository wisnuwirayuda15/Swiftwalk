@extends('layouts.main')

@section('style')
    <style>
        nav,
        footer,
        .navbar-margin-bottom {
            display: none !important;
            margin-top: 0 !important;
        }

        body {
            background: var(--orangefun-gradient-bg) !important;
            height: 100vh;
        }
    </style>
@endsection

@section('main')
    <div class="container mt-5 text-center text-white">
        <div class="row">
            <div class="col-12">
                <img src="/img/403.png" alt="403"
                                    class="img-fluid mb-3"
                                    style="width: 400px; height: 400px">
                <h2>Hanya admin yang boleh masuk sini!!!</h2>
                <p>Jangan coba-coba masuk ke halaman ini lain kali ya :D</p>
                <a href="/" class="btn btn-dark">Kembali ke halaman utama</a>
            </div>
        </div>
    </div>
@endsection
