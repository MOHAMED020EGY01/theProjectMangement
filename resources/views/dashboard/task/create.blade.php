<x-dashboard.layout>
    <x-slot name="title">
        <h1 class="h2">Create Task</h1>
    </x-slot>

    <div class="container">
    <form id="formStore" action="{{ route('dashboard.project.tasks.store', $project_id) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <x-form.input 
                    label="title"
                    name="title" 
                    placeholder="Enter task title" 
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
                <x-form.input 
                    label="project" 
                    name="project_id" 
                    :value="$project_id"
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
        <button type="submit" class="btn btn-outline-success w-100 shadow mt-3">Create Task</button>
    </form>
</div>

<x-slot name="scriptFooter">
    <script src="{{ asset('dashboard/assets/js/StoreOrUpdate/Store.js') }}"></script>
</x-slot>
</x-dashboard.layout>