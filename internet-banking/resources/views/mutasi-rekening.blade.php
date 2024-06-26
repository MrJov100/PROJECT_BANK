<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mutasi Rekening</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 800px;
            margin: 20px auto;
            padding: 30px;
        }

        h1 {
            color: #007bff;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        a.btn-back {
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

        a.btn-back:hover {
            background-color: #0056b3;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container" id="transactions-container" style="display:none;">
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

    <script>
        $(document).ready(function() {
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
                        url: '{{ route("validate-pin") }}', // Pastikan rute ini ada di web.php
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
                    $('#transactions-container').show();
                } else {
                    window.location.href = '{{ route("home") }}';
                }
            });
        });
    </script>
</body>
</html>
