@extends('layouts.main')

@section('main')
    <div class="container">
        @if (count($cart) == 0)
            @include('no-cart')
        @else
            <div class="row d-flex justify-content-center my-4">
                <div class="col-md-8">
                    <div class="card shadow mb-4" data-aos="fade-up" data-aos-duration="1000">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Keranjang - {{ count($cart) }} barang</h5>
                        </div>
                        <div class="card-body">
                            @php
                                $sold_data = [];
                            @endphp
                            @foreach ($cart as $item)
                                @php
                                    $sold_data[] = $item->id;
                                @endphp
                                <!-- Single item -->
                                <div class="row">
                                    <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                        <!-- Image -->
                                        <div class="bg-image hover-overlay hover-zoom ripple rounded-5 cart-img-frame"
                                            data-mdb-ripple-color="light">
                                            <img src="/img/product/{{ $item->image }}" class="cart-img"
                                                alt={{ $item->name }} />
                                            <a href="{{ route('detail', $item->id) }}">
                                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)">
                                                </div>
                                            </a>
                                        </div>
                                        <!-- Image -->
                                    </div>

                                    <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                        <!-- Data -->
                                        <p><strong>{{ $item->name }}</strong></p>
                                        <p>Rp {{ number_format($item->price, 0, '', '.') }}</p>
                                        @php
                                            $total_price += $item->price;
                                        @endphp
                                        <form action="{{ route('remove_cart', $item->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm" data-mdb-toggle="tooltip"
                                                data-mdb-placement="bottom" title="Hapus dari keranjang">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>

                                        <!-- Data -->
                                    </div>

                                    <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                        <!-- Quantity -->
                                        <div class="d-flex mb-4" style="max-width: 300px">
                                            <button class="btn btn-primary px-3 me-2"
                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                <i class="fas fa-minus"></i>
                                            </button>

                                            <div class="form-outline">
                                                <input id="form1" min="1" name="quantity" value="1"
                                                    type="number" class="form-control" />
                                                <label class="form-label" for="form1">Quantity</label>
                                            </div>

                                            <button class="btn btn-primary px-3 ms-2"
                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <!-- Quantity -->
                                    </div>
                                </div>
                                <!-- Single item -->
                                <hr class="my-4" />
                            @endforeach
                        </div>
                    </div>
                    <div class="card shadow mb-4 mb-lg-0" data-aos="fade-up" data-aos-duration="1000">
                        <div class="card-body">
                            <p><strong>Kami menerima pembayaran melalui metode berikut:</strong></p>
                            <img class="me-2" width="60px"
                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/2560px-Bank_Mandiri_logo_2016.svg.png"
                                alt="Mandiri" />

                            <img class="me-2" width="60px"
                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/2560px-Bank_Central_Asia.svg.png"
                                alt="BCA" />

                            <img class="me-2" width="60px"
                                src="https://www.bisnisidea.com/wp-content/uploads/2021/07/QRIS-icon.png" alt="Qris" />

                            <img class="me-2" width="60px"
                                src="https://cdn.pixabay.com/photo/2015/05/26/09/37/paypal-784404_1280.png"
                                alt="Paypal" />

                            <img class="me-2" width="60px"
                                src="https://image.cermati.com/v1585904886/o81yliwckjhywelnx13a.png" alt="Gopay" />

                            <img class="me-2" width="60px"
                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/72/Logo_dana_blue.svg/2560px-Logo_dana_blue.svg.png"
                                alt="Dana" />

                            <img class="me-2" width="60px"
                                src="https://1.bp.blogspot.com/-Iq0Ztu117_8/XzNYaM4ABdI/AAAAAAAAHA0/MabT7B02ErIzty8g26JvnC6cPeBZtATNgCLcBGAsYHQ/s1000/logo-ovo.png"
                                alt="Ovo" />

                            <img class="me-2" width="60px"
                                src="https://shopeepay.co.id/src/pages/home/assets/images/2-shopeepay-rectangle-orange2.png"
                                alt="Shopee pay" />
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow mb-4" data-aos="fade-up" data-aos-duration="1000">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Summary</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                    Produk ({{ count($cart) }})
                                    <span>Rp {{ number_format($total_price, 0, '', '.') }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    Pajak (11%)
                                    <span>
                                        Rp {{ number_format($total_price * (11 / 100), 0, '', '.') }}
                                    </span>
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                    <div>
                                        <strong>Total Harga</strong>
                                    </div>
                                    <span>
                                        <strong>
                                            Rp
                                            {{ number_format($total_price + $total_price * (11 / 100), 0, '', '.') }}
                                        </strong>
                                    </span>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-primary btn-lg btn-block" data-mdb-toggle="modal"
                                data-mdb-target="#staticBackdrop5">
                                Bayar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="modal top fade" id="staticBackdrop5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-mdb-backdrop="true" data-mdb-keyboard="true">
        <div class="modal-dialog modal-dialog-centered text-center d-flex justify-content-center">
            <div class="modal-content w-75">
                <div class="modal-body p-4">
                    @if (auth()->user()->avatar)
                        <img src="/img/avatar/{{ auth()->user()->avatar }}" alt="avatar"
                            class="shadow rounded-circle position-absolute top-0 start-50 translate-middle profile-img" />
                    @else
                        <img src="/img/{{ auth()->user()->gender == 'Laki-laki' ? 'male-avatar.jpg' : 'female-avatar.jpg' }}"
                            alt="avatar"
                            class="shadow rounded-circle position-absolute top-0 start-50 translate-middle profile-img" />
                    @endif
                    <form action="{{ route('checkout_verify') }}" method="post">
                        @csrf
                        @if (isset($sold_data))
                            @foreach ($sold_data as $id)
                                <input type="hidden" name="sold_data[]" value="{{ $id }}">
                            @endforeach
                        @endif
                        <div>
                            <h5 class="pt-5 my-3">{{ auth()->user()->username }}</h5>
                            <div class="form-outline">
                                <input type="password" name="password" id="password" class="form-control" />
                                <label class="form-label" for="password">Password</label>
                            </div>
                            <div id="textExample1" class="form-text mb-4">
                                Anda perlu melakukan verifikasi password sebelum melakukan transaksi ini untuk memastikan
                                bahwa memang anda yang melakukan transaksi ini.
                            </div>
                            <button type="submit" class="btn btn-primary">Verify</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
