@extends('app')

@section('content')
    <h1>Welcome to the Conference Management System</h1>
    <p>Your Name: [Your Name]</p>
    <p>Your Group: [Your Group]</p>
    <a href="{{ route('client.conferences.index') }}">Go to Client Conferences</a>
@endsection
