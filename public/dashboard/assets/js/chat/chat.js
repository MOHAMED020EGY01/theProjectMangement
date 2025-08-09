$(function() {
    $('.user-item').click(function() {
        $('#messages').empty();
        $('.user-item').removeClass('active');
        $(this).addClass('active');
        const userId = $(this).data('id');
        $.ajax({
            method: 'GET',
            url: '/chat/messages/' + userId + '/show',
            beforeSend: function() {
                $('#messages').append('<div id="loading">Loading...</div>');
            },
            success: function(response) {
                console.log(response);
                $('#chatName').text(response.user);
            
                response.data.forEach(msg => {
                    let isMine = msg.sender_id === Number($('meta[name="user-id"]').attr('content'));
                    $('#messages').append(`
                        <div style="width: fit-content; ${isMine ? 'margin-left:auto;' : ''}" 
                            class="p-2 rounded text-white ${isMine ? 'bg-success' : 'bg-primary'}">
                            <span><bdi>${msg.content}</bdi></span>
                        </div>
                        <br>
                    `);
                });
            },
            complete: function() {
                $('#loading').remove();
            }
        });
    })
    $("#chatForm").submit(function(e) {
        e.preventDefault();
        const content = $(this).find('#contentInput').val();
        const userId = $('.user-item.active').data('id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: '/chat/send/' + userId,
            data: {
                content: content
            },
            beforeSend: function() {
                $('#buttonChat').prop('disabled', true);
            },
            success: function(response) {
                $('#messages').append(`
                    <div style="width: fit-content; margin-left:auto;" 
                        class="p-2 rounded text-white bg-success">
                        <span><bdi>${response.content}</bdi></span>
                    </div>
                    <br>
                `);
                $('#contentInput').val('');
            },
            error: function(xhr, status, error) {
                alert(error);
                console.error(error);
            },
            complete: function() {
                $('#buttonChat').prop('disabled', false);
            }
        });
    })

});