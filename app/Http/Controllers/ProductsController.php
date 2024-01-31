<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'string|max:60',
            'price' => 'numeric|required',
            'stock' => 'required|numeric'
        ]);

        Products::create($validatedData);
        return redirect()->route('products.index')->with('success', 'Berhasil membuat product baru');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $product)
    {
        return view('products.show', [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string|max:100',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);
        $product->update($validatedData);
        return redirect()->route('products.index')->with('success', 'Berhasil memperbarui product.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Berhasil menghapus product.');
    }
}
