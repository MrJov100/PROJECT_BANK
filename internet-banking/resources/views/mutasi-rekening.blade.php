<!-- resources/views/mutasi-rekening.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Mutasi Rekening</title>
</head>
<body>
    <h1>Daftar Mutasi Rekening</h1>
<a href="{{ route('home') }}">Kembali ke Home</a>
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
</body>
</html>
