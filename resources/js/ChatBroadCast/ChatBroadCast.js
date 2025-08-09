export function chatBroadCast() {
    $(function () {
        $(".user-item").click(function () {
            $(".user-item").removeClass("active");
            $(this).addClass("active");
            const currentUserId = $("meta[name='user-id']").attr("content");
            const otherUserId = $(".user-item.active").data("id");
            window.Echo.private(`chat.${currentUserId}.${otherUserId}`).listen(
                ".message.sent",
                (e) => {
                    console.log(e);
                    console.log(otherUserId);
                    console.log(e.message.receiver_id);
                    console.log(e.message.sender_id);
                    console.log(e.message.content);

                    if (e.message.receiver_id == currentUserId) {
                        $("#messages").append(`
                    <div style="width: fit-content; margin-right:auto;" 
                        class="p-2 rounded text-white bg-primary">
                        <span><bdi>${e.message.content}</bdi></span>
                    </div>
                `);
                    }
                }
            );
        });
    });
}
