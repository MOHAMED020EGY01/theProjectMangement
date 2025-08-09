<x-dashboard.layout>
    <x-slot name="title">
        <h1 class="h2">Chat Message</h1>
    </x-slot>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <h5>Users</h5>
                <ul class="list-group" id="userList">
                    @foreach($users as $user)
                    <li id="{{ $user->id }}" class="list-group-item user-item " style="cursor: pointer;" data-id="{{ $user->id }}">
                        <img src="{{ $user->profile->image_profile ?? asset('defaultImage/profile/default.jpg') }}" alt="Profile Image" class="rounded-circle m-1" style="width: 25px; height: 25px; object-fit: cover;">
                        {{ $user->name }}
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Chat with <span><bdi id="chatName"></bdi></span></div>
                    <div id="chatBox" class="mb-3" style="height: 50vh; overflow-y: auto; background-color: #f8f9fa;padding: 10px;border-radius: 5px;">
                        <div id="messages">

                        </div>
                    </div>

                    <div class="card-footer">
                        <form id="chatForm">
                            <div class="input-group">
                                <input type="text" name="content" id="contentInput" class="form-control" placeholder="Type a message...">
                                <button id="buttonChat" type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scriptFooter">
        <script src="{{ asset('dashboard/assets/js/chat/chat.js') }}"></script>
    </x-slot>
</x-dashboard.layout>