@extends('layouts.app')

@section('content')
<h2>Welcome to the POS System</h2>

<h3>Pages</h3>
<ul>
    <li><a href="{{ route('customers') }}">Customer Accounts</a></li>
    <li><a href="{{ route('users') }}">User Accounts</a></li>
    <li><a href="{{ route('about') }}">About</a></li>
</ul>
@endsection
