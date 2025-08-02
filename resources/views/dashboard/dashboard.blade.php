<x-dashboard.layout>
    <x-slot name="scriptHead">
        <script src="{{ asset('https://cdn.jsdelivr.net/npm/chart.js') }}"></script>
    </x-slot>


    <x-slot name="title">
        <h1 class="h2">Dashboard Overview</h1>
    </x-slot>

    <div class="row">


        <div class="col-md-6">
            <div id="tasksChartContainer" class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    Project is Overview
                </div>
                <div class="card-body">
                    <canvas id="PinChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Deadline</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($projects->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center">No projects found.</td>
                    </tr>
                    @endif
                    @foreach ($projects as $project)
                    <tr class="hover:bg-gray-100">
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('dashboard.project.show', $project->id) }}">{{ $project->name }}</a></td>
                        <td>{{ $project->status }}</td>
                        <td class="text-danger">
                        <small class="text-danger">{{ $project->deadline->diffForHumans() }}</small>
                        </td>
                        <td>
                            <a href="{{ route('dashboard.project.edit', $project->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <x-slot name="scriptFooter">
        <script>
            const chart = @json($chart);
        </script>
        <script src="{{ asset('dashboard/assets/js/dashboard.js') }}"></script>
    </x-slot>
</x-dashboard.layout>