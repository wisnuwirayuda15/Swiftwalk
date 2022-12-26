@extends('layouts.main')

@section('main')
    <section class="h-100">
        <div class="container">
            <div class="row d-flex justify-content-center my-4">
                <div class="col-md-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Cart - 2 items</h5>
                        </div>
                        <div class="card-body">
                            @for ($x = 1; $x <= 3; $x++)
                            <!-- Single item -->
                            <div class="row">
                                <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                    <!-- Image -->
                                    <div class="bg-image hover-overlay hover-zoom ripple rounded"
                                        data-mdb-ripple-color="light">
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Vertical/12a.webp"
                                            class="w-100" alt="Blue Jeans Jacket" />
                                        <a href="#!">
                                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                        </a>
                                    </div>
                                    <!-- Image -->
                                </div>

                                <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                    <!-- Data -->
                                    <p><strong>Blue denim shirt</strong></p>
                                    <p>Color: blue</p>
                                    <p>Size: M</p>
                                    <button type="button" class="btn btn-danger btn-sm mb-2" data-mdb-toggle="tooltip"
                                        title="Move to the wish list">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm me-1 mb-2"
                                        data-mdb-toggle="tooltip" title="Remove item">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    
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

                                    <!-- Price -->
                                    <p class="text-start text-md-center">
                                        <strong>$17.99</strong>
                                    </p>
                                    <!-- Price -->
                                </div>
                            </div>
                            <!-- Single item -->
                            <hr class="my-4" />
                            @endfor
                        </div>
                    </div>
                    <div class="card shadow mb-4 mb-lg-0">
                        <div class="card-body">
                            <p><strong>Kami menerima pembayaran melalui metode berikut:</strong></p>
                            <img class="me-2" width="60px"
                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/2560px-Bank_Mandiri_logo_2016.svg.png"
                                alt="Mandiri" />

                            <img class="me-2" width="60px"
                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/2560px-Bank_Central_Asia.svg.png"
                                alt="BCA" />

                            <img class="me-2" width="60px"
                                src="https://www.bisnisidea.com/wp-content/uploads/2021/07/QRIS-icon.png"
                                alt="Qris" />

                            <img class="me-2" width="60px"
                                src="https://cdn.pixabay.com/photo/2015/05/26/09/37/paypal-784404_1280.png"
                                alt="Paypal" />

                            <img class="me-2" width="60px"
                                src="https://image.cermati.com/v1585904886/o81yliwckjhywelnx13a.png"
                                alt="Gopay" />
                            
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
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Summary</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                    Products
                                    <span>$53.98</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    Shipping
                                    <span>Gratis</span>
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                    <div>
                                        <strong>Total amount</strong>
                                        <strong>
                                            <p class="mb-0">(including VAT)</p>
                                        </strong>
                                    </div>
                                    <span><strong>$53.98</strong></span>
                                </li>
                            </ul>

                            <button type="button" class="btn btn-primary btn-lg btn-block">
                                Go to checkout
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
