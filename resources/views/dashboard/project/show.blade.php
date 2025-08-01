<x-dashboard.layout>
    <x-slot name="title">
        <h1 class="h2">Show Project</h1>
    </x-slot>
    <x-slot name="scriptHead">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

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
                        <strong><a style="color: #007bff; text-decoration: none;" href="{{ route('dashboard.project.tasks.index', [$project->id,$project->name]) }}">Tasks:</a></strong> {{ $project->tasks->count() }}
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
            <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar"
                        style="width:{{ $project->progress_percentage }}%;"
                        aria-valuenow="{{ $project->progress_percentage }}" aria-valuemin="0" aria-valuemax="100">
                        {{ $project->progress_percentage }}%
                    </div>
                </div>
            <div class="col-md-8">
                <div id="tasksChartContainer" class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        Tasks Overview
                    </div>
                    <div class="card-body">
                        <canvas id="PinChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <x-slot name="scriptFooter">
            <script>
                const chart = @json($chart);
            </script>
            <script src="{{ asset('dashboard/assets/js/project/chartProject.js') }}"></script>
        </x-slot>
</x-dashboard.layout>