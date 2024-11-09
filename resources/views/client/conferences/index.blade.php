@extends('app')

@section('content')
<div class="container mt-5">
    <h2><b>Client Conferences </b></h2>
    <br>
    <br>
  
    @if($latestConference)
        <h3>Latest Conference</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Speakers</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Address</th>
                    <th>Login/Register</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $latestConference->title }}</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>
                    
                    <a href="{{ route('client.login') }}" class="btn btn-secondary">Login</a>
                    
                        <a href="{{ route('client.conferences.register', ['conferenceId' => $latestConference->id]) }}" class="btn btn-primary">Register</a>

                    </td>
                </tr>
            </tbody>
        </table>
        
    @else
        <p>No upcoming conferences.</p>
    @endif
</div>
@endsection
