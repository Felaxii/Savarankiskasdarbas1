@extends('app')

@section('content')
<h1>Edit Conference</h1>
<form action="{{ route('admin.conferences.update', $conference->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="title">Title:</label>
    <input type="text" name="title" value="{{ $conference->title }}" required>
    
    <label for="description">Description:</label>
    <textarea name="description" required>{{ $conference->description }}</textarea>
    
    <label for="date">Date:</label>
    <input type="date" name="date" value="{{ $conference->date }}" required>
    
    <label for="time">Time:</label>
    <input type="time" name="time" value="{{ $conference->time }}" required>
    
    <label for="address">Address:</label>
    <input type="text" name="address" value="{{ $conference->address }}" required>

    <button type="submit">Update Conference</button>
</form>
@endsection
