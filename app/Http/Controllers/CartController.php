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

        foreach ($cart as $cartKey => $cartItem) {
            // Support cart lama: [productId => qty]
            if (is_numeric($cartItem)) {
                $productId = $cartKey;
                $qty = (int) $cartItem;
                $selectedItems = [];
            } else {
                // Support cart baru: [cartKey => ['product_id', 'qty', 'selected_items']]
                $productId = $cartItem['product_id'] ?? null;
                $qty = (int) ($cartItem['qty'] ?? 1);
                $selectedItems = $cartItem['selected_items'] ?? [];
            }

            $product = Product::find($productId);

            if (!$product) {
                continue;
            }

            $subtotal = $product->price * $qty;

            $items[] = [
                'cart_key'       => $cartKey,
                'product'        => $product,
                'qty'            => $qty,
                'subtotal'       => $subtotal,
                'selected_items' => $selectedItems,
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
        $product = Product::findOrFail($id);

        $cart = session('cart', []);

        $qty = (int) $request->input('qty', 1);

        if ($qty < 1) {
            $qty = 1;
        }

        $selectedItems = $request->input('selected_items', []);

        if (is_string($selectedItems)) {
            $selectedItems = json_decode($selectedItems, true) ?? [];
        }

        if (!is_array($selectedItems)) {
            $selectedItems = [];
        }

        // Kalau ada pilihan snack box, bikin key unik supaya pilihan berbeda tidak ketimpa
        if (!empty($selectedItems)) {
            $cartKey = $id . '_' . md5(json_encode($selectedItems));

            if (isset($cart[$cartKey]) && is_array($cart[$cartKey])) {
                $cart[$cartKey]['qty'] += $qty;
            } else {
                $cart[$cartKey] = [
                    'product_id'      => $id,
                    'qty'             => $qty,
                    'selected_items'  => $selectedItems,
                ];
            }
        } else {
            // Produk biasa tetap pakai format lama agar aman
            if (isset($cart[$id])) {
                if (is_numeric($cart[$id])) {
                    $cart[$id] += $qty;
                } elseif (is_array($cart[$id])) {
                    $cart[$id]['qty'] += $qty;
                }
            } else {
                $cart[$id] = $qty;
            }
        }

        session(['cart' => $cart]);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Produk ditambahkan ke keranjang.');
    }

    /**
     * Update jumlah produk di keranjang.
     */
    public function update(Request $request, $cartKey)
    {
        $cart = session('cart', []);

        $qty = (int) $request->input('qty', 1);

        if (!isset($cart[$cartKey])) {
            return redirect()->route('cart.index');
        }

        if ($qty < 1) {
            unset($cart[$cartKey]);
        } else {
            if (is_numeric($cart[$cartKey])) {
                $cart[$cartKey] = $qty;
            } elseif (is_array($cart[$cartKey])) {
                $cart[$cartKey]['qty'] = $qty;
            }
        }

        session(['cart' => $cart]);

        return redirect()->route('cart.index');
    }

    /**
     * Hapus produk dari keranjang.
     */
    public function remove($cartKey)
    {
        $cart = session('cart', []);

        if (isset($cart[$cartKey])) {
            unset($cart[$cartKey]);
        }

        session(['cart' => $cart]);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Produk dihapus dari keranjang.');
    }

    /**
     * Kosongkan keranjang.
     */
    public function clear()
    {
        session()->forget('cart');

        return redirect()
            ->route('cart.index')
            ->with('success', 'Keranjang berhasil dikosongkan.');
    }
}