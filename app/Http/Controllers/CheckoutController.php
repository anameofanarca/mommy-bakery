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
    private function getCartData()
    {
        $cart = session('cart', []);

        $items = [];
        $subtotal = 0;

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

        // Karena checkout kamu otomatis delivery, delivery fee langsung dihitung.
        $deliveryFee = 10000;
        $total = $subtotal + $deliveryFee;

        $user = auth()->user();

        return view('checkout', compact('items', 'subtotal', 'deliveryFee', 'total', 'user'));
    }

    public function saveCheckoutData(Request $request)
    {
        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'delivery_type' => ['required', 'in:pickup,delivery'],
            'address' => ['nullable', 'string'],
            'city' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'schedule_at' => ['nullable', 'date'],
            'event_date' => ['nullable', 'date'],
            'event_time' => ['nullable'],
            'note' => ['nullable', 'string'],
        ]);

        if ($data['delivery_type'] === 'delivery' && empty($data['address'])) {
            return back()
                ->withErrors(['address' => 'Alamat wajib diisi jika memilih delivery.'])
                ->withInput();
        }

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Keranjang belanja Anda kosong.');
        }

        return DB::transaction(function () use ($cart, $data) {
            $orderCode = 'MB-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5));

            $subtotal = 0;
            $itemsPayload = [];

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

            if (empty($itemsPayload)) {
                return redirect()
                    ->route('cart.index')
                    ->with('error', 'Produk di keranjang tidak valid.');
            }

            $deliveryFee = ($data['delivery_type'] === 'delivery') ? 10000 : 0;
            $total = $subtotal + $deliveryFee;

            $fullAddress = $data['address'] ?? null;

            if (!empty($data['city'])) {
                $fullAddress .= "\nKota: " . $data['city'];
            }

            if (!empty($data['postal_code'])) {
                $fullAddress .= "\nKode Pos: " . $data['postal_code'];
            }

            $order = Order::create([
                'user_id' => auth()->id(),
                'order_code' => $orderCode,
                'customer_name' => $data['customer_name'],
                'phone' => $data['phone'],
                'email' => $data['email'] ?? null,
                'delivery_type' => $data['delivery_type'],
                'address' => $fullAddress,
                'schedule_at' => $data['schedule_at'] ?? null,
                'note' => $data['note'] ?? null,
                'subtotal' => $subtotal,
                'delivery_fee' => $deliveryFee,
                'total' => $total,
                'payment_method' => 'qris',
                'status' => 'pending_payment',
            ]);

            foreach ($itemsPayload as &$row) {
                $row['order_id'] = $order->id;
            }

            unset($row);

            OrderItem::insert($itemsPayload);

            foreach ($cart as $cartKey => $cartItem) {
                if (is_numeric($cartItem)) {
                    $productId = $cartKey;
                    $qty = (int) $cartItem;
                } else {
                    $productId = $cartItem['product_id'] ?? null;
                    $qty = (int) ($cartItem['qty'] ?? 1);
                }

                if ($productId) {
                    Product::where('id', $productId)
                        ->where('stock', '>', 0)
                        ->decrement('stock', $qty);
                }
            }

            Payment::create([
                'order_id' => $order->id,
                'method' => 'qris',
                'status' => 'unverified',
            ]);

            session()->forget('cart');
            session()->forget('checkout_data');

            return redirect()->route('payment.show', $order->id);
        });
    }

    public function payment()
    {
        return redirect()->route('checkout.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('checkout.create');
    }
}