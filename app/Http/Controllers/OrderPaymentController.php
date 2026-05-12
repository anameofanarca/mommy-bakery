<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;

class OrderPaymentController extends Controller
{
    public function show(Order $order)
    {
        $order->load(['items', 'payment']);

        return response()->json([
            'order' => $order,
            'instruction' => [
                'note' => 'Silakan transfer sesuai total. Setelah itu upload bukti bayar atau konfirmasi via WhatsApp.',
            ],
        ]);
    }

    public function uploadProof(Request $request, Order $order)
    {
        $validated = $request->validate([
            'proof' => ['required','file','mimes:jpg,jpeg,png,webp,pdf','max:5120'], // max 5MB
        ]);

        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key' => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
        ]);

        $folder = env('CLOUDINARY_FOLDER', 'mommy-bakery');

        $upload = $cloudinary->uploadApi()->upload(
            $validated['proof']->getRealPath(),
            [
                'folder' => $folder.'/payment-proofs',
                'public_id' => $order->order_code,
                'overwrite' => true,
                'resource_type' => 'auto',
            ]
        );

        $url = $upload['secure_url'] ?? null;

        $payment = $order->payment;
        $payment->proof_url = $url;
        $payment->status = 'unverified';
        $payment->save();

        return response()->json([
            'message' => 'Proof uploaded',
            'proof_url' => $url,
        ]);
    }
}