@extends('layouts.main')

@section('style')
    <style>
        .text-yellow {
            color: rgb(255, 159, 28)
        }
    </style>
@endsection

@section('main')
    @if (count($catalogs) == 0)
        @include('maintenance')
    @else
        <div class="text-center container py-5">

            <h1 class="mb-5 animate__animated animate__fadeInUp">
                <strong class="fw-bold text-yellow">Temukan Sneakers Incaran Anda di<br>SneakersID Store</strong>
            </h1>
            <form id="search-bar-mobile" class="mb-5" role="search">
                @csrf
                <div class="input-group search-bar">
                    <input type="text" class="form-control search-bar" placeholder="Cari sneakers lokal incaranmu...">
                    <button class="btn search-btn d-flex" type="submit"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
            <div class="row">
                @foreach ($catalogs as $item)
                    <div class="col-lg-4 col-md-12 mb-4">
                        <div class="card" data-aos="fade-up" data-aos-duration="1000">
                            <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light blue-green-gradient-bg"
                                data-mdb-ripple-color="light">
                                <img src="/img/product/{{ $item->image }}" class="img-fluid"
                                    style="width: 100%; object-fit: cover; aspect-ratio: 16/9;" />
                                <a href="{{ route('detail', $item->id) }}">
                                    <div class="mask">
                                        <div class="d-flex justify-content-start align-items-end h-100">
                                        </div>
                                    </div>
                                    <div class="hover-overlay">
                                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);">
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title mb-3">{{ $item->name }}</h5>
                                <p>{{ $item->sold }} Terjual</p>
                                <h3 class="mb-1 fw-bold">Rp {{ number_format($item->price, 0, '', '.') }}</h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection
