<x-dashboard.layout>
    <x-slot name="title">
        <h1 class="h2">Tasks</h1>
    </x-slot>
    <x-slot name="style">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    </x-slot>

    <div class="container">
        <x-flash-message />

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h5"><strong>Name Project: </strong>{{ $tasks->first()->project->name }}</h2>
            <a href="{{ route('dashboard.project.tasks.create', $project_id) }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Create Task
            </a>
        </div>

        @if($tasks->isEmpty())
        <div class="alert alert-info">No tasks found for this project.</div>
        @else
        <div class="table-responsive shadow rounded overflow-hidden">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Deadline</th>
                        <th>User Name</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($tasks as $task)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td> <a href="{{ route('dashboard.project.tasks.show', [$task->project->id, $task->id]) }}">{{ $task->title }}</a></td>
                        <td>
                            <span class="badge bg-{{ $task->status === 'done' ? 'success' : ($task->status === 'in_progress' ? 'warning' : 'secondary') }}">
                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                            </span>
                        </td>
                        <td>
                            {{ $task->due_date->diffForHumans() }}
                            <br>
                            <small class="text-muted">{{ $task->due_date->format('Y-m-d') }}</small>
                        </td>
                        <td>
                            <span class="badge bg-success">
                                {{ ucfirst($task->user->name) }}
                            </span>
                        </td>
                        <td>{{ $task->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="{{ route('dashboard.project.tasks.edit', [$project_id, $task->id]) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form action="{{ route('dashboard.project.tasks.destroy', [$project_id, $task->id]) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn-delete text-danger" style="border: none; background: transparent;">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    <x-slot name="scriptFooter">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.btn-delete').forEach(button => {
                    button.addEventListener('click', function() {
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.closest('form').submit();
                            }
                        })
                    });
                });
            });
        </script>
    </x-slot>
</x-dashboard.layout>