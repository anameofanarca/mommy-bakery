<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)
            ->orderBy('id', 'desc')
            ->get();

        return view('menu.index', compact('products')); // kirim ke view
    }

    public function byCategory($category)
    {
    $products = Product::where('is_active', true)
        ->where('category', $category)
        ->orderBy('id', 'desc')
        ->get();

    return view('menu.' . $category, compact('products'));
    }

    public function show(Product $product)
    {
        return view('menu.detail', compact('product'));
    }
}