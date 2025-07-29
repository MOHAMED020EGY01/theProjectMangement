<x-dashboard.layout>
    <x-slot name="title">
        <h1 class="h2">Create Project</h1>
    </x-slot>

    <div class="container">
    <form action="{{ route('dashboard.project.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <x-form.input 
                    label="name"
                    name="name" 
                    placeholder="Enter project name" 
                    autofocus 
                    required 
                />
            </div>

            <div class="col-md-6">
                <x-form.select 
                    label="status" 
                    name="status" 
                    :options="$status"
                    placeholder="Enter project status" 
                    required 
                />
            </div>

            <div class="col-md-4">
                <x-form.select 
                    label="user" 
                    name="user_id" 
                    :options="$users"
                    placeholder="Enter project user" 
                    required 
                />
            </div>

            <div class="col-md-4">
                <x-form.select 
                    label="company" 
                    name="company_id" 
                    :options="$companies"
                    placeholder="Enter project company" 
                    required 
                />
            </div>


            <div class="col-md-4">
                <x-form.input 
                    type="date"
                    label="deadline" 
                    name="deadline" 
                    placeholder="Enter project deadline"
                    :value="now()->format('Y-m-d')" 
                    required 
                />
            </div>

            <div class="col-md-12">
                <x-form.textarea 
                    label="description" 
                    name="description" 
                    placeholder="Enter project description" 
                    required 
                />
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Create Project</button>
    </form>
</div>
</x-dashboard.layout>