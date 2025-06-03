<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // Ambil produk dengan relasi brand dan images, 10 per halaman
        $products = Product::with(['brand', 'images'])->paginate(10);

        return view('produk', compact('products'));
    }

    public function show($id)
    {
        // Ambil produk berdasarkan ID dengan relasi brand dan images
        $product = Product::with(['brand', 'images'])->findOrFail($id);

        return view('detail-produk', compact('product'));
    }
}
