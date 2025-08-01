<x-dashboard.layout>
    <x-slot name="title">
        <h1 class="h2">Show Task <strong>{{ $task->project->name }}</strong></h1>
    </x-slot>

    <div class="container py-4">
        <div class="card">
            <div class="card-header">
                <h4>Task Details</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>ID:</strong> {{ $task->id }}
                    </div>
                    <div class="col-md-6">
                        <strong>Name:</strong> {{ $task->title }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Status:</strong> {{ \App\Models\Task::STATUS[$task->status] ?? $task->status }}
                    </div>
                    <div class="col-md-6">
                        <strong>Assigned User:</strong> {{ $task->user->name ?? 'N/A' }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Company:</strong> {{ $task->project->company->name ?? 'N/A' }}
                    </div>
                    <div class="col-md-6">
                        <strong>Deadline:</strong>
                        @if($task->due_date->isFuture())
                        <span class="text-success">{{ $task->due_date->diffForHumans(now(), true) }} left until deadline</span>
                        @else
                        <span class="text-danger">{{ $task->due_date->diffForHumans(now(), true) }} overdue</span>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col">
                            <strong>Description:</strong>
                            <p class="mt-1">{{ $task->description }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Start Comment Section -->
            <div class="card mt-4">
                <div class="card-header">
                    <h4>Comments</h4>
                </div>
                <div class="card-body">
                    <!-- Flash Message -->
                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif


                    <div id="comment-success" class="alert alert-success d-none"></div>
                    <!-- Comment Form -->
                    <form id="comment-form" action="{{ route('tasks.comments.store', $task->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="content" class="form-label">Add a Comment:</label>
                            <textarea name="content" id="comment-content" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Comment</button>
                    </form>


                    <!-- Existing Comments -->
                    <hr>
                    <h6 class="mb-3">Previous Comments</h6>

                    <div id="comment-list">
                        @forelse ($task->comments as $comment)
                        <div class="border rounded p-2 mb-2">
                            <strong>{{ $comment->user->name }}</strong>
                            <span class="text-muted small">{{ $comment->created_at->diffForHumans() }}</span>
                            <p class="mb-0">{{ $comment->content }}</p>
                        </div>
                        @empty
                        <p class="text-muted">No comments yet.</p>
                        @endforelse
                    </div>

                </div>
            </div>
            <!-- End Comment Section -->

        </div>
        <x-slot name="scriptFooter">
            <script>
                function setupCommentForm() {
                    $('#comment-form').one('submit', function(e) {
                        e.preventDefault();

                        const $form = $(this);
                        const $button = $form.find('button[type="submit"]');

                        $button.prop('disabled', true).html(`
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Commenting...
                        `);

                        $.ajax({
                            url: $form.attr('action'),
                            method: 'POST',
                            data: $form.serialize(),
                            success: function(response) {
                                $('#comment-success')
                                    .text('Comment added successfully.')
                                    .removeClass('d-none');

                                $('#comment-list').prepend(`
                        <div class="border rounded p-2 mb-2">
                            <strong>${response.user_name}</strong>
                            <span class="text-muted small">just now</span>
                            <p class="mb-0">${response.content}</p>
                        </div>
                    `);

                                $('#comment-content').val('');
                            },
                            error: function() {
                                alert('Failed to submit comment');
                            },
                            complete: function() {
                                $button.prop('disabled', false).text('Comment');
                                setupCommentForm();
                            }
                        });
                    });
                }
                setupCommentForm();
            </script>
        </x-slot>
</x-dashboard.layout>