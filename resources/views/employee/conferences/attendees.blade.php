@extends('app')

@section('content')
<div class="container mt-5">
    <h2>Attendees for {{ $conference->title }}</h2>

    @if($attendees->isEmpty())
        <p>No attendees found for this conference.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registered At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendees as $attendee)
                    <tr>
                        <td>{{ $attendee->name }} {{ $attendee->surname }}</td>
                        <td>{{ $attendee->email }}</td>
                        <td>{{ $attendee->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('employee.conferences.index') }}" class="btn btn-primary mt-3">Back to Conferences</a>
</div>
@endsection
