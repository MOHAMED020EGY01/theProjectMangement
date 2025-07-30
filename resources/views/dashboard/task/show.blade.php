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
        </div>
</x-dashboard.layout>