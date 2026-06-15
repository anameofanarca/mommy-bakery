<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class PaymentController extends Controller
{
    private function setupMidtrans()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function show($orderId)
    {
        $order = Order::with('items')->findOrFail($orderId);

        $this->setupMidtrans();

        if (!$order->snap_token) {
            $params = [
                'transaction_details' => [
                    'order_id' => $order->order_code,
                    'gross_amount' => (int) $order->total,
                ],
                'customer_details' => [
                    'first_name' => $order->customer_name,
                    'email' => $order->email ?? 'customer@example.com',
                    'phone' => $order->phone ?? '',
                    'billing_address' => [
                        'first_name' => $order->customer_name,
                        'phone' => $order->phone ?? '',
                        'address' => $order->address ?? '',
                    ],
                ],
                'enabled_payments' => [
                    'qris',
                    'gopay',
                    'bank_transfer',
                ],
            ];

            $snapToken = Snap::getSnapToken($params);

            $order->update([
                'snap_token' => $snapToken,
                'payment_method' => 'qris',
                'status' => 'pending_payment',
            ]);
        }

        return view('payment.show', compact('order'));
    }

    public function notification(Request $request)
    {
        $this->setupMidtrans();

        $notification = new Notification();

        $orderCode = $notification->order_id;
        $transactionStatus = $notification->transaction_status;
        $paymentType = $notification->payment_type;
        $transactionId = $notification->transaction_id;

        $order = Order::where('order_code', $orderCode)->first();

        if (!$order) {
            return response()->json([
                'message' => 'Order not found',
            ], 404);
        }

        if ($transactionStatus === 'settlement' || $transactionStatus === 'capture') {
            $order->status = 'paid';
        } elseif ($transactionStatus === 'pending') {
            $order->status = 'pending_payment';
        } elseif ($transactionStatus === 'expire') {
            $order->status = 'cancelled';
        } elseif ($transactionStatus === 'cancel' || $transactionStatus === 'deny') {
            $order->status = 'cancelled';
        }

        $order->payment_method = $paymentType;
        $order->midtrans_transaction_id = $transactionId;
        $order->save();

        return response()->json([
            'message' => 'Notification handled',
        ]);
    }

    public function success($orderId)
    {
        $order = Order::with('items')->findOrFail($orderId);

        return view('payment.success', compact('order'));
    }

    public function checkStatus($orderId)
    {
        $order = Order::findOrFail($orderId);

        return response()->json([
            'status' => $order->status,
        ]);
    }
}