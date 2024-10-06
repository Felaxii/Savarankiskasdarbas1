@extends('app')

@section('content')
    <h2>Latest Conference</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($latestConference)
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Speakers</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $latestConference->title }}</td>
                    <td>{{ $latestConference->description }}</td>
                    <td>{{ $latestConference->speakers }}</td>
                    <td>{{ $latestConference->date }}</td>
                    <td>{{ $latestConference->time }}</td>
                    <td>{{ $latestConference->address }}</td>
                </tr>
            </tbody>
        </table>
    @else
        <p>No conferences available at the moment.</p>
    @endif

    <a href="{{ route('admin.conferences.create') }}" class="btn btn-primary">Create New Conference</a>
@endsection
