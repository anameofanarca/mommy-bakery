<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Ambil item cart dan hitung subtotal.
     */
    private function getCartData()
    {
        $cart = session('cart', []);

        $items = [];
        $subtotal = 0;

        foreach ($cart as $cartKey => $cartItem) {
            // Format cart lama: [productId => qty]
            if (is_numeric($cartItem)) {
                $productId = $cartKey;
                $qty = (int) $cartItem;
                $selectedItems = [];
            } else {
                // Format cart baru: [cartKey => ['product_id', 'qty', 'selected_items']]
                $productId = $cartItem['product_id'] ?? null;
                $qty = (int) ($cartItem['qty'] ?? 1);
                $selectedItems = $cartItem['selected_items'] ?? [];
            }

            $product = Product::find($productId);

            if (!$product) {
                continue;
            }

            $line = $product->price * $qty;

            $items[] = [
                'cart_key' => $cartKey,
                'product_id' => $product->id,
                'product' => $product,
                'qty' => $qty,
                'subtotal' => $line,
                'selected_items' => $selectedItems,
            ];

            $subtotal += $line;
        }

        return [
            'items' => $items,
            'subtotal' => $subtotal,
        ];
    }

    /**
     * Halaman checkout: isi data pemesan.
     */
    public function create()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Keranjang belanja Anda kosong.');
        }

        $cartData = $this->getCartData();

        $items = $cartData['items'];
        $subtotal = $cartData['subtotal'];

        $deliveryFee = 0;
        $total = $subtotal + $deliveryFee;

        return view('checkout', compact('items', 'subtotal', 'deliveryFee', 'total'));
    }

    /**
     * Simpan data pemesan ke session, lalu lanjut ke halaman metode pembayaran.
     */
    public function saveCheckoutData(Request $request)
    {
        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'delivery_type' => ['required', 'in:pickup,delivery'],
            'address' => ['nullable', 'string'],
            'schedule_at' => ['nullable', 'date'],
            'note' => ['nullable', 'string'],
        ]);

        if ($data['delivery_type'] === 'delivery' && empty($data['address'])) {
            return back()
                ->withErrors(['address' => 'Alamat wajib diisi jika memilih delivery.'])
                ->withInput();
        }

        session(['checkout_data' => $data]);

        return redirect()->route('checkout.payment');
    }

    /**
     * Halaman metode pembayaran.
     */
    public function payment()
    {
        $cart = session('cart', []);
        $checkoutData = session('checkout_data');

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Keranjang belanja Anda kosong.');
        }

        if (!$checkoutData) {
            return redirect()
                ->route('checkout.create')
                ->with('error', 'Lengkapi data checkout terlebih dahulu.');
        }

        $cartData = $this->getCartData();

        $items = $cartData['items'];
        $subtotal = $cartData['subtotal'];

        $deliveryFee = ($checkoutData['delivery_type'] === 'delivery') ? 10000 : 0;
        $total = $subtotal + $deliveryFee;

        return view('checkout.payment', compact('items', 'subtotal', 'deliveryFee', 'total'));
    }

    /**
     * Simpan pesanan setelah user memilih metode pembayaran.
     */
    public function store(Request $request)
    {
        $request->validate([
            'payment_method' => ['required', 'string'],
        ]);

        $cart = session('cart', []);
        $checkoutData = session('checkout_data');

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Keranjang belanja Anda kosong.');
        }

        if (!$checkoutData) {
            return redirect()
                ->route('checkout.create')
                ->with('error', 'Lengkapi data checkout terlebih dahulu.');
        }

        return DB::transaction(function () use ($request, $cart, $checkoutData) {
            $orderCode = 'MB-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5));

            $subtotal = 0;
            $itemsPayload = [];

            foreach ($cart as $cartKey => $cartItem) {
                // Format cart lama
                if (is_numeric($cartItem)) {
                    $productId = $cartKey;
                    $qty = (int) $cartItem;
                    $selectedItems = [];
                } else {
                    // Format cart baru / snack box
                    $productId = $cartItem['product_id'] ?? null;
                    $qty = (int) ($cartItem['qty'] ?? 1);
                    $selectedItems = $cartItem['selected_items'] ?? [];
                }

                $product = Product::find($productId);

                if (!$product) {
                    continue;
                }

                $line = $product->price * $qty;
                $subtotal += $line;

                $itemNote = null;

                if (!empty($selectedItems)) {
                    $itemNote = 'Pilihan Snack Box: ' . implode(', ', $selectedItems);
                }

                $itemsPayload[] = [
                    'product_id' => $product->id,
                    'product_name_snapshot' => $product->name,
                    'price_snapshot' => $product->price,
                    'qty' => $qty,
                    'note' => $itemNote,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            $deliveryFee = ($checkoutData['delivery_type'] === 'delivery') ? 10000 : 0;
            $total = $subtotal + $deliveryFee;

            $order = Order::create([
                'order_code' => $orderCode,
                'customer_name' => $checkoutData['customer_name'],
                'phone' => $checkoutData['phone'],
                'email' => $checkoutData['email'] ?? null,
                'delivery_type' => $checkoutData['delivery_type'],
                'address' => $checkoutData['address'] ?? null,
                'schedule_at' => $checkoutData['schedule_at'] ?? null,
                'note' => $checkoutData['note'] ?? null,
                'subtotal' => $subtotal,
                'delivery_fee' => $deliveryFee,
                'total' => $total,
                'payment_method' => $request->payment_method,
                'status' => 'pending_payment',
            ]);

            foreach ($itemsPayload as &$row) {
                $row['order_id'] = $order->id;
            }

            OrderItem::insert($itemsPayload);

            Payment::create([
                'order_id' => $order->id,
                'method' => $request->payment_method,
                'status' => 'unverified',
            ]);

            session()->forget('cart');
            session()->forget('checkout_data');

            return redirect()->route('orders.payment.show', $order);
        });
    }
}
