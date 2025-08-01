<x-dashboard.layout>
    <x-slot name="title">
        <h1 class="h2">Edit Task</h1>
    </x-slot>

    <div class="container">
    <form action="{{ route('dashboard.project.tasks.update', [$task->project->id,$task->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-6">
                <x-form.input 
                    label="title"
                    name="title" 
                    placeholder="Enter task title" 
                    autofocus 
                    required 
                    :value="$task->title"
                />
            </div>

            <div class="col-md-6">
                <x-form.select 
                    label="status" 
                    name="status" 
                    :options="$status"
                    placeholder="Enter project status" 
                    required 
                    :oldvalue="$task->status"
                />
            </div>
            <div class="col-md-4">
                <x-form.select 
                    label="user" 
                    name="user_id" 
                    :options="$users"
                    placeholder="Enter project user" 
                    required 
                    :oldvalue="$task->user_id"
                />
            </div>

            <div class="col-md-4">
                <x-form.input 
                    label="project" 
                    name="project_id" 
                    :value="$task->project->id"
                    placeholder="Enter project project" 
                    required 
                />
            </div>

            <div class="col-md-4">
                <x-form.input 
                    type="date"
                    label="due_date" 
                    name="due_date" 
                    placeholder="Enter project due_date"
                    :value="$task->due_date->format('Y-m-d')" 
                    required 
                />
            </div>

            <div class="col-md-12">
                <x-form.textarea 
                    label="description" 
                    name="description" 
                    placeholder="Enter project description" 
                    required 
                    :value="$task->description"
                />
            </div>
        </div>
        <button type="submit" class="btn btn-outline-primary w-100 shadow mt-3">Update Project</button>
    </form>
</div>
</x-dashboard.layout>