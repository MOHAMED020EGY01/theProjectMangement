import "./bootstrap";
import {broadcastAlertProjectDeleted,} from "./broadcastAlert/broadcastProject";
import {broadcastAlertTaskDeleted,} from "./broadcastAlert/broadcastTask";
import {broadcastAlertTaskCreated,} from "./broadcastAlert/broadcastTask";
window.Echo.private(`App.Models.User.${userId}`).notification((data) => {
    console.log("broadcastAlertProjectDeleted in App");
    if(data.type === "App\\Notifications\\Project\\ProjectDeleted"){
        broadcastAlertProjectDeleted(data);
    }
    if(data.type === "App\\Notifications\\Task\\TaskDeleted"){
        broadcastAlertTaskDeleted(data);
    }
    if(data.type === "App\\Notifications\\Task\\TaskCreated"){
        broadcastAlertTaskCreated(data);
    }

    setTimeout(() => {
        $("#notificationLayout").fadeOut(1000, function () {
            $(this).empty().show();
        });
    }, 5000);

    let currentCount = parseInt($("#notificationCount").text()) || 0;
    let newCount = currentCount + 1;

    $("#notificationBell").addClass(
        "animate__animated animate__bounce animate__fast animate__infinite"
    );

    setTimeout(function () {
        $("#notificationBell").removeClass(
            "animate__animated animate__bounce animate__fast animate__infinite"
        );
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

window.Echo.join('online-users')
    .here(users => {
        users.forEach(user => {
            $(`#user-${user.id}`).text('Online');
        });
    })
    .joining(user => {
        $(`#user-${user.id}`).text('Online');
    })
    .leaving(user => {
        $(`#user-${user.id}`).text('Offline');
    });
