<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
    <h1>{{ request()->routeIs('admin.login') ? 'Admin Login' : 'Employee Login' }}</h1>
    <div class="mt-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <form action="{{ route(request()->routeIs('admin.login') ? 'admin.login' : 'employee.login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Login</button>
    </form>
</div>

<footer class="bg-gray py-4 text-center">
    <div class="container">
        <p class="mb-0">&copy; 2024 BPV. All Rights Reserved.</p>
    </div>
</footer>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
