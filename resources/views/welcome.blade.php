<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Conference Management</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                @if(auth()->check())
                    @if(auth()->user()->role === 'client')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('client.conferences.index') }}">Client Conferences</a>
                        </li>
                    @elseif(auth()->user()->role === 'employee')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('employee.conferences.index') }}">Employee Conferences</a>
                        </li>
                    @elseif(auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.home') }}">Admin Dashboard</a>
                        </li>
                    @endif
                @endif
            </ul>
        </div>
    </div>
</nav>

    <div class="container mt-5 text-center">
        <h1>Welcome to Conference Management</h1>

        @if(auth()->guest())
            <!-- Guest options: Continue as Client, Employee, or Admin -->
            <form action="{{ route('client.continueAsClient') }}" method="POST" class="d-inline-block">
                @csrf
                <button type="submit" class="btn btn-primary mt-4">Continue as Client</button>
            </form>
            <a href="{{ route('employee.login') }}" class="btn btn-secondary mt-4">Continue as Employee</a>
            <a href="{{ route('admin.login') }}" class="btn btn-danger mt-4">Admin Dashboard</a>
        @else
            <!-- User is logged in, show logout button -->
            <form action="{{ route('logout') }}" method="POST" class="d-inline-block">
                @csrf
                <button type="submit" class="btn btn-danger mt-4">Log Out</button>
            </form>
        @endif
    </div>

    <footer class="bg-gray py-4 text-center">
        <div class="container">
            <p class="mb-0">&copy; 2024 BPV. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
