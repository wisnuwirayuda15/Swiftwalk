$('.remove-user-btn, .remove-catalog-btn, .detail-catalog-btn, a.scroll-to-top').mouseenter(function (event) {
    event.stopPropagation();
    $(this).addClass('animate__animated animate__heartBeat');
});
$('.remove-user-btn, .remove-catalog-btn, .detail-catalog-btn, a.scroll-to-top').mouseleave(function (event) {
    event.stopPropagation();
    $(this).removeClass('animate__animated animate__heartBeat');
});


$(".remove-user-btn, .remove-catalog-btn, .delete-acc-btn, .logout-btn").on('click', function () {
    $('.swal2-confirm').mouseenter(function (event) {
        event.stopPropagation();
        $(this).addClass('animate__animated animate__rubberBand');
    });
    $('.swal2-confirm').mouseleave(function (event) {
        event.stopPropagation();
        $(this).removeClass('animate__animated animate__rubberBand');
    });
    $('.swal2-cancel').mouseenter(function (event) {
        event.stopPropagation();
        $(this).addClass('animate__animated animate__tada');
    });
    $('.swal2-cancel').mouseleave(function (event) {
        event.stopPropagation();
        $(this).removeClass('animate__animated animate__tada');
    });
});
