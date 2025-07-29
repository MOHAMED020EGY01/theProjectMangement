<x-dashboard.layout>
    <x-slot name="title">
        <h1 class="h2">Tasks</h1>
    </x-slot>

    <div class="container">
        <x-flash-message />
        <div class="d-flex mb-3">
            <a href="{{ route('dashboard.project.tasks.create', $project_id) }}" class="btn btn-primary">Create Task</a>
        </div>

    </div>

</x-dashboard.layout>