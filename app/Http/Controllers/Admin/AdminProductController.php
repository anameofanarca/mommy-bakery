<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('admin.product', compact('products'));
    }

    public function create()
    {
        return view('admin.add-product');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string',
            'price'       => 'required|numeric',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
            'stock'       => 'required|integer|min:0', 
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name'        => $request->name,
            'category'    => $request->category,
            'price'       => $request->price,
            'description' => $request->description,
            'image_url'   => $imagePath,
            // Perbaikan Utama: Membaca string '1' atau '0' langsung dari form HTML kamu
            'is_active'   => $request->is_active == '1' ? true : false, 
            'stock'       => $request->stock ?? 0,       
        ]);

        return redirect()->route('admin.product')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        return view('admin.edit-product', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string',
            'price'       => 'required|numeric',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
            'stock'       => 'required|integer|min:0', 
        ]);

        $imagePath = $product->image_url;
        if ($request->hasFile('image')) {
            if ($imagePath) Storage::disk('public')->delete($imagePath);
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name'        => $request->name,
            'category'    => $request->category,
            'price'       => $request->price,
            'description' => $request->description,
            'image_url'   => $imagePath,
            // Perbaikan Utama: Diterapkan juga pada fungsi update produk
            'is_active'   => $request->is_active == '1' ? true : false,
            'stock'       => $request->stock ?? 0,
        ]);

        return redirect()->route('admin.product')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy(Product $product)
    {
        if ($product->image_url) {
            Storage::disk('public')->delete($product->image_url);
        }
        $product->delete();

        return redirect()->route('admin.product')->with('success', 'Produk berhasil dihapus!');
    }
}