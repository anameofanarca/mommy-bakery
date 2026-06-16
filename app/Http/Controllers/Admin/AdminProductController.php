<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    private function uploadToCloudinary($file): ?string
    {
        $cloudinaryUrl = env('CLOUDINARY_URL');

        if (!$cloudinaryUrl) {
            throw new \Exception('CLOUDINARY_URL belum diatur di file .env');
        }

        $cloudinary = new Cloudinary($cloudinaryUrl);

        $uploadedFile = $cloudinary->uploadApi()->upload(
            $file->getRealPath(),
            [
                'folder' => 'mommy-bakery/products',
            ]
        );

        return $uploadedFile['secure_url'] ?? null;
    }

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
            'product_name'  => 'required|string|max:255',
            'category'      => 'required|string',
            'price'         => 'required',
            'description'   => 'nullable|string',
            'product_image' => 'nullable|image|max:2048',
            'stock'         => 'required|integer|min:0',
        ]);

        $imagePath = null;

        if ($request->hasFile('product_image')) {
            $imagePath = $this->uploadToCloudinary($request->file('product_image'));
        }

        $price = str_replace(['.', ','], '', $request->price);

        Product::create([
            'name'        => $request->product_name,
            'category'    => $request->category,
            'price'       => (int) $price,
            'description' => $request->description,
            'image_url'   => $imagePath,
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
            'product_name'  => 'required|string|max:255',
            'category'      => 'required|string',
            'price'         => 'required',
            'description'   => 'nullable|string',
            'product_image' => 'nullable|image|max:2048',
            'stock'         => 'required|integer|min:0',
        ]);

        $imagePath = $product->image_url;

        if ($request->hasFile('product_image')) {
            if ($imagePath && !Str::startsWith($imagePath, ['http://', 'https://'])) {
                Storage::disk('public')->delete($imagePath);
            }

            $imagePath = $this->uploadToCloudinary($request->file('product_image'));
        }

        $price = str_replace(['.', ','], '', $request->price);

        $product->update([
            'name'        => $request->product_name,
            'category'    => $request->category,
            'price'       => (int) $price,
            'description' => $request->description,
            'image_url'   => $imagePath,
            'is_active'   => $request->is_active == '1' ? true : false,
            'stock'       => $request->stock ?? 0,
        ]);

        return redirect()
            ->route('admin.product')
            ->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy(Product $product)
    {
        if ($product->image_url && !Str::startsWith($product->image_url, ['http://', 'https://'])) {
            Storage::disk('public')->delete($product->image_url);
        }

        if (method_exists($product, 'orderItems')) {
            $product->orderItems()->delete();
        }

        $product->delete();

        return redirect()
            ->route('admin.product')
            ->with('success', 'Produk berhasil dihapus!');
    }
}