<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <label>Nama Lengkap:</label>
        <input type="text" name="nama_lengkap" required><br>

        <label>NIK:</label>
        <input type="text" name="nik" required><br>

        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <label>Confirm Password:</label>
        <input type="password" name="password_confirmation" required><br>

        <label>Tanggal Lahir:</label>
        <input type="date" name="tanggal_lahir" required><br>

        <label>Jenis Kelamin:</label>
        <select name="jenis_kelamin" required>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>
