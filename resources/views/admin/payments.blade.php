<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Overview - Mommy Catering & Bakery</title>

    @vite(['resources/css/app.css', 'resources/css/menu.css', 'resources/css/admin.css'])
</head>
<body>
    <div class="admin-dashboard">
        @include('admin.layouts.sidebar')

        <main class="admin-main payments-main">
            <section class="payments-header">
                <div>
                    <h1>Payment Overview</h1>
                    <p>Track revenue and manage catering transactions.</p>
                </div>

                <div class="payments-actions">
                    <button type="button" class="period-btn">Last 30 Days</button>
                    <button type="button" class="export-btn">Export Report</button>
                </div>
            </section>

            <section class="payments-summary">
                <div class="payment-stat-card">
                    <p>Total Revenue</p>
                    <h2>Rp 0</h2>
                    <small>No revenue yet</small>
                </div>

                <div class="payment-stat-card">
                    <p>Pending Verifications</p>
                    <h2>0</h2>
                    <small>No pending verification</small>
                </div>

                <div class="payment-stat-card">
                    <p>Average Transaction</p>
                    <h2>Rp 0</h2>
                    <small>No transactions yet</small>
                </div>

                <div class="payment-stat-card">
                    <p>Refund Rate</p>
                    <h2>0%</h2>
                    <small>No refund data</small>
                </div>
            </section>

            <section class="payments-content">
                <div class="payments-left">
                    <div class="payment-panel">
                        <div class="payment-panel-header">
                            <h2>Verification Queue</h2>
                            <span>0 Transfers Pending</span>
                        </div>

                        <div class="payment-empty-state">
                            <div class="payment-empty-icon">🏦</div>
                            <h3>No Pending Verification</h3>
                            <p>Bank transfer payments that need verification will appear here.</p>
                        </div>

                        <a href="#" class="view-all-link">View All Pending Verifications</a>
                    </div>

                    <div class="payment-panel revenue-panel">
                        <div class="payment-panel-header">
                            <h2>Revenue Trend</h2>
                        </div>

                        <div class="chart-empty-state">
                            <h3>No Revenue Data Yet</h3>
                            <p>Revenue chart will appear after transactions are available.</p>
                        </div>
                    </div>
                </div>

                <div class="payments-right">
                    <div class="payment-panel methods-panel">
                        <div class="payment-panel-header">
                            <h2>Payment Methods</h2>
                        </div>

                        <div class="method-item">
                            <div>
                                <strong>Bank Transfer</strong>
                                <small>Enabled</small>
                            </div>
                            <span class="toggle-empty"></span>
                        </div>

                        <div class="method-item">
                            <div>
                                <strong>QRIS</strong>
                                <small>Disabled</small>
                            </div>
                            <span class="toggle-empty"></span>
                        </div>

                        <button type="button" class="configure-btn">Configure Methods</button>
                    </div>

                    <div class="payout-card">
                        <p>Catering Payouts</p>
                        <small>Your next scheduled payout will appear here.</small>
                        <h2>Rp 0</h2>
                        <button type="button">Request Early Payout</button>
                    </div>
                </div>
            </section>

            <section class="payment-panel transactions-panel">
                <div class="transactions-header">
                    <h2>Recent Transactions</h2>
                    <input type="text" placeholder="Search transactions...">
                </div>

                <div class="transactions-table-head">
                    <span>Date</span>
                    <span>Transaction ID</span>
                    <span>Client</span>
                    <span>Method</span>
                    <span>Status</span>
                    <span>Amount</span>
                </div>

                <div class="transactions-empty">
                    <div class="payment-empty-icon">💳</div>
                    <h3>No Transactions Yet</h3>
                    <p>Completed and pending transactions will appear here.</p>
                </div>

                <div class="transactions-footer">
                    <span>Showing 0 of 0 transactions</span>

                    <div class="pagination-empty">
                        <button type="button" disabled>Previous</button>
                        <button type="button" class="active" disabled>1</button>
                        <button type="button" disabled>Next</button>
                    </div>
                </div>
            </section>
        </main>
    </div>

    @include('layouts.footer')
</body>
</html>