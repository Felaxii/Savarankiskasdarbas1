<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Conferences</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Employee Conferences</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Title</th>
            <th>Date</th>
            <th>Description</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($conferences as $conference)
            <tr>
                <td>{{ $conference->title }}</td>
                <td>{{ $conference->date->format('Y-m-d') }}</td>
                <td>{{ $conference->description }}</td>
                <td>{{ $conference->date >= now() ? 'Current' : 'Past' }}</td>
                <td><a href="{{ route('employee.conferences.show', $conference->id) }}" class="btn btn-info">View</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
