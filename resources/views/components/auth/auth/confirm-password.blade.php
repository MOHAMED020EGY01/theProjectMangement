<x-auth.layout.guest>
    <div class="container">
        <div class="row">
            <div class="col">
                <h4 class="mb-4">Confirm Password</h4>

                <p class="mb-3 text-muted">Please confirm your password before continuing.</p>

                <form method="POST" action="{{-- route('password.confirm') --}}">
                    @csrf

                    <x-form.input
                        name="password"
                        label="Password"
                        type="password"
                        placeholder="Enter your password"
                        prepend='<i class="fa fa-lock"></i>'
                        required
                        autocomplete="current-password" />

                    <button type="submit" class="btn btn-outline-primary w-100 shadow mt-3">
                        Confirm
                    </button>
                </form>

                <div class="mt-3 text-center">
                    <a href="{{-- route('login') --}}" class="text-decoration-none">Back to login</a>
                </div>
            </div>
        </div>
    </div>
</x-auth.layout.guest>