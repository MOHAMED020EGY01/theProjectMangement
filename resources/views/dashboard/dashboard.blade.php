<x-dashboard.layout>
    <x-slot name="scriptHead">
        <script src="{{ asset('https://cdn.jsdelivr.net/npm/chart.js') }}"></script>
    </x-slot>


    <x-slot name="title">
        <h1 class="h2">Dashboard Overview</h1>
    </x-slot>

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
    <x-slot name="scriptFooter">
        <script>

            const chart = @json($chart);
        </script>
        <script src="{{ asset('dashboard/assets/js/dashboard.js') }}"></script>
    </x-slot>
</x-dashboard.layout>