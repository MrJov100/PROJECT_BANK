<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Internet Banking</title>
</head>
<body>
    <h1>Welcome to Internet Banking</h1>
    <nav>
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('transfer') }}">Transfer</a></li>
            <li><a href="{{ route('transactions') }}">Transactions</a></li>
        </ul>
    </nav>
    <p>Welcome to our internet banking service. Please use the navigation links to access your account dashboard, make transfers, or view your transaction history.</p>
</body>
</html>
