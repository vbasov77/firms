// Save Comment
$(".save-comment").on('click', function () {
    var _comment = $(".comment").val();
    var _firm = $(this).data('firm');
    var vm = $(this);

    // Run Ajax
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/save_comment')",
        type: "post",
        dataType: 'json',
        data: {
            comment: _comment,
            firm: _firm,
        },

        beforeSend: function () {
            vm.text('Добавляем...').addClass('disabled');

        },
        success: function (res) {
            var _html = '<blockquote class="blockquote">\
            <small class="mb-0">' + _comment + '</small>\
            <br><small style="font-size: 10px" class="mb-0 text-left">' + res.date + '</small>\
            </blockquote><hr/>';
            if (res.bool == true) {
                $(".comments").prepend(_html);
                $(".comment").val('');
                $(".comment-count").text($('blockquote').length);
                $(".no-comments").hide();
            }
            vm.text('Добавить').removeClass('disabled');
        }
    });
});