<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer</title>
</head>
<body>
    <h1>Transfer</h1>
    <nav>
        <ul>
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('transfer') }}">Transfer</a></li>
            <li><a href="{{ route('transactions') }}">Transactions</a></li>
        </ul>
    </nav>
    <form action="#" method="POST">
        @csrf
        <label for="recipient">Recipient:</label>
        <input type="text" id="recipient" name="recipient"><br><br>
        <label for="amount">Amount:</label>
        <input type="text" id="amount" name="amount"><br><br>
        <button type="submit">Transfer</button>
    </form>
</body>
</html>
