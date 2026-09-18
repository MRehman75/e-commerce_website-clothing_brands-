<div class="product-page-wrapper">
    <!-- Cart Messages -->
    @if($cartMessage)
        <div class="container mt-3">
            <div class="alert alert-{{ $cartMessageType == 'success' ? 'success' : 'danger' }} alert-dismissible fade show" role="alert">
                <i class="fas fa-{{ $cartMessageType == 'success' ? 'check-circle' : 'exclamation-circle' }} me-2"></i>
                {{ $cartMessage }}
                <button type="button" class="btn-close" wire:click="$set('cartMessage', null)"></button>
            </div>
        </div>
    @endif

    @if(session()->has('message'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @if(session()->has('error'))
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <!-- Breadcrumb -->
    <div class="container">
        <nav aria-label="breadcrumb" class="py-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products') }}" class="text-decoration-none text-muted">Products</a></li>
                @if($product->category)
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">{{ $product->category->name }}</a></li>
                @endif
                <li class="breadcrumb-item active">{{ $product->name }}</li>
            </ol>
        </nav>
    </div>

    <!-- Product Section -->
    <section class="product-section">
        <div class="container">
            <div class="row g-5">
                <!-- Product Gallery -->
                <div class="col-lg-6">
                    <div class="product-gallery">
                        <div class="main-image-wrapper">
                            @if($mainImage)
                                <img src="{{ $mainImage }}"
                                     alt="{{ $product->name }}"
                                     class="main-product-image"
                                     id="mainProductImage"
                                     onerror="this.src='https://via.placeholder.com/600x700/FAFAFA/999?text=No+Image'" />
                            @else
                                <img src="https://via.placeholder.com/600x700/FAFAFA/999?text=No+Image"
                                     alt="No Image"
                                     class="main-product-image" />
                            @endif

                            @if($product->compare_price && $product->price < $product->compare_price)
                                @php
                                    $discount = round((($product->compare_price - $product->price) / $product->compare_price) * 100);
                                @endphp
                                <span class="product-badge badge-sale">-{{ $discount }}%</span>
                            @endif
                        </div>

                        <!-- Thumbnails -->
                        @if(count($productImages) > 1)
                            <div class="thumbnail-wrapper mt-3">
                                <div class="d-flex gap-2 flex-wrap">
                                    @foreach($productImages as $index => $image)
                                        <div class="thumbnail-item {{ $loop->first ? 'active' : '' }}"
                                             onclick="changeMainImage(this, '{{ $image }}')">
                                            <img src="{{ $image }}"
                                                 alt="Thumbnail {{ $index + 1 }}"
                                                 class="img-fluid rounded"
                                                 onerror="this.src='https://via.placeholder.com/80x80/FAFAFA/999?text=No+Image'" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-lg-6">
                    <div class="product-info">
                        <!-- Category -->
                        <div class="product-category">
                            @if($product->category)
                                {{ $product->category->name }}
                            @else
                                Uncategorized
                            @endif
                            @if($product->brand)
                                · {{ $product->brand->name }}
                            @endif
                        </div>

                        <!-- Title -->
                        <h1 class="product-title">{{ $product->name }}</h1>

                        <!-- SKU -->
                        @if($product->sku)
                            <div class="product-sku text-muted small mb-2">SKU: {{ $product->sku }}</div>
                        @endif

                        <!-- Price -->
                        <div class="product-price">
                            <span class="current-price">${{ number_format($product->price, 2) }}</span>
                            @if($product->compare_price && $product->compare_price > $product->price)
                                <span class="old-price">${{ number_format($product->compare_price, 2) }}</span>
                                @php
                                    $discount = round((($product->compare_price - $product->price) / $product->compare_price) * 100);
                                @endphp
                                @if($discount > 0)
                                    <span class="discount-badge">-{{ $discount }}%</span>
                                @endif
                            @endif
                        </div>

                        <!-- Stock Status -->
                        <div class="stock-status mb-3">
                            @if($stock > 10)
                                <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i> In Stock</span>
                            @elseif($stock > 0)
                                <span class="badge bg-warning text-dark"><i class="fas fa-exclamation-triangle me-1"></i> Only {{ $stock }} left</span>
                            @else
                                <span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i> Out of Stock</span>
                            @endif
                        </div>

                        <!-- ============================================================
                        SIZE SELECTOR - Dynamic from Database
                        ============================================================ -->
                        @if($sizes->isNotEmpty())
                            <div class="size-selector">
                                <span class="size-label">Select Size <span class="text-danger">*</span></span>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($sizes as $size)
                                        <button wire:click="selectSize('{{ $size->size_name }}')"
                                                class="size-btn {{ $selectedSize == $size->size_name ? 'active' : '' }} {{ $size->stock <= 0 ? 'disabled' : '' }}"
                                                {{ $size->stock <= 0 ? 'disabled' : '' }}
                                                type="button">
                                            {{ $size->size_name }}
                                            @if($size->stock <= 0)
                                                <span class="text-danger small">(Out of Stock)</span>
                                            @endif
                                        </button>
                                    @endforeach
                                </div>
                                @if($selectedSize)
                                    <small class="text-muted d-block mt-1">Selected: <strong>{{ $selectedSize }}</strong></small>
                                @endif
                            </div>
                        @endif

                        <!-- ============================================================
                        COLOR SELECTOR - Dynamic from Database
                        ============================================================ -->
                        @if($colors->isNotEmpty())
                            <div class="color-selector">
                                <span class="color-label">Select Color <span class="text-danger">*</span></span>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($colors as $color)
                                        <button wire:click="selectColor('{{ $color->color_name }}')"
                                                class="color-btn {{ $selectedColor == $color->color_name ? 'active' : '' }} {{ $color->stock <= 0 ? 'disabled' : '' }}"
                                                {{ $color->stock <= 0 ? 'disabled' : '' }}
                                                type="button"
                                                style="background: {{ $color->color_code }}; width:40px; height:40px; border-radius:50%; border:2px solid {{ $selectedColor == $color->color_name ? '#C9A227' : '#ddd' }}; {{ $color->color_code == '#ffffff' ? 'border-color:#ccc;' : '' }}">
                                            <span class="color-tooltip">{{ $color->color_name }}</span>
                                        </button>
                                    @endforeach
                                </div>
                                @if($selectedColor)
                                    <small class="text-muted d-block mt-1">Selected: <strong>{{ $selectedColor }}</strong></small>
                                @endif
                            </div>
                        @endif

                        <!-- Quantity Selector -->
                        <div class="quantity-section">
                            <label class="form-label fw-bold">Quantity</label>
                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                <div class="quantity-selector">
                                    <button type="button" class="qty-btn" wire:click="decrementQuantity" wire:loading.attr="disabled">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <span class="qty-value">{{ $quantity }}</span>
                                    <button type="button" class="qty-btn" wire:click="incrementQuantity" wire:loading.attr="disabled">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>

                                <button class="btn-add-to-cart"
                                        wire:click="addToCart"
                                        wire:loading.attr="disabled"
                                        wire:target="addToCart"
                                        @if($stock <= 0) disabled @endif>
                                    <span wire:loading.remove wire:target="addToCart">
                                        <i class="fas fa-shopping-bag me-2"></i> Add to Bag
                                    </span>
                                    <span wire:loading wire:target="addToCart">
                                        <i class="fas fa-spinner fa-spin me-2"></i> Adding...
                                    </span>
                                </button>

                                <button class="btn-wishlist {{ $isInWishlist ? 'active' : '' }}"
                                        wire:click="toggleWishlist"
                                        type="button">
                                    <i class="{{ $isInWishlist ? 'fas' : 'far' }} fa-heart"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Product Meta -->
                        <div class="product-meta mt-4">
                            @if($product->sku)
                                <div class="meta-item">
                                    <span class="meta-label">SKU:</span>
                                    <span class="meta-value">{{ $product->sku }}</span>
                                </div>
                            @endif
                            @if($product->category)
                                <div class="meta-item">
                                    <span class="meta-label">Category:</span>
                                    <span class="meta-value">{{ $product->category->name }}</span>
                                </div>
                            @endif
                            @if($product->brand)
                                <div class="meta-item">
                                    <span class="meta-label">Brand:</span>
                                    <span class="meta-value">{{ $product->brand->name }}</span>
                                </div>
                            @endif
                            @if($product->status)
                                <div class="meta-item">
                                    <span class="meta-label">Status:</span>
                                    <span class="meta-value">{{ ucfirst($product->status) }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- SEO -->
                        @if($product->seo_title || $product->seo_description)
                            <div class="product-seo mt-3 small text-muted">
                                @if($product->seo_title)
                                    <div><strong>SEO Title:</strong> {{ $product->seo_title }}</div>
                                @endif
                                @if($product->seo_description)
                                    <div><strong>SEO Description:</strong> {{ $product->seo_description }}</div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Product Tabs -->
            <div class="product-tabs mt-5">
                <ul class="nav nav-tabs" id="productTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab">
                            Description
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab">
                            Product Details
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping" type="button" role="tab">
                            Shipping & Returns
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="productTabsContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                        <div class="pt-3">
                            {!! $product->description ?? 'No description available.' !!}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="details" role="tabpanel">
                        <div class="pt-3">
                            <h5>Product Specifications</h5>
                            <table class="table table-bordered mt-3">
                                <tbody>
                                    <tr><td><strong>SKU</strong></td><td>{{ $product->sku ?? 'N/A' }}</td></tr>
                                    <tr><td><strong>Category</strong></td><td>{{ $product->category->name ?? 'N/A' }}</td></tr>
                                    @if($product->brand)
                                        <tr><td><strong>Brand</strong></td><td>{{ $product->brand->name }}</td></tr>
                                    @endif
                                    <tr><td><strong>Price</strong></td><td>${{ number_format($product->price, 2) }}</td></tr>
                                    @if($product->compare_price)
                                        <tr><td><strong>Compare Price</strong></td><td>${{ number_format($product->compare_price, 2) }}</td></tr>
                                    @endif
                                    <tr><td><strong>Stock</strong></td><td>{{ $product->stock }}</td></tr>
                                    <tr><td><strong>Status</strong></td><td>{{ ucfirst($product->status ?? 'Active') }}</td></tr>
                                </tbody>
                            </table>
                            @if($product->attributes && is_array($product->attributes))
                                <h5 class="mt-4">Additional Attributes</h5>
                                <table class="table table-bordered">
                                    <tbody>
                                        @foreach($product->attributes as $key => $value)
                                            <tr>
                                                <td><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}</strong></td>
                                                <td>{{ $value }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade" id="shipping" role="tabpanel">
                        <div class="pt-3">
                            <h5>Shipping Information</h5>
                            <p>Free domestic shipping on all orders over $100. Standard delivery takes 3–5 business days. Express shipping is available at checkout.</p>

                            <h5 class="mt-3">Returns Policy</h5>
                            <p>We accept returns within 14 days of delivery. Items must be unused and in original packaging. Please contact our support team to initiate a return.</p>

                            @if($product->category)
                                <div class="mt-3">
                                    <strong>Category:</strong> {{ $product->category->name }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================
    RELATED PRODUCTS WITH SIZE & COLOR FILTER
    ============================================================ -->
    <section class="related-products-section py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                <h2 class="section-title text-center mb-0">You May Also Like</h2>
                @if($selectedSize || $selectedColor)
                    <span class="text-muted small d-flex align-items-center gap-2 flex-wrap">
                        <i class="fas fa-filter me-1"></i>
                        Filtered by:
                        @if($selectedSize) 
                            <span class="badge bg-dark">{{ $selectedSize }}</span>
                        @endif
                        @if($selectedColor) 
                            <span class="badge bg-dark" style="background:{{ $colors->firstWhere('color_name', $selectedColor)->color_code ?? '#000' }}; color:#fff;">
                                {{ $selectedColor }}
                            </span>
                        @endif
                        <button wire:click="$set('selectedSize', null); $set('selectedColor', null); loadRelatedProducts()" 
                                class="btn btn-sm btn-outline-danger ms-1">
                            <i class="fas fa-times"></i> Clear
                        </button>
                    </span>
                @endif
            </div>

            @if(count($filteredRelatedProducts) > 0)
                <div class="row g-4">
                    @foreach($filteredRelatedProducts as $related)
                        <div class="col-6 col-md-3">
                            <a href="{{ route('product.show', $related['slug']) }}" class="related-product-card text-decoration-none">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-img-wrapper">
                                        @if(isset($related['image']) && $related['image'])
                                            <img src="{{ $related['image'] }}"
                                                 alt="{{ $related['name'] }}"
                                                 class="card-img-top"
                                                 onerror="this.src='https://via.placeholder.com/300x350/FAFAFA/999?text=No+Image'" />
                                        @else
                                            <img src="https://via.placeholder.com/300x350/FAFAFA/999?text=No+Image"
                                                 alt="No Image"
                                                 class="card-img-top" />
                                        @endif
                                    </div>
                                    <div class="card-body text-center">
                                        <h6 class="card-title">{{ $related['name'] }}</h6>
                                        <div class="price">
                                            <span class="fw-bold text-dark">${{ number_format($related['price'], 2) }}</span>
                                            @if(isset($related['compare_price']) && $related['compare_price'] > $related['price'])
                                                <span class="text-muted text-decoration-line-through ms-2">${{ number_format($related['compare_price'], 2) }}</span>
                                            @endif
                                        </div>
                                        @if(isset($related['category']) && $related['category'])
                                            <small class="text-muted d-block mt-1">{{ $related['category'] }}</small>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-filter fa-3x text-muted mb-3 d-block"></i>
                    <h5>No Products Found</h5>
                    <p class="text-muted">No products available with the selected size or color.</p>
                    @if($selectedSize || $selectedColor)
                        <button wire:click="$set('selectedSize', null); $set('selectedColor', null); loadRelatedProducts()" 
                                class="btn btn-outline-dark mt-2">
                            <i class="fas fa-times me-1"></i> Clear Filters
                        </button>
                    @endif
                </div>
            @endif
        </div>
    </section>

    <!-- JavaScript -->
    <script>
        function changeMainImage(element, src) {
            const mainImage = document.getElementById('mainProductImage');
            if (mainImage) {
                mainImage.src = src;
            }
            document.querySelectorAll('.thumbnail-item').forEach(item => {
                item.classList.remove('active');
            });
            if (element) {
                element.classList.add('active');
            }
        }
    </script>

    <!-- Styles -->
    <style>
        .product-section {
            padding: 20px 0 40px;
        }

        .main-image-wrapper {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            background: #f8f9fa;
        }

        .main-product-image {
            width: 100%;
            height: auto;
            aspect-ratio: 3/4;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .main-image-wrapper:hover .main-product-image {
            transform: scale(1.02);
        }

        .product-badge {
            position: absolute;
            top: 16px;
            left: 16px;
            padding: 4px 16px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            background: #C9A227;
            color: #fff;
            z-index: 2;
        }

        .product-badge.badge-sale {
            background: #dc3545;
        }

        .product-badge.badge-new {
            background: #0d6efd;
        }

        .product-badge.badge-limited {
            background: #6f42c1;
        }

        .product-info {
            padding: 0 10px;
        }

        .product-category {
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #6c757d;
            margin-bottom: 8px;
        }

        .product-title {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 4px;
            color: #1a1a1a;
        }

        .product-sku {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .product-price {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .current-price {
            font-size: 1.8rem;
            font-weight: 700;
            color: #C9A227;
        }

        .old-price {
            font-size: 1.2rem;
            color: #adb5bd;
            text-decoration: line-through;
        }

        .discount-badge {
            background: #dc3545;
            color: #fff;
            padding: 2px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .product-description {
            color: #6c757d;
            line-height: 1.8;
            margin-bottom: 24px;
        }

        .product-description ul {
            padding-left: 20px;
        }

        .product-description ul li {
            margin-bottom: 4px;
        }

        /* ============================================================
           SIZE SELECTOR
        ============================================================ */
        .size-selector {
            margin-bottom: 1.5rem;
        }

        .size-label {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #333;
            display: block;
            margin-bottom: 0.5rem;
        }

        .size-btn {
            padding: 0.5rem 1.2rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fff;
            font-size: 0.8rem;
            font-weight: 500;
            color: #333;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .size-btn:hover:not(.disabled) {
            border-color: #C9A227;
            color: #C9A227;
        }

        .size-btn.active {
            border-color: #C9A227;
            background: #C9A227;
            color: #fff;
        }

        .size-btn.disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        /* ============================================================
           COLOR SELECTOR
        ============================================================ */
        .color-selector {
            margin-bottom: 1.5rem;
        }

        .color-label {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #333;
            display: block;
            margin-bottom: 0.5rem;
        }

        .color-btn {
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .color-btn:hover:not(.disabled) {
            transform: scale(1.1);
        }

        .color-btn.active {
            border-color: #C9A227 !important;
            box-shadow: 0 0 0 3px rgba(201, 162, 39, 0.3);
        }

        .color-btn.disabled {
            opacity: 0.3;
            cursor: not-allowed;
            transform: none !important;
        }

        .color-tooltip {
            position: absolute;
            bottom: -22px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 0.6rem;
            color: #999;
            white-space: nowrap;
            display: none;
        }

        .color-btn:hover .color-tooltip {
            display: block;
        }

        /* ============================================================
           QUANTITY SELECTOR
        ============================================================ */
        .quantity-section {
            margin-bottom: 24px;
        }

        .quantity-selector {
            display: inline-flex;
            align-items: center;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            overflow: hidden;
            background: #fff;
        }

        .qty-btn {
            width: 40px;
            height: 40px;
            border: none;
            background: #f8f9fa;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qty-btn:hover {
            background: #e9ecef;
        }

        .qty-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .qty-value {
            min-width: 40px;
            text-align: center;
            font-weight: 500;
            font-size: 1rem;
            padding: 0 4px;
        }

        .btn-add-to-cart {
            padding: 10px 30px;
            background: #1a1a1a;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.05em;
            transition: all 0.3s ease;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-add-to-cart:hover:not(:disabled) {
            background: #C9A227;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(201, 162, 39, 0.3);
        }

        .btn-add-to-cart:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .btn-wishlist {
            width: 48px;
            height: 48px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background: #fff;
            color: #6c757d;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .btn-wishlist:hover {
            border-color: #dc3545;
            color: #dc3545;
        }

        .btn-wishlist.active {
            border-color: #dc3545;
            color: #dc3545;
            background: rgba(220, 53, 69, 0.05);
        }

        .product-meta {
            border-top: 1px solid #dee2e6;
            padding-top: 16px;
        }

        .meta-item {
            display: flex;
            gap: 8px;
            padding: 4px 0;
            font-size: 0.9rem;
        }

        .meta-label {
            font-weight: 600;
            color: #495057;
            min-width: 80px;
        }

        .meta-value {
            color: #6c757d;
        }

        .product-tabs {
            border-top: 1px solid #dee2e6;
            padding-top: 30px;
        }

        .product-tabs .nav-tabs {
            border-bottom: 2px solid #dee2e6;
        }

        .product-tabs .nav-link {
            border: none;
            color: #6c757d;
            font-weight: 500;
            padding: 12px 24px;
            position: relative;
        }

        .product-tabs .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background: #C9A227;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .product-tabs .nav-link.active {
            color: #1a1a1a;
            background: transparent;
        }

        .product-tabs .nav-link.active::after {
            transform: scaleX(1);
        }

        .product-tabs .nav-link:hover {
            color: #1a1a1a;
        }

        .related-products-section {
            background: #f8f9fa;
            padding: 60px 0;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 300;
            letter-spacing: 0.05em;
            color: #1a1a1a;
        }

        .related-product-card {
            color: inherit;
            transition: transform 0.3s ease;
        }

        .related-product-card:hover {
            transform: translateY(-5px);
        }

        .related-product-card .card {
            border-radius: 12px;
            overflow: hidden;
            transition: box-shadow 0.3s ease;
        }

        .related-product-card .card:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08) !important;
        }

        .card-img-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 8px 8px 0 0;
            background: #f8f9fa;
        }

        .card-img-wrapper img {
            aspect-ratio: 1/1.2;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }

        .card-body h6 {
            font-size: 0.9rem;
            margin-bottom: 4px;
        }

        .price {
            font-size: 0.9rem;
        }

        .thumbnail-wrapper {
            overflow-x: auto;
        }

        .thumbnail-wrapper::-webkit-scrollbar {
            height: 4px;
        }

        .thumbnail-wrapper::-webkit-scrollbar-thumb {
            background: #C9A227;
            border-radius: 4px;
        }

        .thumbnail-item {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .thumbnail-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .thumbnail-item:hover {
            border-color: #dee2e6;
        }

        .thumbnail-item.active {
            border-color: #C9A227;
        }

        .table-bordered {
            border-color: #dee2e6;
        }

        .table-bordered td {
            padding: 8px 12px;
            vertical-align: middle;
        }

        .table-bordered td:first-child {
            width: 30%;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .product-title {
                font-size: 1.5rem;
            }

            .current-price {
                font-size: 1.4rem;
            }

            .btn-add-to-cart {
                padding: 8px 20px;
                font-size: 0.9rem;
            }

            .qty-btn {
                width: 35px;
                height: 35px;
            }

            .qty-value {
                min-width: 35px;
                font-size: 0.9rem;
            }

            .thumbnail-item {
                width: 60px;
                height: 60px;
            }

            .product-section .row.g-5 {
                gap: 1.5rem !important;
            }
        }

        @media (max-width: 576px) {
            .thumbnail-item {
                width: 50px;
                height: 50px;
            }

            .main-product-image {
                aspect-ratio: 1/1.1;
            }

            .product-info {
                padding: 0;
            }

            .quantity-section .d-flex {
                flex-wrap: wrap;
            }

            .btn-add-to-cart {
                flex: 1;
                justify-content: center;
                padding: 8px 16px;
                font-size: 0.8rem;
            }

            .btn-wishlist {
                width: 42px;
                height: 42px;
                font-size: 1rem;
            }

            .product-tabs .nav-link {
                padding: 8px 12px;
                font-size: 0.75rem;
            }
        }
    </style>
</div>