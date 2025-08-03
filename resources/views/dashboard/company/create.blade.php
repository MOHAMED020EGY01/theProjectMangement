<x-dashboard.layout>
    <x-slot name="title">
        <h1 class="h2">Create Company</h1>
    </x-slot>
    <form action="{{ route('dashboard.company.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <x-form.input name="name" label="Company Name" placeholder="Enter Company Name" type="text" autofocus required />
            </div>
            <div class="col-md-6">
                <x-form.input name="logo" label="Company Logo" type="file" required />
            </div>
        </div>
        <button type="submit" class="btn btn-outline-success w-100 shadow mt-3">Create Company</button>
    </form>
</x-dashboard.layout>