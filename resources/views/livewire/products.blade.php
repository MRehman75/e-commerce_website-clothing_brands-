<div>
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VELENZA · Products</title>

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400&family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet" />

    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

    <style>
        /* ============================================================
           GLOBAL RESET & ROOTS
        ============================================================ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #0a0a0a;
            --gold: #C9A227;
            --beige: #F5F1EB;
            --bg-light: #FAFAFA;
            --font-heading: 'Playfair Display', serif;
            --font-body: 'Poppins', sans-serif;
        }

        body {
            font-family: var(--font-body);
            color: #1a1a1a;
            background: #fff;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, h5, .heading-font {
            font-family: var(--font-heading);
            font-weight: 300;
            letter-spacing: 0.04em;
        }

        .gold {
            color: var(--gold);
        }

        /* ============================================================
           PRODUCTS HERO - Cinematic Banner
        ============================================================ */
        .products-hero {
            height: 40vh;
            min-height: 300px;
            position: relative;
            overflow: hidden;
            background: var(--primary);
        }

        .products-hero .hero-bg {
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1483985988355-763728e1935b?w=1600&auto=format&fit=crop&q=80') center 30% / cover no-repeat;
            transform: scale(1.04);
            animation: heroZoom 25s ease-in-out infinite alternate;
        }

        @keyframes heroZoom {
            0% { transform: scale(1.04); }
            100% { transform: scale(1.12); }
        }

        .products-hero .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.25) 60%);
        }

        .products-hero .hero-content {
            position: relative;
            z-index: 10;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #fff;
            padding: 0 20px;
        }

        .products-hero .hero-content .hero-label {
            font-family: var(--font-body);
            font-size: 0.7rem;
            letter-spacing: 0.35em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 1rem;
            opacity: 0.8;
        }

        .products-hero .hero-content h1 {
            font-family: var(--font-heading);
            font-size: clamp(2.8rem, 7vw, 4.5rem);
            font-weight: 300;
            letter-spacing: 0.06em;
            line-height: 1.05;
            animation: fadeUp 1.2s ease 0.5s forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        .products-hero .hero-content .hero-sub {
            font-family: var(--font-body);
            font-size: 1rem;
            font-weight: 300;
            max-width: 500px;
            margin-top: 0.8rem;
            animation: fadeUp 1.2s ease 0.8s forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        @keyframes fadeUp {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* ============================================================
           SECTION SPACING & SIDEBAR FILTERS
        ============================================================ */
        .section-spacer {
            padding: 60px 0 80px;
        }

        .filter-sidebar {
            position: sticky;
            top: 20px;
        }

        .filter-sidebar .filter-title {
            font-family: var(--font-heading);
            font-size: 1.4rem;
            font-weight: 300;
            letter-spacing: 0.04em;
            margin-bottom: 0.2rem;
        }

        .filter-sidebar .filter-subtitle {
            font-family: var(--font-body);
            font-size: 0.65rem;
            font-weight: 300;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #999;
            margin-bottom: 1.5rem;
        }

        .filter-sidebar .filter-group {
            margin-bottom: 1.8rem;
        }

        .filter-sidebar .filter-group .filter-group-title {
            font-family: var(--font-body);
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #333;
            margin-bottom: 0.8rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
        }

        .filter-sidebar .filter-group .filter-option {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.35rem 0;
            cursor: pointer;
            transition: 0.2s;
            font-family: var(--font-body);
            font-size: 0.85rem;
            font-weight: 300;
            color: #555;
            user-select: none;
        }

        .filter-sidebar .filter-group .filter-option:hover {
            color: var(--primary);
        }

        .filter-sidebar .filter-group .filter-option input[type="checkbox"],
        .filter-sidebar .filter-group .filter-option input[type="radio"] {
            appearance: none;
            -webkit-appearance: none;
            width: 16px;
            height: 16px;
            border: 1.5px solid #ccc;
            border-radius: 4px;
            position: relative;
            cursor: pointer;
            flex-shrink: 0;
            transition: 0.2s;
        }

        .filter-sidebar .filter-group .filter-option input[type="checkbox"]:checked,
        .filter-sidebar .filter-group .filter-option input[type="radio"]:checked {
            border-color: var(--gold);
            background: var(--gold);
        }

        .filter-sidebar .filter-group .filter-option input[type="checkbox"]:checked::after,
        .filter-sidebar .filter-group .filter-option input[type="radio"]:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
            font-size: 10px;
        }

        .filter-sidebar .filter-group .filter-option input[type="radio"] {
            border-radius: 50%;
        }

        .filter-sidebar .filter-group .filter-option .count {
            font-size: 0.7rem;
            color: #bbb;
            margin-left: auto;
        }

        .filter-sidebar .price-range {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-top: 0.8rem;
        }

        .filter-sidebar .price-range input {
            width: 100%;
            padding: 0.4rem 0.6rem;
            border: 1px solid #e5e5e5;
            border-radius: 8px;
            font-family: var(--font-body);
            font-size: 0.8rem;
            background: var(--bg-light);
            transition: 0.3s;
        }

        .filter-sidebar .price-range input:focus {
            border-color: var(--gold);
            outline: none;
            background: #fff;
        }

        .filter-sidebar .filter-actions {
            display: flex;
            gap: 10px;
            margin-top: 1.5rem;
        }

        .filter-sidebar .filter-actions .btn-reset {
            width: 100%;
            padding: 0.6rem 1.2rem;
            background: transparent;
            color: #888;
            border: 1px solid #e5e5e5;
            border-radius: 40px;
            font-family: var(--font-body);
            font-size: 0.7rem;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            transition: 0.3s;
            cursor: pointer;
        }

        .filter-sidebar .filter-actions .btn-reset:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        /* Mobile Filter Toggle */
        .mobile-filter-toggle {
            display: none;
            justify-content: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .mobile-filter-toggle button {
            padding: 0.5rem 1.5rem;
            border-radius: 40px;
            font-family: var(--font-body);
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            transition: 0.3s;
        }

        .btn-filter-toggle {
            background: var(--primary);
            color: #fff;
            border: none;
        }

        .btn-sort-toggle {
            background: transparent;
            color: #333;
            border: 1px solid #e5e5e5;
        }

        /* ============================================================
           PRODUCT CARDS
        ============================================================ */
        .product-card {
            border-radius: 16px;
            overflow: hidden;
            background: #fff;
            transition: 0.4s ease;
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.03);
            height: 100%;
            position: relative;
            border: 1px solid rgba(0, 0, 0, 0.04);
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            border-color: rgba(201, 162, 39, 0.2);
        }

        .product-card .img-wrap {
            position: relative;
            overflow: hidden;
            aspect-ratio: 1/1.15;
            background: var(--bg-light);
        }

        .product-card .img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .product-card:hover .img-wrap img {
            transform: scale(1.05);
        }

        .product-card .img-wrap .hover-img {
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .product-card:hover .img-wrap .hover-img {
            opacity: 1;
        }

        .product-card .badge-modern {
            position: absolute;
            top: 12px;
            left: 12px;
            background: var(--gold);
            color: #fff;
            font-size: 0.55rem;
            letter-spacing: 0.1em;
            padding: 0.25rem 0.8rem;
            border-radius: 40px;
            font-weight: 500;
            z-index: 5;
            text-transform: uppercase;
        }

        .product-card .badge-modern.badge-sale {
            background: #dc3545;
        }

        .product-card .badge-modern.badge-new {
            background: #0d6efd;
        }

        .product-card .wishlist-btn {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(4px);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            transition: 0.3s ease;
            opacity: 0;
            transform: translateX(10px);
            z-index: 5;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }

        .product-card:hover .wishlist-btn {
            opacity: 1;
            transform: translateX(0);
        }

        .product-card .wishlist-btn i {
            font-size: 0.9rem;
            color: #333;
            transition: 0.3s ease;
        }

        .product-card .wishlist-btn.active i {
            color: #e74c3c;
        }

        .product-card .wishlist-btn:hover i {
            color: #e74c3c;
        }

        .product-card .wishlist-btn.active {
            background: rgba(231, 76, 60, 0.1);
        }

        .product-card .quick-actions {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 0.8rem;
            background: linear-gradient(0deg, rgba(255, 255, 255, 0.9) 0%, transparent 100%);
            transform: translateY(100%);
            transition: 0.3s ease;
            display: flex;
            justify-content: center;
            gap: 0.6rem;
            opacity: 0;
            z-index: 6;
        }

        .product-card:hover .quick-actions {
            transform: translateY(0);
            opacity: 1;
        }

        .product-card .quick-actions .action-icon {
            background: #fff;
            padding: 0.5rem 0.8rem;
            border-radius: 50px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            font-size: 0.8rem;
            color: #333;
            cursor: pointer;
            transition: 0.2s;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .product-card .quick-actions .action-icon:hover {
            background: var(--gold);
            color: #fff;
        }

        .product-card .quick-actions .action-icon.view-icon:hover {
            background: #af9316;
            color: #fff;
        }

        .product-card .product-info {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .product-card .product-info .product-category {
            font-size: 0.6rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #aaa;
            margin-bottom: 0.2rem;
        }

        .product-card .product-info h6 {
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 0.4rem;
            color: var(--primary);
        }

        .product-card .product-info .price {
            font-weight: 600;
            color: var(--gold);
            font-size: 0.95rem;
        }

        .product-card .product-info .old-price {
            color: #bbb;
            text-decoration: line-through;
            font-size: 0.75rem;
            margin-left: 0.4rem;
            font-weight: 300;
        }

        .product-card .product-info .ratings {
            display: flex;
            align-items: center;
            gap: 4px;
            margin-top: auto;
            padding-top: 0.5rem;
        }

        .product-card .product-info .ratings .stars {
            color: var(--gold);
            font-size: 0.75rem;
        }

        .product-card .product-info .ratings .rating-count {
            font-size: 0.65rem;
            color: #aaa;
        }

        .product-link {
            text-decoration: none;
            color: inherit;
            display: block;
            height: 100%;
        }

        /* ============================================================
           PAGINATION CUSTOM STYLING
        ============================================================ */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        .pagination-wrapper .pagination {
            margin-bottom: 0;
            gap: 6px;
        }

        .pagination-wrapper .page-item .page-link {
            color: var(--primary);
            border: 1px solid #e5e5e5;
            border-radius: 8px !important;
            padding: 0.5rem 0.85rem;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            box-shadow: none;
        }

        .pagination-wrapper .page-item.active .page-link {
            background-color: var(--gold);
            border-color: var(--gold);
            color: #fff;
        }

        .pagination-wrapper .page-item .page-link:hover {
            border-color: var(--gold);
            color: var(--gold);
            background-color: rgba(201, 162, 39, 0.05);
        }

        .pagination-wrapper .page-item.disabled .page-link {
            color: #ccc;
            border-color: #f0f0f0;
            background-color: transparent;
        }

        /* Alert Messages */
        .alert-modern {
            padding: 0.8rem 1.2rem;
            border-radius: 12px;
            font-family: var(--font-body);
            font-size: 0.9rem;
            font-weight: 300;
            margin-bottom: 1rem;
        }

        /* Featured Toggle Button */
        .btn-gold {
            background: #C9A227 !important;
            color: #fff !important;
            border-color: #C9A227 !important;
        }
        .btn-gold:hover {
            background: #b8911f !important;
            color: #fff !important;
        }
        .btn-outline-dark {
            color: #333;
            border-color: #dee2e6;
            background: transparent;
        }
        .btn-outline-dark:hover {
            border-color: #C9A227;
            color: #C9A227;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .filter-sidebar {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 9999;
                padding: 20px;
            }

            .filter-sidebar.active {
                display: block;
            }

            .filter-sidebar .filter-content {
                background: #fff;
                border-radius: 16px;
                padding: 2rem;
                max-width: 400px;
                margin: auto;
                position: relative;
                max-height: 85vh;
                overflow-y: auto;
            }

            .filter-sidebar .filter-close {
                position: absolute;
                top: 15px;
                right: 15px;
                background: none;
                border: none;
                font-size: 1.2rem;
                color: #888;
            }

            .mobile-filter-toggle {
                display: flex;
            }
        }
    </style>
</head>

<body>

    <!-- PRODUCTS HERO -->
    <section class="products-hero">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <span class="hero-label">✦ Collection</span>
            <h1>{{ $categoryName ? $categoryName : 'Our Products' }}</h1>
            <p class="hero-sub">{{ $categoryName ? 'Explore products from the '.$categoryName.' collection.' : 'Curated pieces for the discerning — where quality meets timeless design.' }}</p>
        </div>
    </section>

    <!-- PRODUCTS MAIN CONTENT -->
    <section class="section-spacer">
        <div class="container">

            <!-- Alerts -->
            @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">

                <!-- SIDEBAR FILTERS -->
                <div class="col-lg-3">
                    <div class="filter-sidebar" id="filterSidebar">
                        <div class="filter-content">

                            <!-- Mobile Close Button -->
                            <button class="filter-close d-lg-none" onclick="closeFilters()">
                                <i class="fas fa-times"></i>
                            </button>

                            <h3 class="filter-title">Filters</h3>
                            <p class="filter-subtitle">Refine your search</p>

                            <!-- Category Filter -->
                            <div class="filter-group">
                                <div class="filter-group-title">Category</div>
                                @foreach($categories as $category)
                                <label class="filter-option">
                                    <input type="checkbox" value="{{ $category->id }}" wire:model.live="selectedCategories">
                                    <span>{{ $category->name }}</span>
                                    <span class="count">({{ $category->products()->where('status',1)->count() }})</span>
                                </label>
                                @endforeach
                            </div>

                            <!-- Price Range Filter -->
                            <div class="filter-group">
                                <div class="filter-group-title">Price Range</div>
                                <div class="price-range">
                                    <input type="number" wire:model.live="minPrice" placeholder="Min">
                                    <span class="price-separator">—</span>
                                    <input type="number" wire:model.live="maxPrice" placeholder="Max">
                                </div>
                            </div>

                            <!-- Availability Filter -->
                            <div class="filter-group">
                                <div class="filter-group-title">Availability</div>
                                <label class="filter-option">
                                    <input type="radio" name="availability" value="stock" wire:model.live="availability">
                                    In Stock
                                </label>
                                <label class="filter-option">
                                    <input type="radio" name="availability" value="out" wire:model.live="availability">
                                    Out of Stock
                                </label>
                                <label class="filter-option">
                                    <input type="radio" name="availability" value="all" wire:model.live="availability">
                                    All Products
                                </label>
                            </div>

                            <!-- Filter Actions -->
                            <div class="filter-actions">
                                <button class="btn-reset" wire:click="$set('selectedCategories', [])">
                                    Reset Filters
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
                      
                <!-- PRODUCTS GRID -->
                <div class="col-lg-9">

                    <!-- Mobile Filter Toggle Buttons -->
                    <div class="mobile-filter-toggle">
                        <button class="btn-filter-toggle" onclick="openFilters()">
                            <i class="fas fa-sliders-h me-1"></i> Filters
                        </button>
                    </div>

                    <!-- Header Toolbar (Results count, Featured Toggle & Sorting) -->
                    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <span style="font-size:0.8rem; font-weight:300; color:#888;">
                                Showing <strong style="color:#333;">{{ $products->count() }}</strong> products
                            </span>
                            
                            <!-- Featured Toggle Button -->
                            <button wire:click="toggleFeatured" 
                                    class="btn btn-sm {{ $featuredOnly ? 'btn-gold' : 'btn-outline-dark' }}"
                                    style="border-radius:30px; padding:4px 16px; font-size:0.7rem; letter-spacing:0.05em;">
                                <i class="fas fa-star me-1"></i>
                                {{ $featuredOnly ? '⭐ Featured' : 'All Products' }}
                            </button>
                        </div>
                        
                        <select wire:model.live="sort" class="form-select w-auto" style="font-size:0.8rem; border-radius:8px;">
                            <option value="latest">Newest First</option>
                            <option value="low">Price: Low to High</option>
                            <option value="high">Price: High to Low</option>
                        </select>
                    </div>

                    <!-- Products Row -->
                    <div class="row g-4">
                        @forelse($products as $product)
                        <div class="col-md-4 col-6" wire:key="product-{{ $product->id }}">
                            <div class="product-card">
                                <div class="img-wrap">
                                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" />

                                    @if($product->gallery && is_array($product->gallery) && count($product->gallery) > 0)
                                        <img class="hover-img" src="{{ asset('storage/'.$product->gallery[0]) }}" alt="{{ $product->name }}" />
                                    @endif

                                    @if($product->badge)
                                        <span class="badge-modern">{{ $product->badge }}</span>
                                    @endif

                                    @if($product->compare_price && $product->price < $product->compare_price)
                                        @php
                                            $discount = round((($product->compare_price - $product->price) / $product->compare_price) * 100);
                                        @endphp
                                        <span class="badge-modern badge-sale">-{{ $discount }}%</span>
                                    @endif

                                    @if($product->featured)
                                        <span class="badge-modern" style="background:#C9A227; left:70px;">★ FEATURED</span>
                                    @endif

                                    <!-- Wishlist Button -->
                                    <button class="wishlist-btn {{ in_array($product->id, $wishlistStatus) ? 'active' : '' }}" 
                                            wire:click="toggleWishlist({{ $product->id }})"
                                            wire:loading.attr="disabled"
                                            type="button"
                                            title="Add to wishlist">
                                        <i class="fas fa-heart"></i>
                                    </button>

                                    <!-- Quick Actions -->
                                    <div class="quick-actions">
                                        <a href="{{ route('product.show', $product->slug) }}" class="action-icon view-icon" title="View Product">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <button class="action-icon" wire:click="addToCart({{ $product->id }})" 
                                                wire:loading.attr="disabled"
                                                type="button"
                                                title="Add to Cart">
                                            <i class="bi bi-bag-plus"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="product-info">
                                    <div class="product-category">{{ $product->category->name ?? 'Uncategorized' }}</div>
                                    <h6>{{ $product->name }}</h6>

                                    <div>
                                        <span class="price">${{ number_format($product->price, 2) }}</span>
                                        @if($product->compare_price)
                                            <span class="old-price">${{ number_format($product->compare_price, 2) }}</span>
                                        @endif
                                    </div>

                                    <div class="ratings">
                                        <span class="stars">
                                            @php
                                                $rating = $product->reviews->avg('rating') ?? 0;
                                            @endphp
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= round($rating))
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </span>
                                        <span class="rating-count">({{ $product->reviews->count() ?? 0 }})</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center py-5">
                            <i class="fas fa-box-open fa-3x text-muted mb-3 d-block"></i>
                            <h5>No Products Found</h5>
                            <p class="text-muted">Try adjusting your filters</p>
                        </div>
                        @endforelse
                    </div>

                   <!-- Pagination - Only show for normal products listing -->
@if(!$showCategorySections)
    <div class="pagination-wrapper" data-aos="fade-up">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
@endif

                </div>

            </div>
        </div>
    </section>

    <!-- SCRIPTS - FIXED: No duplicate header error -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS only once
        if (typeof window.aosInitialized === 'undefined') {
            AOS.init({
                duration: 700,
                once: true,
                easing: 'ease-out-cubic',
                offset: 30
            });
            window.aosInitialized = true;
        }

        function openFilters() {
            var sidebar = document.getElementById('filterSidebar');
            if (sidebar) {
                sidebar.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeFilters() {
            var sidebar = document.getElementById('filterSidebar');
            if (sidebar) {
                sidebar.classList.remove('active');
                document.body.style.overflow = '';
            }
        }

        // Filter Sidebar Click Handler
        var filterSidebar = document.getElementById('filterSidebar');
        if (filterSidebar) {
            filterSidebar.addEventListener('click', function(e) {
                if (e.target === this && window.innerWidth <= 992) {
                    closeFilters();
                }
            });
        }

        // Refresh AOS on Livewire updates
        document.addEventListener('livewire:init', function() {
            Livewire.on('filterUpdated', function() {
                if (typeof AOS !== 'undefined') {
                    AOS.refresh();
                }
            });
        });
    </script>
</body>

</html>
</div>