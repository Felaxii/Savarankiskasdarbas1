
@extends('app')

@section('content')
    <div class="jumbotron">
        <h1 class="display-4">Welcome to the Admin Dashboard!</h1>
        <p class="lead">Manage users and conferences from this panel.</p>
    </div>

    <div class="mt-5">
        <h2>Manage</h2>
        <ul class="list-group">
            <li class="list-group-item"><a href="{{ route('admin.users.index') }}" class="btn btn-info mt-2">Manage Users</a></li>
            <li class="list-group-item"><a href="{{ route('admin.conferences.index') }}" class="btn btn-info mt-3">Manage Conferences</a></li>
        </ul>
    </div>
@endsection
