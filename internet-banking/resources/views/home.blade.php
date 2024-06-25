<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <h1>Selamat Datang, {{ Auth::user()->nama_lengkap }}</h1>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <a href="{{ route('saldo') }}">
    <button>Cek Saldo</button>
</a>
</body>
</html>
