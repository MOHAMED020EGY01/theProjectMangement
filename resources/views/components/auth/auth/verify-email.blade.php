<x-auth.layout.guest>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card shadow rounded-4 border-0">
                    <div class="card-body p-4">
                        <h4 class="mb-3">Verify Your Email Address</h4>

                        @if (session('status') == 'verification-link-sent')
                            <div class="alert alert-success" role="alert">
                                A new verification link has been sent to your email address.
                            </div>
                        @endif

                        <p class="mb-3 text-muted">
                            Before proceeding, please check your email for a verification link.
                            If you did not receive the email, click the button below to request another.
                        </p>

                        <form method="POST" action="{{-- route('verification.send') --}}">
                            @csrf

                            <button type="submit" class="btn btn-outline-primary w-100 shadow">
                                Resend Verification Email
                            </button>
                        </form>

                        <div class="mt-3 text-center">
                            <a href="{{ route('logout') }}"
                               class="text-decoration-none"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-auth.layout.guest>
