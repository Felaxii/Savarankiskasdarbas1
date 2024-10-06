@extends('app')

@section('content')
<div class="container mt-5">
    <h2>Client Conferences</h2>
    
    <div class="mb-4">
        <h5>Login/Register</h5>
        <form action="{{ route('client.register.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login/Register</button>
        </form>
    </div>

    <h5>Latest Conference</h5>
    @if ($latestConference)
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Speakers</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $latestConference->title }}</td>
                    <td>{{ $latestConference->description }}</td>
                    <td>{{ $latestConference->speakers }}</td>
                    <td>{{ $latestConference->date }}</td>
                    <td>{{ $latestConference->time }}</td>
                    <td>{{ $latestConference->address }}</td>
                </tr>
            </tbody>
        </table>
    @else
        <p>No upcoming conferences available at the moment.</p>
    @endif
</div>
@endsection
