<!DOCTYPE html>
<html>
<head>
    <title>Tambah Saldo</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <a href="{{ route('home') }}">Kembali ke Home</a>
    <h1>Jumlah Saldo: Rp{{ number_format(Auth::user()->saldo, 2) }}</h1>

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
        <label>Tambah Saldo (Rp):</label>
        <input type="number" name="amount" step="0.01" required>
        <button type="submit">Tambah</button>
    </form>
</body>
</html>
