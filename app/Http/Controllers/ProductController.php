<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Mengambil semua produk yang aktif di web
        $products = Product::where('is_active', true)
            ->orderBy('id', 'desc')
            ->get();

        return view('menu.index', compact('products'));
    }

    public function byCategory($category)
    {
        // Mengambil produk aktif berdasarkan kategori tertentu (nasibox, bakery, dll.)
        $products = Product::where('is_active', true)
            ->where('category', $category)
            ->orderBy('id', 'desc')
            ->get();

        return view('menu.' . $category, compact('products'));
    }

    public function show(Product $product)
    {
        // Proteksi: cegah produk nonaktif diakses via URL langsung
        if (!$product->is_active) {
            abort(404);
        }

        return view('menu.detail', compact('product'));
    }
}