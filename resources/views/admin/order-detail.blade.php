<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Detail - Mommy Catering & Bakery</title>

    @vite(['resources/css/app.css', 'resources/css/menu.css', 'resources/css/admin.css'])
</head>
<body>
    <div class="admin-dashboard">
        @include('admin.layouts.sidebar')

        <main class="admin-main orders-main">
            <section class="orders-header">
                <div>
                    <div class="breadcrumb">Admin › Orders › Detail</div>
                    <h1>Order Detail</h1>
                </div>

                <div class="orders-actions">
                    <a href="{{ route('admin.orders.index') }}"
                       style="background:#FEF4D0; border:1px solid #d8c98c; color:#3b2a22; padding:12px 18px; border-radius:10px; text-decoration:none; font-weight:600;">
                        Back to Orders
                    </a>
                </div>
            </section>

            @if (session('success'))
                <div style="margin-bottom: 20px; padding: 14px 18px; border-radius: 12px; background: #DCFCE7; color: #166534;">
                    {{ session('success') }}
                </div>
            @endif

            <section style="display:grid; grid-template-columns: 1.1fr 0.9fr; gap:24px; margin-bottom:30px;">
                <div style="background:#fffaf0; border:1px solid #eadfbd; border-radius:18px; padding:28px;">
                    <h2 style="font-size:24px; margin-bottom:20px;">Customer Information</h2>

                    <div style="display:grid; gap:14px;">
                        <div>
                            <small style="color:#7c6f64;">Order ID</small>
                            <p style="font-weight:700; font-size:18px;">{{ $order->order_code }}</p>
                        </div>

                        <div>
                            <small style="color:#7c6f64;">Customer Name</small>
                            <p style="font-weight:600;">{{ $order->customer_name }}</p>
                        </div>

                        <div>
                            <small style="color:#7c6f64;">Phone</small>
                            <p>{{ $order->phone }}</p>
                        </div>

                        <div>
                            <small style="color:#7c6f64;">Email</small>
                            <p>{{ $order->email ?? '-' }}</p>
                        </div>

                        <div>
                            <small style="color:#7c6f64;">Delivery Type</small>
                            <p>{{ ucfirst($order->delivery_type) }}</p>
                        </div>

                        <div>
                            <small style="color:#7c6f64;">Address</small>
                            <p>{{ $order->address ?? '-' }}</p>
                        </div>

                        <div>
                            <small style="color:#7c6f64;">Schedule</small>
                            <p>
                                {{ $order->schedule_at ? $order->schedule_at->format('d M Y H:i') : '-' }}
                            </p>
                        </div>

                        <div>
                            <small style="color:#7c6f64;">Customer Note</small>
                            <p>{{ $order->note ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <div style="background:#FEF4D0; border:1px solid #d8c98c; border-radius:18px; padding:28px;">
                    <h2 style="font-size:24px; margin-bottom:20px;">Payment Summary</h2>

                    <div style="display:grid; gap:14px;">
                        <div>
                            <small style="color:#7c6f64;">Payment Method</small>
                            <p style="font-weight:700;">{{ strtoupper($order->payment_method ?? '-') }}</p>
                        </div>

                        <div>
                            <small style="color:#7c6f64;">Status</small>
                            <p>
                                @if ($order->status === 'paid')
                                    <span style="display:inline-block; padding:7px 14px; border-radius:999px; background:#DCFCE7; color:#166534;">
                                        Pembayaran Berhasil
                                    </span>
                                @elseif ($order->status === 'pending_payment')
                                    <span style="display:inline-block; padding:7px 14px; border-radius:999px; background:#FEF9C3; color:#854D0E;">
                                        Menunggu Pembayaran
                                    </span>
                                @elseif ($order->status === 'processing')
                                    <span style="display:inline-block; padding:7px 14px; border-radius:999px; background:#DBEAFE; color:#1D4ED8;">
                                        Diproses
                                    </span>
                                @elseif ($order->status === 'completed')
                                    <span style="display:inline-block; padding:7px 14px; border-radius:999px; background:#E5E7EB; color:#374151;">
                                        Selesai
                                    </span>
                                @else
                                    <span style="display:inline-block; padding:7px 14px; border-radius:999px; background:#FEE2E2; color:#991B1B;">
                                        Dibatalkan
                                    </span>
                                @endif
                            </p>
                        </div>

                        <div style="border-top:1px solid #d8c98c; padding-top:14px;">
                            <div style="display:flex; justify-content:space-between; margin-bottom:10px;">
                                <span>Subtotal</span>
                                <strong>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</strong>
                            </div>

                            <div style="display:flex; justify-content:space-between; margin-bottom:10px;">
                                <span>Delivery Fee</span>
                                <strong>Rp {{ number_format($order->delivery_fee, 0, ',', '.') }}</strong>
                            </div>

                            <div style="display:flex; justify-content:space-between; border-top:1px solid #d8c98c; padding-top:14px; font-size:22px; color:#8B3A3A;">
                                <span>Total</span>
                                <strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong>
                            </div>
                        </div>

                        <div style="display:flex; flex-wrap:wrap; gap:10px; margin-top:14px;">
                            @if ($order->status === 'pending_payment' && Route::has('admin.orders.markPaid'))
                                <form action="{{ route('admin.orders.markPaid', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" style="background:#16A34A; color:white; border:none; border-radius:10px; padding:10px 16px; cursor:pointer; font-weight:600;">
                                        Tandai Dibayar
                                    </button>
                                </form>
                            @endif

                            @if ($order->status === 'paid' && Route::has('admin.orders.markProcessing'))
                                <form action="{{ route('admin.orders.markProcessing', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" style="background:#2563EB; color:white; border:none; border-radius:10px; padding:10px 16px; cursor:pointer; font-weight:600;">
                                        Proses Pesanan
                                    </button>
                                </form>
                            @endif

                            @if ($order->status === 'processing' && Route::has('admin.orders.markCompleted'))
                                <form action="{{ route('admin.orders.markCompleted', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" style="background:#6B7280; color:white; border:none; border-radius:10px; padding:10px 16px; cursor:pointer; font-weight:600;">
                                        Selesaikan
                                    </button>
                                </form>
                            @endif

                            @if ($order->status !== 'cancelled' && Route::has('admin.orders.cancel'))
                                <form action="{{ route('admin.orders.cancel', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" style="background:#DC2626; color:white; border:none; border-radius:10px; padding:10px 16px; cursor:pointer; font-weight:600;">
                                        Batalkan
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </section>

            <section style="background:#fffaf0; border:1px solid #eadfbd; border-radius:18px; padding:28px;">
                <h2 style="font-size:24px; margin-bottom:20px;">Ordered Items</h2>

                <div style="overflow-x:auto;">
                    <table style="width:100%; border-collapse:collapse;">
                        <thead>
                            <tr style="background:#FEF4D0;">
                                <th style="padding:16px; text-align:left;">Product</th>
                                <th style="padding:16px; text-align:left;">Price</th>
                                <th style="padding:16px; text-align:left;">Qty</th>
                                <th style="padding:16px; text-align:left;">Subtotal</th>
                                <th style="padding:16px; text-align:left;">Note</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($order->items as $item)
                                <tr style="border-bottom:1px solid #eadfbd;">
                                    <td style="padding:16px;">
                                        <strong>{{ $item->product_name_snapshot }}</strong>
                                    </td>

                                    <td style="padding:16px;">
                                        Rp {{ number_format($item->price_snapshot, 0, ',', '.') }}
                                    </td>

                                    <td style="padding:16px;">
                                        {{ $item->qty }}
                                    </td>

                                    <td style="padding:16px;">
                                        <strong>
                                            Rp {{ number_format($item->price_snapshot * $item->qty, 0, ',', '.') }}
                                        </strong>
                                    </td>

                                    <td style="padding:16px;">
                                        {{ $item->note ?? '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

    @include('layouts.footer')
</body>
</html>