$(function() {
    $('.like-button').on('click', function() {
        const idUser = $(this).data('id-user');
        const idPost = $(this).data('id-post');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
        });

        $.ajax({
            url: `http://${window.location.hostname}:${window.location.port}/toggle-like`,
            data: {
                id_user: idUser,
                id_post: idPost,
            },
            method: 'post',
            dataType: 'json',
            success: function(respons) {
                let count = $(`button[data-id-post="${respons.id_post}"]`)
                    .children('.like-count')
                    .html();
                if (respons.status == 'deleted') {
                    $(`button[data-id-post="${respons.id_post}"]`)
                        .children('.bi-suit-heart-fill')
                        .addClass('bi-suit-heart')
                        .removeClass('bi-suit-heart-fill');
                    $(`button[data-id-post="${respons.id_post}"]`)
                        .children('.like-count')
                        .html(parseInt(count) - 1);
                } else if (respons.status == 'created') {
                    $(`button[data-id-post="${respons.id_post}"]`)
                        .children('.bi-suit-heart')
                        .addClass('bi-suit-heart-fill')
                        .removeClass('bi-suit-heart');
                    $(`button[data-id-post="${respons.id_post}"]`)
                        .children('.like-count')
                        .html(parseInt(count) + 1);
                }
            },
        });
    });
});
