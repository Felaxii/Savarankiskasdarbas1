<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Register</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
</head>
<body>
    <div class="container">
        <h1>Login / Register</h1>

        <form method="GET" action="{{ url('/') }}">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>

        <a href="{{ route('client.conferences.index') }}" class="btn btn-secondary">Back to Conferences</a>
    </div>
</body>
</html>
