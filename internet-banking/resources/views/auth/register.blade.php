<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        .container input[type="text"], .container input[type="email"], .container input[type="password"], .container input[type="date"], .container select {
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
        <h2>Register</h2>

        @if(session('success_message'))
        <div class="alert">
            {{ session('success_message') }}
        </div>
        @endif

        <!-- Registration form -->
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <label for="nama_lengkap">Nama Lengkap:</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" required>

            <label for="BANKID">BANKID:</label>
            <input type="text" id="BANKID" name="BANKID" required>

            <label for="nik">NIK:</label>
            <input type="text" id="nik" name="nik" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>

            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>

            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
