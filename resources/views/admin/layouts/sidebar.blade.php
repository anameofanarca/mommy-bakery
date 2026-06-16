<aside class="admin-sidebar">
    <div>
        <h2>Mommy Admin</h2>
        <p>Kitchen Management</p>

        <nav>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <img src="{{ asset('images/admin/dashboard.png') }}" alt="Dashboard icon">
                Dashboard
            </a>

            <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <img src="{{ asset('images/admin/orders.png') }}" alt="Orders">
                Orders
            </a>

            <a href="{{ route('admin.product') }}" class="{{ request()->routeIs('admin.product') || request()->routeIs('admin.product.create') ? 'active' : '' }}">
                <img src="{{ asset('images/admin/products.png') }}" alt="Products">
                Products
            </a>
        </nav>
    </div>

    <div class="admin-user">
        <div class="admin-user-info">
            <img src="{{ asset('images/logo-register.png') }}" alt="Chef">
            <div>
                <strong>Chef Iik</strong>
                <small>Owner</small>
            </div>
        </div>

        <a href="{{ url('/') }}" title="Back to website">
            <img src="{{ asset('images/admin/Button-out.png') }}" alt="Back to website">
        </a>
    </div>
</aside>