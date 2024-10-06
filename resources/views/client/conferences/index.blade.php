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

    
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Speakers</th>
                <th>Date</th>
                <th>Time</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($conferences as $conference)
                <tr>
                    <td>{{ $conference->title }}</td>
                    <td>{{ $conference->description }}</td>
                    <td>{{ $conference->speakers }}</td>
                    <td>{{ $conference->date->format('Y-m-d') }}</td>
                    <td>{{ $conference->time }}</td>
                    <td>{{ $conference->address }}</td>
                    <td><a href="{{ route('client.conferences.show', $conference->id) }}" class="btn btn-info">View</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
