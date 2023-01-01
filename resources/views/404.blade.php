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
            background: var(--blue-green-gradient-bg) !important;
            height: 100vh;
        }
    </style>
@endsection

@section('main')
    <div class="container mt-5 text-center text-white" data-aos="fade-up" data-aos-duration="1000">
        <div class="row">
            <div class="col-12">
                <img src="/img/404.png" alt="404"
                                    class="img-fluid mb-3"
                                    style="width: 400px; height: 400px">
                <h2>Eh, kok ga ada apa-apa disini???</h2>
                <p>Pastikan url yang kamu tulis sudah benar ya.</p>
                <a href="/" class="btn btn-primary">Kembali ke halaman utama</a>
            </div>
        </div>
    </div>
@endsection
