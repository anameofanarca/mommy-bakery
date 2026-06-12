<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Inventory - Mommy Catering & Bakery</title>
    @vite(['resources/css/app.css', 'resources/css/menu.css', 'resources/css/admin.css'])
    
    <style>
        .visibility-badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 4px;
            margin-top: 6px;
        }
        .status-live {
            background-color: #e0f2fe;
            color: #0369a1;
        }
        .status-draft {
            background-color: #f3f4f6;
            color: #4b5563;
        }
        .badge-out-of-stock {
            background-color: #fee2e2 !important;
            color: #991b1b !important;
        }

        .product-tabs a {
            min-width: 130px;
            height: 44px;
            border-radius: 999px;
            background-color: #F2E8C5;
            color: #3f281d;
            font-family: 'Be Vietnam Pro', sans-serif;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .product-tabs a.active {
            background-color: #963b3f;
            color: #ffffff;
        }

        .product-card-image {
            display: block;
            position: relative;
            text-decoration: none;
        }

        .admin-product-title-link {
            color: inherit;
            text-decoration: none;
        }

        .admin-product-title-link:hover h3 {
            text-decoration: underline;
        }
    </style>
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
                <a href="{{ route('admin.product') }}"
                   class="{{ request('category') == null ? 'active' : '' }}">
                    Semua
                </a>

                <a href="{{ route('admin.product', ['category' => 'Nasi Box']) }}"
                   class="{{ request('category') == 'Nasi Box' ? 'active' : '' }}">
                    Nasi Box
                </a>

                <a href="{{ route('admin.product', ['category' => 'Tumpeng']) }}"
                   class="{{ request('category') == 'Tumpeng' ? 'active' : '' }}">
                    Tumpeng
                </a>

                <a href="{{ route('admin.product', ['category' => 'Prasmanan']) }}"
                   class="{{ request('category') == 'Prasmanan' ? 'active' : '' }}">
                    Prasmanan
                </a>

                <a href="{{ route('admin.product', ['category' => 'Bakery']) }}"
                   class="{{ request('category') == 'Bakery' ? 'active' : '' }}">
                    Bakery
                </a>

                <a href="{{ route('admin.product', ['category' => 'Snack Box']) }}"
                   class="{{ request('category') == 'Snack Box' ? 'active' : '' }}">
                    Snack Box
                </a>
            </section>

            <section class="product-grid">

                @forelse($products as $product)
                    <div class="product-card-admin">

                        <a href="{{ route('product.show', $product->id) }}" class="product-card-image">
                            @if($product->stock > 0)
                                <span class="stock-badge in-stock">In Stock</span>
                            @else
                                <span class="stock-badge inactive badge-out-of-stock">Out of Stock</span>
                            @endif

                            <img src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('images/product/default.png') }}"
                                 alt="{{ $product->name }}">
                        </a>
                        
                        <div class="product-card-info">
                            <div class="product-card-title-row">
                                <a href="{{ route('product.show', $product->id) }}" class="admin-product-title-link">
                                    <h3>{{ $product->name }}</h3>
                                </a>

                                <span class="product-price">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            </div>

                            <span class="product-meta">
                                {{ strtoupper($product->category) }} • {{ $product->stock ?? 0 }} UNITS
                            </span>
                            
                            <div>
                                @if($product->is_active)
                                    <span class="visibility-badge status-live">● Live di Web</span>
                                @else
                                    <span class="visibility-badge status-draft">○ Sembunyi (Draft)</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="product-card-actions">
                            <a href="{{ route('admin.product.edit', $product->id) }}" class="btn-edit">
                                Edit
                            </a>

                            <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST"
                                  onsubmit="return confirm('Hapus produk ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn-delete">🗑</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 text-gray-400">
                        <p class="text-sm font-medium">Belum ada produk di kategori ini</p>
                    </div>
                @endforelse

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