@extends('app')

@section('content')
    <h2>Manage Users</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->surname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <!-- Edit Button -->
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Edit</a>

                        <!-- Delete Button -->
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
