<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (Session::has('success'))
            <x-sweetalert :message="Session::get('success')" />
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12 text-gray-800 overflow-x-auto">
                    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3 text-white"><i class="bi bi-plus-lg"></i> Add</a>

                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr class="text-md font-semibold tracking-wide text-left text-gray-100 uppercase border-b bg-gray-400">
                                <th class="px-4 py-3 w-[1%] text-center">#</th>
                                <th class="px-4 py-3">Product</th>
                                <th class="px-4 py-3">Harga</th>
                                <th class="px-4 py-3">Stok</th>
                                <th class="px-4 py-3 w-[1%]">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <th class="text-center">{{ $loop->iteration }}</th>
                                <td>{{ $product->name }}</td>
                                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td>{{ ucfirst($product->stock) }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <a href="{{ route('products.show', $product->id) }}" type="button" class="btn btn-info btn-sm text-white"><i class="bi bi-eye"></i></a>
                                        <a href="{{ route('products.edit', $product->id) }}" type="button" class="btn btn-warning btn-sm text-white"><i class="bi bi-pencil-square"></i></a>
                                        <button class="btn btn-error text-white btn-sm deleteBtn" data-product="{{ $product->id }}"><i class="bi bi-trash3"></i></button>
                                        <form method="post" action="{{ route('products.destroy', ['product' => $product->id]) }}" class="hidden deleteForm" data-product="{{ $product->id }}">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $products->links('components.pagination') }}
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.btnDetail').click(function() {
                let modal = $('#detailModal').modal('show');
                let name = $(this).data('user-detail');
            })

            $('.deleteBtn').click(function() {
                const product = $(this).data('product');
                Swal.fire({
                    title: 'Anda yakin?'
                    , text: "Anda tidak bisa mengembalikan data ini!"
                    , icon: 'warning'
                    , showCancelButton: true
                    , confirmButtonColor: '#3085d6'
                    , cancelButtonColor: '#d33'
                    , confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const deleteForm = $(`.deleteForm[data-product="${product}"]`);
                        deleteForm.submit();
                    }
                });
            });
        })

    </script>
</x-app-layout>
