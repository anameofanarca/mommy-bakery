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

            @if(session('success'))
                <div style="background:#d1fae5; color:#065f46; padding:12px 16px; border-radius:8px; margin-bottom:16px;">
                    {{ session('success') }}
                </div>
            @endif

            <section class="product-tabs">
                <button class="active">Semua</button>
                <button>Nasi Box</button>
                <button>Tumpeng</button>
                <button>Prasmanan</button>
                <button>Bakery</button>
                <button>Snack Box</button>
            </section>

            <section class="product-grid">

                @foreach($products as $product)
                <div class="product-card-admin">
                    <div class="product-card-image">
                        @if($product->is_active)
                            <span class="stock-badge in-stock">In Stock</span>
                        @else
                            <span class="stock-badge inactive">Nonaktif</span>
                        @endif
                        <img src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('images/product/default.png') }}"
                             alt="{{ $product->name }}">
                    </div>
                    <div class="product-card-info">
                        <div class="product-card-title-row">
                            <h3>{{ $product->name }}</h3>
                            <span class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>
                        <span class="product-meta">{{ strtoupper($product->category) }} • {{ $product->stock ?? 0 }} UNITS</span>
                    </div>
                    <div class="product-card-actions">
                        <a href="{{ route('admin.product.edit', $product->id) }}" class="btn-edit">Edit</a>
                        <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST"
                              onsubmit="return confirm('Hapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">🗑</button>
                        </form>
                    </div>
                </div>
                @endforeach

                {{-- Card Add New Product --}}
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