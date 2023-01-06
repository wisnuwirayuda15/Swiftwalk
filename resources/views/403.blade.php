@extends('layouts.main')

@section('style')
    <style>
        nav,
        footer,
        .navbar-margin-bottom,
        .loading-animation {
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
    <div class="container mt-5 text-center text-white" data-aos="fade-up" data-aos-duration="1000">
        <div class="row">
            <div class="col-12">
                <img src="/img/403.png" alt="403" class="img-fluid mb-3" style="width: 400px; height: 400px">
                <h2>Hanya admin yang boleh masuk sini!!!</h2>
                <p>Silahkan hubungi administrator anda jika ingin mengakses halaman ini.</p>
                <a href="/" class="btn btn-dark">Kembali ke halaman utama</a>
            </div>
        </div>
    </div>
@endsection
