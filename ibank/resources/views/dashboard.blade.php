<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>
    <nav>
        <ul>
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('transfer') }}">Transfer</a></li>
            <li><a href="{{ route('transactions') }}">Transactions</a></li>
        </ul>
    </nav>
    <p>Welcome to your internet banking dashboard!</p>
</body>
</html>
