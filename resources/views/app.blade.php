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
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('employee.conferences.index') }}" id="employee-link">Employee Conferences</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.home') }}" id="admin-link">Admin Dashboard</a>
                </li>
            </ul>

            <!-- Showing the assigned role -->
            @if(session()->has('role'))
    <span class="navbar-text text-white me-3">
        Current Role: 
        @if(session('role') === 'client')
            Client
        @elseif(session('role') === 'employee')
            Employee
        @elseif(session('role') === 'admin')
            Admin
        @else
            {{ ucfirst(session('role')) }}  
        @endif
    </span>
    <form action="{{ route('logout') }}" method="POST" class="d-inline-block">
        @csrf
        <button type="submit" class="btn btn-danger">Log Out</button>
    </form>
@else
    <span class="navbar-text text-white me-3">No role assigned</span>
@endif

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
        const employeeLink = document.querySelector('#employee-link');
        const adminLink = document.querySelector('#admin-link');

        if (employeeLink) {
            employeeLink.addEventListener('click', function(event) {
                if (!@json(session('role')) || @json(session('role')) !== 'employee') {
                    event.preventDefault();
                    alert("Access Denied");
                }
            });
        }

        if (adminLink) {
            adminLink.addEventListener('click', function(event) {
                if (!@json(session('role')) || @json(session('role')) !== 'admin') {
                    event.preventDefault();
                    alert("Access Denied");
                }
            });
        }
    });
</script>
</body>
</html>
