<x-dashboard.layout>
    <x-slot name="title">
        <h1 class="h2">Company</h1>
    </x-slot>
    <x-flash-message />

<div class="d-flex mb-3">
    <a href="{{ route('dashboard.company.create') }}" class="btn btn-primary">Create Company</a>
</div>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Logo</th>
            <th>Name</th>
            <th>Users</th>
            <th>Projects</th>
            <th>create at</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @if ($companies->isEmpty())
        <tr>
            <td colspan="8" class="text-center">No companies found.</td>
        </tr>
        @endif
        @foreach ($companies as $company)
        <tr class="hover:bg-gray-100" style="table-layout: fixed;">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $company->logo }}</td>
            <td><a href="{{ route('dashboard.company.show', $company->id) }}">{{ $company->name }}</a></td>
            <td>{{ $company->users->count() }}</td>
            <td>{{ $company->projects->count() }}</td>
            <td>{{ $company->created_at->format('Y-m-d') }}</td>
            <td>
                <a href="{{ route('dashboard.company.edit', $company->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                <form action="{{ route('dashboard.company.destroy', $company->id) }}" method="POST" class="d-inline delete-form">
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

{{ $companies->withQueryString()->links() }}

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