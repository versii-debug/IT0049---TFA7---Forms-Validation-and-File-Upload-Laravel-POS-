<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} | POS System</title>
</head>
<body>
    <header>
        <h1>POS System</h1>
        <nav>
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('customers') }}">Customers</a>
            <a href="{{ route('users') }}">Users</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>Basic POS System</p>
    </footer>
</body>
</html>
