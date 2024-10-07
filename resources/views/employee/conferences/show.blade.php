<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $conference->title }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
</head>
<body>
    <div class="container">
        <h1>{{ $conference->title }}</h1>
        <p>{{ $conference->description }}</p>
        <p>Date: {{ $conference->date }}</p>
        
        <a href="{{ route('employee.conferences.index') }}">Back to Conferences</a>
    </div>
</body>
</html>
