@extends('app')

@section('content')
    <h2>Employee Conferences</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Speakers</th>
                <th>Lectures</th>
                <th>Date</th>
                <th>Time</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            @forelse($conferences as $conference)
                <tr>
                    <td>{{ $conference->title }}</td>
                    <td>{{ $conference->description }}</td>
                    <td>{{ $conference->speakers }}</td>
                    <td>{{ $conference->lectures }}</td>
                    <td>{{ $conference->date }}</td>
                    <td>{{ $conference->time }}</td>
                    <td>{{ $conference->address }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No conferences found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
