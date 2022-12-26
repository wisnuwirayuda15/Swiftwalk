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
                if (response.alert == 'wishlist')
            }
        });
    });
</script>