<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #007bff; /* Warna latar belakang */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background-color: #ffffff; /* Warna latar belakang konten */
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            box-sizing: border-box;
        }

        h1 {
            color: #007bff; /* Warna teks utama */
            margin-bottom: 20px;
        }

        p {
            color: #333; /* Warna teks tambahan */
            font-size: 18px;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            background-color: #fff; /* Warna tombol */
            color: #007bff;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 5px;
            margin: 0 10px;
            transition: background-color 0.3s ease, color 0.3s ease;
            font-weight: bold;
        }

        a:hover {
            background-color: #0056b3; /* Warna tombol saat dihover */
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Internet Banking Application</h1>
        <p>Manage your finances securely and conveniently.</p>
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    </div>
</body>
</html>
