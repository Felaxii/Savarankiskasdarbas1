@extends('app')

@section('content')
    <h2>{{ $conference->title }}</h2>
    <p>{{ $conference->description }}</p>
    <p>Date: {{ $conference->date }}</p>
    <p>Time: {{ $conference->time }}</p>
    <p>Address: {{ $conference->address }}</p>
@endsection
