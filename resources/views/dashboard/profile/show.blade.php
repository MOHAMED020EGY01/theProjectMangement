<x-dashboard.layout>
    <x-slot name="title">
        Profile
    </x-slot>
    <x-slot name="style">
        <style>
            .card {
                background: linear-gradient(145deg, #ffffff, #f5f5f5);
            }
            .card h3 {
                color: #2c3e50;
            }
            .card strong {
                color: #34495e;
            }
        </style>
    </x-slot>
    <div class="container py-5">
        <div class="card shadow-lg border-0 rounded-4 p-4" style="max-width: 700px; margin: auto;">
            <div class="row g-4 align-items-center">
                <div class="col-md-4 text-center">
                    <img src="{{ asset('storage/' . optional($profile)->image) ?? 'https://via.placeholder.com/150' }}" 
                         alt="Profile Image" 
                         class="img-fluid rounded-circle border border-3 border-primary" 
                         style="width: 150px; height: 150px; object-fit: cover;">
                </div>


                <div class="col-md-8">
                    <h3 class="fw-bold mb-3">{{ $profile->user->name ?? 'N/A' }}</h3>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><strong>Phone:</strong> {{ $profile->phone ?? 'N/A'}}</li>
                        <li class="mb-2"><strong>Address:</strong> {{ $profile->address ?? 'N/A'}}</li>
                        <li class="mb-2"><strong>City:</strong> {{ $profile->city ?? 'N/A'}}</li>
                        <li class="mb-2"><strong>State:</strong> {{ $profile->state ?? 'N/A'}}</li>
                        <li class="mb-2"><strong>Zip Code:</strong> {{ $profile->zip ?? 'N/A'}}</li>
                        <li class="mb-2"><strong>Country:</strong> {{ $profile->country ?? 'N/A'}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>



</x-dashboard.layout>
