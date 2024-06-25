<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set PIN</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
        }
        .container {
            width: 350px;
            margin: 100px auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #fff;
            text-align: center;
        }
        .container h2 {
            color: #003399;
        }
        .container label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
            text-align: left;
        }
        .container input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        .container button {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #003399;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .container button:hover {
            background-color: #002266;
        }
        .alert {
            margin-top: 20px;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Set PIN</h2>

        <!-- Display account number -->
        @if(session('account_number'))
        <div class="alert">
            Nomor Rekening Anda: {{ session('account_number') }}
        </div>
        @endif

        <p>Silahkan atur PIN Anda</p>
        <form action="{{ route('set.pin') }}" method="POST">
            @csrf
            <label for="pin">PIN:</label>
            <input type="password" id="pin" name="pin" required>

            <label for="pin_confirmation">Confirm PIN:</label>
            <input type="password" id="pin_confirmation" name="pin_confirmation" required>

            <button type="submit">Set PIN</button>
        </form>
    </div>
</body>
</html>
