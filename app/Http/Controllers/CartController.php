<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Tampilkan halaman keranjang.
     */
    public function index()
    {
        $cart = session('cart', []);

        $items = [];
        $total = 0;

        foreach ($cart as $productId => $qty) {
            $product = Product::find($productId);

            if (!$product) continue; // skip kalau produk udah dihapus dari DB

            $subtotal = $product->price * $qty;

            $items[] = [
                'product'  => $product,
                'qty'      => $qty,
                'subtotal' => $subtotal,
            ];

            $total += $subtotal;
        }

        return view('cart', compact('items', 'total'));
    }

    /**
     * Tambah produk ke keranjang.
     */
    public function add(Request $request, $id)
    {
        Product::findOrFail($id); // pastikan produk ada

        $cart = session('cart', []);

        $qty = (int) $request->input('qty', 1);
        if ($qty < 1) $qty = 1;

        if (isset($cart[$id])) {
            $cart[$id] += $qty;
        } else {
            $cart[$id] = $qty;
        }

        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    /**
     * Update jumlah (qty) produk di keranjang.
     */
    public function update(Request $request, $id)
    {
        $cart = session('cart', []);

        $qty = (int) $request->input('qty', 1);

        if ($qty < 1) {
            unset($cart[$id]);
        } else {
            $cart[$id] = $qty;
        }

        session(['cart' => $cart]);

        return redirect()->route('cart.index');
    }

    /**
     * Hapus produk dari keranjang.
     */
    public function remove($id)
    {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang.');
    }

    /**
     * Kosongkan keranjang (opsional, dipanggil setelah checkout sukses).
     */
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index');
    }
}