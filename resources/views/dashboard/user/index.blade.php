<x-dashboard.layout>
    <x-slot name="title">
        Users
    </x-slot>
    <div class="container">
            <x-flash-message />
    
            @if($users->isEmpty())
            <div class="alert alert-info">No users found.</div>
            @else
            <div class="table-responsive shadow rounded overflow-hidden">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
    
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td> <a style="text-decoration-line: none;" href="{{ route('profile.show', $user->id) }}">{{ $user->name }}</a></td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->diffForHumans() }}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>

</x-dashboard.layout>
