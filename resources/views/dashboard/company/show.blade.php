<x-dashboard.layout>
    <x-slot name="title">
        <h1 class="h2">Show Comapny</h1>
    </x-slot>
    <x-slot name="scriptHead">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    </x-slot>

    <div class="container py-4">
        <div class="card">
            <div class="card-header">
                <h4>Company Details</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>ID:</strong> {{ $company->id }}
                    </div>
                    <div class="col-md-6">
                        <strong>Name:</strong> {{ $company->name }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>User Number:</strong> {{ $company->users()->count() }}
                    </div>
                    <div class="col-md-4">
                        <strong>Project Number:</strong> {{ $company->projects()->count() }}
                    </div>
                    <div class="col-md-4">
                        <strong>Tasks Number:</strong> {{ $company->projects()->withCount('tasks')->count() }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <img src="{{ asset('storage/' . $company->logo) }}" alt="logo">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div id="ProjectChartContainer" class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        Project Overview
                    </div>
                    <div class="card-body">
                        <canvas id="PinProjectChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div id="tasksChartContainer" class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        Tasks Overview
                    </div>
                    <div class="card-body">
                        <canvas id="PinTaskChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <x-slot name="scriptFooter">
            <script>
                const projectChart = @json($chartProject);
                const taskChart = @json($chartTasks);
            </script>
            <script src="{{ asset('dashboard/assets/js/project/chartProject.js') }}"></script>
        </x-slot>
</x-dashboard.layout>