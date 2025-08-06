/**
 * summary broadcastAlertComment()
 * @pram data
 * @void
 * 
 */




/**
 * summary broadcastAlertProejctDeleted()
 * @pram data
 * @void
 * 
 */
console.log("before Function broadcastAlertProjectDeleted");

export function broadcastAlertProjectDeleted(data) {
console.log("in Function broadcastAlertProjectDeleted");
console.log(data.type);

    if (data.type === "App\\Notifications\\Project\\ProjectDeleted") {
console.log("in IF Function broadcastAlertProjectDeleted");

        $("#notificationLayout").append(`
            <div class="alert shadow rounded border-0 bg-light position-relative overflow-hidden p-4 mb-3" style="box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h5 class="text-danger fw-bold mb-1">${data.title}</h5>
                        <small class="text-muted"><strong>Name: </strong>${data.body.name}</small>
                    </div>
                    <a href="${data.url}?notification_id=${data.Alert_id}" class="btn btn-sm btn-outline-primary">View</a>
                </div>
        
                <!-- Progress Bar -->
                <div class="progress mt-3" style="height: 6px; border-radius: 3px;">
                    <div class="progress-bar bg-info progress-bar-striped progress-bar-animated"
                        role="progressbar"
                        style="width: 100%; transition: width 5s linear;">
                    </div>
                </div>
            </div>
        `);

        $("#notificationNav").prepend(`
            <li class="mb-2">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-2">
                            <div class="fw-bold text-primary"><strong>Title: </strong>${data.title}</div>
                            <div class="text-muted small"><strong>Name: </strong>${data.body.name}</div>
                            <a href="${data.url}?notification_id=${data.Alert_id}"><strong>view</strong></a>
                            <div class="text-muted small">Broadcast</div>
                        </div>
                    </div>
            </li>
            `);
    }
}
