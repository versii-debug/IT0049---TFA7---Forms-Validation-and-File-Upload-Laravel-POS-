@extends('layouts.app')

@section('content')
<h2>Edit Customer</h2>

<form method="POST" action="{{ route('customers.update', $customer) }}">
    @csrf
    @method('PUT')
    <p>
        <label for="full_name">Full Name</label>
        <input id="full_name" name="full_name" value="{{ old('full_name', $customer->full_name) }}" required>
        @error('full_name') <span>{{ $message }}</span> @enderror
    </p>
    <p>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email', $customer->email) }}" required>
        @error('email') <span>{{ $message }}</span> @enderror
    </p>
    <p>
        <label for="phone">Phone</label>
        <input id="phone" name="phone" value="{{ old('phone', $customer->phone) }}">
        @error('phone') <span>{{ $message }}</span> @enderror
    </p>
    <button type="submit">Update Customer</button>
</form>
@endsection
