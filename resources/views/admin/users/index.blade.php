@extends('app')

@section('content')
<h1>All Users</h1>
<ul>
    @foreach($users as $user)
        <li>
            <a href="{{ route('admin.users.edit', $user->id) }}">{{ $user->name }} {{ $user->surname }}</a>
        </li>
    @endforeach
</ul>
@endsection
