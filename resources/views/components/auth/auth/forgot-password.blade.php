<x-auth.layout.guest>
    <div class="container">
        <div class="row">
            <div class="col">
                <h4 class="mb-4">Forgot Your Password?</h4>

                <p class="mb-3 text-muted">Enter your email and we’ll send you a link to reset your password.</p>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{-- route('password.email') --}}">
                    @csrf

                    <x-form.input
                        name="email"
                        type="email"
                        label="Email"
                        placeholder="Enter your email"
                        prepend='<i class="fa fa-envelope"></i>'
                        :value="old('email')"
                        required
                        autofocus />

                    <button type="submit" class="btn btn-outline-primary w-100 shadow mt-3">
                        Send Password Reset Link
                    </button>
                </form>

                <div class="mt-3 text-center">
                    <a href="{{-- route('login') --}}" class="text-decoration-none">Back to login</a>
                </div>
            </div>
        </div>
    </div>
</x-auth.layout.guest>
