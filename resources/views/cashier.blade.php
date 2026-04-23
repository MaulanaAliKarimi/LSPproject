<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Portal RPL') }} - Kasir</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 dark:bg-gray-950 dark:text-gray-100">
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

        <div class="flex justify-center mb-6">
            <div class="w-20 h-20 bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl flex items-center justify-center shadow-lg">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
        </div>

        @if($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('cashier.pay') }}" method="POST">
            @csrf
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-dashed border-gray-300 dark:border-gray-600">

                <h5 class="font-semibold mb-4 text-gray-700 dark:text-gray-200">Detail Pembelian</h5>

                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">
                    <strong>Kasir:</strong> {{ Auth::user()->name }}
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                    <strong>Tanggal:</strong> {{ now()->format('d/m/Y H:i') }}
                </p>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga Satuan</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="cartTable">
                        @foreach($cartItems as $id => $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td class="item-price" data-price="{{ $item['price'] }}">
                                Rp {{ number_format($item['price'], 0, ',', '.') }}
                            </td>
                            <td>
                                <input type="number" name="qty[{{ $id }}]"
                                    class="form-control qty-input" style="width:80px"
                                    value="1" min="1" max="{{ $item['stock'] }}"
                                    data-price="{{ $item['price'] }}">
                            </td>
                            <td class="subtotal">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Total</th>
                            <th id="grandTotal">Rp {{ number_format($total, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>

                <div class="mt-4">
                    <label class="form-label text-gray-700 dark:text-gray-300">Uang Bayar (Rp)</label>
                    <input type="number" name="pay_total" id="pay_total"
                        class="form-control @error('pay_total') is-invalid @enderror"
                        placeholder="Masukkan jumlah uang" min="0" value="{{ old('pay_total') }}">
                    @error('pay_total')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-3 text-end text-sm text-gray-500 dark:text-gray-400">
                    Kembalian: <strong id="kembalian">Rp 0</strong>
                </div>
            </div>

            <div class="mt-4 text-center">
                <a href="{{ route('checkout') }}" class="btn btn-secondary me-2">Kembali</a>
                <button type="submit" class="btn btn-success">Bayar</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Hitung subtotal & kembalian secara real-time
    let totalBase = {{ $total }};

    function formatRupiah(num) {
        return 'Rp ' + num.toLocaleString('id-ID');
    }

    function recalculate() {
        let grandTotal = 0;
        document.querySelectorAll('.qty-input').forEach(function(input) {
            const price = parseInt(input.dataset.price);
            const qty = parseInt(input.value) || 1;
            const subtotal = price * qty;
            grandTotal += subtotal;
            input.closest('tr').querySelector('.subtotal').textContent = formatRupiah(subtotal);
        });

        document.getElementById('grandTotal').textContent = formatRupiah(grandTotal);
        totalBase = grandTotal;
        updateKembalian();
    }

    function updateKembalian() {
        const pay = parseInt(document.getElementById('pay_total').value) || 0;
        const kembalian = pay - totalBase;
        document.getElementById('kembalian').textContent = formatRupiah(kembalian >= 0 ? kembalian : 0);
    }

    document.querySelectorAll('.qty-input').forEach(function(input) {
        input.addEventListener('input', recalculate);
    });

    document.getElementById('pay_total').addEventListener('input', updateKembalian);
</script>
</body>
</html>