<x-dashboard.layout>
    <x-slot name="title">
        Profile
    </x-slot>
    <x-flash-message/>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Profile</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('profile.update', $user_id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-6">
                <x-form.input
                    name="name"
                    label="Name"
                    type="text"
                    value="{{ $profile->name ?? '' }}"
                    required 
                    placeholder="Enter Name"/>
            </div>

            <div class="col-md-6">
                <x-form.input
                    name="phone"
                    label="Phone"
                    type="tel"
                    value="{{ $profile->phone ?? '' }}"
                    required 
                    placeholder="Enter Phone"/>
            </div>
            <div class="col-md-8">
                <x-form.input
                    name="address"
                    label="Address"
                    type="text"
                    value="{{ $profile->address ?? '' }}"
                    required 
                    placeholder="Enter Address"/>
            </div>
            <div class="col-md-4">
                <x-form.input
                    name="city"
                    label="City"
                    type="text"
                    value="{{ $profile->city ?? '' }}"
                    required 
                    placeholder="Enter City"/>
            </div>
            <div class="col-md-4">
                <x-form.input
                    name="state"
                    label="State"
                    type="text"
                    value="{{ $profile->state ?? '' }}"
                    required 
                    placeholder="Enter state"/>
            </div>

            <div class="col-md-4">
                <x-form.input
                    name="zip"
                    label="zip code"
                    type="text"
                    value="{{ $profile->zip ?? '' }}"
                    required 
                    placeholder="Enter zip code"/>
            </div>
            <div class="col-md-4">
                <x-form.select
                    name="country"
                    label="Country"
                    :options="$country"
                    :oldvalue="$profile->country ?? ''"
                    required />
            </div>
            <div class="col-md-4">
                <x-form.input
                    name="image"
                    label="Image"
                    type="file"
                    :value="$profile->image ?? ''"
                    required />
            </div>
        </div>
        <button type="submit" class="btn btn-outline-primary w-100 shadow mt-3">Update Profile</button>
    </form>
</x-dashboard.layout>