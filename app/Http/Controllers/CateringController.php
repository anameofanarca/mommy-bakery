<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CateringOrder;

class CateringController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'      => 'required|string|max:255',
            'no_whatsapp'       => 'required|string|max:20',
            'email'             => 'nullable|email|max:255',
            'jenis_acara'       => 'required|string|max:255',
            'jumlah_tamu'       => 'required|integer|min:1',
            'tanggal_acara'     => 'required|date',
            'budget'            => 'nullable|numeric',
            'preferensi_menu'   => 'required|string',
            'catatan_tambahan'  => 'nullable|string',
        ]);

        $order = CateringOrder::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil disimpan',
            'order_id' => $order->id
        ]);
    }
}