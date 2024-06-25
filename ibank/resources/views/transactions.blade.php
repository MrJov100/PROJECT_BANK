<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
</head>
<body>
    <h1>Transactions</h1>
    <nav>
        <ul>
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('transfer') }}">Transfer</a></li>
            <li><a href="{{ route('transactions') }}">Transactions</a></li>
        </ul>
    </nav>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <!-- Example transactions -->
            <tr>
                <td>2024-01-01</td>
                <td>Payment</td>
                <td>$100.00</td>
            </tr>
            <tr>
                <td>2024-01-02</td>
                <td>Transfer</td>
                <td>$50.00</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
