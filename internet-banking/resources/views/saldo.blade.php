<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Saldo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
    /* CSS yang sudah ada tetap sama */

    .container {
        /* Mengatur kontainer */
        background-color: #fff; /* Warna latar belakang konten */
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        text-align: center;
        max-width: 600px;
        margin: 20px auto;
        padding: 30px;
    }

    h1 {
        color: #007bff; /* Warna teks utama */
        margin-bottom: 20px;
    }

    form {
        margin-top: 20px;
    }

    label {
        font-size: 18px;
        display: block;
        margin-bottom: 10px;
        text-align: left;
    }

    input[type="number"] {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    button[type="submit"] {
        background-color: #28a745; /* Warna hijau */
        color: #fff;
        border: none;
        padding: 12px 24px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        margin-top: 10px;
    }

    button[type="submit"]:hover {
        background-color: #218838; /* Warna hijau sedikit lebih gelap saat dihover */
    }

    a.btn-back {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 8px 16px; /* Mengurangi padding tombol */
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px; /* Mengurangi ukuran font tombol */
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        margin-top: 10px;
        display: inline-block;
    }

    a.btn-back:hover {
        background-color: #0056b3;
        text-decoration: none;
    }

    /* Gaya tambahan untuk link pada halaman */
    a {
        color: #007bff; /* Warna link */
        text-decoration: none;
        margin-top: 10px;
        display: inline-block;
    }

    a:hover {
        text-decoration: underline;
    }
</style>


</head>
<body>
    <div class="container">
    <a href="{{ route('home') }}" class="btn-back">Kembali ke Home</a>
    <h1>Jumlah Saldo: Rp{{ number_format(Auth::user()->saldo, 2, ',', '.') }}</h1>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: `{!! session('success') !!}`
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: `{!! $errors->first('amount') !!}`
            });
        </script>
    @endif

    <form action="{{ route('add-saldo') }}" method="POST">
        @csrf
        <label for="amount">Tambah Saldo (Rp):</label>
        <input type="number" id="amount" name="amount" step="0.01" required>
        <button type="submit">Tambah</button>
    </form>
</div>

</body>
</html>
