<div class="wishlist-wrapper">
    <!-- Sidebar -->
    <aside class="main-sidebar" id="mainSidebar">
        <!-- User Panel -->
        <div class="user-panel">
            <div class="user-avatar">
                <span class="avatar-text">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
                </span>
            </div>
            <div class="user-info">
                <h6 class="user-name">{{ auth()->user()->name ?? 'User' }}</h6>
                <span class="user-email">{{ auth()->user()->email ?? '' }}</span>
                <span class="user-status">
                    <span class="status-dot"></span> Online
                </span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="sidebar-menu">
            <ul class="nav-list">
                <li class="nav-item {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('customer.dashboard') }}" class="nav-link">
                        <i class="fas fa-th-large nav-icon"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('customer.orders*') ? 'active' : '' }}">
                    <a href="{{ route('customer.orders') }}" class="nav-link">
                        <i class="fas fa-shopping-bag nav-icon"></i>
                        <span>Orders</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('customer.wishlist*') ? 'active' : '' }}">
                    <a href="{{ route('customer.wishlist') }}" class="nav-link">
                        <i class="fas fa-heart nav-icon"></i>
                        <span>Wishlist</span>
                        @if($wishlistCount > 0)
                            <span class="nav-badge">{{ $wishlistCount }}</span>
                        @endif
                        @if(request()->routeIs('customer.wishlist*'))
                            <span class="nav-indicator"></span>
                        @endif
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('customer.profile*') ? 'active' : '' }}">
                    <a href="{{ route('customer.profile') }}" class="nav-link">
                        <i class="fas fa-user nav-icon"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li class="nav-divider"></li>
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <a href="#" class="nav-link logout-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt nav-icon"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Main Content -->
   <div class="wishlist-main">
    <!-- Header -->
    <header class="wishlist-header d-lg-none">
        <div class="header-left">
            <button class="sidebar-toggle" id="sidebarToggleBtn" aria-label="Toggle Sidebar">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <div class="header-right"></div>
    </header>

        <!-- Content -->
        <div class="wishlist-content">
            <!-- ============================================================
            PAGE HEADER
            ============================================================ -->
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="page-title">My Wishlist</h2>
                    <p class="text-muted small">
                        <i class="fas fa-heart text-danger me-1"></i>
                        {{ $wishlistCount }} {{ Str::plural('item', $wishlistCount) }} saved
                    </p>
                </div>
                <div class="d-flex gap-2">
                    @if($wishlistCount > 0)
                        <button wire:click="addAllToCart" class="btn btn-gold btn-sm">
                            <i class="fas fa-shopping-cart me-1"></i> Add All to Cart
                        </button>
                        <button wire:click="clearWishlist" 
                                wire:confirm="Are you sure you want to clear your wishlist?"
                                class="btn btn-outline-danger btn-sm">
                            <i class="fas fa-trash-alt me-1"></i> Clear All
                        </button>
                    @endif
                </div>
            </div>

            <!-- ============================================================
            MESSAGES
            ============================================================ -->
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

            <!-- ============================================================
            WISHLIST ITEMS
            ============================================================ -->
            @if($wishlistCount > 0)
                <div class="wishlist-grid">
                    @foreach($wishlistItems as $item)
                        <div class="wishlist-card" wire:key="wishlist-{{ $item['id'] }}">
                            <!-- Product Image -->
                            <div class="wishlist-card-image">
                                <a href="{{ route('product.show', $item['slug'] ?? $item['product_id']) }}">
                                    @if($item['image'])
                                        <img src="{{ asset('storage/' . $item['image']) }}" 
                                             alt="{{ $item['name'] }}">
                                    @else
                                        <div class="no-image">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </a>
                                <!-- Stock Status Badge -->
                                @if($item['in_stock'])
                                    <span class="stock-badge in-stock">
                                        <i class="fas fa-check-circle"></i> In Stock
                                    </span>
                                @else
                                    <span class="stock-badge out-of-stock">
                                        <i class="fas fa-times-circle"></i> Out of Stock
                                    </span>
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div class="wishlist-card-body">
                                <a href="{{ route('product.show', $item['slug'] ?? $item['product_id']) }}" 
                                   class="product-name">
                                    {{ $item['name'] }}
                                </a>
                                
                                <div class="product-price">
                                    @if($item['compare_price'] && $item['compare_price'] > $item['price'])
                                        <span class="old-price">${{ number_format($item['compare_price'], 2) }}</span>
                                        <span class="current-price">${{ number_format($item['price'], 2) }}</span>
                                    @else
                                        <span class="current-price">${{ number_format($item['price'], 2) }}</span>
                                    @endif
                                </div>

                                <div class="product-actions">
                                    @if($item['in_stock'])
                                        <button wire:click="addToCart({{ $item['product_id'] }})" 
                                                class="btn-add-cart">
                                            <i class="fas fa-shopping-bag me-1"></i> Add to Cart
                                        </button>
                                    @else
                                        <button class="btn-add-cart disabled" disabled>
                                            <i class="fas fa-times-circle me-1"></i> Out of Stock
                                        </button>
                                    @endif
                                    
                                    <button wire:click="removeFromWishlist({{ $item['id'] }})" 
                                            wire:confirm="Remove this item from wishlist?"
                                            class="btn-remove">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </div>

                                <div class="product-meta">
                                    <span class="added-date">
                                        <i class="far fa-clock me-1"></i> Added {{ $item['created_at'] }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Wishlist Stats -->
                <div class="wishlist-stats mt-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-heart text-danger"></i>
                                </div>
                                <div class="stat-info">
                                    <h4>{{ $wishlistCount }}</h4>
                                    <span>Total Items</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-check-circle text-success"></i>
                                </div>
                                <div class="stat-info">
                                    @php
                                        $inStock = collect($wishlistItems)->where('in_stock', true)->count();
                                    @endphp
                                    <h4>{{ $inStock }}</h4>
                                    <span>In Stock</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-shopping-cart text-gold"></i>
                                </div>
                                <div class="stat-info">
                                    @php
                                        $totalValue = collect($wishlistItems)->sum('price');
                                    @endphp
                                    <h4>${{ number_format($totalValue, 0) }}</h4>
                                    <span>Total Value</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- ============================================================
                EMPTY WISHLIST
                ============================================================ -->
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h5 class="empty-state-title">Your Wishlist is Empty</h5>
                    <p class="empty-state-text">
                        Start saving your favorite items by clicking the heart icon on any product.
                    </p>
                    <a href="{{ route('products') }}" class="btn btn-gold mt-3">
                        <i class="fas fa-shopping-bag me-1"></i> Start Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- ============================================================
STYLES
============================================================ -->
<style>
    /* ============================================================
    WISHLIST WRAPPER
    ============================================================ */
    .wishlist-wrapper {
        display: flex;
        min-height: calc(100vh - 36px);
        background: #f5f6fa;
    }

    /* ============================================================
    SIDEBAR
    ============================================================ */
    .wishlist-wrapper .main-sidebar {
        position: sticky;
        top: 0;
        left: 0;
        width: 270px;
        height: 100vh;
        background: #0a0a0a;
        color: rgba(255,255,255,0.7);
        display: flex;
        flex-direction: column;
        overflow-y: auto;
        z-index: 100;
        border-right: 1px solid rgba(255,255,255,0.04);
        flex-shrink: 0;
        transition: all 0.3s ease;
    }
    .wishlist-wrapper .main-sidebar::-webkit-scrollbar {
        width: 4px;
    }
    .wishlist-wrapper .main-sidebar::-webkit-scrollbar-track {
        background: #0a0a0a;
    }
    .wishlist-wrapper .main-sidebar::-webkit-scrollbar-thumb {
        background: rgba(201,162,39,0.3);
        border-radius: 4px;
    }

    .wishlist-wrapper .user-panel {
        padding: 24px 20px 20px;
        border-bottom: 1px solid rgba(255,255,255,0.04);
        display: flex;
        align-items: center;
        gap: 14px;
        flex-shrink: 0;
    }
    .wishlist-wrapper .user-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: linear-gradient(135deg, #C9A227, #f9d76a);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 4px 16px rgba(201,162,39,0.25);
    }
    .wishlist-wrapper .avatar-text {
        color: #0a0a0a;
        font-size: 18px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    .wishlist-wrapper .user-name {
        color: #fff;
        font-size: 0.95rem;
        font-weight: 600;
        margin: 0;
        line-height: 1.2;
        font-family: 'Poppins', sans-serif;
    }
    .wishlist-wrapper .user-email {
        color: rgba(255,255,255,0.5);
        font-size: 0.7rem;
        display: block;
        margin-top: 1px;
    }
    .wishlist-wrapper .user-status {
        display: flex;
        align-items: center;
        gap: 6px;
        color: rgba(255,255,255,0.4);
        font-size: 0.6rem;
        margin-top: 2px;
    }
    .wishlist-wrapper .status-dot {
        display: inline-block;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #28a745;
        animation: pulse-dot 2s ease-in-out infinite;
    }
    @keyframes pulse-dot {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(0.8); }
    }

    .wishlist-wrapper .sidebar-menu {
        flex: 1;
        padding: 12px 0 20px;
        overflow-y: auto;
    }
    .wishlist-wrapper .nav-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .wishlist-wrapper .nav-item {
        margin: 2px 0;
    }
    .wishlist-wrapper .nav-link {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 10px 20px;
        color: rgba(255,255,255,0.6);
        text-decoration: none;
        transition: all 0.25s ease;
        border-left: 3px solid transparent;
        position: relative;
        font-size: 0.85rem;
        font-weight: 400;
        border-radius: 0 8px 8px 0;
        margin: 0 8px;
    }
    .wishlist-wrapper .nav-link:hover {
        color: #fff;
        background: rgba(255,255,255,0.04);
        border-left-color: rgba(201,162,39,0.4);
    }
    .wishlist-wrapper .nav-item.active .nav-link {
        color: #fff;
        background: rgba(201,162,39,0.08);
        border-left-color: #C9A227;
    }
    .wishlist-wrapper .nav-item.active .nav-link .nav-icon {
        color: #C9A227;
    }
    .wishlist-wrapper .nav-icon {
        font-size: 1.1rem;
        width: 24px;
        text-align: center;
        flex-shrink: 0;
        color: rgba(255,255,255,0.35);
        transition: color 0.25s ease;
    }
    .wishlist-wrapper .nav-item.active .nav-icon {
        color: #C9A227;
    }
    .wishlist-wrapper .nav-link:hover .nav-icon {
        color: #C9A227;
    }
    .wishlist-wrapper .nav-badge {
        margin-left: auto;
        background: #C9A227;
        color: #0a0a0a;
        font-size: 0.6rem;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 20px;
        min-width: 20px;
        text-align: center;
    }
    .wishlist-wrapper .nav-indicator {
        margin-left: auto;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #C9A227;
        animation: pulse-dot 2s ease-in-out infinite;
    }
    .wishlist-wrapper .nav-divider {
        height: 1px;
        background: rgba(255,255,255,0.04);
        margin: 12px 20px;
    }
    .wishlist-wrapper .logout-link {
        color: rgba(255,255,255,0.4) !important;
        margin-top: 4px;
    }
    .wishlist-wrapper .logout-link:hover {
        color: #dc3545 !important;
    }
    .wishlist-wrapper .logout-link:hover .nav-icon {
        color: #dc3545 !important;
    }

    .wishlist-wrapper .sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5);
        z-index: 1040;
    }
    .wishlist-wrapper .sidebar-overlay.active {
        display: block;
    }

    @media (max-width: 992px) {
        .wishlist-wrapper .main-sidebar {
            position: fixed;
            left: -100%;
            width: 280px;
            height: 100vh;
            transition: left 0.3s ease;
            box-shadow: 0 0 40px rgba(0,0,0,0.3);
            z-index: 1050;
        }
        .wishlist-wrapper .main-sidebar.open {
            left: 0;
        }
    }

    /* ============================================================
    WISHLIST MAIN
    ============================================================ */
    .wishlist-main {
        flex: 1;
        display: flex;
        flex-direction: column;
        min-width: 0;
        background: #f5f6fa;
    }

    /* ============================================================
    WISHLIST HEADER
    ============================================================ */
    .wishlist-header {
        background: #fff;
        padding: 12px 24px;
        border-bottom: 1px solid rgba(0,0,0,0.04);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-shrink: 0;
        position: sticky;
        top: 0;
        z-index: 50;
        min-height: 60px;
    }
    .wishlist-header .header-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .wishlist-header .sidebar-toggle {
        background: none;
        border: none;
        font-size: 1.2rem;
        color: #333;
        cursor: pointer;
        padding: 4px 8px;
        border-radius: 8px;
        transition: background 0.2s;
        display: none;
    }
    .wishlist-header .sidebar-toggle:hover {
        background: #f0f0f0;
    }
    .wishlist-header .header-right {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    /* ============================================================
    WISHLIST CONTENT
    ============================================================ */
    .wishlist-content {
        flex: 1;
        padding: 24px;
        overflow-y: auto;
    }

    /* ============================================================
    PAGE TITLE
    ============================================================ */
    .page-title {
        font-family: 'Playfair Display', serif;
        font-weight: 600;
        color: #0a0a0a;
        margin-bottom: 0;
    }

    /* ============================================================
    WISHLIST GRID
    ============================================================ */
    .wishlist-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 20px;
    }

    /* ============================================================
    WISHLIST CARD
    ============================================================ */
    .wishlist-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.04);
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.02);
    }
    .wishlist-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.06);
        border-color: rgba(201,162,39,0.1);
    }

    /* Card Image */
    .wishlist-card-image {
        position: relative;
        aspect-ratio: 1/1.1;
        overflow: hidden;
        background: #f8f9fa;
    }
    .wishlist-card-image a {
        display: block;
        width: 100%;
        height: 100%;
    }
    .wishlist-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .wishlist-card:hover .wishlist-card-image img {
        transform: scale(1.03);
    }
    .wishlist-card-image .no-image {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #dee2e6;
        font-size: 3rem;
    }

    .stock-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.6rem;
        font-weight: 600;
        letter-spacing: 0.03em;
        display: flex;
        align-items: center;
        gap: 4px;
        backdrop-filter: blur(4px);
    }
    .stock-badge.in-stock {
        background: rgba(40, 167, 69, 0.9);
        color: #fff;
    }
    .stock-badge.out-of-stock {
        background: rgba(220, 53, 69, 0.9);
        color: #fff;
    }

    /* Card Body */
    .wishlist-card-body {
        padding: 16px 18px 18px;
    }
    .product-name {
        display: block;
        font-size: 0.9rem;
        font-weight: 600;
        color: #0a0a0a;
        text-decoration: none;
        margin-bottom: 6px;
        transition: color 0.2s;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .product-name:hover {
        color: #C9A227;
    }

    .product-price {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
    }
    .current-price {
        font-size: 1.1rem;
        font-weight: 700;
        color: #C9A227;
    }
    .old-price {
        font-size: 0.85rem;
        color: #adb5bd;
        text-decoration: line-through;
    }

    .product-actions {
        display: flex;
        gap: 8px;
    }
    .btn-add-cart {
        flex: 1;
        padding: 8px 14px;
        border: none;
        border-radius: 8px;
        background: #0a0a0a;
        color: #fff;
        font-size: 0.75rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
    }
    .btn-add-cart:hover:not(.disabled) {
        background: #C9A227;
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(201,162,39,0.25);
    }
    .btn-add-cart.disabled {
        background: #e9ecef;
        color: #adb5bd;
        cursor: not-allowed;
    }

    .btn-remove {
        width: 38px;
        height: 38px;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        background: transparent;
        color: #dc3545;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        flex-shrink: 0;
    }
    .btn-remove:hover {
        background: #dc3545;
        color: #fff;
        border-color: #dc3545;
    }

    .product-meta {
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px solid rgba(0,0,0,0.04);
    }
    .added-date {
        font-size: 0.7rem;
        color: #adb5bd;
    }

    /* ============================================================
    WISHLIST STATS
    ============================================================ */
    .stat-card {
        background: #fff;
        border-radius: 12px;
        padding: 16px 20px;
        border: 1px solid rgba(0,0,0,0.04);
        display: flex;
        align-items: center;
        gap: 16px;
        transition: all 0.3s ease;
    }
    .stat-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.04);
    }
    .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }
    .stat-info h4 {
        font-size: 1.2rem;
        font-weight: 700;
        margin: 0;
        color: #0a0a0a;
    }
    .stat-info span {
        font-size: 0.75rem;
        color: #6c757d;
    }
    .text-gold {
        color: #C9A227;
    }

    /* ============================================================
    EMPTY STATE
    ============================================================ */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: #fff;
        border-radius: 16px;
        border: 1px solid rgba(0,0,0,0.04);
    }
    .empty-state-icon {
        font-size: 4rem;
        color: #dee2e6;
        margin-bottom: 16px;
    }
    .empty-state-title {
        font-weight: 600;
        font-size: 1.2rem;
        color: #0a0a0a;
        margin-bottom: 4px;
    }
    .empty-state-text {
        color: #6c757d;
        font-size: 0.9rem;
        max-width: 400px;
        margin: 0 auto;
    }

    /* ============================================================
    BUTTONS
    ============================================================ */
    .btn-gold {
        background: #C9A227;
        color: #fff;
        border: none;
        transition: all 0.3s ease;
    }
    .btn-gold:hover {
        background: #b8911f;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 24px rgba(201,162,39,0.25);
    }
    .btn-outline-danger {
        color: #dc3545;
        border: 1px solid #dc3545;
        background: transparent;
        transition: all 0.3s ease;
    }
    .btn-outline-danger:hover {
        background: #dc3545;
        color: #fff;
    }

    /* ============================================================
    RESPONSIVE
    ============================================================ */
    @media (max-width: 992px) {
        .wishlist-header .sidebar-toggle {
            display: block;
        }
        .wishlist-header {
            padding: 10px 16px;
            min-height: 50px;
        }
        .wishlist-content {
            padding: 16px;
        }
        .wishlist-grid {
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 16px;
        }
    }

    @media (max-width: 768px) {
        .wishlist-grid {
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 12px;
        }
        .wishlist-card-body {
            padding: 12px 14px 14px;
        }
        .product-name {
            font-size: 0.8rem;
        }
        .current-price {
            font-size: 0.95rem;
        }
        .btn-add-cart {
            font-size: 0.7rem;
            padding: 6px 10px;
        }
        .btn-remove {
            width: 34px;
            height: 34px;
            font-size: 0.8rem;
        }
        .wishlist-stats .stat-card {
            padding: 12px 16px;
        }
        .stat-info h4 {
            font-size: 1rem;
        }
        .d-flex.gap-2 {
            flex-wrap: wrap;
        }
        .d-flex.gap-2 .btn {
            font-size: 0.7rem;
            padding: 4px 12px;
        }
    }

    @media (max-width: 576px) {
        .wishlist-content {
            padding: 12px;
        }
        .wishlist-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 10px;
        }
        .wishlist-card-body {
            padding: 10px 12px 12px;
        }
        .product-name {
            font-size: 0.75rem;
        }
        .current-price {
            font-size: 0.85rem;
        }
        .stock-badge {
            font-size: 0.5rem;
            padding: 2px 8px;
        }
        .btn-add-cart {
            font-size: 0.6rem;
            padding: 4px 8px;
        }
        .btn-remove {
            width: 30px;
            height: 30px;
            font-size: 0.7rem;
        }
        .page-title {
            font-size: 1.2rem;
        }
    }
</style>

<!-- Sidebar Toggle Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarToggle = document.getElementById('sidebarToggleBtn');
        const sidebar = document.querySelector('.wishlist-wrapper .main-sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                sidebar.classList.toggle('open');
                if (overlay) {
                    overlay.classList.toggle('active');
                }
                document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
            });
        }

        if (overlay) {
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('open');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            });
        }

        window.addEventListener('resize', function() {
            if (window.innerWidth > 992) {
                if (sidebar) sidebar.classList.remove('open');
                if (overlay) overlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    });
</script>