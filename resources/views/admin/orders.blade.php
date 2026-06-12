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

            <section class="orders-summary">
                <div class="order-stat-card">
                    <div class="stat-top">
                        <span>Pending Orders</span>
                    </div>
                    <h2>0</h2>
                    <small>No pending orders</small>
                </div>

                <div class="order-stat-card">
                    <div class="stat-top">
                        <span>Processing</span>
                    </div>
                    <h2>0</h2>
                    <small>No active processing</small>
                </div>

                <div class="order-stat-card">
                    <div class="stat-top">
                        <span>Completed</span>
                    </div>
                    <h2>0</h2>
                    <small>No completed orders</small>
                </div>

                <div class="order-stat-card">
                    <div class="stat-top">
                        <span>Revenue</span>
                    </div>
                    <h2>Rp 0</h2>
                    <small>No revenue yet</small>
                </div>
            </section>

            <section class="orders-table-card">
                <div class="orders-table-head">
                    <span>Order ID</span>
                    <span>Customer</span>
                    <span>Date</span>
                    <span>Amount</span>
                    <span>Status</span>
                    <span>Actions</span>
                </div>

                <div class="orders-empty">
                    <div class="orders-empty-icon">🧾</div>
                    <h3>No Customer Orders Yet</h3>
                    <p>New customer orders will appear here when available.</p>
                </div>

                <div class="orders-table-footer">
                    <span>Showing 0 of 0 orders</span>

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
                    <p>No kitchen activity yet.</p>
                </div>

                <div class="catering-notes-card">
                    <h2>Catering Notes</h2>

                    <div class="notes-empty">
                        <strong>No notes yet</strong>
                        <p>Catering reminders and kitchen notes will appear here.</p>
                    </div>

                    <a href="#">View Kitchen Log →</a>
                </div>
            </section>
        </main>
    </div>

    @include('layouts.footer')
</body>
</html>