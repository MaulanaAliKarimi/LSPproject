<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Riwayat Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12 px-6">

        @if($transactions->isEmpty())
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-dashed border-gray-300 dark:border-gray-600 flex flex-col items-center justify-center min-h-[200px]">
                <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada riwayat transaksi.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Total</th>
                            <th scope="col">Uang Bayar</th>
                            <th scope="col">Kembalian</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $index => $transaction)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $transaction->user->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($transaction->date)->format('d/m/Y H:i') }}</td>
                            <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($transaction->pay_total, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($transaction->pay_total - $transaction->total, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('transaction_detail', $transaction->id) }}" class="btn btn-primary">
                                  Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>
</x-app-layout>