<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('items')->latest();

        // Search by order code, customer name, or phone
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('order_code', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $orders = $query->get();

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

    public function export(Request $request)
    {
        $query = Order::with('items')->latest();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('order_code', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $orders = $query->get();

        $filename = 'orders-' . now()->format('Ymd-His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($orders) {
            $handle = fopen('php://output', 'w');

            // BOM for Excel UTF-8
            fputs($handle, "\xEF\xBB\xBF");

            // Header row
            fputcsv($handle, [
                'Order Code',
                'Tanggal',
                'Customer',
                'Phone',
                'Email',
                'Delivery Type',
                'Subtotal',
                'Delivery Fee',
                'Total',
                'Payment Method',
                'Status',
                'Items',
            ]);

            foreach ($orders as $order) {
                $itemsList = $order->items->map(function ($item) {
                    return "{$item->product_name_snapshot} x{$item->qty}";
                })->implode(', ');

                fputcsv($handle, [
                    $order->order_code,
                    $order->created_at?->format('d/m/Y H:i') ?? '-',
                    $order->customer_name,
                    $order->phone,
                    $order->email ?? '-',
                    ucfirst($order->delivery_type),
                    $order->subtotal,
                    $order->delivery_fee,
                    $order->total,
                    strtoupper($order->payment_method ?? '-'),
                    $order->status,
                    $itemsList,
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}