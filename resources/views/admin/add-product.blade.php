<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product - Mommy Catering & Bakery</title>

    @vite(['resources/css/app.css', 'resources/css/menu.css', 'resources/css/admin.css'])
</head>
<body>
    <div class="admin-dashboard">
        @include('admin.layouts.sidebar')

        <main class="admin-main add-product-main">
            <section class="add-product-header">
                <div>
                    <h1>Add New Product</h1>
                    <p>Create a new listing for your artisanal bakery or catering menu.</p>
                </div>

                <a href="{{ route('admin.product') }}" class="cancel-link">× Cancel</a>
            </section>

            <form action="#" method="POST" enctype="multipart/form-data" class="add-product-form">
                @csrf

                <div class="form-left">
                    <div class="form-card general-info-card">
                        <h2>General Information</h2>

                        <label for="product_name">Product Name</label>
                        <input type="text" id="product_name" name="product_name" placeholder="e.g. Sourdough Artisan Loaf">

                        <label for="description">Description</label>
                        <textarea id="description" name="description" placeholder="Describe the flavors, ingredients, and soul of this product..."></textarea>
                    </div>

                    <div class="small-card-wrapper">
                        <div class="form-card small-form-card">
                            <h2>Pricing</h2>

                            <label for="price">Base Price</label>
                                <div class="price-input">
                                    <span>Rp</span>
                                    <input type="text" id="price" name="price" placeholder="0" inputmode="numeric">
                                </div>
                        </div>

                        <div class="form-card small-form-card">
                            <h2>Inventory</h2>

                            <label for="stock">Stock Quantity</label>
                            <input type="number" id="stock" name="stock" placeholder="e.g. 50">
                        </div>
                    </div>
                </div>

                <div class="form-right">
                    <div class="form-card category-card">
                        <h2>Categorization</h2>

                        <label class="radio-option">
                            <input type="radio" name="category" value="Nasi Box">
                            <span>Nasi Box</span>
                        </label>

                        <label class="radio-option">
                            <input type="radio" name="category" value="Tumpeng">
                            <span>Tumpeng</span>
                        </label>

                        <label class="radio-option">
                            <input type="radio" name="category" value="Prasmanan">
                            <span>Prasmanan</span>
                        </label>

                        <label class="radio-option">
                            <input type="radio" name="category" value="Bakery">
                            <span>Bakery</span>
                        </label>

                        <label class="radio-option">
                            <input type="radio" name="category" value="Snack Box">
                            <span>Snack Box</span>
                        </label>
                    </div>

                    <div class="form-card image-card">
                        <h2>Product Image</h2>

                        <label for="product_image" class="upload-box">
                            <div class="upload-icon">☁</div>
                            <strong>Drop image or Click</strong>
                            <small>JPG or PNG up to 5MB</small>
                        </label>

                        <input type="file" id="product_image" name="product_image" hidden>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.product') }}" class="btn-cancel">Cancel Changes</a>
                    <button type="submit" class="btn-save">Save Product</button>
                </div>
            </form>
        </main>
    </div>

    @include('layouts.footer')
</body>
</html>