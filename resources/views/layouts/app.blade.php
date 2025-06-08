<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{asset('assets/img/icons/icon-48x48.png')}}" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>Volunteer Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<div class="wrapper">
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="{{route('dashboard')}}">
                <span class="align-middle">Volunteer Management</span>
            </a>

            <ul class="sidebar-nav">
                <li class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('dashboard') }}">
                        <i class="align-middle" data-feather="home"></i> <span class="align-middle">Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('places.index') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('places.index') }}">
                        <i class="align-middle" data-feather="map-pin"></i> <span class="align-middle">Places</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('tasks.index') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('tasks.index') }}">
                        <i class="align-middle" data-feather="clipboard"></i> <span class="align-middle">Tasks</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('volunteers.index') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('volunteers.index') }}">
                        <i class="align-middle" data-feather="users"></i> <span class="align-middle">Volunteers</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('assignments.index') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('assignments.index') }}">
                        <i class="align-middle" data-feather="link"></i> <span class="align-middle">Assignments</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="#" id="logoutBtn" class="sidebar-link">
                        <i class="align-middle" data-feather="log-out"></i> <span class="align-middle">Log Out</span>
                    </a>
                </li>
            </ul>


        </div>
    </nav>

    <div class="main">

        @yield('main')

        <footer class="footer">
            <div class="container-fluid">
                <div class="row text-muted">
                    <div class="col-12 text-center">
                        <p class="mb-0">
                            <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>AdminKit</strong></a>
                            -
                            <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>Bootstrap Admin Template</strong></a>
                            &copy;
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<script src="{{asset('assets/js/app.js')}}"></script>

<script>
    document.getElementById('logoutBtn').addEventListener('click', function (e) {
        e.preventDefault();


        localStorage.removeItem('token');


        Swal.fire({
            icon: 'success',
            title: 'Logged out',
            text: 'You have been successfully logged out.',
            timer: 1500,
            showConfirmButton: false
        });


        setTimeout(() => {
            window.location.href = '/';
        }, 1500);
    });
</script>

</body>

</html>
