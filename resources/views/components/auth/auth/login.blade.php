<x-auth.layout.guest>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <x-form.input
                        name="email"
                        type="email"
                        label="Email"
                        placeholder="Enter your email"
                        prepend='<i class="fa fa-envelope"></i>'
                        autofocus
                        required />


                    <x-form.input
                        name="password"
                        label="Password"
                        type="password"
                        placeholder="Enter your password"
                        prepend='<i class="fa fa-lock"></i>'
                        autocomplete="new-password"
                        required />

                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-outline-primary w-100 shadow">login</button>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('register') }}" class="btn btn-outline-success w-100 shadow">register</a>
                            </div>
                            <hr class="my-4">
                            <div class="col-md-12">
                                <a href="{{ route('auth.redirect', 'google') }}" class="btn btn-outline-danger w-100 shadow">Google</a>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</x-auth.layout.guest>