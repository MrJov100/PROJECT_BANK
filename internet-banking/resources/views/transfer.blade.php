<!DOCTYPE html>
<html>
<head>
    <title>Transfer Saldo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #2980b9, #2c3e50);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 500px;
            padding: 30px;
        }
        .btn-home {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-decoration: none;
        }
        .btn-home:hover {
            background-color: #0056b3;
        }
        .btn-transfer {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-transfer:hover {
            background-color: #218838;
        }
        .btn-back {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 6px 12px; /* Ukuran tombol yang lebih kecil */
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-top: 10px;
            display: inline-block;
            text-decoration: none;
        }
        .btn-back:hover {
            background-color: #0056b3;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('home') }}" class="btn-back">Kembali ke Home</a>
        <h1>Transfer Saldo</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form id="transfer-form" action="{{ route('transfer.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="account_number">Pilih Rekening Penerima:</label>
                <select class="form-control" id="account_number" name="account_number">
                    <option value="">-- Pilih Nomor Rekening --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->account_number }}">{{ $user->nama_lengkap }} ({{ $user->account_number }})</option>
                    @endforeach
                </select>
                @error('account_number')
                    <small class="text-danger">{{ $message }}</small><br>
                @enderror
            </div>
            <div class="form-group">
                <label for="amount">Jumlah (Rp):</label>
                <input type="number" class="form-control" id="amount" name="amount" step="0.01" required>
                @error('amount')
                    <small class="text-danger">{{ $message }}</small><br>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-transfer">Transfer</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#transfer-form').on('submit', function(event) {
                event.preventDefault();

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
                        // Kirim PIN ke server untuk validasi
                        return $.ajax({
                            url: '{{ route("validate-pin") }}',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                pin: pin
                            },
                            success: function(response) {
                                if (!response.valid) {
                                    Swal.showValidationMessage('PIN salah.');
                                }
                                return response.valid;
                            },
                            error: function() {
                                Swal.showValidationMessage('Terjadi kesalahan saat memvalidasi PIN.');
                            }
                        });
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#transfer-form').off('submit').submit();
                    }
                });
            });
        });
    </script>
</body>
</html>
