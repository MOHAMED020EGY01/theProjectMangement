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


                    <button type="submit" class="btn btn-outline-primary w-100 shadow">login</button>
                </form>
            </div>
        </div>
    </div>
</x-auth.layout.guest>