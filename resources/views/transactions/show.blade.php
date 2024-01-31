<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12 text-gray-800 overflow-x-auto">
                    <div class="row flex-row">
                        <div class="col mb-3 mt-3">
                            <h1 class="text-sm">ID Transaksi :</h1>
                            <h1 class="text-bold text-lg">{{ $sale->id }}</h1>
                        </div>
                        <hr>
                        <div class="col mb-3 mt-3">
                            <h1 class="text-sm">No Invoice :</h1>
                            <h1 class="text-bold text-lg">{{ $sale->invoice }}</h1>
                        </div>
                        <hr>
                        <div class="col mb-3 mt-3">
                            <h1 class="text-sm">Customer :</h1>
                            <h1 class="text-bold text-lg">{{ $sale->customer }}</h1>
                        </div>
                        <hr>
                        <div class="col mb-3 mt-3">
                            <h1 class="text-sm">Kasir :</h1>
                            <h1 class="text-bold text-lg">{{ $sale->kasir }}</h1>
                        </div>
                        <hr>
                        <div class="col mb-3 mt-3">
                            <h1 class="text-sm">Waktu :</h1>
                            <h1 class="text-bold text-lg">{{ $sale->created_at->format('H:i, d F Y') }}</h1>
                        </div>
                        <div class="col mb-3 mt-3">
                            <h1 class="text-sm">Detail Product :</h1>
                        </div>
                        <div class="bg-gray-100 p-5 rounded-lg">
                            <div class="overflow-auto">
                                <table class="table mt-3">
                                    <thead>
                                        <tr class="text-black">
                                          <th class="w-[1%] text-center font-bold">#</th>
                                          <th>Nama Product</th>
                                          <th>Harga Satuan</th>
                                          <th>Qty</th>
                                          <th class="w-[20%] text-center">Sub Total</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach ($sale->salesDetails as $detail)
                                        <tr>
                                            <td class="text-center font-bold">{{ $loop->iteration }}</td>
                                            <td>{{ $detail->product->name }}</td>
                                            <td>Rp {{ number_format($detail->product->price, 0, ',', '.') }}</td>
                                            <td>{{ $detail->quantity }}</td>
                                            <td class="text-center">Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                      </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col mb-3 mt-3">
                            <h1 class="text-sm">Metode Pembayaran :</h1>
                            <h1 class="text-bold text-lg">{{ $sale->payment_method }}</h1>
                        </div>
                        <hr>
                        <div class="col mb-5 mt-3">
                            <h1 class="text-sm">Grand Total :</h1>
                            <h1 class="font-bold text-lg">Rp {{ number_format($sale->total_price, 0, ',', '.') }},-</h1>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <x-button-link-secondary href="{{ route('transaction.index') }}">Kembali</x-button-link-secondary>
                        <a href="{{ route('print.transaksi', $sale->invoice) }}" class="btn btn-primary text-light">
                            <i class="bi bi-filetype-pdf"></i> PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
