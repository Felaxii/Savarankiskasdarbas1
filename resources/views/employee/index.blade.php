@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Conferences</h1>
    @foreach ($conferences as $conference)
        <div class="conference">
            <h3>{{ $conference->title }}</h3>
            <p>{{ $conference->description }}</p>
            <p>Date: {{ $conference->date }} at {{ $conference->time }}</p>
            <p>Address: {{ $conference->address }}</p>
            <a href="{{ route('employee.show', $conference->id) }}" class="btn btn-primary">View Conference</a>
        </div>
    @endforeach
</div>
@endsection
