<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product - Mommy Catering & Bakery</title>

    @vite(['resources/css/app.css', 'resources/css/menu.css', 'resources/css/admin.css'])
    
    <style>
        .status-toggle-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f9fafb;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            margin-top: 8px;
        }
        .switch {
            position: relative;
            display: inline-block;
            width: 48px;
            height: 24px;
        }
        .switch input { 
            opacity: 0;
            width: 0;
            height: 0;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: #ccc;
            transition: .3s;
            border-radius: 24px;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .3s;
            border-radius: 50%;
        }
        input:checked + .slider {
            background-color: #10b981; /* Warna hijau sukses */
        }
        input:checked + .slider:before {
            transform: translateX(24px);
        }
    </style>
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

            @if(session('success'))
                <div style="background:#d1fae5; color:#065f46; padding:12px 16px; border-radius:8px; margin-bottom:16px;">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div style="background:#fee2e2; color:#991b1b; padding:12px 16px; border-radius:8px; margin-bottom:16px;">
                    <ul style="margin:0; padding-left:16px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data" class="add-product-form">
                @csrf

                <div class="form-left">
                    <div class="form-card general-info-card">
                        <h2>General Information</h2>

<<<<<<< HEAD
                        <label for="name">Product Name</label>
                        <input type="text" id="name" name="name"
                               value="{{ old('name') }}"
                               placeholder="e.g. Sourdough Artisan Loaf">
=======
                        <label for="product_name">Product Name</label>
<input type="text" id="product_name" name="product_name"
       value="{{ old('product_name') }}"
       placeholder="e.g. Sourdough Artisan Loaf">
>>>>>>> 4513ceec811717e1d959cc42e234de287fe65df0

                        <label for="description">Description</label>
                        <textarea id="description" name="description"
                                  placeholder="Describe the flavors, ingredients, and soul of this product...">{{ old('description') }}</textarea>
                    </div>

                    <div class="small-card-wrapper">
                        <div class="form-card small-form-card">
                            <h2>Pricing</h2>

                            <label for="price">Base Price</label>
                            <div class="price-input">
                                <span>Rp</span>
                                <input type="text" id="price" name="price"
                                       value="{{ old('price') }}"
                                       placeholder="0" inputmode="numeric">
                            </div>
                        </div>

                        <div class="form-card small-form-card">
                            <h2>Inventory</h2>
                            <label for="stock">Stock Quantity</label>
                            <input type="number" id="stock" name="stock" 
                                value="{{ old('stock', 0) }}"
                                placeholder="e.g. 50" min="0">
                        </div>
                    </div>
                </div>

                <div class="form-right">
                    
                    <div class="form-card status-card">
                        <h2>Product Visibility</h2>
                        <p style="font-size: 13px; color: #666; margin-bottom: 8px;">Tentukan apakah produk ini langsung tampil di website utama.</p>
                        
                        <div class="status-toggle-wrapper">
                            <span style="font-weight: 500; font-size: 14px;">Tampilkan di Web</span>
                            <label class="switch">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
<<<<<<< HEAD
                    </div>
                    <div class="form-card category-card">
                        <h2>Categorization</h2>

                        <label class="radio-option">
                            <input type="radio" name="category" value="nasibox"
                                   {{ old('category') == 'nasibox' ? 'checked' : '' }}>
                            <span>Nasi Box</span>
                        </label>

                        <label class="radio-option">
                            <input type="radio" name="category" value="tumpeng"
                                   {{ old('category') == 'tumpeng' ? 'checked' : '' }}>
                            <span>Tumpeng</span>
                        </label>

                        <label class="radio-option">
                            <input type="radio" name="category" value="prasmanan"
                                   {{ old('category') == 'prasmanan' ? 'checked' : '' }}>
                            <span>Prasmanan</span>
                        </label>

                        <label class="radio-option">
                            <input type="radio" name="category" value="bakery"
                                   {{ old('category') == 'bakery' ? 'checked' : '' }}>
                            <span>Bakery</span>
                        </label>

                        <label class="radio-option">
                            <input type="radio" name="category" value="snackbox"
                                   {{ old('category') == 'snackbox' ? 'checked' : '' }}>
                            <span>Snack Box</span>
                        </label>
=======
>>>>>>> 4513ceec811717e1d959cc42e234de287fe65df0
                    </div>
                    <div class="form-card category-card">
    <h2>Categorization</h2>

    <label class="radio-option">
        <input type="radio" name="category" value="Nasi Box"
               {{ old('category') == 'Nasi Box' ? 'checked' : '' }}>
        <span>Nasi Box</span>
    </label>

    <label class="radio-option">
        <input type="radio" name="category" value="Tumpeng"
               {{ old('category') == 'Tumpeng' ? 'checked' : '' }}>
        <span>Tumpeng</span>
    </label>

    <label class="radio-option">
        <input type="radio" name="category" value="Prasmanan"
               {{ old('category') == 'Prasmanan' ? 'checked' : '' }}>
        <span>Prasmanan</span>
    </label>

    <label class="radio-option">
        <input type="radio" name="category" value="Bakery"
               {{ old('category') == 'Bakery' ? 'checked' : '' }}>
        <span>Bakery</span>
    </label>

    <label class="radio-option">
        <input type="radio" name="category" value="Snack Box"
               {{ old('category') == 'Snack Box' ? 'checked' : '' }}>
        <span>Snack Box</span>
    </label>
</div>

                    <div class="form-card image-card">
                        <h2>Product Image</h2>

<<<<<<< HEAD
                        <label for="image" class="upload-box" id="upload-label">
=======
                        <label for="product_image" class="upload-box" id="upload-label">
>>>>>>> 4513ceec811717e1d959cc42e234de287fe65df0
                            <div class="upload-icon">☁</div>
                            <strong>Drop image or Click</strong>
                            <small>JPG atau PNG, maks 2MB</small>
                        </label>

                        <input type="file" id="product_image" name="product_image" hidden accept="image/*">
                        <div id="image-preview" style="display:none; margin-top:12px;">
                            <img id="preview-img" src="" alt="Preview"
                                 style="width:100%; border-radius:8px; object-fit:cover; max-height:200px;">
                            <p id="preview-name" style="font-size:12px; color:#888; margin-top:6px; text-align:center;"></p>
                        </div>
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

    <script>
        // Preview gambar sebelum upload
        document.getElementById('product_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('preview-img').src = event.target.result;
                document.getElementById('preview-name').textContent = file.name;
                document.getElementById('image-preview').style.display = 'block';
                document.getElementById('upload-label').style.display = 'none';
            };
            reader.readAsDataURL(file);
        });
    </script>
</body>
</html>