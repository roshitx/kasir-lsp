<!DOCTYPE html>
<html>
<head>
    <title>Struk Nota Transaksi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="#">
    {{-- <link rel="icon" type="image/png" sizes="192x192" href="{{asset('assets/logo.png')}}"> --}}
    {{-- <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/logo.png')}}"> --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            font-size: 13px;
            font-family: 'Arial', sans-serif;
            line-height: 1.5;
        }

        .invoice {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 10px;
            width: 75mm;
            box-shadow: 0px 0px 10px #ccc;
            text-align: center;
            display: inline-block;
            vertical-align: top;
        }

        h1 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #343a40;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th,
        td {
            padding: 3px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        tfoot td {
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        @media print {
            @page {
                size: 50mm 90mm;
                margin: 0;
            }

            header,
            footer {
                display: none;
            }

            .no-print {
                display: none;
            }

            button {
                display: none;
            }

            @supports (-webkit-touch-callout: none) {

                /* for Safari */
                body::before {
                    content: "";
                    display: block;
                    position: fixed;
                    top: 0;
                    right: 0;
                    bottom: 0;
                    left: 0;
                    background-color: white;
                }

                body {
                    -webkit-print-color-adjust: exact;
                }
            }

            @media print and (-ms-high-contrast: active),
            print and (-ms-high-contrast: none) {

                /* for Edge and IE */
                body {
                    -ms-overflow-style: none;
                }
            }
        }

    </style>
</head>
<body>
    <div class="no-print" style="margin-bottom: 1em; margin-top: 1em;">
        <a href="{{route('transaction.index')}}" class="btn btn-danger"><i class="fa fa-desktop mr-2"></i><b>Kembali</b></a>
    </div>
    <div class="invoice">
        <div class="row">
            <div class="col-4">
                <img class="img" src="{{asset('assets/logo.png')}}" alt="" width="100%">
            </div>
            <div class="col-8 text-left">
                <div style="font-size: 2em; font-weight: 700; color: black;">App Kasir</div>
                <div style="font-size: 1.75em; font-weight: 500; color: black; margin-top: -5px;">Cashier App</div>
            </div>
        </div>
        <div class="py-4">
            Terima kasih sudah menjadi loyal customer kami
        </div>
        <table>
            <tr>
                <td class="mb-0">No:</td>
                <td class="mb-0">{{ $transaksi->invoice }}</td>
            </tr>
            <tr>
                <td class="mb-0">Kasir:</td>
                <td class="mb-0">{{ auth()->user()->name }}</td>
            </tr>
            <tr>
                <td class="mb-0">Waktu:</td>
                <td class="mb-0">{{Carbon\Carbon::now()->format('H:i:s')}}</td>
            </tr>
            <tr>
                <td class="mb-0">Tanggal:</td>
                <td class="mb-0">{{Carbon\Carbon::today()->format('d/m/Y')}}</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            @php
            $total = 0;
            @endphp

            <!-- Loop untuk setiap produk dalam transaksi -->
            @foreach ($transaksi->salesDetails as $detail)
            <tr>
                <td>{{ $detail->product->name }} <span class="text-danger">x{{ $detail->quantity }}</span></td>
                <td class="text-right">Rp {{ number_format($detail->sub_total, 0, 0, '.') }}</td>
            </tr>
            @php
            $total += $detail->sub_total;
            @endphp
            @endforeach
            <tr>
                <td>Total</td>
                <td class="text-right">Rp {{number_format($total,0,0,'.')}}</td>
            </tr>
        </table>
        <div class="d-flex justify-content-center">
            <p class="fw-bold m-0">Terimakasih sudah berbelanja!</p>
        </div>
    </div>

    <script>
        window.print();

    </script>
</body>
</html>
