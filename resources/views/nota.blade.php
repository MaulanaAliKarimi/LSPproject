<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nota #{{ $transaction->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="bg-gray-50 text-gray-900">
<div class="py-12">
    <div class="max-w-md mx-auto px-4">

        <div class="flex justify-center mb-4">
            <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl flex items-center justify-center shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow border border-dashed border-gray-300">
            <h5 class="text-center font-bold mb-1">NOTA PEMBELIAN</h5>
            <p class="text-center text-sm text-gray-500 mb-4">#{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</p>

            <div class="text-sm mb-3">
                <p><strong>Kasir:</strong> {{ $transaction->user->name }}</p>
                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($transaction->date)->format('d/m/Y H:i') }}</p>
            </div>

            <hr>

            <table class="table table-sm mt-3">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th class="text-center">Qty</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaction->details as $detail)
                    <tr>
                        <td>{{ $detail->item->name }}</td>
                        <td class="text-center">{{ $detail->qty }}</td>
                        <td class="text-end">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">Total</th>
                        <th class="text-end">Rp {{ number_format($transaction->total, 0, ',', '.') }}</th>
                    </tr>
                    <tr>
                        <td colspan="2">Uang Bayar</td>
                        <td class="text-end">Rp {{ number_format($transaction->pay_total, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td colspan="2"><strong>Kembalian</strong></td>
                        <td class="text-end"><strong>Rp {{ number_format($kembalian, 0, ',', '.') }}</strong></td>
                    </tr>
                </tfoot>
            </table>

            <hr>
            <p class="text-center text-sm text-gray-400 mt-3">Terima kasih atas pembelian Anda!</p>
        </div>

        <div class="mt-4 text-center no-print">
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Kembali</a>
        </div>

    </div>
</div>
</body>
</html>