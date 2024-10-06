@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $conference->title }}</h1>
    <p>{{ $conference->description }}</p>
    <p>Speakers: {{ $conference->speakers }}</p>
    <p>Date: {{ $conference->date }} at {{ $conference->time }}</p>
    <p>Address: {{ $conference->address }}</p>

    <h2>Registered Clients</h2>
    <ul>
        @foreach ($conference->registrations as $user)
            <li>{{ $user->name }} {{ $user->surname }} ({{ $user->email }})</li>
        @endforeach
    </ul>

    <a href="{{ route('employee.index') }}" class="btn btn-secondary">Back to Conferences</a>
</div>
@endsection
