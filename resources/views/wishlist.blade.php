@extends('layouts.main')

@section('main')
    <div class="text-center container">
        @if (count($wishlist) == 0)
            @include('no-wishlist')
        @else
            <h1 class="py-5 mt-4 mb-5" data-aos="fade-up" data-aos-duration="1000">
                <strong>Wujudkan wishlistmu sekarang juga!</strong>
            </h1>
            <div class="row">
                @foreach ($wishlist as $item)
                    <div class="col-lg-4 col-md-12 mb-4">
                        <div class="card" data-aos="fade-up" data-aos-duration="1000">
                            <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light blue-green-gradient-bg"
                                data-mdb-ripple-color="light">
                                <img src="/img/product/{{ $item->image }}"class="img-fluid"
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
                                <div class="d-flex justify-content-center">
                                    <form action="{{ route('remove_wishlist', $item->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button id="trash_icon_btn" type="submit"
                                            class="btn btn-danger mx-2 mt-3 px-3 fs-6" data-mdb-toggle="tooltip"
                                            data-mdb-placement="bottom" title="Hapus dari wishlist">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
