<div class="dropdown position-relative ">
    <button id="notificationBell" class="btn btn-light position-relative dropdown-toggle " type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-solid fa-bell fa-lg"></i>
        @if($count > 0)
        <span id="notificationCount" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{ $count }}
            <span class="visually-hidden">unread notifications</span>
        </span>
        @endif
    </button>

    <ul id="notificationNav" class="dropdown-menu dropdown-menu-end p-2" style="width: 300px; max-height: 400px; overflow-y: auto;">

        @if($count > 0)
        @foreach ($notifications as $notification)

        <li class="mb-2">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-2">
                    @if ($notification->type !== 'App\Notifications\Project\ProjectDeleted')
                    <div class="fw-bold text-primary">
                        <strong>Title: </strong>{{ $notification->data['title'] }}
                    </div>
                    @else
                    <div class="fw-bold text-danger">
                        <strong>Title: </strong>{{ $notification->data['title'] }}
                    </div>
                    @endif
                    <div class="text-muted small"><strong>Name: </strong>{{ $notification->data['body']['name'] }}</div>

                    @if($notification->type !== 'App\Notifications\Project\ProjectDeleted')
                    <div class="text-muted small"><strong>Deadline: </strong>{{ $notification->data['body']['deadline'] }}</div>
                    <div class="text-muted small"><strong>Message: </strong>{{ $notification->data['body']['message'] }}</div>
                    @endif

                    <a href="{{ $notification->data['url'] }}?notification_id={{ $notification->id }}
                @if($notification->type == 'App\Notifications\Task\comment')
                    #comment-{{ $notification->data['id'] }}
                @endif ">
                        <strong>Show</strong>
                    </a>

                    <div class="text-muted small">{{ $notification->created_at->diffForHumans() }}</div>
                </div>
            </div>
        </li>
        @endforeach

        @else
        <li>
            <div class="text-center text-muted">No notifications</div>
        </li>
        @endif
        <li class="text-center small">
            <a href="{{ route('notifications.index') }}" class="text-decoration-none ">View All Notifications</a>
        </li>
    </ul>
</div>