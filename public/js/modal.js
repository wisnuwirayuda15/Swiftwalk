$('.admin-role-btn, .user-role-btn').on('click', function () {
    const id = $(this).attr('id');
    const is_admin = $(this).attr('is_admin');
    let admin = '';
    let user = '';
    if (is_admin == 1) {
        admin = 'selected'
    } else {
        user = 'selected'
    }
    $('.inputModal').html(
        '<select required name="is_admin" id="is_admin" class="form-select">' +
        '<option ' + admin + ' value="Admin">Admin</option>' +
        '<option ' + user + ' value="User">User</option></select>'
    );
    $('#modalLabel').text('Ganti role:');
    $('#modalForm').attr({
        'action': '/admin/dashboard/users/update/role/' + id
    });
});


$('#edit_avatar').on('click', function () {
    $('div#preview_avatar').removeClass('d-flex');
    $('div#preview_avatar').addClass('d-none');
    $('#inputModal').remove()
    $('.inputModal').html(
        '<i class="fa-solid fa-cloud-arrow-up fa-4x mb-3" for="inputModal"></i>' +
        '<input required id="inputModal" name="avatar" type="file" class="form-control avatar-preview" accept="image/*"/>'
    )
    $('#modalLabel').text('Pilih gambar untuk avatarmu:')
    $('#modalForm').attr({
        'action': '/profile/update/avatar',
        'enctype': 'multipart/form-data'
    })
    $('#remove_avatar_div').html(
        '<a id="remove_avatar_btn" href="/profile/remove/avatar" class="remove-avatar-btn btn btn-danger"><i class="fa-solid fa-trash-xmark"></i> Hapus Avatar</a>'
    )

    //Remove avatar button confirm
    $('#remove_avatar_btn').on('click', function (event) {
        event.preventDefault();
        const href = $(this).attr('href');
        Swal.fire({
            title: 'Hapus Avatar',
            text: 'Apakah kamu yakin ingin menghapus avatarmu?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: 'rgb(56, 107, 192)',
            cancelButtonColor: 'rgb(209, 72, 95)',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                $('#remove_avatar_btn').html(
                    '<div class="spinner-border spinner-border-sm" role="status"></div>'
                )
                document.location.href = href;
            }
        })
    });

    //Preview avatar and size validation
    $('#inputModal').change(function (event) {
        event.preventDefault();

        const file = this.files[0];
        const fileType = file["type"];
        const validImageTypes = ["image/jpg", "image/jpeg", "image/png", "image/gif"];
        // console.log(file);

        if ($.inArray(fileType, validImageTypes) < 0) {
            Swal.fire({
                icon: 'warning',
                text: 'Ekstensi file yang didukung: .JPG .JPEG .PNG .GIF'
            }).then(() => {
                $('svg.fa-cloud-arrow-up').show();
                $('div#preview_avatar').removeClass('d-flex');
                $('div#preview_avatar').addClass('d-none');
                $('#inputModal').val('')
            })
        } else if (file.size > 2097152) {
            Swal.fire({
                icon: 'warning',
                text: 'Ukuran file maksimal 2Mb.'
            }).then(() => {
                $('svg.fa-cloud-arrow-up').show();
                $('div#preview_avatar').removeClass('d-flex');
                $('div#preview_avatar').addClass('d-none');
                $('#inputModal').val('')
            })
        } else {
            let reader = new FileReader();
            reader.onload = function (event) {
                // console.log(event.target.result);
                $('svg.fa-cloud-arrow-up').hide();
                $('img#preview_avatar').attr('src', event.target.result);
                $('div#preview_avatar').removeClass('d-none');
                $('div#preview_avatar').addClass('d-flex');
            }
            reader.readAsDataURL(file);
        }
    });
});


$('#edit_username').on('click', function () {
    $('div#preview_avatar').removeClass('d-flex');
    $('div#preview_avatar').addClass('d-none');
    $('#inputModal').remove()
    $('.inputModal').html(
        '<input required id="inputModal" name="username" type="text" class="form-control" placeholder="Masukan username baru anda..." />'
    )
    $('#modalLabel').text('Username baru:')
    $('#modalForm').attr({
        'action': '/profile/update/username'
    })
    $('#remove_avatar_btn').remove()
});


$('#edit_gender').on('click', function () {
    $('div#preview_avatar').removeClass('d-flex');
    $('div#preview_avatar').addClass('d-none');
    $('#inputModal').remove()
    $('.inputModal').html(
        '<select required name="gender" id="gender" class="form-select">' +
        '<option value="" selected>Jenis Kelamin</option>' +
        '<option value="Laki-laki">Laki-laki</option>' +
        '<option value="Perempuan">Perempuan</option>' +
        '</select>'
    )
    $('#modalLabel').text('Pilih gender:')
    $('#modalForm').attr({
        'action': '/profile/update/gender'
    })
    $('#remove_avatar_btn').remove()
});


$('#edit_number').on('click', function () {
    $('div#preview_avatar').removeClass('d-flex');
    $('div#preview_avatar').addClass('d-none');
    $('#inputModal').remove()
    $('.inputModal').html(
        '<input required id="inputModal" name="number" type="text" class="form-control" placeholder="Masukan nomor handphone baru anda..." />'
    )
    $('#modalLabel').text('Nomor handphone baru:')
    $('#modalForm').attr({
        'action': '/profile/update/number'
    })
    $('#remove_avatar_btn').remove()
});


$('#edit_password').on('click', function () {
    $('div#preview_avatar').removeClass('d-flex');
    $('div#preview_avatar').addClass('d-none');
    $('#inputModal').remove()
    $('.inputModal').html(
        '<input required name="old_password" type="password" class="form-control mb-3" placeholder="Masukan password lama anda..." />' +
        '<input required name="password" type="password" class="form-control mb-3" placeholder="Masukan password baru anda..." />' +
        '<input required name="password_confirmation" type="password" class="form-control" placeholder="Konfimasi password baru anda..." />'
    )
    $('#modalLabel').text('Password baru:')
    $('#modalForm').attr({
        'action': '/profile/update/password'
    })
    $('#remove_avatar_btn').remove()
});


$('#modalForm').on('submit', function () {
    $('#save_btn').html(
        '<div class="spinner-border spinner-border-sm text-light" role="status"></div>'
    )
});





