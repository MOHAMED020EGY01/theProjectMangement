<x-auth.layout.guest>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <form action="">

                    <x-auth.form.input
                        name="username"
                        label="Username"
                        placeholder="Enter your username"
                        prepend='<i class="fa fa-user"></i>'
                        required
                        autofocus />

                    <x-auth.form.input
                        name="email"
                        type="email"
                        label="Email"
                        placeholder="Enter your email"
                        prepend='<i class="fa fa-envelope"></i>'
                        required />


                    <x-auth.form.input
                        name="password"
                        label="Password"
                        type="password"
                        placeholder="Enter your password"
                        prepend='<i class="fa fa-lock"></i>'
                        required
                        autocomplete="new-password" />


                    <button type="submit" class="btn btn-outline-primary w-100 shadow">login</button>
                </form>
            </div>
        </div>
    </div>
</x-auth.layout.guest>