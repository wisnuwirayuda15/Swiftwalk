//Logout button confirm
$('.logout-btn').on('click', function (event) {
    event.preventDefault();
    const href = $(this).attr('href');
    Swal.fire({
        title: 'Logout',
        text: 'Apakah anda yakin ingin logout?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'rgb(56, 107, 192)',
        cancelButtonColor: 'rgb(209, 72, 95)',
        confirmButtonText: 'Logout',
        cancelButtonText: 'Ga jadi deh hehe',
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })
});


//Delete account button confirm
$('.delete-acc-btn').on('click', function (event) {
    event.preventDefault();
    Swal.fire({
        title: 'Hapus Akun',
        text: 'Apakah anda yakin ingin menghapus akun ini? Akun ini tidak dapat dikembalikan setelah anda menghapusnya.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'rgb(56, 107, 192)',
        cancelButtonColor: 'rgb(209, 72, 95)',
        confirmButtonText: 'Hapus aja deh :(',
        cancelButtonText: 'Jangan dong :)',
    }).then((result) => {
        if (result.value) {
            $(this).closest('form').submit();
        }
    })
});


//Delete user button confirm
$('.remove-user-btn').on('click', function (event) {
    event.preventDefault();
    Swal.fire({
        title: 'Hapus Akun',
        text: 'Hapus akun ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'rgb(56, 107, 192)',
        cancelButtonColor: 'rgb(209, 72, 95)',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Tidak',

    }).then((result) => {
        if (result.value) {
            const id = $(this).attr('id');
            $('.remove-user-btn[id=' + id + ']').html(
                '<div class="spinner-border spinner-border-sm text-light" role="status"></div>'
            )
            $(this).closest('form').submit();
        }
    })
});



//Delete catalog button confirm
$('.remove-catalog-btn').on('click', function (event) {
    event.preventDefault();
    Swal.fire({
        title: 'Hapus Akun',
        text: 'Hapus item ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'rgb(56, 107, 192)',
        cancelButtonColor: 'rgb(209, 72, 95)',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Tidak',

    }).then((result) => {
        if (result.value) {
            const id = $(this).attr('id');
            $('.remove-catalog-btn[id=' + id + ']').html(
                '<div class="spinner-border spinner-border-sm text-light" role="status"></div>'
            )
            $(this).closest('form').submit();
        }
    })
});