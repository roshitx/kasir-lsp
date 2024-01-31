<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12 text-gray-800 overflow-x-auto">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Edit Product') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Mohon isi kolom dibawah dengan benar.') }}
                        </p>
                    </header>
                    <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data" class="mt-6 space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="max-w-xl">
                            <div class="form-control">
                                <x-input-label for="name" :value="__('Nama Product')" required />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="$product->name" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                        </div>

                        <div class="max-w-xl">
                            <div class="form-control">
                                <x-input-label for="description" :value="__('Description')" :required="false"/>
                                <x-textarea-input name="description" :value="$product->description"/>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>
                        </div>

                        <div class="max-w-xl">
                            <div class="form-control">
                                <x-input-label for="price" :value="__('Harga')" required />
                                <x-text-input id="price" name="price" type="number" class="mt-1 block w-full" :value="$product->price" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('price')" />
                            </div>
                        </div>

                        <div class="max-w-xl">
                            <div class="form-control">
                                <x-input-label for="stock" :value="__('Stok')" required />
                                <x-text-input id="stock" name="stock" type="number" class="mt-1 block w-full" :value="$product->stock" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('stock')" />
                            </div>
                        </div>

                        <x-primary-button>Simpan</x-primary-button>
                        <x-button-link-secondary href="{{ route('products.index') }}">Batal</x-button-link-secondary>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
