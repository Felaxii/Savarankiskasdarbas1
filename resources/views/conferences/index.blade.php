@extends('app')

@section('content')
    <h2>Conferences</h2>
    <ul>
        @foreach ($conferences as $conference)
            <li>
                <a href="{{ route('client.conferences.show', $conference->id) }}">{{ $conference->title }}</a>
            </li>
        @endforeach
    </ul>

    <h3>Register for a Conference</h3>
    <form action="{{ route('client.register') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <button type="submit">Register</button>
    </form>
@endsection
