<x-dashboard.layout>
    <x-slot name="title">
        <h1 class="h2">Projects</h1>
    </x-slot>

    <x-flash-message/>

    <div class="d-flex mb-3">
        <a href="{{ route('dashboard.project.create') }}" class="btn btn-primary">Create Project</a>
    </div>
    
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Company</th>
                <th>User</th>
                <th>Deadline</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if ($projects->isEmpty())
                <tr>
                    <td colspan="8" class="text-center">No projects found.</td>
                </tr>
            @endif
            @foreach ($projects as $project)
            <tr class="hover:bg-gray-100" style="table-layout: fixed;">
                <td>{{ $loop->iteration }}</td>
                <td><a href="{{ route('dashboard.project.show', $project->id) }}">{{ $project->name }}</a></td>
                <td>{{ $project->description }}</td>
                <td>{{ $project->status }}</td>
                <td>{{ $project->company->name }}</td>
                <td>{{ $project->user->name }}</td>
                <td>{{ $project->deadline }}</td>
                <td>
                    <a href="{{ route('dashboard.project.edit', $project->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                    <form action="{{ route('dashboard.project.destroy', $project->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-danger" style="outline: none; border: none;"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>



</x-dashboard.layout>