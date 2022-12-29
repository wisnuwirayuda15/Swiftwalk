@extends('layouts.main')

@section('style')
    <style>
        .text-yellow {
            color: rgb(255, 159, 28)
        }
    </style>
@endsection

@section('main')
    @if (count(isset($catalogs) ? $catalogs : [1]) == 0 || count(isset($result) ? $result : [1]) == 0)
        @if (count(isset($catalogs) ? $catalogs : [1]) == 0)
            @include('maintenance')
        @else
            @include('no-result')
        @endif
    @else
        <div class="text-center container py-5">
            <form action="{{ route('search') }}" method='POST' id="search-bar-mobile" class="nav-item" role="search">
                @csrf
                <div class="input-group search-bar nav-padding">
                    <input type="text" class="form-control search-bar" placeholder="Cari sneakers lokal incaranmu..."
                        name="search" id="search" value="{{ isset($keyword) ? $keyword : '' }}">
                    <button class="btn search-btn d-flex" type="submit"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
            @if (!isset($keyword))
                <div id="carouselExampleTouch" class="carousel slide mb-5" data-aos="fade-up" data-aos-duration="1000">
                    <div class="carousel-indicators">
                        <button type="button" data-mdb-target="#carouselExampleTouch" data-mdb-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-mdb-target="#carouselExampleTouch" data-mdb-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-mdb-target="#carouselExampleTouch" data-mdb-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner rounded-5 shadow">
                        <div class=" active carousel-item" data-mdb-interval="2000">
                            <img src="/img/slide_1.jpg" class="d-block carousel-img img-fluid" alt="slide_1" />
                        </div>
                        <div class="carousel-item" data-mdb-interval="2000">
                            <img src="/img/slide_2.jpg" class="d-block carousel-img img-fluid" alt="slide_2" />
                        </div>
                        <div class="carousel-item" data-mdb-interval="2000">
                            <img src="/img/slide_3.jpg" class="d-block carousel-img img-fluid" alt="slide_3" />
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleTouch"
                        data-mdb-slide="prev">
                        <i class="fa-solid fa-chevron-left fa-3x"></i>
                    </button>
                    <button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleTouch"
                        data-mdb-slide="next">
                        <i class="fa-solid fa-chevron-right fa-3x"></i>
                    </button>
                </div>
            @else
                <h1 class="mb-5 animate__animated animate__fadeInUp">
                    Hasi pencarian untuk "<strong>{{ $keyword }}</strong>"
                </h1>
            @endif
            <div class="row">
                @foreach (isset($keyword) ? $result : $catalogs as $item)
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
