@extends('layouts.app')

@section('content')
<h2>Edit User</h2>

<form method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <p>
        <label for="username">Username</label>
        <input id="username" name="username" value="{{ old('username', $user->username) }}" required>
        @error('username') <span>{{ $message }}</span> @enderror
    </p>
    <p>
        <label for="full_name">Full Name</label>
        <input id="full_name" name="full_name" value="{{ old('full_name', $user->full_name) }}" required>
        @error('full_name') <span>{{ $message }}</span> @enderror
    </p>
    <p>
        <label for="role">Role</label>
        <input id="role" name="role" value="{{ old('role', $user->role) }}">
        @error('role') <span>{{ $message }}</span> @enderror
    </p>
    <p>
        <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('images/avatar-placeholder.svg') }}" alt="Current avatar" width="48" height="48">
    </p>
    <p>
        <label for="avatar">Profile Picture (maximum 2MB)</label>
        <input id="avatar" type="file" name="avatar" accept="image/*">
        @error('avatar') <span>{{ $message }}</span> @enderror
    </p>
    <button type="submit">Update User</button>
</form>
@endsection
