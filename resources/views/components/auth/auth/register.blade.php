<x-auth.layout.guest>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <x-form.input
                        name="name"
                        label="name"
                        placeholder="Enter your name"
                        prepend='<i class="fa fa-user"></i>'
                        required
                        autofocus />

                    <x-form.input
                        name="username"
                        label="Username"
                        placeholder="Enter your username"
                        prepend='<i class="fa fa-user"></i>'
                        required />

                    <x-form.input
                        name="email"
                        type="email"
                        label="Email"
                        placeholder="Enter your email"
                        prepend='<i class="fa fa-envelope"></i>'
                        required />

                    <x-form.input
                        name="phone"
                        label="Phone Number"
                        placeholder="01XXXXXXXXX"
                        type="tel"
                        prepend="+20"
                        append='<i class="fa fa-phone"></i>'
                        required />


                    <x-form.input
                        name="password"
                        label="Password"
                        type="password"
                        placeholder="Enter your password"
                        prepend='<i class="fa fa-lock"></i>'
                        required
                        autocomplete="new-password" />

                    <x-form.input
                        name="password_confirmation"
                        label="Confirm Password"
                        type="password"
                        placeholder="Confirm your password"
                        prepend='<i class="fa fa-lock"></i>'
                        required
                        autocomplete="new-password" />

                    <x-form.select
                        name="company_id"
                        label="Company"
                        placeholder="Select a company"
                        :options="App\Models\Company::pluck('name','id')"
                        prepend='<i class="fa fa-building"></i>'
                        required />

                    <hr>


                    <button type="submit" class="btn btn-outline-primary w-100 shadow">Register</button>
                </form>
            </div>
        </div>
    </div>
</x-auth.layout.guest>