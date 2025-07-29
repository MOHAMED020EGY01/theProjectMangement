<x-auth.layout.guest>
    <div class="container">
        <div class="row">
            <div class="col">
                <h4 class="mb-4">Reset Password</h4>


                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{-- route('password.update') --}}">
                    @csrf


                    <input type="hidden" name="token" value="{{-- $request->route('token') --}}">

                    <x-form.input
                        name="email"
                        type="email"
                        label="Email"
                        placeholder="Enter your email"
                        prepend='<i class="fa fa-envelope"></i>'
                        
                        required
                        autofocus />

                    <x-form.input
                        name="password"
                        label="New Password"
                        type="password"
                        placeholder="Enter your new password"
                        append='<i class="fa fa-lock"></i>'
                        required
                        autocomplete="new-password" />

                    <x-form.input
                        name="password_confirmation"
                        label="Confirm Password"
                        type="password"
                        placeholder="Confirm your password"
                        append='<i class="fa fa-lock"></i>'
                        required
                        autocomplete="new-password" />

                    <button type="submit" class="btn btn-outline-primary w-100 shadow mt-3">
                        Reset Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-auth.layout.guest>
