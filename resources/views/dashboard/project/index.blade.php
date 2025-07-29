<x-dashboard.layout>
    <x-slot name="title">
        <h1 class="h2">Projects</h1>
    </x-slot>

    <x-flash-message />

    <div class="d-flex mb-3">
        <a href="{{ route('dashboard.project.create') }}" class="btn btn-primary">Create Project</a>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
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
                <td>{{ $project->status }}</td>
                <td>{{ $project->company->name }}</td>
                <td>{{ $project->user->name }}</td>
                <td>{{ $project->deadline->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('dashboard.project.edit', $project->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                    <form action="{{ route('dashboard.project.destroy', $project->id) }}" method="POST" class="d-inline delete-form">
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