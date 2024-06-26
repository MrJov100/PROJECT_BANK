<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Internet Banking</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #2980b9, #2c3e50); /* Gradient background */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.95); /* Background semi-transparent putih */
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 600px;
            margin: 20px;
            padding: 30px;
            color: #333; /* Warna teks utama */
        }
        h1 {
            color: #007bff; /* Warna teks utama */
            font-size: 36px;
            margin-bottom: 20px;
            text-transform: uppercase; /* Transformasi teks menjadi huruf kapital */
            letter-spacing: 2px; /* Jarak antar huruf */
        }
        .saldo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
        }
        .saldo-text {
            font-size: 24px;
            margin-right: 10px;
        }
        .saldo-value {
            font-size: 24px;
            color: #28a745; /* Warna teks jumlah saldo */
            font-weight: bold;
        }
        .saldo-hidden {
            font-size: 24px;
            color: #d9534f; /* Warna teks saat saldo tersembunyi */
            font-weight: bold;
        }
        .button-container {
            margin-top: 20px;
        }
        .button-container a {
            text-decoration: none;
        }
        .button-container button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px; /* Mengurangi padding tombol */
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            margin-right: 10px;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 123, 255, 0.1);
        }
        .button-container button:hover {
            background-color: #0056b3;
        }
        form {
            margin-top: 20px;
        }
        
        form button {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 10px 20px; /* Mengurangi padding tombol */
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 6px rgba(220, 53, 69, 0.1);
        }
        form button:hover {
            background-color: #c82333;
        }
        .btn-outline-primary {
            color: #007bff;
            border-color: #007bff;
            box-shadow: none;
        }
        .btn-outline-primary:hover {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }
        .rekening {
            font-size: 18px; /* Ukuran font nomor rekening */
            margin-bottom: 20px; /* Menambahkan margin bottom untuk jarak visual */
            background-color: #f8f9fa; /* Warna latar belakang nomor rekening */
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: inline-block; /* Menyesuaikan ukuran dengan konten */
        }
        .rekening span {
            font-weight: bold;
            color: #007bff; /* Warna teks nomor rekening */
        }
    </style>
    <script>
        function toggleSaldo() {
            var saldoElement = document.getElementById('saldo-value');
            var toggleButton = document.getElementById('toggle-saldo-btn');
            
            if (saldoElement.innerHTML === 'Rp{{ number_format(Auth::user()->saldo, 2, ',', '.') }}') {
                saldoElement.innerHTML = '*************';
                toggleButton.innerHTML = '🔓 Lihat Saldo';
                toggleButton.classList.remove('btn-danger');
                toggleButton.classList.add('btn-success');
            } else {
                saldoElement.innerHTML = 'Rp{{ number_format(Auth::user()->saldo, 2, ',', '.') }}';
                toggleButton.innerHTML = '🔒 Tutup Saldo';
                toggleButton.classList.remove('btn-success');
                toggleButton.classList.add('btn-danger');
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Selamat Datang, {{ Auth::user()->nama_lengkap }}</h1>

        <div class="rekening">
            Nomor Rekening: <span>{{ Auth::user()->account_number }}</span>
        </div>

        <div class="saldo-container">
            <div class="saldo-text">
                Saldo:
            </div>
            <div id="saldo-value" class="saldo-value">
                Rp{{ number_format(Auth::user()->saldo, 2, ',', '.') }}
            </div>
            <div id="saldo-hidden" class="saldo-hidden" style="display: none;">
                *************
            </div>
            <button id="toggle-saldo-btn" onclick="toggleSaldo()" class="btn btn-danger btn-toggle">
                🔒 Tutup Saldo
            </button>
        </div>

        <div class="button-container">
            <a href="{{ route('saldo') }}"><button class="btn btn-outline-primary">Setor Uang</button></a>
            <a href="{{ route('mutasi-rekening') }}"><button class="btn btn-outline-primary">Mutasi Rekening</button></a>
            <a href="{{ route('transfer') }}"><button class="btn">Transfer Saldo</button></a> <!-- Tombol Transfer -->
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
</body>
</html>
