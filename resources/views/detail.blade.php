@extends('layouts.main')

@section('style')
    <style>
        body,
        html {
            background: rgb(255, 255, 255);
            background-color: rgb(255, 255, 255);
            background-image: rgb(255, 255, 255);
        }

        .detail-page .detail-page-right {
            width: 60%;
        }

        .detail-page .detail-page-left {
            width: 40%;
        }

        @media screen and (max-width: 600px) {
            .detail-page .detail-page-left {
                display: none;
            }

            .detail-page .detail-page-right {
                width: 100%;
            }
        }
    </style>
@endsection

@section('main')
    <div class="d-flex detail-page" style="height: 100vh">
        <!-- detail-page-left  -->
        <div
            class="detail-page-left d-flex align-items-center justify-content-center detail-img-margin animate__animated animate__fadeInLeftBig">
            <img src="/img/product/{{ $item->image }}"
                class="img-fluid rounded-5 shadow detail-product-image cyan-blue-gradient-bg" alt="product image">
        </div>
        <!-- detail-page-right  -->
        <div class="container h-100 detail-page-right">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-8">
                    <div class="product-description animate__animated animate__fadeInRightBig">
                        <span class="text-info">Sneakers</span>
                        <h1 class="fw-bold">{{ $item->name }}</h1>
                        <p>{{ $item->description }}</p>

                        <hr>

                        <h1 class="fw-bol">Rp {{ number_format($item->price, 0, '', '.') }}</h1>
                        <a id="wishlist_icon_btn" href="#" class="btn btn-danger mt-3 fs-5" data-mdb-toggle="tooltip"
                            data-mdb-placement="bottom" title="Tambah ke wishlist" data-catalog-id="{{ $item->id }}">
                            <i class="{{ $wishlist == 0 ? 'fa-regular' : 'fa-solid' }} fa-heart"></i>
                        </a>

                        <a href="#" class="btn btn-primary mt-3 fs-5 mx-lg-3" data-mdb-toggle="tooltip"
                            data-mdb-placement="bottom" title="Tambah ke keranjang">
                            <i class="fa-solid fa-cart-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#wishlist_icon_btn').click(function(event) {
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/wishlist',
                method: 'POST',
                data: {
                    user_id: {{ auth()->user()->id }},
                    catalog_id: $(this).data('catalog-id')
                },
                success: function(response) {
                    if (response.alert == 'add_wishlist') {
                        totalWishlist();
                        iziToast.success({
                            message: 'Berhasil ditambahkan ke wishlist!',
                        });
                    } else if (response.alert == 'remove_wishlist') {
                        totalWishlist();
                        iziToast.error({
                            message: 'Berhasil dihapus dari wishlist!',
                        });
                    }
                }
            });
        });
    </script>
@endsection
