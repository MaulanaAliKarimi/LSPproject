<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Keranjang Anda') }}
        </h2>
    </x-slot>

    <div class="py-12 px-6">

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(empty($cart))
            <div class="mt-6 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-dashed border-gray-300 dark:border-gray-600 flex flex-col items-center justify-center min-h-[200px]">
                <p class="text-sm text-gray-500 dark:text-gray-400">Anda belum menambahkan item ke dalam keranjang.</p>
                <a href="{{ route('selectitem') }}" class="btn btn-primary mt-3">Pilih Item</a>
            </div>
        @else
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $index => $cartItem)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $cartItem['name'] }}</td>
                            <td>Rp {{ number_format($cartItem['price'], 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $cartItem['id']) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus item ini dari keranjang?')">Batalkan pesanan</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" class="text-end">Total</th>
                            <th>Rp {{ number_format($total, 0, ',', '.') }}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>

                <div class="mt-4 text-center">
                    <a href="{{ route('selectitem') }}" class="btn btn-secondary me-2">Tambah Item Lagi</a>
                    <a href="{{ route('cashier') }}" class="btn btn-primary">Beli</button>
                </div>
            </div>
        @endif

    </div>
</x-app-layout>