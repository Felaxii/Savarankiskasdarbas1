@extends('app')

@section('content')

<h1>Create Conference</h1>
<form action="{{ route('admin.conferences.store') }}" method="POST">
    @csrf
    <label for="title">Title:</label>
    <input type="text" name="title" required>
    
    <label for="description">Description:</label>
    <textarea name="description" required></textarea>
    
    <label for="date">Date:</label>
    <input type="date" name="date" required>
    
    <label for="time">Time:</label>
    <input type="time" name="time" required>
    
    <label for="address">Address:</label>
    <input type="text" name="address" required>

    <button type="submit">Create Conference</button>
</form>
@endsection
