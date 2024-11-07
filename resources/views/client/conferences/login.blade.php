@extends('app')

@section('content')
<div class="container mt-5">
    <h2>Login</h2>

    @if(session('errors'))
        <div class="alert alert-danger">
            <strong>{{ $errors->first('email') }}</strong>
        </div>
    @endif

    <form action="{{ route('client.login.post') }}" method="POST">
        @csrf

        @if($latestConference)
            <input type="hidden" name="conferenceId" value="{{ $latestConference->id }}">
        @endif

 
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>
    
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>

        </div>

        <button type="submit" class="btn btn-secondary">Login</button>
    </form>

    <br>
    <br>

    @if($latestConference)
        <a href="{{ route('client.conferences.register', ['conferenceId' => $latestConference->id]) }}" class="btn btn-primary">Register</a>
    @else
        <p>No conference available for registration.</p>
    @endif
</div>
@endsection
