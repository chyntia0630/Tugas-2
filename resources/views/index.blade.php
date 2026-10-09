<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Alat Tulis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            margin: 0;
            padding: 30px;
            color: #1f2937;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #2563eb;
            color: white;
            padding: 18px 24px;
            border-radius: 12px;
        }

        .produk {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            margin-top: 24px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 3px 12px #00000010;
        }

        .harga {
            color: #2563eb;
            font-weight: bold;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        button:disabled {
            background: #9ca3af;
            cursor: not-allowed;
        }
    </style>
</head>
<body>

    <header>
        <h2>Toko Alat Tulis</h2>
        <span>Keranjang (0)</span>
    </header>

    <h2>Daftar Barang</h2>

    <div class="produk">
        @foreach ($barangs as $barang)
            <div class="card">
                <h3>{{ $barang->nama }}</h3>

                <p class="harga">
                    Rp{{ number_format($barang->harga, 0, ',', '.') }}
                </p>

                <p>Stok: {{ $barang->stok }}</p>

                <button disabled>
                    Masukkan ke Keranjang
                </button>
            </div>
        @endforeach
    </div>

</body>
</html>
