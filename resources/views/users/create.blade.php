@extends('layouts.app')

@section('content')
<h2>Create User</h2>

<form method="POST" action="{{ route('users.store') }}">
    @csrf
    <p>
        <label for="username">Username</label>
        <input id="username" name="username" value="{{ old('username') }}" required>
        @error('username') <span>{{ $message }}</span> @enderror
    </p>
    <p>
        <label for="full_name">Full Name</label>
        <input id="full_name" name="full_name" value="{{ old('full_name') }}" required>
        @error('full_name') <span>{{ $message }}</span> @enderror
    </p>
    <p>
        <label for="role">Role</label>
        <input id="role" name="role" value="{{ old('role') }}">
        @error('role') <span>{{ $message }}</span> @enderror
    </p>
    <button type="submit">Create User</button>
</form>
@endsection
