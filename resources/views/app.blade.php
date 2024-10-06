<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conference Management</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav>
        
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="{{ route('client.conferences.index') }}">Client Conferences</a></li>
            <li><a href="{{ route('admin.users.index') }}">Admin Users</a></li>
            <li><a href="{{ route('admin.conferences.index') }}">Admin Conferences</a></li>
        </ul>
    </nav>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>

