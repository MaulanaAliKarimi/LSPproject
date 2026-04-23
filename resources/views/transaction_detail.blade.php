<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Riwayat Transaksi') }}
        </h2>
    </x-slot>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>ID Transaksi:</strong> {{ $transaction->id }}</p>
            <p><strong>Tanggal:</strong> {{ $transaction->created_at }}</p>
            <p><strong>Total:</strong> Rp {{ number_format($transaction->total, 0, ',', '.') }}</p>
        </div>
    </div>

    <h4>Daftar Item</h4>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Item</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->details as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->item->name }}</td>
                    <td>Rp {{ number_format($detail->item->price, 0, ',', '.') }}</td>
                    <td>{{ $detail->qty }}</td>
                    <td>
                        Rp {{ number_format($detail->qty * $detail->item->price, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>