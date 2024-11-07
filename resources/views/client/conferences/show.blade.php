@extends('app')

@section('content')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $conference->name }}</title>
</head>
<body>
    <div class="container">
        <h1>{{ $conference->name }}</h1>
        <p><strong>Title: </strong>{{ $conference->title }}</p>
        <p><strong>Description: </strong>{{ $conference->description }}</p>
        <p><strong>Speaker: </strong>{{ $conference->speakers }}</p>
        <p><strong>Date: </strong>{{ $conference->date }}</p>
        <p><strong>Time: </strong>{{ $conference->time }}</p>
        <p><strong>Address: </strong>{{ $conference->address }}</p>
                    

        <a href="{{ route('client.conferences.index') }}" class="btn btn-secondary">Back to Conferences</a>
    </div>
</body>
@endsection

