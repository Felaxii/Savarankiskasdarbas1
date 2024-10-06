@extends('app')

@section('title', 'Employee Conferences')

@section('content')
    <h2>Employee Conferences</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Speakers</th>
                <th>Date</th>
                <th>Time</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($conferences as $conference)
                <tr>
                    <td>{{ $conference->title }}</td>
                    <td>{{ $conference->description }}</td>
                    <td>{{ $conference->speakers }}</td>
                    <td>{{ $conference->date->format('Y-m-d') }}</td>
                    <td>{{ $conference->time }}</td>
                    <td>{{ $conference->address }}</td>
                    <td><a href="{{ route('employee.conferences.show', $conference->id) }}" class="btn btn-info">View</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
