<x-dashboard.layout>
    <x-slot name="title">
        <h1 class="h2">Chat</h1>
    </x-slot>
    <x-slot name="style">
        <style>
            #chatBox {
                background-color: #f8f9fa;
                padding: 10px;
                border-radius: 5px;
            }

            .bg-success {
                background-color: #28a745 !important;
            }

            .bg-primary {
                background-color: #007bff !important;
            }

            .text-end {
                text-align: right;
            }

            .text-start {
                text-align: left;
            }
        </style>

    </x-slot>
    <div class="container py-4">
        <div class="row">
            <!-- قائمة المستخدمين -->
            <div class="col-md-4">
                <h5>Users</h5>
                <ul class="list-group" id="userList">
                    @foreach($users as $user)
                    <li class="list-group-item user-item " data-id="{{ $user->id }}">
                        {{ $user->name }}
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- واجهة الدردشة -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Chat</div>
                    <div id="chatBox" class="mb-3" style="height: 400px; overflow-y: auto;">
                        @foreach($messages as $message)
                        <div class="d-flex mb-2 {{ $message->sender_id == auth()->id() ? 'justify-content-end' : 'justify-content-start' }}">
                            <div class="p-2 rounded text-white 
                {{ $message->sender_id == auth()->id() ? 'bg-success text-end' : 'bg-primary text-start' }}"
                                style="max-width: 75%;">
                                {{ $message->content }}
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="card-footer">
                        <form id="chatForm">
                            <div class="input-group">
                                <input type="text" name="message" id="messageInput" class="form-control" placeholder="Type a message...">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scriptFooter">
        <script>
            const currentUserId = "{{ auth()->id() }}";
        </script>
        <script>
            let selectedUserId = null;

            // عند الضغط على مستخدم
            $('.user-item').on('click', function() {
                $('.user-item').removeClass('active');
                $(this).addClass('active');
                selectedUserId = $(this).data('id');
                loadMessages();
            });

            function loadMessages() {
                if (!selectedUserId) return;

                $.get(`/chat/messages/${selectedUserId}`, function(messages) {
                    let html = '';

                    messages.forEach(msg => {
                        let isMine = msg.sender_id === currentUserId;

                        html += `
                        <div class="d-flex ${isMine ? 'justify-content-end' : 'justify-content-start'}">
                            <div class="p-2 rounded ${isMine ? 'bg-primary text-white' : 'bg-light'}">
                                ${msg.content}
                            </div>
                        </div>
                        `;
                    });


                    $('#chatBox').html(html);
                    $('#chatBox').scrollTop($('#chatBox')[0].scrollHeight);
                });
            }

            // إرسال رسالة
            $('#chatForm').on('submit', function(e) {
                e.preventDefault();
                let message = $('#messageInput').val();
                if (!message.trim() || !selectedUserId) return;

                $.post(`/chat/send/${selectedUserId}`, {
                    _token: '{{ csrf_token() }}',
                    content: message
                }, function() {
                    $('#messageInput').val('');
                    loadMessages();
                });
            });

            // تحديث تلقائي كل 5 ثواني
            setInterval(loadMessages, 5000);
        </script>
    </x-slot>
</x-dashboard.layout>