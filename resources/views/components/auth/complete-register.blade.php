<x-auth.layout.guest>
    <x-flash-message/>
    <form action="{{ route('complete.register') }}" method="POST">
        @csrf
        <x-form.input
            name="username"
            label="Username"
            placeholder="Enter your username"
            prepend='<i class="fa fa-user"></i>'
            required />

        <x-form.select
            name="company_id"
            label="Company"
            placeholder="Select a company"
            :options="App\Models\Company::pluck('name','id')"
            prepend='<i class="fa fa-building"></i>'
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

        <button type="submit" class="btn btn-outline-primary w-100 shadow">Register</button>
    </form>
</x-auth.layout.guest>