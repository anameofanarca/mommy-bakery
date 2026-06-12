<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Inventory - Mommy Catering & Bakery</title>

    @vite(['resources/css/app.css', 'resources/css/menu.css', 'resources/css/admin.css'])
</head>
<body>
    <div class="admin-dashboard">
        @include('admin.layouts.sidebar')

        <main class="admin-main">
            <section class="product-header">
                <div>
                    <h1>Product Inventory</h1>
                    <p>Manage your artisanal bakery and catering menu items.</p>
                </div>

                <div class="product-search">
                    <input type="text" placeholder="Search items...">
                    <button type="button">≡</button>
                </div>
            </section>

            <section class="product-tabs">
                <button class="active">Semua</button>
                <button>Nasi Box</button>
                <button>Tumpeng</button>
                <button>Prasmanan</button>
                <button>Bakery</button>
                <button>Snack Box</button>
            </section>

            <section class="product-grid empty-product-grid">
                <a href="{{ route('admin.product.create') }}" class="add-product-card">
                    <div class="add-icon">+</div>
                    <h3>Add New<br>Product</h3>
                    <p>Add a bakery item or catering package</p>
                </a>
            </section>
        </main>
    </div>

    @include('layouts.footer')
</body>
</html>