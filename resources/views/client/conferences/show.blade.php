<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $conference->name }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>{{ $conference->name }}</h1>
        <p><strong>Date:</strong> {{ $conference->date }}</p>
        <p><strong>Description:</strong> {{ $conference->description }}</p>
        

        <a href="{{ route('client.conferences.index') }}" class="btn btn-secondary">Back to Conferences</a>
    </div>
</body>
</html>
