<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Semua Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (Session::has('success'))
            <x-sweetalert :message="Session::get('success')" />
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12 text-gray-800 overflow-x-auto">
                    <a href="{{ route('transaction.create') }}" class="btn btn-primary mb-3 text-white w-full"><i class="bi bi-cart"></i> Transaksi Baru</a>

                    <h3 class="mt-3 font-medium text-lg mb-2">Semua Transaksi</h3>
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr class="text-md font-semibold tracking-wide text-left text-gray-100 uppercase border-b bg-gray-400">
                                <th class="px-4 py-3 w-[1%] text-center">#</th>
                                <th class="px-4 py-3">ID Transaksi</th>
                                <th class="px-4 py-3">Customer</th>
                                <th class="px-4 py-3">Kasir</th>
                                <th class="px-4 py-3">Total</th>
                                <th class="px-4 py-3">Pembayaran</th>
                                <th class="px-4 py-3">Waktu</th>
                                <th class="px-4 py-3 w-[1%]">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                            <tr>
                                <th class="text-center">{{ $loop->iteration }}</th>
                                <td>{{ $transaction->id }}</td>
                                <td>{{ $transaction->customer }}</td>
                                <td>{{ $transaction->kasir }}</td>
                                <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                <td>{{ $transaction->payment_method }}</td>
                                <td>{{ $transaction->created_at->format('H:i, d M y') }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <a href="{{ route('transaction.show', $transaction->invoice) }}" type="button" class="btn btn-info btn-sm text-white"><i class="bi bi-eye"></i></a>
                                        <button class="btn btn-error text-white btn-sm deleteBtn" data-transaction="{{ $transaction->invoice }}"><i class="bi bi-trash3"></i></button>
                                        <form method="post" action="{{ route('transaction.destroy', ['transaction' => $transaction->invoice]) }}" class="hidden deleteForm" data-transaction="{{ $transaction->invoice }}">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $transactions->links('components.pagination') }}
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
                const transaction = $(this).data('transaction');
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
                        const deleteForm = $(`.deleteForm[data-transaction="${transaction}"]`);
                        deleteForm.submit();
                    }
                });
            });
        })

    </script>
</x-app-layout>
