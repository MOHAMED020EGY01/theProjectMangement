<div class="dropdown position-relative">
    <button class="btn btn-light position-relative dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-solid fa-bell fa-lg"></i>
        @if($notifications->count() > 0)
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{ $notifications->count() }}
            <span class="visually-hidden">unread notifications</span>
        </span>
        @endif
    </button>

    <ul class="dropdown-menu dropdown-menu-end p-2" style="width: 300px; max-height: 400px; overflow-y: auto;">
        @forelse ($notifications as $notification)
        @if ($notification->type == 'App\Notifications\TaskAssigned')
        <li class="mb-2">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-2">
                    <div class="fw-bold text-primary">{{ $notification->data['assigned_by'] }}</div>
                    <div class="text-muted small">{{ $notification->data['task_title'] }}</div>
                    <div class="text-muted small">{{ $notification->created_at->diffForHumans() }}</div>
                </div>
            </div>
        </li>
        @endif

        @if ($notification->type == 'App\Notifications\CommentAssigned')
        <li class="mb-2">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-2">
                    <div class="fw-bold text-primary">{{ $notification->data['commented_by'] }}</div>
                    <div class="text-muted small">{{ $notification->data['task_title'] }}</div>
                    <div class="text-muted small">{{ $notification->created_at->diffForHumans() }}</div>
                </div>
            </div>
        </li>
        @endif
        @empty
        <li>
            <div class="text-center text-muted">No notifications</div>
        </li>
        @endforelse
    </ul>
</div>