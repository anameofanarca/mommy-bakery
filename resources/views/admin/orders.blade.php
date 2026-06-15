<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Orders - Mommy Catering & Bakery</title>

    @vite(['resources/css/app.css', 'resources/css/menu.css', 'resources/css/admin.css'])
</head>
<body>
    <div class="admin-dashboard">
        @include('admin.layouts.sidebar')

        <main class="admin-main orders-main">
            @php
                $orders = $orders ?? collect();

                $pendingCount = $orders->where('status', 'pending_payment')->count();
                $processingCount = $orders->where('status', 'processing')->count();
                $completedCount = $orders->where('status', 'completed')->count();
                $paidRevenue = $orders->whereIn('status', ['paid', 'processing', 'completed'])->sum('total');
            @endphp

            <section class="orders-header">
                <div>
                    <div class="breadcrumb">Admin › Orders</div>
                    <h1>Customer Orders</h1>
                </div>

                <div class="orders-actions">
                    <input type="text" placeholder="Search orders...">
                    <button type="button">Filter</button>
                    <button type="button">Export</button>
                </div>
            </section>

            @if (session('success'))
                <div style="margin-bottom: 20px; padding: 14px 18px; border-radius: 12px; background: #DCFCE7; color: #166534;">
                    {{ session('success') }}
                </div>
            @endif

            <section class="orders-summary">
                <div class="order-stat-card">
                    <div class="stat-top">
                        <span>Pending Orders</span>
                    </div>
                    <h2>{{ $pendingCount }}</h2>
                    <small>{{ $pendingCount > 0 ? 'Waiting for payment' : 'No pending orders' }}</small>
                </div>

                <div class="order-stat-card">
                    <div class="stat-top">
                        <span>Processing</span>
                    </div>
                    <h2>{{ $processingCount }}</h2>
                    <small>{{ $processingCount > 0 ? 'Active processing orders' : 'No active processing' }}</small>
                </div>

                <div class="order-stat-card">
                    <div class="stat-top">
                        <span>Completed</span>
                    </div>
                    <h2>{{ $completedCount }}</h2>
                    <small>{{ $completedCount > 0 ? 'Completed customer orders' : 'No completed orders' }}</small>
                </div>

                <div class="order-stat-card">
                    <div class="stat-top">
                        <span>Revenue</span>
                    </div>
                    <h2>Rp {{ number_format($paidRevenue, 0, ',', '.') }}</h2>
                    <small>{{ $paidRevenue > 0 ? 'Total paid revenue' : 'No revenue yet' }}</small>
                </div>
            </section>

            <section class="orders-table-card">
                @if ($orders->count() > 0)
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background: #FEF4D0;">
                                    <th style="padding: 18px; text-align: left;">Order ID</th>
                                    <th style="padding: 18px; text-align: left;">Customer</th>
                                    <th style="padding: 18px; text-align: left;">Date</th>
                                    <th style="padding: 18px; text-align: left;">Amount</th>
                                    <th style="padding: 18px; text-align: left;">Status</th>
                                    <th style="padding: 18px; text-align: left;">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($orders as $order)
                                    <tr style="border-bottom: 1px solid #eadfbd;">
                                        <td style="padding: 18px; vertical-align: top;">
                                            <strong>{{ $order->order_code }}</strong>
                                        </td>

                                        <td style="padding: 18px; vertical-align: top;">
                                            <strong>{{ $order->customer_name }}</strong><br>
                                            <small>{{ $order->phone }}</small>
                                        </td>

                                        <td style="padding: 18px; vertical-align: top;">
                                            {{ $order->created_at ? $order->created_at->format('d M Y') : '-' }}<br>
                                            <small>{{ $order->created_at ? $order->created_at->format('H:i') : '' }}</small>
                                        </td>

                                        <td style="padding: 18px; vertical-align: top;">
                                            <strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong><br>
                                            <small>{{ strtoupper($order->payment_method ?? '-') }}</small>
                                        </td>

                                        <td style="padding: 18px; vertical-align: top;">
                                            @if ($order->status === 'paid')
                                                <span style="display:inline-block; padding:6px 12px; border-radius:999px; background:#DCFCE7; color:#166534; font-size:13px;">
                                                    Pembayaran Berhasil
                                                </span>
                                            @elseif ($order->status === 'pending_payment')
                                                <span style="display:inline-block; padding:6px 12px; border-radius:999px; background:#FEF9C3; color:#854D0E; font-size:13px;">
                                                    Menunggu Pembayaran
                                                </span>
                                            @elseif ($order->status === 'processing')
                                                <span style="display:inline-block; padding:6px 12px; border-radius:999px; background:#DBEAFE; color:#1D4ED8; font-size:13px;">
                                                    Diproses
                                                </span>
                                            @elseif ($order->status === 'completed')
                                                <span style="display:inline-block; padding:6px 12px; border-radius:999px; background:#E5E7EB; color:#374151; font-size:13px;">
                                                    Selesai
                                                </span>
                                            @else
                                                <span style="display:inline-block; padding:6px 12px; border-radius:999px; background:#FEE2E2; color:#991B1B; font-size:13px;">
                                                    Dibatalkan
                                                </span>
                                            @endif
                                        </td>

                                        <td style="padding: 18px; vertical-align: top;">
                                            <div style="display: flex; flex-direction: column; gap: 8px; align-items: flex-start;">
                                                @if ($order->status === 'pending_payment' && Route::has('admin.orders.markPaid'))
                                                    <form action="{{ route('admin.orders.markPaid', $order->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')

                                                        <button type="submit" style="background:#16A34A; color:white; border:none; border-radius:8px; padding:7px 12px; cursor:pointer;">
                                                            Tandai Dibayar
                                                        </button>
                                                    </form>
                                                @endif

                                                @if ($order->status === 'paid' && Route::has('admin.orders.markProcessing'))
                                                    <form action="{{ route('admin.orders.markProcessing', $order->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')

                                                        <button type="submit" style="background:#2563EB; color:white; border:none; border-radius:8px; padding:7px 12px; cursor:pointer;">
                                                            Proses
                                                        </button>
                                                    </form>
                                                @endif

                                                @if ($order->status === 'processing' && Route::has('admin.orders.markCompleted'))
                                                    <form action="{{ route('admin.orders.markCompleted', $order->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')

                                                        <button type="submit" style="background:#6B7280; color:white; border:none; border-radius:8px; padding:7px 12px; cursor:pointer;">
                                                            Selesai
                                                        </button>
                                                    </form>
                                                @endif

                                                @if (Route::has('admin.orders.show'))
                                                    <a href="{{ route('admin.orders.show', $order->id) }}" style="color:#8B3A3A; font-weight:600;">
                                                        Detail
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="orders-empty">
                        <div class="orders-empty-icon">🧾</div>
                        <h3>No Customer Orders Yet</h3>
                        <p>New customer orders will appear here when available.</p>
                    </div>
                @endif

                <div class="orders-table-footer">
                    <span>Showing {{ $orders->count() }} of {{ $orders->count() }} orders</span>

                    <div class="pagination-empty">
                        <button type="button" disabled>‹</button>
                        <button type="button" class="active" disabled>1</button>
                        <button type="button" disabled>›</button>
                    </div>
                </div>
            </section>

            <section class="orders-bottom">
                <div class="kitchen-status-card empty-kitchen-card">
                    <h2>Kitchen Status</h2>

                    @if ($processingCount > 0)
                        <p>{{ $processingCount }} order sedang diproses di dapur.</p>
                    @else
                        <p>No kitchen activity yet.</p>
                    @endif
                </div>

                <div class="catering-notes-card">
                    <h2>Catering Notes</h2>

                    @if ($orders->whereNotNull('note')->count() > 0)
                        @foreach ($orders->whereNotNull('note')->take(3) as $order)
                            <div class="notes-empty" style="margin-bottom: 12px;">
                                <strong>{{ $order->order_code }}</strong>
                                <p>{{ $order->note }}</p>
                            </div>
                        @endforeach
                    @else
                        <div class="notes-empty">
                            <strong>No notes yet</strong>
                            <p>Catering reminders and kitchen notes will appear here.</p>
                        </div>
                    @endif

                    <a href="#">View Kitchen Log →</a>
                </div>
            </section>
        </main>
    </div>

    @include('layouts.footer')
</body>
</html>