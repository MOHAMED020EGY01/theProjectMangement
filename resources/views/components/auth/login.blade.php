<x-auth.layout.guest>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form action="">


                <x-auth.form.input
                        name="name"
                        label="Name"
                        placeholder="Enter your name"
                        prepend='<i class="fa fa-user"></i>'
                        required
                        autofocus />


                    <x-auth.form.input
                        name="username"
                        label="Username"
                        placeholder="Enter your username"
                        prepend='<i class="fa fa-user"></i>'
                        required
                         />

                    <x-auth.form.input
                        name="email"
                        type="email"
                        label="Email"
                        placeholder="Enter your email"
                        prepend='<i class="fa fa-envelope"></i>'
                        required
                         />

                    <x-auth.form.input
                        name="phone"
                        label="Phone Number"
                        placeholder="01XXXXXXXXX"
                        type="tel"
                        prepend="+20"
                        append='<i class="fa fa-phone"></i>'
                        required />


                    <x-auth.form.input
                        name="password"
                        label="Password"
                        type="password"
                        placeholder="Enter your password"
                        append='<i class="fa fa-lock"></i>'
                        required
                        autocomplete="new-password" />


                    <button type="submit" class="btn btn-outline-primary w-100 shadow">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-auth.layout.guest>