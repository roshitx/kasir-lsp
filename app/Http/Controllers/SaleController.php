<?php

namespace App\Http\Controllers;

use App\Models\DetailSale;
use App\Models\Sale;
use App\Models\Products;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Sale::paginate(10);
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paymentMethod = [
            'QRIS' => 'QRIS',
            'Cash' => 'Cash',
            'Transfer Bank' => 'Transfer Bank',
            'Credit Card' => 'Credit Card',
            'E-Wallet' => 'E-Wallet',
        ];

        $products = Products::all();
        return view('transactions.create', compact('products', 'paymentMethod'));
    }

    public function getProduk($id)
    {
        $product = Products::find($id);

        return response()->json($product);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kasir = Auth::user()->name;
        $validate = $request->validate([
            'id' => 'required|string',
            'customer' => 'required|string',
            'payment_method' => 'required',
            'grand_total' => 'required|numeric',
        ]);

        $transaksi = new Sale();
        $transaksi->id = $request->id;
        $transaksi->customer = $request->customer;
        $transaksi->kasir = $kasir;
        $transaksi->total_price = $request->grand_total;
        $transaksi->payment_method = $request->payment_method;
        $transaksi->invoice = Str::random(16);

        // Simpan transaksi utama terlebih dahulu
        $transaksi->save();

        $transaksiId = $transaksi->id;

        $products = json_decode($request->product, true);

        foreach ($products as $product) {
            $detail_transaksi = new DetailSale();
            $detail_transaksi->product_id = $product['productId'];
            $detail_transaksi->quantity = $product['quantity'];
            $detail_transaksi->sub_total = $product['subTotal'];

            // Setelah transaksi utama disimpan, kita bisa mendapatkan ID-nya
            $detail_transaksi->sale_id = $transaksiId;
            $detail_transaksi->save();

            $this->reduceStock($product['productId'], $product['quantity']);
        }

        return redirect()->route('print.nota', ['invoice' => $transaksi->invoice]);
    }

    protected function reduceStock($productId, $quantity)
    {
        $product = Products::find($productId);

        if ($product) {
            // Kurangi stok sesuai quantity
            $product->stock -= $quantity;
            $product->save();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($invoice)
    {
        $sale = Sale::where('invoice', $invoice)->first();
        return view('transactions.show', [
            'sale' => $sale,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($invoice)
    {
        $transaksi = Sale::where('invoice', $invoice);
        $transaksi->delete();
        return redirect()->route('transaction.index')->with('success', 'Berhasil menghapus data transaksi!');
    }

    public function nota($invoice)
    {
        $transaksi = Sale::where('invoice', $invoice)->first();
        return view('transactions.invoice', compact('transaksi'));
    }

    public function print($invoice)
    {
        $time = time();
        $transaksi = Sale::where('invoice', $invoice)->first();
        $pdf = Pdf::loadView('transactions.pdf', ['transaksi' => $transaksi]);
        $filename = 'laporan_transaksi_' . date('YmdHis', $time) . '.pdf';

        return $pdf->download($filename);
    }
}
