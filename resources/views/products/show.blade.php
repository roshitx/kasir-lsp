<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12 text-gray-800 overflow-x-auto">
                    <div class="row flex-row">
                        <div class="col mb-3 mt-3">
                            <h1 class="text-sm">Nama Product :</h1>
                            <h1 class="text-bold text-lg">{{ $product->name }}</h1>
                        </div>
                        <hr>
                        <div class="col mb-3 mt-3">
                            <h1 class="text-sm">Deskripsi Product :</h1>
                            <h1 class="text-bold text-lg">{{ $product->description }}</h1>
                        </div>
                        <hr>
                        <div class="col mb-3 mt-3">
                            <h1 class="text-sm">Harga Product :</h1>
                            <h1 class="text-bold text-lg">Rp {{ number_format($product->price, 0, ',', '.') }},-</h1>
                        </div>
                        <hr>
                        <div class="col mb-3 mt-3">
                            <h1 class="text-sm">Stock Product :</h1>
                            <h1 class="text-bold text-lg">{{ $product->stock }} Pcs</h1>
                        </div>
                        <hr>
                        <div class="col mb-3 mt-3">
                            <h1 class="text-sm">Dibuat :</h1>
                            <h1 class="text-bold text-lg">{{ $product->created_at->format('H:i, d F Y') }}</h1>
                        </div>
                    </div>
                    <x-button-link-secondary href="{{ route('products.index') }}">Kembali</x-button-link-secondary>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
