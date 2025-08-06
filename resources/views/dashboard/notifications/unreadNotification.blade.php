<x-dashboard.layout>
    <x-slot name="title">Notifications</x-slot>

    <x-flash-message/>

    <div class="container py-5">
        <div class="card shadow-lg rounded-4 border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top-4">
                <h3 class="mb-0"><i class="fas fa-bell m-2"></i> All Notifications Unread</h3>
            </div>
            <div>
                <a href="{{ route('notifications.index') }}" class="btn btn-outline-primary shadow m-2"><i class="fas fa-bell"></i> All Notifications</a>
            </div>
            <div class="card-body">
                <div class="list-group">
                {{ $notifications->withQueryString()->links() }}
                    @if($notifications->count() > 0)
                    @foreach ($notifications as $notification)
                    <div class="card mb-2 border border-2 {{ $notification->read_at ? 'border-light bg-light' : 'border-primary bg-white' }} shadow-sm rounded-4 p-4">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3" style="font-size: 22px;">
                                <strong>Title: </strong> {{ $notification->data['title'] ?? 'No Title' }}
                            </h5>
                            @if($notification->type !== 'App\Notifications\Project\ProjectDeleted')
                            <p class="card-text" style="font-size: 18px;">
                                <strong>Message: </strong><bdi>{{ $notification->data['body']['message'] ?? 'No Content' }}</bdi>
                            </p>
                            @endif

                            <p class="text-muted" style="font-size: 14px;">
                                <strong>notification send: </strong><bdi>{{ $notification->created_at->diffForHumans() }}</bdi>
                            </p>
                            @if ($notification->restore)
                            <p class="text-primary" style="font-size: 14px;">
                                <strong>notification restore: </strong><bdi>{{ $notification->restore->diffForHumans() }}</bdi>
                            </p>
                            @endif
                            @if ($notification->read_at)
                            <p class="text-success" style="font-size: 14px;">
                                <strong>notification read: </strong><bdi>{{ $notification->read_at->diffForHumans() }}</bdi>
                            </p>
                            @endif
                            <a class="btn btn-outline-primary px-4 py-2" style="font-size: 16px;"
                                href="{{ $notification->data['url'] }}?notification_id={{ $notification->id }}@if($notification->type == 'App\Notifications\Task\CommentAssigned')#comment-{{ $notification->data['id'] }}@endif">
                                <i class="fas fa-eye"></i> <b>Show</b>
                            </a>
                            <form action="{{ route('notifications.delete', $notification->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger px-4 py-2" style="font-size: 16px;">
                                    <i class="fas fa-trash"></i> <b>Delete</b>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="text-center text-muted py-5" style="font-size: 18px;">
                        No notifications found.
                    </div>
                    @endif
                    {{ $notifications->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>