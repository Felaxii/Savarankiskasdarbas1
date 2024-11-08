@extends('app')

@section('content')
<div class="container mt-5">
    <h2>Login</h2>

    {{-- Display errors --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('client.login.post') }}" method="POST">
        @csrf

        {{-- Hidden field for conference ID --}}
        @if($latestConference)
            <input type="hidden" name="conferenceId" value="{{ $latestConference->id }}">
        @endif

        {{-- Email Field --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password Field --}}
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-secondary">Login</button>
    </form>

    <br>
    <br>

    {{-- Conference registration button --}}
    @if($latestConference)
        <a href="{{ route('client.conferences.register', ['conferenceId' => $latestConference->id]) }}" class="btn btn-primary">Register</a>
    @else
        <p>No conference available for registration.</p>
    @endif
</div>
@endsection
