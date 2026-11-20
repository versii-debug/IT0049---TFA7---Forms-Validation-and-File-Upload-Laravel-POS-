@extends('layouts.app')

@section('content')
<h2>User Accounts</h2>
<p><a href="{{ route('users.create') }}">Create User</a></p>

<table>
    <thead>
        <tr>
            <th>Avatar</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>
                    <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('images/avatar-placeholder.svg') }}" alt="Avatar" width="48" height="48">
                </td>
                <td>{{ $user['username'] }}</td>
                <td>{{ $user['full_name'] }}</td>
                <td>{{ $user['role'] }}</td>
                <td><a href="{{ route('users.edit', $user) }}">Edit</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
