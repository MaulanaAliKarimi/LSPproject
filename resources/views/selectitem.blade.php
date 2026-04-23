<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <div v-else class="mt-6 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-dashed border-gray-300 dark:border-gray-600 flex flex-col items-center justify-center min-h-[200px]">
        <p class="text-sm text-gray-500 dark:text-gray-400">Item kosong</p>
    </div>
    
  <!-- <button type="submit" class="btn btn-danger">Tambahkan ke Keranjang</button> -->
</x-app-layout>