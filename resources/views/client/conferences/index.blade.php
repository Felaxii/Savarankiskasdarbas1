@extends('app')

@section('content')
<h1>All Conferences</h1>
<ul>
    @foreach($conferences as $conference)
        <li>
            <a href="{{ route('client.conferences.show', $conference->id) }}">{{ $conference->title }}</a>
        </li>
    @endforeach
</ul>
@endsection
