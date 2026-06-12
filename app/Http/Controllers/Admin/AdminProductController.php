<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index(Request $request)
{
    $products = Product::query()
        ->when($request->category, function ($query) use ($request) {
            $query->where('category', $request->category);
        })
        ->orderBy('id', 'desc')
        ->get();

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

        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('products', 'public');
        }

        $price = str_replace(['.', ','], '', $request->price);

        Product::create([
            'name'        => $request->product_name,
            'category'    => $request->category,
            'price'       => (int) $price,
            'description' => $request->description,
            'image_url'   => $imagePath,
            // Perbaikan Utama: Membaca string '1' atau '0' langsung dari form HTML kamu
            'is_active'   => $request->is_active == '1' ? true : false, 
            'stock'       => $request->stock ?? 0,       
        ]);

        return redirect()
            ->route('admin.product')
            ->with('success', 'Produk berhasil ditambahkan!');
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

        if ($request->hasFile('product_image')) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            $imagePath = $request->file('product_image')->store('products', 'public');
        }

        $price = str_replace(['.', ','], '', $request->price);

        $product->update([
            'name'        => $request->product_name,
            'category'    => $request->category,
            'price'       => (int) $price,
            'description' => $request->description,
            'image_url'   => $imagePath,
            // Perbaikan Utama: Diterapkan juga pada fungsi update produk
            'is_active'   => $request->is_active == '1' ? true : false,
            'stock'       => $request->stock ?? 0,
        ]);

        return redirect()
            ->route('admin.product')
            ->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy(Product $product)
    {
        if ($product->image_url) {
            Storage::disk('public')->delete($product->image_url);
        }

        $product->delete();

        return redirect()
            ->route('admin.product')
            ->with('success', 'Produk berhasil dihapus!');
    }
}