<x-dashboard.layout>
    <x-slot name="title">
        <h1 class="h2">Show Project</h1>
    </x-slot>

    <div class="container py-4">
        <div class="card">
            <div class="card-header">
                <h4>Project Details</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>ID:</strong> {{ $project->id }}
                    </div>
                    <div class="col-md-6">
                        <strong>Name:</strong> {{ $project->name }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Status:</strong> {{ \App\Models\Project::STATUS[$project->status] ?? $project->status }}
                    </div>
                    <div class="col-md-6">
                        <strong>Assigned User:</strong> {{ $project->user->name ?? 'N/A' }}
                    </div>
                    <div class="col-md-6">
                        <strong><a style="color: #007bff; text-decoration: none;" href="{{ route('dashboard.project.tasks.index', $project->id) }}">Tasks:</a></strong> {{ $project->tasks->count() }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Company:</strong> {{ $project->company->name ?? 'N/A' }}
                    </div>
                    <div class="col-md-6">
                            <strong>Deadline:</strong>
                            @if($deadline->isFuture())
                            <span class="text-success">{{ $deadline->diffForHumans($now, true) }} left until deadline</span>
                            @else
                            <span class="text-danger">{{ $deadline->diffForHumans($now, true) }} overdue</span>
                            @endif

                    </div>

                    <div class="row">
                        <div class="col">
                            <strong>Description:</strong>
                            <p class="mt-1">{{ $project->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-dashboard.layout>