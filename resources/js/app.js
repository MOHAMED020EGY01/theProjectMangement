import "./bootstrap";
window.Echo.private(`App.Models.User.${userId}`).notification((data) => {
    $("#notificationLayout").append(`
        <div class="alert shadow rounded border-0 bg-light position-relative overflow-hidden p-4 mb-3" style="box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h5 class="text-primary fw-bold mb-1">${data.title}</h5>
                    <small class="text-muted"><strong>Name: </strong>${data.body.name}</small>
                </div>
                <a href="${data.url}?notification_id=${data.comment_id}#comment-${data.comment_id}" class="btn btn-sm btn-outline-primary">View</a>
            </div>
            <p class="mb-1"><strong>Deadline:</strong> ${data.body.deadline}</p>
            <p class="text-dark"><strong>Message:</strong> ${data.body.message}</p>
    
            <!-- Progress Bar -->
            <div class="progress mt-3" style="height: 6px; border-radius: 3px;">
                <div class="progress-bar bg-info progress-bar-striped progress-bar-animated"
                    role="progressbar"
                    style="width: 100%; transition: width 5s linear;">
                </div>
            </div>
        </div>
    `);

    setTimeout(() => {
        $("#notificationLayout").fadeOut(1000, function () {
            $(this).empty().show();
        });
    }, 5000);

    $("#notificationNav").prepend(`
    <li class="mb-2">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-2">
                    <div class="fw-bold text-primary"><strong>Title: </strong>${data.title}</div>
                    <div class="text-muted small"><strong>Name: </strong>${data.body.name}</div>
                    <div class="text-muted small"><strong>Deadline: </strong>${data.body.deadline}</div>
                    <div class="text-muted small"><strong>Message: </strong>${data.body.message}</div>
                    <a href="${data.url}?notification_id=${data.comment_id}#comment-${data.comment_id}"><strong>view</strong></a>
                    <div class="text-muted small">Broadcast</div>
                </div>
            </div>
    </li>
    `);

    let currentCount = parseInt($("#notificationCount").text()) || 0;
    let newCount = currentCount + 1;

    $("#notificationBell").addClass("animate__animated animate__bounce animate__fast animate__infinite");

    setTimeout(function () {
        $("#notificationBell").removeClass("animate__animated animate__bounce animate__fast animate__infinite");
    }, 3000);
    
    if ($("#notificationCount").length) {
        $("#notificationCount").text(newCount);
    } else {
        $(".fa-bell").after(`
            <span id="notificationCount" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary shadow-sm">
                ${newCount}
                <span class="visually-hidden">unread notifications</span>
            </span>
        `);
    }
});
