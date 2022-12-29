AOS.init();


function totalWishlist() {
    $.ajax({
        type: 'GET',
        url: '/wishlist/total',
        success: function (response) {
            var response = JSON.parse(response);
            if (response == 0) {
                $('#total_wishlist_badge').text('');
            } else {
                $('#total_wishlist_badge').text(response);
            }
        }
    });
} totalWishlist()


function totalCart() {
    $.ajax({
        type: 'GET',
        url: '/cart/total',
        success: function (response) {
            var response = JSON.parse(response);
            if (response == 0) {
                $('#total_cart_badge').text('');
            } else {
                $('#total_cart_badge').text(response);
            }
        }
    });
} totalCart()


$('a#wishlist_icon_btn').on('click', function () {
    if ($('a#wishlist_icon_btn > svg.fa-heart').attr('data-prefix') == 'fa-regular') {
        $('a#wishlist_icon_btn > svg.fa-heart').attr('data-prefix', 'fa-solid');
        $(this).attr('data-mdb-original-title', 'Hapus dari wishlist');
    } else {
        $('a#wishlist_icon_btn > svg.fa-heart').attr('data-prefix', 'fa-regular');
        $(this).attr('data-mdb-original-title', 'Tambah ke wishlist');
    }
});


$('a#cart_icon_btn').on('click', function () {
    if ($('a#cart_icon_btn > svg').attr('data-icon') == 'cart-plus') {
        $('a#cart_icon_btn > svg').attr('data-icon', 'cart-xmark');
        $('a#cart_icon_btn > svg').attr('data-prefix', 'fa-solid');
        $(this).attr('data-mdb-original-title', 'Hapus dari keranjang');
    } else {
        $('a#cart_icon_btn > svg').attr('data-icon', 'cart-plus');
        $('a#cart_icon_btn > svg').attr('data-prefix', 'fa-regular');
        $(this).attr('data-mdb-original-title', 'Masukan ke keranjang');
    }
});


// Add product image input
$('.add-product-image-input-btn').click(function (event) {
    event.preventDefault();
    $('#product_image_input').click();
});
$('#product_image_input').change(function (event) {
    event.preventDefault();
    const file = this.files[0];
    const fileType = file["type"];
    const validImageTypes = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/jfif", "image/webp"];
    // console.log(file);
    if ($.inArray(fileType, validImageTypes) < 0) {
        $('img#product_image_preview').attr('src', '/img/product-image-placeholder.jpg');
        $('#product_image_input').val('')
        Swal.fire({
            icon: 'warning',
            text: 'Ekstensi file yang didukung: .JPG .JPEG .PNG .GIF .PNG .JPG .JPEG .GIF .JFIF .WEBP'
        })
    } else if (file.size > 5242880) {
        $('img#product_image_preview').attr('src', '/img/product-image-placeholder.jpg');
        $('#product_image_input').val('')
        Swal.fire({
            icon: 'warning',
            text: 'Ukuran file maksimal 5Mb.'
        })
    } else {
        let reader = new FileReader();
        reader.onload = function (event) {
            // console.log(event.target.result);
            $('img#product_image_preview').attr('src', event.target.result);
        }
        reader.readAsDataURL(file);
    }
});


$('#login_register_badge').click(function () {
    $('.login-register-right-box').removeClass('animate__fadeInRight');
    $('.login-register-right-box').addClass('animate__fadeOutRight');
});


$('#wishlist_icon_btn').click(function (event) {
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
            catalog_id: $(this).data('catalog-id')
        },
        success: function (response) {
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


$('#cart_icon_btn').click(function (event) {
    event.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/cart',
        method: 'POST',
        data: {
            catalog_id: $(this).data('catalog-id')
        },
        success: function (response) {
            if (response.alert == 'add_cart') {
                totalCart();
                iziToast.success({
                    message: 'Berhasil ditambahkan ke keranjang!',
                });
            } else if (response.alert == 'remove_cart') {
                totalCart();
                iziToast.error({
                    message: 'Berhasil dihapus dari keranjang!',
                });
            }
        }
    });
});