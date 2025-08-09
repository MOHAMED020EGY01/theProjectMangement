<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="user-id" content="{{ auth()->id() }}">
    <!-- csrf token in Chat-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('app.name')}}</title>

    <!---------------- CSS Link  --------------->
    <!-- animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/dashboard.css') }}">
    {{ $style ?? '' }}
    <!---------------- JS Link  --------------->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Pusher brodcast -->
    <script>
        const userId = "{{ Auth::id() }}";
    </script>
    @vite('resources/js/app.js')


    <!-- tags -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">

    <!-- Chart.js -->
    {{ $scriptHead ?? '' }}
</head>

<body>
    <div style="z-index: 9999;position: fixed; top: 4rem; right: 10px;" id="notificationLayout" class="p-3">

    </div>
    <!-- Navigation Sidebar -->
    <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
            <div class="sidebar-brand d-flex align-items-center px-3 mb-3">
                <i class="fas fa-chart-line me-2 text-primary"></i>
                <span class="h5 mb-0">{{config('app.name')}}</span>
            </div>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-home me-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a id="project-link" class="nav-link {{ Route::is('dashboard.project.index') ? 'active' : '' }}" href="{{ route('dashboard.project.index') }}">
                        <i class="fas fa-chart-bar me-2"></i>
                        Project
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('dashboard.chat.index') ? 'active' : '' }}" href="{{ route('chat.index') }}" data-bs-target="Chat">
                        <i class="fas fa-comments me-2"></i>
                        Chat
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('dashboard.company.index') ? 'active' : '' }}" href="{{ route('dashboard.company.index') }}" data-bs-target="company">
                        <i class="fas fa-building me-2"></i>
                        Company
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.index') }}" data-bs-target="users">
                        <i class="fas fa-users me-2"></i>
                        Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-target="settings">
                        <i class="fas fa-cog me-2"></i>
                        Settings
                    </a>
                </li>
            </ul>

            <hr>

            <div class="px-3">
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center text-muted text-uppercase">
                    <span>Quick Actions</span>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link text-muted" href="#">
                            <i class="fas fa-plus-circle me-2"></i>
                            New Project
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-muted" href="#">
                            <i class="fas fa-download me-2"></i>
                            Export Data
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="spinner" style="
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(255,255,255,0.6);
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
" class="d-none">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Main Content -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <!-- Top Navigation Bar -->
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <div class="d-flex align-items-center">
                <button class="btn btn-outline-secondary d-md-none me-2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="h2">{{ $title ?? '' }}</h1>
            </div>
            <div class="d-flex align-items-center gap-3">

                {{-- إشعارات المهمات --}}
                <x-dashboard.notifications.task />

                {{-- قائمة المستخدم --}}
                <div class="dropdown">
                    <button class="position-relative btn btn-light border rounded-pill px-3 d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img width="25px" height="25px" class="rounded-circle" src="{{ Auth::user()->profile->image_profile ?? asset('defaultImage/profile/default.jpg') }}" alt="logo">
                        
                        <span id="userOnline" class="rounded-pill" style="width: 10px; height: 10px; border-radius: 50%; background-color: green; position: absolute; top: 27px; left: 30px;"></span>

                        <span class="fw-semibold">{{ Auth::user()->name }}</span>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                        <li><a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('profile.index') }}"><i class="fa-solid fa-user"></i> Profile</a></li>
                        <li><a class="dropdown-item d-flex align-items-center gap-2" href="#"><i class="fa-solid fa-cog"></i> Settings</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item text-danger d-flex align-items-center gap-2" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-right-from-bracket"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>

            </div>


        </div>
        {{ $slot }}

    </main>

    <!-- Bootstrap 5.3 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- spiner -->
    <script>
        $(function() {
            $('body').on('click', 'a', function() {
                const href = $(this).attr('href');

                if (href && href.includes('#')) {
                    return;
                }

                $('#spinner').removeClass('d-none');
            });
        });
        $(window).on('pageshow', function(event) {
            $('#spinner').addClass('d-none');
        });
        $(window).on('beforeunload', function() {
            $('#spinner').removeClass('d-none');
        });
    </script>

    <!-- Custom JavaScript -->
    {{ $scriptFooter ?? '' }}
</body>

</html>