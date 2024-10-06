
@extends('app')

@section('content')
    <div class="jumbotron">
        <h1 class="display-4">Welcome to the Admin Dashboard!</h1>
        <p class="lead">Manage users and conferences from this panel.</p>
    </div>

    <div class="mt-5">
        <h2>Manage</h2>
        <ul class="list-group">
            <li class="list-group-item"><a href="{{ route('admin.users.index') }}">Manage Users</a></li>
            <li class="list-group-item"><a href="{{ route('admin.conferences.index') }}">Manage Conferences</a></li>
        </ul>
    </div>
@endsection
