@extends('app')

@section('content')
<h1>Edit User</h1>


<form action="{{ route('admin.users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="username">Username:</label>
    <input type="text" name="username" value="{{ $user->username }}" required>

    <label for="email">Email:</label>
    <input type="email" name="email" value="{{ $user->email }}" required>

    <button type="submit">Update User</button>
</form>

<form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete User</button>
</form>

@endsection
