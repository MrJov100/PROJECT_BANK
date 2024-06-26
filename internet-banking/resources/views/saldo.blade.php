<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Saldo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 600px;
            margin: 20px auto;
            padding: 30px;
        }

        h1 {
            color: #007bff;
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
            margin-bottom: 10px;
        }

        button[type="submit"], #submit-btn {
            background-color: #28a745;
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

        button[type="submit"]:hover, #submit-btn:hover {
            background-color: #218838;
        }

        .btn-back {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
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

        a {
            color: #007bff;
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
                    text: `{!! $errors->first() !!}`
                });
            </script>
        @endif

        <form id="saldo-form" action="{{ route('add-saldo') }}" method="POST" style="display:none;">
            @csrf
            <input type="hidden" id="amount" name="amount" required>
            <input type="hidden" id="pin" name="pin" required>
        </form>

        <label for="amount-input">Tambah Saldo (Rp):</label>
        <input type="number" id="amount-input" step="0.01" required>
        <button id="submit-btn">Tambah</button>
    </div>
    <script>
        $(document).ready(function() {
            $('#submit-btn').on('click', function(event) {
                event.preventDefault();

                var amount = $('#amount-input').val();

                if (amount < 10000) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Minimal saldo yang dapat ditambahkan adalah Rp 10,000.'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Masukkan PIN',
                    input: 'password',
                    inputAttributes: {
                        autocapitalize: 'off',
                        name: 'pin'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Kirim',
                    showLoaderOnConfirm: true,
                    preConfirm: (pin) => {
                        if (!pin) {
                            Swal.showValidationMessage('PIN harus diisi.');
                        }
                        return pin;
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#amount').val(amount);
                        $('#pin').val(result.value);
                        $('#saldo-form').submit();
                    }
                });
            });
        });
    </script>
</body>
</html>
