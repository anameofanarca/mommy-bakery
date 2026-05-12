<?php

namespace App\Http\Controllers;

use App\Models\Order;

class WhatsAppController extends Controller
{
    public function redirect(Order $order)
    {
        $order->load(['items', 'payment']);

        $wa = env('WA_ADMIN');
        abort_if(empty($wa), 500, 'WA_ADMIN is not configured');

        $lines = [];
        $lines[] = "Konfirmasi Pembayaran - Mommy Bakery and Catering";
        $lines[] = "Kode Order: {$order->order_code}";
        $lines[] = "Nama: {$order->customer_name}";
        $lines[] = "No HP: {$order->phone}";
        $lines[] = "Total: Rp " . number_format($order->total, 0, ',', '.');
        $lines[] = "Items:";
        foreach ($order->items as $it) {
            $lines[] = "- {$it->product_name_snapshot} x{$it->qty}";
        }
        if ($order->payment?->proof_url) {
            $lines[] = "Bukti Bayar: {$order->payment->proof_url}";
        }

        $text = implode("\n", $lines);
        $url = "https://wa.me/{$wa}?text=" . urlencode($text);

        return redirect()->away($url);
    }
}