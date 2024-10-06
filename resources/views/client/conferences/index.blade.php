<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Conferences</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
</head>
<body>
    <div class="container">
        <h1>All Conferences</h1>

        <a href="{{ route('client.register') }}" class="btn btn-primary">Register/Login</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($conferences as $conference)
                    <tr>
                        <td>{{ $conference->id }}</td>
                        <td>{{ $conference->name }}</td>
                        <td>{{ $conference->date }}</td>
                        <td>
                            <a href="{{ route('client.conferences.show', $conference->id) }}" class="btn btn-info">View Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
