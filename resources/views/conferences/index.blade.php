@extends('app')

@section('content')
<div class="container mt-5">
    <h2>Client Conferences</h2>
    <p>Welcome to the client conferences page!</p>

    @if($latestConference)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $latestConference->title }}</h5>
                <a href="{{ route('client.conferences.registerForm', $latestConference->id) }}" class="btn btn-primary">Register</a>
            </div>
        </div>
    @else
        <p>No upcoming conferences available.</p>
    @endif
</div>
@endsection