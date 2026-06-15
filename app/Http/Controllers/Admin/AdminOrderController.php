<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items')
            ->latest()
            ->get();

        return view('admin.orders', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        return view('admin.order-detail', compact('order'));
    }

    public function markPaid($id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => 'paid',
            'payment_method' => 'qris',
        ]);

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Order berhasil ditandai sebagai sudah dibayar.');
    }

    public function markProcessing($id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => 'processing',
        ]);

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Order berhasil diproses.');
    }

    public function markCompleted($id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => 'completed',
        ]);

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Order berhasil diselesaikan.');
    }

    public function cancel($id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => 'cancelled',
        ]);

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Order berhasil dibatalkan.');
    }
}