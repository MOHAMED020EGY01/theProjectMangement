<x-dashboard.layout>
    <x-slot name="title">
        <h1 class="h2">Edit Project</h1>
    </x-slot>

    <div class="container">
    <form action="{{ route('dashboard.project.update', $project->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-6">
                <x-form.input 
                    label="name"
                    name="name" 
                    placeholder="Enter project name" 
                    autofocus 
                    required 
                    :value="$project->name"
                />
            </div>

            <div class="col-md-6">
                <x-form.select 
                    label="status" 
                    name="status" 
                    :options="$status"
                    placeholder="Enter project status" 
                    required 
                    :oldvalue="$project->status"
                />
            </div>

            <div class="col-md-4">
                <x-form.select 
                    label="user" 
                    name="user_id" 
                    :options="$users"
                    placeholder="Enter project user" 
                    required 
                    :oldvalue="$project->user_id"
                />
            </div>

            <div class="col-md-4">
                <x-form.select 
                    label="company" 
                    name="company_id" 
                    :options="$companies"
                    placeholder="Enter project company" 
                    required 
                    :oldvalue="$project->company_id"
                />
            </div>


            <div class="col-md-4">
                <x-form.input 
                    type="date"
                    label="deadline" 
                    name="deadline" 
                    placeholder="Enter project deadline"
                    :value="$project->deadline" 
                    required 

                />
            </div>

            <div class="col-md-12">
                <x-form.textarea 
                    label="description" 
                    name="description" 
                    placeholder="Enter project description" 
                    required 
                    :value="$project->description"
                />
            </div>
        </div>
        <button type="submit" class="btn btn-outline-primary w-100 shadow mt-3">Update Project</button>
    </form>
</div>
</x-dashboard.layout>