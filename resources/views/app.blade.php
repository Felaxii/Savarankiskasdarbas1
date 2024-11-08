<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand">Conference Management</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('client.conferences.index') }}">Client Conferences</a>
                </li>

                <!-- Employee and Admin links are always shown, but access is restricted -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('employee.conferences.index') }}" id="employee-link">Employee Conferences</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}" id="admin-link">Admin Dashboard</a>
                </li>
            </ul>
            
            <form action="{{ route('logout') }}" method="POST" class="d-inline-block">
                @csrf
                <button type="submit" class="btn btn-danger">
                    @auth
                        Log Out
                    @else
                        Log Out
                    @endauth
                </button>
            </form>
        </div>
    </div>
</nav>


<div class="container mt-5">
    @yield('content')
</div>

<footer class="bg-gray py-4 text-center">
    <div class="container">
        <p class="mb-0">&copy; 2024 BPV. All Rights Reserved.</p>
    </div>
</footer>
<script src="{{ mix('js/app.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the employee and admin links
        const employeeLink = document.querySelector('#employee-link');
        const adminLink = document.querySelector('#admin-link');

        // Check if the user has proper roles and prevent navigation if they don't
        if (employeeLink) {
            employeeLink.addEventListener('click', function(event) {
                @if(!auth()->check() || !auth()->user()->hasRole('employee'))
                    event.preventDefault();
                    alert("Access Denied");
                @endif
            });
        }

        if (adminLink) {
            adminLink.addEventListener('click', function(event) {
                @if(!auth()->check() || !auth()->user()->hasRole('admin'))
                    event.preventDefault();
                    alert("Access Denied");
                @endif
            });
        }
    });
</script>
</body>
</html>
