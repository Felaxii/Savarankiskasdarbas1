@extends('app')

@section('content')

<h1>Edit Conference</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form action="{{ route('admin.conferences.update', $conference->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="mb-3">
        <label for="title" class="form-label">Title:</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $conference->title) }}" required>
    </div>
    
    <div class="mb-3">
        <label for="description" class="form-label">Description:</label>
        <textarea name="description" class="form-control" required>{{ old('description', $conference->description) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="speakers" class="form-label">Speakers:</label>
        <input type="text" name="speakers" class="form-control" value="{{ old('speakers', $conference->speakers) }}">
    </div>
    
    <div class="mb-3">
        <label for="date" class="form-label">Date:</label>
        <input type="date" name="date" class="form-control" value="{{ old('date', $conference->date) }}" required>
    </div>

    <div class="mb-3">
    <label for="time" class="form-label">Time:</label>
    <input type="time" name="time" class="form-control" value="{{ old('time', \Carbon\Carbon::parse($conference->time)->format('H:i')) }}" required>
</div>
    
    <div class="mb-3">
        <label for="address" class="form-label">Address:</label>
        <input type="text" name="address" class="form-control" value="{{ old('address', $conference->address) }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Update Conference</button>
</form>

@endsection
