<x-dashboard.layout>
    <x-slot name="title">
        Profile test
    </x-slot>

    <x-slot name="style">
        <!-- Tagify  -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
    </x-slot>


    <x-flash-message />
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
    <div class="row">
        <div class="col-md-4">
            <div class="row">

                <div class="col-md-5">

                    <img src="{{ $profile?->image_profile ?? asset('defaultImage/profile/default.jpg') }}"" alt="Profile Image"
                        class="m-3 img-fluid rounded-circle border border-3 border-primary"
                        style="width: 150px; height: 150px; object-fit: cover; ">
                </div>
                <div  class="col-md-2 d-flex align-items-center justify-content-center">
                    <span>
                    <i id="imageSwap" class="fa-solid fa-arrow-left-long"></i>
                    </span>
                </div>
                <div class="col-md-5">

                    <img id="imagePreview" src="" alt="Preview" style="width: 150px; height: 150px; object-fit: cover; "
                        class="m-3 img-fluid rounded-circle border border-3 border-primary">
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
                    placeholder="Enter Name" />
            </div>

            <div class="col-md-6">
                <x-form.input
                    name="phone"
                    label="Phone"
                    type="tel"
                    value="{{ $profile->phone ?? '' }}"
                    required
                    placeholder="Enter Phone" />
            </div>
            <div class="col-md-8">
                <x-form.input
                    name="address"
                    label="Address"
                    type="text"
                    value="{{ $profile->address ?? '' }}"
                    required
                    placeholder="Enter Address" />
            </div>
            <div class="col-md-4">
                <x-form.input
                    name="city"
                    label="City"
                    type="text"
                    value="{{ $profile->city ?? '' }}"
                    required
                    placeholder="Enter City" />
            </div>
            <div class="col-md-4">
                <x-form.input
                    name="state"
                    label="State"
                    type="text"
                    value="{{ $profile->state ?? '' }}"
                    required
                    placeholder="Enter state" />
            </div>

            <div class="col-md-4">
                <x-form.input
                    name="zip"
                    label="zip code"
                    type="text"
                    value="{{ $profile->zip ?? '' }}"
                    required
                    placeholder="Enter zip code" />
            </div>
            <div class="col-md-4">
                <x-form.select
                    name="country"
                    label="Country"
                    :options="$country"
                    :oldvalue="$profile->country ?? ''"
                    required />
            </div>
            <div class="col-md-4" id="image">
                <x-form.input
                    id="imageInput"
                    name="image"
                    label="Image"
                    type="file" />
            </div>

            <div class="col-md-4">
                <x-form.input
                    id="tags"
                    name="tags"
                    label="Tags"
                    type="text"
                    value="{{ $profile->tags->pluck('name')->implode(',') }}"
                    required
                    placeholder="Enter tags" />
            </div>
        </div>
        <button type="submit" class="btn btn-outline-primary w-100 shadow mt-3">Update Profile</button>
    </form>
    <x-slot name="scriptFooter">
        <!-- Tagify -->
        <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
        <script>
            $(document).ready(function() {
                let input = document.getElementById('tags');
                let tagify = new Tagify(input, {
                    delimiters: ",| ",
                    maxTags: 8,
                });
            });
        </script>
    <script>
        $(function() {
            $('#imagePreview').hide();
            $('#imageSwap').hide();

            $('#imageInput').change(function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview')
                            .attr('src', e.target.result)
                            .show(1000);   
                        $('#imageSwap').show(1000);
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
    </x-slot>

</x-dashboard.layout>