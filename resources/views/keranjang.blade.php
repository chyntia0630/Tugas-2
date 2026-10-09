<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            margin: 0;
            padding: 30px;
            color: #1f2937;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        header {
            background: #2563eb;
            color: white;
            padding: 20px 24px;
            border-radius: 12px;
            margin-bottom: 24px;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 12px;
            margin-bottom: 16px;
            box-shadow: 0 3px 12px #00000010;
        }

        .item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .muted {
            color: #6b7280;
        }

        .harga {
            color: #2563eb;
            font-weight: bold;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        button, .button {
            padding: 10px 14px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .primary {
            background: #2563eb;
            color: white;
        }

        .danger {
            background: #dc2626;
            color: white;
        }

        .secondary {
            background: #e5e7eb;
            color: #1f2937;
        }

        .total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 20px;
            font-weight: bold;
            gap: 12px;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 16px;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
        }

        .success {
            background: #dcfce7;
            color: #166534;
        }

        .empty {
            text-align: center;
            padding: 45px 20px;
        }

        form {
            display: inline;
        }

        button:disabled {
            background: #9ca3af;
            cursor: not-allowed;
            opacity: 0.7;
        }

        @media (max-width: 500px) {
            body {
                padding: 16px;
            }

            .item, .total {
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
<div class="container">

    <header>
        <h1>Keranjang Belanja</h1>
        <p>Belanja alat tulis dengan mudah</p>
        <a href="/" class="button secondary"> Kembali ke Toko</a>
    </header>

    @if (session('success'))
        <div class="alert success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert error">{{ session('error') }}</div>
    @endif

    @if (count($items) > 0)

        @foreach ($items as $item)
            <div class="card">
                <div class="item">
                    <div>
                        <h3>{{ $item['barang']->nama }}</h3>

                        <p class="harga">
                            Rp{{ number_format($item['barang']->harga, 0, ',', '.') }}
                        </p>

                        <p class="muted">
                            Subtotal:
                            Rp{{ number_format($item['subtotal'], 0, ',', '.') }}
                        </p>
                    </div>

                    <div class="actions">
                        <form action="{{ route('keranjang.kurang', $item['barang']->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="secondary">−</button>
                        </form>

                        <strong>{{ $item['jumlah'] }}</strong>

                        <form action="{{ route('keranjang.tambahJumlah', $item['barang']->id) }}" method="POST">
                            @csrf
                            <button 
                            type="submit"
                            class="primary"
                            {{ $item['jumlah'] >= $item['barang']->stok ? 'disabled' : '' }}
                            >
                            
                            +
                        
                        </button>
                        </form>

                        <form action="{{ route('keranjang.hapus', $item['barang']->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="card">
            <div class="total">
                <span>Total</span>
                <span class="harga">
                    Rp{{ number_format($total, 0, ',', '.') }}
                </span>
            </div>

            <form action="{{ route('keranjang.kosongkan') }}" method="POST"
                  onsubmit="return confirm('Yakin ingin mengosongkan keranjang?')">
                @csrf
                <button type="submit" class="danger">
                    Kosongkan Keranjang
                </button>
            </form>
        </div>

    @else
        <div class="card empty">
            <h2>Keranjang masih kosong</h2>
            <p class="muted">Yuk, pilih barang yang kamu butuhkan!</p>
            <a href="/" class="button primary">Mulai Belanja</a>
        </div>
    @endif

</div>
</body>
</html>
