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
            if (is_numeric($cartItem)) {
                $productId = $cartKey;
                $qty = (int) $cartItem;
                $selectedItems = [];
            } else {
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

        // Cek stok habis
        if ($product->stock <= 0) {
            return redirect()->back()->with('error', 'Maaf, produk ini sedang habis.');
        }

        $cart = session('cart', []);

        $qty = (int) $request->input('qty', 1);

        if ($qty < 1) {
            $qty = 1;
        }

        // Cek qty tidak melebihi stok
        if ($qty > $product->stock) {
            return redirect()->back()->with('error', 'Maaf, stok tidak mencukupi. Stok tersedia: ' . $product->stock . ' pcs.');
        }

        // Cek kalau produk sudah ada di cart, total qty tidak boleh melebihi stok
        if (isset($cart[$id])) {
            $existingQty = is_numeric($cart[$id]) ? $cart[$id] : ($cart[$id]['qty'] ?? 0);
            if (($existingQty + $qty) > $product->stock) {
                return redirect()->back()->with('error', 'Maaf, stok tidak mencukupi. Stok tersedia: ' . $product->stock . ' pcs, sudah ada ' . $existingQty . ' di keranjang.');
            }
        }

        $selectedItems = $request->input('selected_items', []);

        if (is_string($selectedItems)) {
            $selectedItems = json_decode($selectedItems, true) ?? [];
        }

        if (!is_array($selectedItems)) {
            $selectedItems = [];
        }

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

        // Ambil product id untuk cek stok
        $productId = is_numeric($cart[$cartKey]) ? $cartKey : ($cart[$cartKey]['product_id'] ?? $cartKey);
        $product = Product::find($productId);

        if ($product && $qty > $product->stock) {
            return redirect()->route('cart.index')->with('error', 'Stok tidak mencukupi. Stok tersedia: ' . $product->stock . ' pcs.');
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