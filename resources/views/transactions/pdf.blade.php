<!DOCTYPE html>
<html>
<head>
    <title>Transaksi {{ $transaksi->invoice }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="#">
    {{-- <link rel="icon" type="image/png" sizes="192x192" href="{{asset('assets/logo.png')}}"> --}}
    {{-- <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/logo.png')}}"> --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        #container {
            width: '100%';
        }

        .child {
            max-width: '50%';
            padding: 80px;
        }
    </style>
</head>
<body>
    <div id="container">
        <div class="child">
            <h4 class="text-center mt-5">Laporan transaksi no {{ $transaksi->id }}</h6>
                <hr>
            <div>
                <p>ID Transaksi : {{ $transaksi->id }}</p>
            </div>
            <div>
                <p>No Transaksi : {{ $transaksi->invoice }}</p>
            </div>
            <div>
                <p>Nama Customer : {{ $transaksi->customer }}</p>
            </div>
            <div>
                <p>Nama Kasir : {{ $transaksi->kasir }}</p>
            </div>
            <div>
                <p>Waktu : {{ $transaksi->created_at->format('H:i d M Y') }}</p>
            </div>
            <div>
                <p>Detail Transaksi :</p>
            </div>
            <div>
                <table class="table">
                    <thead>
                        <tr class="text-black">
                          <th class="text-center font-bold">#</th>
                          <th>Nama Product</th>
                          <th>Harga Satuan</th>
                          <th>Qty</th>
                          <th class="text-center">Sub Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($transaksi->salesDetails as $detail)
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
            <hr>
            <div>
                <p>Metode Pembayaran : {{ $transaksi->payment_method }}</p>
            </div>
            <div>
                <p>Grand Total : <strong>Rp {{ number_format($transaksi->total_price, 0, ',', '.') }}</strong></p>
            </div>
        </div>
    </div>
</body>
</html>
