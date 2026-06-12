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
     * Menampilkan halaman checkout (mengambil data dari session cart).
     */
    public function create()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        $items = [];
        $subtotal = 0;

        foreach ($cart as $productId => $qty) {
            $product = Product::find($productId);
            if ($product) {
                $line = $product->price * $qty;
                $items[] = [
                    'product_id' => $product->id,
                    'product' => $product, // untuk ditampilkan di view
                    'qty' => $qty,
                    'subtotal' => $line,
                ];
                $subtotal += $line;
            }
        }

        $deliveryFee = 10000; // Contoh sederhana, bisa disesuaikan
        $total = $subtotal + $deliveryFee;

        return view('checkout', compact('items', 'subtotal', 'deliveryFee', 'total'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => ['required','string','max:255'],
            'phone' => ['required','string','max:30'],
            'email' => ['nullable','email','max:255'],
            'delivery_type' => ['required','in:pickup,delivery'],
            'address' => ['nullable','string'],
            'schedule_at' => ['nullable','date'],
            'note' => ['nullable','string'],
            'payment_method' => ['required','string'],

            'items' => ['required','array','min:1'],
            'items.*.product_id' => ['required','integer','exists:products,id'],
            'items.*.qty' => ['required','integer','min:1'],
            'items.*.note' => ['nullable','string'],
        ]);

        if ($data['delivery_type'] === 'delivery' && empty($data['address'])) {
            return response()->json(['message' => 'Address is required for delivery'], 422);
        }

        return DB::transaction(function () use ($data) {
            $orderCode = 'MB-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5));

            $subtotal = 0;
            $itemsPayload = [];

            $productIds = collect($data['items'])->pluck('product_id')->all();
            $products = Product::query()->whereIn('id', $productIds)->get()->keyBy('id');

            foreach ($data['items'] as $item) {
                $product = $products[$item['product_id']];
                $line = $product->price * (int)$item['qty'];
                $subtotal += $line;

                $itemsPayload[] = [
                    'product_id' => $product->id,
                    'product_name_snapshot' => $product->name,
                    'price_snapshot' => $product->price,
                    'qty' => (int)$item['qty'],
                    'note' => $item['note'] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            $deliveryFee = ($data['delivery_type'] === 'delivery') ? 10000 : 0; // rule sederhana
            $total = $subtotal + $deliveryFee;

            $order = Order::create([
                'order_code' => $orderCode,
                'customer_name' => $data['customer_name'],
                'phone' => $data['phone'],
                'email' => $data['email'] ?? null,
                'delivery_type' => $data['delivery_type'],
                'address' => $data['address'] ?? null,
                'schedule_at' => $data['schedule_at'] ?? null,
                'note' => $data['note'] ?? null,
                'subtotal' => $subtotal,
                'delivery_fee' => $deliveryFee,
                'total' => $total,
                'payment_method' => $data['payment_method'],
                'status' => 'pending_payment',
            ]);

            foreach ($itemsPayload as &$row) {
                $row['order_id'] = $order->id;
            }
            OrderItem::insert($itemsPayload);

            Payment::create([
                'order_id' => $order->id,
                'method' => $data['payment_method'],
                'status' => 'unverified',
            ]);

            return response()->json([
                'order_id' => $order->id,
                'order_code' => $order->order_code,
                'payment_url' => route('orders.payment.show', $order),
                'whatsapp_url' => route('orders.whatsapp', $order),
            ], 201);
        });
    }
}