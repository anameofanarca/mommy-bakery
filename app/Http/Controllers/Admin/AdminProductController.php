<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
<<<<<<< HEAD
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('admin.product', compact('products'));
    }
=======
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
>>>>>>> 4513ceec811717e1d959cc42e234de287fe65df0

    public function create()
    {
        return view('admin.add-product');
    }

    public function store(Request $request)
    {
        $request->validate([
<<<<<<< HEAD
            'name'        => 'required|string|max:255',
            'category'    => 'required|string',
            'price'       => 'required|numeric',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
            'stock'       => 'required|integer|min:0', // <== Tambah validasi stock
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
            'is_active'   => $request->has('is_active'), // <== Sudah benar menangkap checkbox
            'stock'       => $request->stock ?? 0,       // <== Tambahkan ini agar stock tersimpan saat buat baru
        ]);

        return redirect()->route('admin.product')->with('success', 'Produk berhasil ditambahkan!');
=======
            'product_name'  => 'required|string|max:255',
            'category'      => 'required|string|max:100',
            'price'         => 'required|string',
            'description'   => 'nullable|string',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'stock'         => 'required|integer|min:0',
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
            'is_active'   => true,
            'stock'       => $request->stock ?? 0,
        ]);

        return redirect()
            ->route('admin.product')
            ->with('success', 'Produk berhasil ditambahkan!');
>>>>>>> 4513ceec811717e1d959cc42e234de287fe65df0
    }

    public function edit(Product $product)
    {
        return view('admin.edit-product', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
<<<<<<< HEAD
            'name'        => 'required|string|max:255',
            'category'    => 'required|string',
            'price'       => 'required|numeric',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
            'stock'       => 'required|integer|min:0', // <== Tambah validasi stock
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
            'is_active'   => $request->has('is_active'),
            'stock'       => $request->stock ?? 0,
        ]);

        return redirect()->route('admin.product')->with('success', 'Produk berhasil diupdate!');
=======
            'product_name'  => 'required|string|max:255',
            'category'      => 'required|string|max:100',
            'price'         => 'required|string',
            'description'   => 'nullable|string',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'stock'         => 'required|integer|min:0',
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
            'is_active'   => true,
            'stock'       => $request->stock ?? 0,
        ]);

        return redirect()
            ->route('admin.product')
            ->with('success', 'Produk berhasil diupdate!');
>>>>>>> 4513ceec811717e1d959cc42e234de287fe65df0
    }

    public function destroy(Product $product)
    {
        if ($product->image_url) {
            Storage::disk('public')->delete($product->image_url);
        }
<<<<<<< HEAD
        $product->delete();

        return redirect()->route('admin.product')->with('success', 'Produk berhasil dihapus!');
=======

        $product->delete();

        return redirect()
            ->route('admin.product')
            ->with('success', 'Produk berhasil dihapus!');
>>>>>>> 4513ceec811717e1d959cc42e234de287fe65df0
    }
}