<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border-l-4 border-orange-500">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-orange-100 dark:bg-orange-500/10 rounded-lg">
                            <svg class="w-8 h-8 text-orange-600 dark:text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold">Halo, {{ Auth::user()->name }}!</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Selamat datang kembali di sistem portal RPL. Silakan pilih menu untuk memulai.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-dashed border-gray-300 dark:border-gray-600 flex flex-col items-center justify-center min-h-[200px]">
                <p class="text-gray-500 dark:text-gray-400 font-medium italic">Zonk</p>
            </div>

        </div>
    </div>
</x-app-layout>