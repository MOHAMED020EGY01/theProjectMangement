<x-dashboard.layout>
    <x-slot name="title">Notifications</x-slot>

    <div class="container py-5">
        <div class="card shadow-lg rounded-4 border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top-4">
                <h3 class="mb-0">📬 All Notifications</h3>
            </div>
            <div class="card-body">
                <div class="list-group">
                    @if($notifications->count() > 0)
                        @foreach ($notifications as $notification)
                            <div class="card mb-2 border border-2 {{ $notification->read_at ? 'border-light bg-light' : 'border-primary bg-white' }} shadow-sm rounded-4 p-4">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold mb-3" style="font-size: 22px;">
                                        {{ $notification->data['title'] ?? 'No Title' }}
                                    </h5>
                                    <p class="card-text" style="font-size: 18px;">
                                        {{ $notification->data['body']['message'] ?? 'No Content' }}
                                    </p>
                                    <p class="text-muted" style="font-size: 14px;">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </p>
                                    <a class="btn btn-outline-primary px-4 py-2" style="font-size: 16px;"
                                        href="{{ $notification->data['url'] }}?notification_id={{ $notification->id }}#comment-{{ $notification->data['id'] }}">
                                        👁️ View
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center text-muted py-5" style="font-size: 18px;">
                            No notifications found.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>
