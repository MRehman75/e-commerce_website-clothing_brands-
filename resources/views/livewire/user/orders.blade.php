<div class="orders-wrapper">
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
                        @if(request()->routeIs('customer.dashboard'))
                            <span class="nav-indicator"></span>
                        @endif
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('customer.orders*') ? 'active' : '' }}">
                    <a href="{{ route('customer.orders') }}" class="nav-link">
                        <i class="fas fa-shopping-bag nav-icon"></i>
                        <span>Orders</span>
                        @php
                            $pendingCount = \App\Models\Order::where('user_id', auth()->id())
                                ->where('status', 'pending')
                                ->count();
                        @endphp
                        @if($pendingCount > 0)
                            <span class="nav-badge">{{ $pendingCount }}</span>
                        @endif
                        @if(request()->routeIs('customer.orders*'))
                            <span class="nav-indicator"></span>
                        @endif
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('customer.wishlist*') ? 'active' : '' }}">
                    <a href="{{ route('customer.wishlist') }}" class="nav-link">
                        <i class="fas fa-heart nav-icon"></i>
                        <span>Wishlist</span>
                        @if(request()->routeIs('customer.wishlist*'))
                            <span class="nav-indicator"></span>
                        @endif
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('customer.profile*') ? 'active' : '' }}">
                    <a href="{{ route('customer.profile') }}" class="nav-link">
                        <i class="fas fa-user nav-icon"></i>
                        <span>Profile</span>
                        @if(request()->routeIs('customer.profile*'))
                            <span class="nav-indicator"></span>
                        @endif
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
    <div class="orders-main">
        <!-- Header -->
<header class="orders-header d-lg-none">
    <div class="header-left">
        <button class="sidebar-toggle" id="sidebarToggleBtn" aria-label="Toggle Sidebar">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <div class="header-right"></div>
</header>

        <!-- Content -->
        <div class="orders-content">
            <!-- Page Title -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="page-title">My Orders</h2>
                    <p class="text-muted small">View and manage all your orders</p>
                </div>
                <a href="{{ route('products') }}" class="btn btn-gold btn-sm">
                    <i class="fas fa-shopping-bag me-1"></i> Continue Shopping
                </a>
            </div>

            <!-- Status Tabs -->
            <div class="order-tabs mb-4">
                <div class="d-flex flex-wrap gap-2">
                    @php
                        $tabs = [
                            'all' => ['label' => 'All Orders', 'icon' => 'fa-list'],
                            'pending' => ['label' => 'Pending', 'icon' => 'fa-clock'],
                            'processing' => ['label' => 'Processing', 'icon' => 'fa-spinner'],
                            'shipped' => ['label' => 'Shipped', 'icon' => 'fa-truck'],
                            'delivered' => ['label' => 'Delivered', 'icon' => 'fa-check-circle'],
                            'cancelled' => ['label' => 'Cancelled', 'icon' => 'fa-times-circle'],
                        ];
                    @endphp

                    @foreach($tabs as $key => $tab)
                        <button wire:click="$set('statusFilter', '{{ $key }}')"
                                class="tab-btn {{ $statusFilter == $key ? 'active' : '' }}">
                            <i class="fas {{ $tab['icon'] }}"></i>
                            {{ $tab['label'] }}
                            <span class="tab-count">{{ $statusCounts[$key] ?? 0 }}</span>
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Filters -->
            <div class="filters-bar mb-4">
                <div class="row g-2 align-items-center">
                    <div class="col-md-5">
                        <div class="search-box">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text"
                                   wire:model.live="search"
                                   placeholder="Search by order number..."
                                   class="search-input">
                        </div>
                    </div>
                    <div class="col-md-3 ms-auto">
                        <select wire:model.live="sortBy" class="form-select form-select-sm">
                            <option value="newest">Sort: Newest First</option>
                            <option value="oldest">Sort: Oldest First</option>
                            <option value="amount_high">Sort: Amount (High to Low)</option>
                            <option value="amount_low">Sort: Amount (Low to High)</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Orders List -->
            <div class="orders-list">
                @if($orders->count() > 0)
                    @foreach($orders as $order)
                        <div class="order-card" wire:key="order-{{ $order->id }}">
                            <div class="order-card-header">
                                <div class="order-info">
                                    <div class="order-number">
                                        <span class="order-label">Order #</span>
                                        <span class="order-value">{{ $order->order_number }}</span>
                                    </div>
                                    <div class="order-date">
                                        <i class="fas fa-calendar-alt text-muted me-1"></i>
                                        {{ $order->created_at->format('d M Y, h:i A') }}
                                    </div>
                                </div>
                                <div class="order-status">
                                    <span class="status-badge status-{{ $order->status }}">
                                        <i class="fas fa-{{ $order->status == 'delivered' ? 'check-circle' : ($order->status == 'pending' ? 'clock' : ($order->status == 'cancelled' ? 'times-circle' : 'spinner')) }}"></i>
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                            </div>

                            <div class="order-card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-5">
                                        <div class="order-items">
                                            <i class="fas fa-box text-muted me-1"></i>
                                            <span>{{ $order->items->count() }} item(s)</span>
                                            <span class="text-muted mx-2">·</span>
                                            <span class="text-muted">Payment: {{ ucfirst($order->payment_method ?? 'N/A') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-md-end">
                                        <div class="order-total">
                                            <span class="total-label">Total:</span>
                                            <span class="total-amount">${{ number_format($order->total, 2) }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-md-end">
                                        <a href="{{ route('customer.orders.show', $order->id) }}"
                                           class="btn-view-order">
                                            View Order <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Pagination -->
                    <div class="pagination-wrapper mt-4">
                        {{ $orders->links() }}
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-inbox"></i>
                        </div>
                        <h5 class="empty-state-title">No Orders Found</h5>
                        <p class="empty-state-text">You haven't placed any orders yet.</p>
                        <a href="{{ route('products') }}" class="btn btn-gold mt-3">
                            <i class="fas fa-shopping-bag me-1"></i> Start Shopping
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
STYLES
============================================================ -->
<style>
    /* ============================================================
    ORDERS WRAPPER
    ============================================================ */
    .orders-wrapper {
        display: flex;
        min-height: calc(100vh - 36px);
        background: #f5f6fa;
    }

    /* ============================================================
    SIDEBAR
    ============================================================ */
    .orders-wrapper .main-sidebar {
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
    .orders-wrapper .main-sidebar::-webkit-scrollbar {
        width: 4px;
    }
    .orders-wrapper .main-sidebar::-webkit-scrollbar-track {
        background: #0a0a0a;
    }
    .orders-wrapper .main-sidebar::-webkit-scrollbar-thumb {
        background: rgba(201,162,39,0.3);
        border-radius: 4px;
    }

    .orders-wrapper .user-panel {
        padding: 24px 20px 20px;
        border-bottom: 1px solid rgba(255,255,255,0.04);
        display: flex;
        align-items: center;
        gap: 14px;
        flex-shrink: 0;
    }
    .orders-wrapper .user-avatar {
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
    .orders-wrapper .avatar-text {
        color: #0a0a0a;
        font-size: 18px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    .orders-wrapper .user-name {
        color: #fff;
        font-size: 0.95rem;
        font-weight: 600;
        margin: 0;
        line-height: 1.2;
        font-family: 'Poppins', sans-serif;
    }
    .orders-wrapper .user-email {
        color: rgba(255,255,255,0.5);
        font-size: 0.7rem;
        display: block;
        margin-top: 1px;
    }
    .orders-wrapper .user-status {
        display: flex;
        align-items: center;
        gap: 6px;
        color: rgba(255,255,255,0.4);
        font-size: 0.6rem;
        margin-top: 2px;
    }
    .orders-wrapper .status-dot {
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

    .orders-wrapper .sidebar-menu {
        flex: 1;
        padding: 12px 0 20px;
        overflow-y: auto;
    }
    .orders-wrapper .nav-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .orders-wrapper .nav-item {
        margin: 2px 0;
    }
    .orders-wrapper .nav-link {
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
    .orders-wrapper .nav-link:hover {
        color: #fff;
        background: rgba(255,255,255,0.04);
        border-left-color: rgba(201,162,39,0.4);
    }
    .orders-wrapper .nav-item.active .nav-link {
        color: #fff;
        background: rgba(201,162,39,0.08);
        border-left-color: #C9A227;
    }
    .orders-wrapper .nav-item.active .nav-link .nav-icon {
        color: #C9A227;
    }
    .orders-wrapper .nav-icon {
        font-size: 1.1rem;
        width: 24px;
        text-align: center;
        flex-shrink: 0;
        color: rgba(255,255,255,0.35);
        transition: color 0.25s ease;
    }
    .orders-wrapper .nav-item.active .nav-icon {
        color: #C9A227;
    }
    .orders-wrapper .nav-link:hover .nav-icon {
        color: #C9A227;
    }
    .orders-wrapper .nav-badge {
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
    .orders-wrapper .nav-indicator {
        margin-left: auto;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #C9A227;
        animation: pulse-dot 2s ease-in-out infinite;
    }
    .orders-wrapper .nav-divider {
        height: 1px;
        background: rgba(255,255,255,0.04);
        margin: 12px 20px;
    }
    .orders-wrapper .logout-link {
        color: rgba(255,255,255,0.4) !important;
        margin-top: 4px;
    }
    .orders-wrapper .logout-link:hover {
        color: #dc3545 !important;
    }
    .orders-wrapper .logout-link:hover .nav-icon {
        color: #dc3545 !important;
    }

    /* Sidebar Overlay */
    .orders-wrapper .sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5);
        z-index: 1040;
    }
    .orders-wrapper .sidebar-overlay.active {
        display: block;
    }

    /* Sidebar Responsive */
    @media (max-width: 992px) {
        .orders-wrapper .main-sidebar {
            position: fixed;
            left: -100%;
            width: 280px;
            height: 100vh;
            transition: left 0.3s ease;
            box-shadow: 0 0 40px rgba(0,0,0,0.3);
            z-index: 1050;
        }
        .orders-wrapper .main-sidebar.open {
            left: 0;
        }
    }

    /* ============================================================
    ORDERS MAIN
    ============================================================ */
    .orders-main {
        flex: 1;
        display: flex;
        flex-direction: column;
        min-width: 0;
        background: #f5f6fa;
    }

    /* ============================================================
    ORDERS HEADER
    ============================================================ */
    .orders-header {
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
    .orders-header .header-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .orders-header .sidebar-toggle {
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
    .orders-header .sidebar-toggle:hover {
        background: #f0f0f0;
    }
    .orders-header .header-right {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    /* ============================================================
    ORDERS CONTENT
    ============================================================ */
    .orders-content {
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
    ORDER TABS
    ============================================================ */
    .tab-btn {
        padding: 8px 18px;
        border: none;
        border-radius: 30px;
        background: #f1f3f5;
        color: #6c757d;
        font-size: 0.8rem;
        font-weight: 500;
        transition: all 0.3s ease;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .tab-btn:hover {
        background: #e9ecef;
        color: #0a0a0a;
    }
    .tab-btn.active {
        background: #0a0a0a;
        color: #fff;
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
    }
    .tab-btn.active .tab-count {
        background: rgba(255,255,255,0.2);
        color: #fff;
    }
    .tab-count {
        background: rgba(0,0,0,0.06);
        color: #6c757d;
        font-size: 0.6rem;
        font-weight: 600;
        padding: 1px 8px;
        border-radius: 20px;
        min-width: 20px;
        text-align: center;
    }

    /* ============================================================
    FILTERS BAR
    ============================================================ */
    .filters-bar {
        background: #fff;
        padding: 12px 16px;
        border-radius: 12px;
        border: 1px solid rgba(0,0,0,0.04);
        box-shadow: 0 2px 8px rgba(0,0,0,0.02);
    }
    .search-box {
        position: relative;
    }
    .search-box .search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #adb5bd;
        font-size: 0.85rem;
    }
    .search-box .search-input {
        width: 100%;
        padding: 8px 14px 8px 40px;
        border: 1px solid #e9ecef;
        border-radius: 30px;
        font-size: 0.85rem;
        background: #f8f9fa;
        transition: all 0.3s ease;
        outline: none;
        color: #1a1a1a;
    }
    .search-box .search-input:focus {
        border-color: #C9A227;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(201,162,39,0.06);
    }
    .form-select-sm {
        font-size: 0.8rem;
        border-radius: 30px;
        border-color: #e9ecef;
        padding: 6px 30px 6px 14px;
        background-color: #f8f9fa;
        cursor: pointer;
    }
    .form-select-sm:focus {
        border-color: #C9A227;
        box-shadow: 0 0 0 3px rgba(201,162,39,0.06);
    }

    /* ============================================================
    ORDER CARDS
    ============================================================ */
    .orders-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .order-card {
        background: #fff;
        border-radius: 12px;
        border: 1px solid rgba(0,0,0,0.04);
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.02);
    }
    .order-card:hover {
        box-shadow: 0 8px 30px rgba(0,0,0,0.06);
        border-color: rgba(201,162,39,0.1);
        transform: translateY(-2px);
    }
    .order-card-header {
        padding: 14px 20px;
        background: #fafafa;
        border-bottom: 1px solid rgba(0,0,0,0.03);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
    }
    .order-info {
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }
    .order-number {
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .order-label {
        color: #6c757d;
        font-size: 0.7rem;
        font-weight: 500;
        letter-spacing: 0.03em;
    }
    .order-value {
        font-weight: 700;
        font-size: 0.9rem;
        color: #0a0a0a;
    }
    .order-date {
        color: #6c757d;
        font-size: 0.8rem;
    }
    .order-date i {
        font-size: 0.7rem;
    }

    .order-status {
        flex-shrink: 0;
    }
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 14px;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: capitalize;
        letter-spacing: 0.03em;
    }
    .status-pending {
        background: #fff3cd;
        color: #856404;
    }
    .status-processing {
        background: #cce5ff;
        color: #004085;
    }
    .status-shipped {
        background: #d1ecf1;
        color: #0c5460;
    }
    .status-delivered {
        background: #d4edda;
        color: #155724;
    }
    .status-cancelled {
        background: #f8d7da;
        color: #721c24;
    }

    .order-card-body {
        padding: 14px 20px;
    }
    .order-items {
        font-size: 0.85rem;
        color: #495057;
    }
    .order-total {
        display: flex;
        align-items: center;
        gap: 6px;
        justify-content: flex-end;
    }
    .total-label {
        font-size: 0.8rem;
        color: #6c757d;
    }
    .total-amount {
        font-size: 1.1rem;
        font-weight: 700;
        color: #C9A227;
    }
    .btn-view-order {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 6px 18px;
        border: 1px solid #C9A227;
        border-radius: 30px;
        color: #C9A227;
        font-size: 0.75rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        background: transparent;
    }
    .btn-view-order:hover {
        background: #C9A227;
        color: #fff;
        text-decoration: none;
        transform: translateX(2px);
    }

    /* ============================================================
    PAGINATION
    ============================================================ */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
    }
    .pagination-wrapper .pagination {
        margin: 0;
        gap: 4px;
    }
    .pagination-wrapper .page-link {
        border: 1px solid #e9ecef;
        border-radius: 8px;
        color: #495057;
        padding: 6px 14px;
        font-size: 0.85rem;
        transition: all 0.3s ease;
    }
    .pagination-wrapper .page-link:hover {
        background: #C9A227;
        color: #fff;
        border-color: #C9A227;
    }
    .pagination-wrapper .page-item.active .page-link {
        background: #0a0a0a;
        border-color: #0a0a0a;
        color: #fff;
    }
    .pagination-wrapper .page-item.disabled .page-link {
        opacity: 0.4;
        cursor: not-allowed;
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

    /* ============================================================
    RESPONSIVE
    ============================================================ */
    @media (max-width: 992px) {
        .orders-header .sidebar-toggle {
            display: block;
        }
        .orders-header {
            padding: 10px 16px;
            min-height: 50px;
        }
        .orders-content {
            padding: 16px;
        }
    }

    @media (max-width: 768px) {
        .order-card-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .order-info {
            width: 100%;
            flex-wrap: wrap;
        }
        .order-status {
            width: 100%;
        }
        .order-card-body .row > div {
            margin-bottom: 8px;
        }
        .order-card-body .row > div:last-child {
            margin-bottom: 0;
        }
        .order-total {
            justify-content: flex-start;
        }
        .btn-view-order {
            width: 100%;
            justify-content: center;
        }
        .tab-btn {
            font-size: 0.7rem;
            padding: 6px 12px;
        }
        .tab-count {
            font-size: 0.5rem;
            padding: 1px 6px;
            min-width: 16px;
        }
        .filters-bar .row {
            flex-direction: column;
        }
        .filters-bar .col-md-3.ms-auto {
            margin-left: 0 !important;
        }
    }

    @media (max-width: 576px) {
        .orders-content {
            padding: 12px;
        }
        .order-number .order-value {
            font-size: 0.8rem;
        }
        .order-date {
            font-size: 0.7rem;
        }
        .order-card-body {
            padding: 12px 16px;
        }
        .total-amount {
            font-size: 1rem;
        }
        .order-tabs .d-flex {
            gap: 4px;
        }
        .tab-btn {
            font-size: 0.65rem;
            padding: 4px 10px;
        }
        .search-box .search-input {
            font-size: 0.8rem;
            padding: 6px 12px 6px 34px;
        }
    }
</style>

<!-- Sidebar Toggle Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarToggle = document.getElementById('sidebarToggleBtn');
        const sidebar = document.querySelector('.orders-wrapper .main-sidebar');
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