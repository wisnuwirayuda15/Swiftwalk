@extends('layouts.main')

@section('style')
    <style>
        label {
            flex-basis: 40%;
        }

        .form-control:focus {
            border-color: #00cdac;
            box-shadow: inset 0 0 0 1px #00cdac
        }
    </style>
@endsection

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-3">
                <form action="{{ route('add_item') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-5 card" data-aos="fade-up" data-aos-duration="500">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <a href="{{ route('catalog') }}"><span><i class="fa-regular fa-chevron-left"></i></span>
                                Catalog</a>
                        </div>
                    </div>

                    <!---Product Image--->
                    <div class="mt-4 card" data-aos="fade-up" data-aos-duration="500">
                        <div class="card-header d-flex align-items-center">
                            <span>
                                <i class="fa-solid fa-folder-arrow-up"></i> Upload Foto Produk
                            </span>
                        </div>
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <img id="product_image_preview" src="/img/product-image-placeholder.jpg"
                                alt="product_image_preview" class="rounded-6 img-fluid shadow mb-3"
                                style="width: 250px; height: 250px; object-fit: cover" data-mdb-toggle="tooltip"
                                title="Gambar yang anda pilih akan muncul di sini" data-mdb-placement="right">
                            <p>Ukuran file maksimal 5Mb dan format gambar yang didukung: .PNG .JPG .JPEG .GIF .JFIF .WEBP</p>
                            <input id="product_image_input" name="image" type="file" class="d-none form-control"
                                accept="image/*" />
                            <button class="icon-product-image-input-btn add-product-image-input-btn">
                                <div class="product-image-input-icon"></div>
                                <div class="product-image-input-btn-txt">Pilih Gambar Produk</div>
                            </button>
                        </div>
                    </div>

                    <!---Product Info--->
                    <div class="mt-4 card" data-aos="fade-up" data-aos-duration="500">
                        <div class="card-header d-flex align-items-center">
                            <span>
                                <i class="fa-solid fa-circle-info"></i> Informasi Produk
                            </span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="mb-4 d-flex">
                                <label class="form-label fw-bolder" for="name">Nama Produk</label>
                                <input required type="text" id="name" name="name" class="form-control"
                                    data-mdb-toggle="tooltip" title="Nama produk minimal 3 karakter, maksimal 50 karakter"
                                    data-mdb-placement="left" placeholder="Contoh: Jelly Shoes"
                                    value="{{ old('name') }}" />
                            </div>

                            <div class="mb-4 d-flex">
                                <label class="form-label fw-bolder" for="description">Deskripsi Produk</label>
                                <textarea required type="textarea" id="description" name="description" class="form-control" rows="8"
                                    placeholder="Contoh: Jelly Shoes adalah jenis sepatu yang terbuat dari bahan karet bening atau transparan, sehingga terlihat seperti sepatu jelly. Jelly Shoes biasanya digunakan selama musim panas karena bahan karetnya yang lembut dan nyaman dipakai saat cuaca panas. Selain itu, Jelly Shoes juga memiliki desain yang unik dan menarik, sehingga banyak orang yang menyukainya hanya karena penampilannya saja.">{{ old('description') }}</textarea>
                            </div>

                            <div class="mb-4 d-flex">
                                <label class="form-label fw-bolder" for="price">Harga Produk (Rupiah)</label>
                                <input required type="number" id="price" name="price" class="form-control"
                                    data-mdb-placement="left" placeholder="Contoh: 69000 (Rp 69.000)"
                                    value="{{ old('price') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4" data-aos="fade-up" data-aos-duration="500">
                        <a href="{{ route('catalog') }}" class="btn btn-light shadow-sm mx-3 fs-6"><i
                                class="fa-solid fa-arrow-left"></i> Kembali</a>
                        <button type="submit" class="pulse-animated-btn fs-6"><i class="fa-solid fa-plus"></i> Tambah
                            Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'warning',
                text: '{{ $errors->first() }}',
            })
        </script>
    @endif
@endsection
