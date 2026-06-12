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
                    <p>Welcome back! Here's what’s happening in your bakery today.</p>
                </div>

                <button class="date-button" type="button">
                    Oct 24, 2023
                </button>
            </section>

            <section class="overview-cards">
                <div class="overview-card">
                    <div>
                        <p>Total Orders</p>
                        <h2>0</h2>
                        <small>No orders yet</small>
                    </div>
                </div>

                <div class="overview-card">
                    <div>
                        <p>Revenue</p>
                        <h2>Rp 0</h2>
                        <small>No revenue yet</small>
                    </div>
                </div>

                <div class="overview-card">
                    <div>
                        <p>New Orders</p>
                        <h2>0</h2>
                        <small>No new orders</small>
                    </div>
                </div>
            </section>

            <section class="dashboard-bottom">
                <div class="dashboard-panel recent-orders-panel">
                    <div class="panel-header">
                        <h2>Recent Orders</h2>
                        <a href="#">View all Orders</a>
                    </div>

                    <div class="empty-state">
                        <div class="empty-icon">📋</div>
                        <h3>No Recent Orders</h3>
                        <p>Customer orders will appear here once available.</p>
                    </div>
                </div>

                <div class="dashboard-panel popular-items-panel">
                    <div class="panel-header">
                        <h2>Popular Items</h2>
                    </div>

                    <div class="empty-state small-empty">
                        <div class="empty-icon">🍰</div>
                        <h3>No Popular Items</h3>
                        <p>Best-selling products will appear here.</p>
                    </div>

                    <a href="{{ route('admin.product') }}" class="manage-inventory-btn">
                        Manage Inventory
                    </a>
                </div>
            </section>
        </main>
    </div>

    @include('layouts.footer')
</body>
</html>