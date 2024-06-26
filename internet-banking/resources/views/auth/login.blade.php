<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN - Internet Banking</title>
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
        }
        .container h2 {
            text-align: center;
            color: #003399;
        }
        .container label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        .container input[type="text"], .container input[type="password"] {
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
        .notes {
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>LOGIN</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <label for="BANKID">Please Enter Your BANKID</label>
            <input type="text" id="BANKID" name="BANKID" required>

            <label for="password">Please Enter Your Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Send</button>
        </form>
        <div class="notes">
            <p>1. Fill in the column "Please Enter Your BANKID" with the BANKID provided to you.</p>
            <p>2. Fill in the column "Please Enter Your Password" with your password.</p>
            <p>3. //Aturan 3// </p>
        </div>
    </div>
</body>
</html>
