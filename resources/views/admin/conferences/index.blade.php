@extends('app')

@section('content')
    <h2>Admin Conferences</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Speakers</th>

                <th>Date</th>
                <th>Time</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($conferences as $conference)
                <tr>
                    <td>{{ $conference->title }}</td>
                    <td>{{ $conference->description }}</td>
                    <td>{{ $conference->speakers }}</td>
                    <td>{{ $conference->date }}</td>
                    <td>{{ $conference->time }}</td>
                    <td>{{ $conference->address }}</td>
                    <td>
                        <a href="{{ route('admin.conferences.edit', $conference->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.conferences.destroy', $conference->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No conferences found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('admin.conferences.create') }}" class="btn btn-primary">Create New Conference</a>
@endsection
