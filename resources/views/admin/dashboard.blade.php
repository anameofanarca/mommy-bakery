<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kitchen Overview - Mommy Catering & Bakery</title>
    @vite(['resources/css/app.css', 'resources/css/menu.css', 'resources/css/admin.css'])
</head>
<body>
<div class="admin-dashboard">
    @include('admin.layouts.sidebar')

    <main class="admin-main">
        <section class="dashboard-header">
            <div>
                <h1>Kitchen Overview</h1>
                <p>Welcome back! Here's what's happening in your bakery today.</p>
            </div>
            <button class="date-button" type="button">{{ now()->format('M d, Y') }}</button>
        </section>

        {{-- STAT CARDS --}}
        <section class="overview-cards">
            <div class="overview-card">
                <p>Total Orders</p>
                <h2>{{ $totalOrders }}</h2>
                <small>{{ $totalOrders > 0 ? 'Total pesanan masuk' : 'No orders yet' }}</small>
            </div>

            <div class="overview-card">
                <p>Revenue</p>
                <h2>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h2>
                <small>{{ $totalRevenue > 0 ? 'Total pendapatan' : 'No revenue yet' }}</small>
            </div>

            <div class="overview-card">
                <p>Pending Orders</p>
                <h2>{{ $pendingOrders }}</h2>
                <small>{{ $pendingOrders > 0 ? 'Menunggu konfirmasi' : 'No new orders' }}</small>
            </div>
        </section>

        {{-- CHARTS ROW --}}
        <section style="display:grid; grid-template-columns:1.6fr 1fr; gap:20px; margin-bottom:24px;">

            {{-- BAR CHART --}}
            <div style="background:#FFF9EC; border:1px solid #e1d4bd; border-radius:14px; padding:24px;">
                <h3 style="font-family:'Libre Caslon Text',serif; font-size:18px; color:#3f281d; margin:0 0 4px;">Revenue 7 Hari Terakhir</h3>
                <p style="font-size:13px; color:#7c6f64; margin:0 0 16px;">Total pendapatan dari order paid/processing/completed</p>
                <div style="position:relative; height:220px;">
                    <canvas id="barChart"></canvas>
                </div>
            </div>

            {{-- DONUT CHART --}}
            <div style="background:#FFF9EC; border:1px solid #e1d4bd; border-radius:14px; padding:24px;">
                <h3 style="font-family:'Libre Caslon Text',serif; font-size:18px; color:#3f281d; margin:0 0 4px;">Status Order</h3>
                <p style="font-size:13px; color:#7c6f64; margin:0 0 16px;">Distribusi status semua order</p>
                <div id="donut-legend" style="display:flex; flex-wrap:wrap; gap:8px; margin-bottom:12px; font-size:12px; color:#5c514b;"></div>
                <div style="position:relative; height:180px;">
                    <canvas id="donutChart"></canvas>
                </div>
            </div>
        </section>

        {{-- RECENT ORDERS + PRODUCTS PANEL --}}
        <section class="dashboard-bottom">

            {{-- RECENT ORDERS --}}
            <div class="dashboard-panel recent-orders-panel">
                <div class="panel-header">
                    <h2>Recent Orders</h2>
                    <a href="{{ route('admin.orders.index') }}">View all Orders</a>
                </div>

                @if ($recentOrders->isEmpty())
                    <div class="empty-state">
                        <div class="empty-icon">📋</div>
                        <h3>No Recent Orders</h3>
                        <p>Customer orders will appear here once available.</p>
                    </div>
                @else
                    <table style="width:100%; border-collapse:collapse;">
                        <thead>
                            <tr style="background:#f7f0d6;">
                                <th style="padding:14px 20px; text-align:left; font-size:13px; color:#52443e;">Kode</th>
                                <th style="padding:14px 20px; text-align:left; font-size:13px; color:#52443e;">Customer</th>
                                <th style="padding:14px 20px; text-align:left; font-size:13px; color:#52443e;">Total</th>
                                <th style="padding:14px 20px; text-align:left; font-size:13px; color:#52443e;">Status</th>
                                <th style="padding:14px 20px; text-align:left; font-size:13px; color:#52443e;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentOrders as $order)
                                <tr style="border-top:1px solid #eadfca;">
                                    <td style="padding:14px 20px; font-size:13px;">{{ $order->order_code }}</td>
                                    <td style="padding:14px 20px; font-size:13px;">
                                        {{ $order->customer_name }}<br>
                                        <small style="color:#7a6a5e;">{{ $order->phone }}</small>
                                    </td>
                                    <td style="padding:14px 20px; font-size:13px; font-weight:600;">
                                        Rp {{ number_format($order->total, 0, ',', '.') }}
                                    </td>
                                    <td style="padding:14px 20px;">
                                        @if ($order->status === 'paid')
                                            <span style="background:#dff4e5; color:#2f8b57; padding:4px 10px; border-radius:999px; font-size:11px; font-weight:700;">Dibayar</span>
                                        @elseif ($order->status === 'pending_payment')
                                            <span style="background:#fff3a6; color:#8a6a00; padding:4px 10px; border-radius:999px; font-size:11px; font-weight:700;">Menunggu</span>
                                        @elseif ($order->status === 'processing')
                                            <span style="background:#dbeafe; color:#1d4ed8; padding:4px 10px; border-radius:999px; font-size:11px; font-weight:700;">Diproses</span>
                                        @elseif ($order->status === 'completed')
                                            <span style="background:#e5e7eb; color:#374151; padding:4px 10px; border-radius:999px; font-size:11px; font-weight:700;">Selesai</span>
                                        @else
                                            <span style="background:#fee2e2; color:#991b1b; padding:4px 10px; border-radius:999px; font-size:11px; font-weight:700;">Dibatalkan</span>
                                        @endif
                                    </td>
                                    <td style="padding:14px 20px;">
                                        <a href="{{ route('admin.orders.show', $order->id) }}"
                                           style="color:#963b40; font-weight:600; font-size:13px; text-decoration:none;">
                                            Detail →
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            {{-- RIGHT PANEL: Products + Popular --}}
            <div class="dashboard-panel popular-items-panel">
                <div class="panel-header">
                    <h2>Products</h2>
                    <a href="{{ route('admin.product') }}">Manage</a>
                </div>

                <div style="padding:20px 24px; border-bottom:1px solid #eadfca;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:14px;">
                        <span style="font-size:13px; color:#5c514b;">Total Produk Aktif</span>
                        <strong style="font-size:22px; color:#3f281d;">{{ $totalProducts }}</strong>
                    </div>
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:14px;">
                        <span style="font-size:13px; color:#5c514b;">Pending Orders</span>
                        <strong style="font-size:22px; color:#963b3f;">{{ $pendingOrders }}</strong>
                    </div>
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <span style="font-size:13px; color:#5c514b;">Total Revenue</span>
                        <strong style="font-size:13px; color:#3f281d;">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</strong>
                    </div>
                </div>

                {{-- POPULAR PRODUCTS --}}
                <div style="padding:16px 24px 8px;">
                    <p style="font-size:12px; font-weight:700; color:#7c6f64; text-transform:uppercase; letter-spacing:1px; margin:0 0 12px;">
                        Produk Terpopuler
                    </p>

                    @if ($popularProducts->isEmpty())
                        <div style="text-align:center; padding:20px 0; color:#9a8a80; font-size:13px;">
                            Belum ada data penjualan
                        </div>
                    @else
                        @foreach ($popularProducts as $item)
                            <div style="display:flex; justify-content:space-between; align-items:center; padding:12px 0; border-bottom:1px solid #eadfca;">
                                <div>
                                    <strong style="font-size:13px; color:#2f211b; display:block;">
                                        {{ $item->product_name_snapshot }}
                                    </strong>
                                    <small style="color:#7a6a5e;">Terjual {{ $item->total_sold }} pcs</small>
                                </div>
                                <span style="background:#f3dfdb; color:#963b40; font-size:11px; font-weight:700; padding:3px 9px; border-radius:999px; white-space:nowrap;">
                                    #{{ $loop->iteration }}
                                </span>
                            </div>
                        @endforeach
                    @endif
                </div>

                <a href="{{ route('admin.product') }}" class="manage-inventory-btn">Manage Inventory</a>
            </div>

        </section>
    </main>
</div>

@include('layouts.footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
<script>
    const revenueByDay = @json($revenueByDay);
    const statusCounts = @json($statusCounts);

    // Bar chart
    const days = revenueByDay.map(d => d.date);
    const vals = revenueByDay.map(d => Number(d.total));

    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: days.length ? days : ['(belum ada data)'],
            datasets: [{
                label: 'Revenue',
                data: vals.length ? vals : [0],
                backgroundColor: '#639922',
                borderRadius: 4,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 11 } } },
                y: {
                    grid: { color: 'rgba(0,0,0,0.06)' },
                    ticks: {
                        font: { size: 11 },
                        callback: v => 'Rp ' + (v >= 1000 ? (v/1000).toFixed(0) + 'k' : v)
                    }
                }
            }
        }
    });

    // Donut chart
    const statusLabels = {
        paid: 'Dibayar',
        pending_payment: 'Menunggu',
        processing: 'Diproses',
        completed: 'Selesai',
        cancelled: 'Dibatalkan'
    };
    const statusColors = {
        paid: '#639922',
        pending_payment: '#BA7517',
        processing: '#185FA5',
        completed: '#5F5E5A',
        cancelled: '#A32D2D'
    };

    const sKeys   = Object.keys(statusCounts);
    const sLabels = sKeys.map(s => statusLabels[s] || s);
    const sData   = sKeys.map(s => Number(statusCounts[s]));
    const sColors = sKeys.map(s => statusColors[s] || '#888');

    const legend = document.getElementById('donut-legend');
    legend.innerHTML = sLabels.map((l, i) =>
        `<span style="display:flex;align-items:center;gap:4px;">
            <span style="width:10px;height:10px;border-radius:2px;background:${sColors[i]};display:inline-block;"></span>
            ${l} (${sData[i]})
        </span>`
    ).join('');

    new Chart(document.getElementById('donutChart'), {
        type: 'doughnut',
        data: {
            labels: sLabels.length ? sLabels : ['Belum ada'],
            datasets: [{
                data: sData.length ? sData : [1],
                backgroundColor: sColors.length ? sColors : ['#D3D1C7'],
                borderWidth: 2,
                borderColor: '#FFF9EC'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            cutout: '65%'
        }
    });
</script>
</body>
</html>