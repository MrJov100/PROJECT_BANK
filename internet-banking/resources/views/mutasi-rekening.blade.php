<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mutasi Rekening</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f0f0; /* Warna latar belakang */
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #fff; /* Warna latar belakang konten */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 800px;
            margin: 20px auto;
            padding: 30px;
        }
        h1 {
            color: #007bff; /* Warna teks utama */
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2; /* Warna latar header kolom */
        }
        table td {
            font-size: 16px;
        }
        a {
            color: #007bff; /* Warna link */
            text-decoration: none;
            margin-top: 10px;
            display: inline-block;
        }
        a:hover {
            text-decoration: underline;
        }
        .btn-back {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        margin-top: 10px;
        display: inline-block;
    }

    .btn-back:hover {
        background-color: #0056b3;
        text-decoration: none;
    }

    </style>
</head>
<body>
    <div class="container">
        <h1>Daftar Mutasi Rekening</h1>
        <a href="{{ route('home') }}" class="btn-back">Kembali ke Home</a>

        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Deskripsi</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->created_at }}</td>
                    <td>{{ $transaction->deskripsi }}</td>
                    <td>Rp{{ number_format($transaction->jumlah, 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
