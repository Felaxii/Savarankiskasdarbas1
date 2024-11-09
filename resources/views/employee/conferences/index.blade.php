@extends('app')

@section('content')
    <h2>Employee Conferences</h2>

    @if(session('access_denied'))
        <script>
            alert("Access Denied");
        </script>
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
                <th>Attendees</th>
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
                        <a href="{{ route('employee.conferences.attendees', ['conferenceId' => $conference->id]) }}" 
                           class="btn btn-secondary">View Attendees</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No conferences found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
