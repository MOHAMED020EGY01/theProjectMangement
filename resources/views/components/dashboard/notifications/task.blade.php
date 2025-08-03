<div class="dropdown position-relative ">
    <button id="notificationBell" class="btn btn-light position-relative dropdown-toggle " type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-solid fa-bell fa-lg"></i>
        @if($notifications->count() > 0)
        <span id="notificationCount" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{ $notifications->count() }}
            <span class="visually-hidden">unread notifications</span>
        </span>
        @endif
    </button>

    <ul id="notificationNav" class="dropdown-menu dropdown-menu-end p-2" style="width: 300px; max-height: 400px; overflow-y: auto;">

        @if($notifications->count() > 0)
        @foreach ($notifications as $notification)

        <!---------       TaskAssigned --   Notifications   --------------->

        @if ($notification->type == 'App\Notifications\TaskAssigned')
        <li class="mb-2">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-2">
                    <div class="fw-bold text-primary"><strong>Title: </strong>{{ $notification->data['title'] }}</div>
                    <div class="text-muted small"><strong>Name: </strong>{{ $notification->data['body']['name'] }}</div>
                    <div class="text-muted small"><strong>Deadline: </strong>{{ $notification->data['body']['deadline'] }}</div>
                    <div class="text-muted small"><strong>Message: </strong>{{ $notification->data['body']['message'] }}</div>
                    <a href="{{ $notification->data['url'] }}"><strong>view</strong></a>
                    <div class="text-muted small">{{ $notification->created_at->diffForHumans() }}</div>
                </div>
            </div>
        </li>
        @endif
        <!---------       CommentAssigned --   Notifications   --------------->
        @if ($notification->type == 'App\Notifications\CommentAssigned')
        <li class="mb-2">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-2">
                    <div class="fw-bold text-primary"><strong>Title: </strong>{{ $notification->data['title'] }}</div>
                    <div class="text-muted small"><strong>Name: </strong>{{ $notification->data['body']['name'] }}</div>
                    <div class="text-muted small"><strong>Deadline: </strong>{{ $notification->data['body']['deadline'] }}</div>
                    <div class="text-muted small"><strong>Message: </strong>{{ $notification->data['body']['message'] }}</div>
                    <a href="{{ $notification->data['url'] }}?notification_id={{ $notification->id }}#comment-{{ $notification->data['id'] }}"><strong>view</strong></a>
                    <div class="text-muted small">{{ $notification->created_at->diffForHumans() }}</div>
                </div>
            </div>
        </li>
        @endif
        <!---------       ProjectAlert --   Notifications   --------------->
        @if ($notification->type == 'App\Notifications\ProjectAlert')
        <li class="mb-2">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-2">
                    <div class="fw-bold text-primary"><strong>Title: </strong>{{ $notification->data['title'] }}</div>
                    <div class="text-muted small"><strong>Name: </strong>{{ $notification->data['body']['name'] }}</div>
                    <div class="text-muted small"><strong>Deadline: </strong>{{ $notification->data['body']['deadline'] }}</div>
                    <a href="{{ $notification->data['url'] }}"><strong>view</strong></a>
                    <div class="text-muted small">{{ $notification->created_at->diffForHumans() }}</div>
                </div>
            </div>
        </li>
        @endif

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