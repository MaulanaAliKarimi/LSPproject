<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Item') }}
        </h2>
    </x-slot>

    <div class="py-12 px-6">

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($items->isEmpty())
            <div class="mt-6 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-dashed border-gray-300 dark:border-gray-600 flex flex-col items-center justify-center min-h-[200px]">
                <p class="text-sm text-gray-500 dark:text-gray-400">Item kosong</p>
            </div>
        @else
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf

                @error('selected_items')
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        Pilih minimal satu item terlebih dahulu.
                    </div>
                @enderror

                <div class="mt-6 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-dashed border-gray-300 dark:border-gray-600">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Pilih</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $index => $item)
                            <tr class="{{ $item->stock < 5 ? 'table-warning' : '' }}">
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $item->category->name ?? '-' }}</td>
                                <td>
                                    {{ $item->name }}
                                    @if($item->stock < 5)
                                        <span class="badge bg-warning text-dark ms-1">Stok menipis!</span>
                                    @endif
                                </td>
                                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td>{{ $item->stock }}</td>
                                <td>
                                    @if($item->stock > 0)
                                        <input class="form-check-input" type="checkbox"
                                            name="selected_items[]" value="{{ $item->id }}"
                                            id="item_{{ $item->id }}">
                                    @else
                                        <span class="badge bg-danger">Habis</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4 text-center">
                        <button type="submit" class="btn btn-success">
                            Tambahkan ke Keranjang
                        </button>
                    </div>
                </div>
            </form>
        @endif
    </div>
</x-app-layout>