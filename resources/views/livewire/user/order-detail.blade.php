<div class="order-detail-wrapper">
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
                        @if(request()->routeIs('customer.orders*'))
                            <span class="nav-indicator"></span>
                        @endif
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('customer.wishlist*') ? 'active' : '' }}">
                    <a href="{{ route('customer.wishlist') }}" class="nav-link">
                        <i class="fas fa-heart nav-icon"></i>
                        <span>Wishlist</span>
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
    <div class="order-detail-main">
        <header class="order-detail-header">
            <div class="header-left">
                <button class="sidebar-toggle" id="sidebarToggleBtn" aria-label="Toggle Sidebar">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div class="header-right"></div>
        </header>

        <!-- Content -->
        <div class="order-detail-content">
            <!-- Back Button & Order Header -->
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <a href="{{ route('customer.orders') }}" class="text-decoration-none text-muted d-inline-block mb-2">
                        <i class="fas fa-arrow-left me-2"></i> Back to Orders
                    </a>
                    <h2 class="page-title mb-0">Order #{{ $order->order_number }}</h2>
                    <small class="text-muted">
                        Placed on {{ $order->created_at->format('l, d F Y, h:i A') }}
                    </small>
                </div>
                <div class="mt-2 mt-md-0">
                    <span class="status-badge status-{{ $order->status }}">
                        <i class="fas fa-{{ $order->status == 'delivered' ? 'check-circle' : ($order->status == 'pending' ? 'clock' : ($order->status == 'cancelled' ? 'times-circle' : 'spinner')) }}"></i>
                        {{ ucfirst($order->status) }}
                    </span>
                    <span class="status-badge status-{{ $order->payment_status == 'paid' ? 'delivered' : 'pending' }} ms-2">
                        <i class="fas fa-credit-card me-1"></i>
                        {{ ucfirst($order->payment_status ?? 'Pending') }}
                    </span>
                </div>
            </div>

            <!-- Messages -->
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

            @if(session()->has('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Order Summary Cards -->
            <div class="row g-3 mb-4">
                <div class="col-md-3 col-6">
                    <div class="summary-card">
                        <div class="summary-card-icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="summary-card-body">
                            <h6 class="summary-label">Total Items</h6>
                            <h4 class="summary-value">{{ $order->items->sum('quantity') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="summary-card">
                        <div class="summary-card-icon gold">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="summary-card-body">
                            <h6 class="summary-label">Total Amount</h6>
                            <h4 class="summary-value gold">${{ number_format($order->total, 2) }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="summary-card">
                        <div class="summary-card-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <div class="summary-card-body">
                            <h6 class="summary-label">Payment Method</h6>
                            <h4 class="summary-value">{{ ucfirst($order->payment_method ?? 'N/A') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="summary-card">
                        <div class="summary-card-icon">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <div class="summary-card-body">
                            <h6 class="summary-label">Order Date</h6>
                            <h4 class="summary-value">{{ $order->created_at->format('d M Y') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Status Timeline -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-history text-gold me-2"></i>Order Status
                    </h5>
                    <div class="timeline-wrapper">
                        <div class="timeline-steps">
                            @foreach($statusSteps as $index => $step)
                                <div class="timeline-step {{ $step['completed'] ? 'completed' : '' }}">
                                    <div class="timeline-icon {{ $step['completed'] ? 'completed' : '' }}">
                                        <i class="fas {{ $step['icon'] }}"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <h6 class="timeline-label">{{ $step['label'] }}</h6>
                                        @if($step['date'])
                                            <span class="timeline-date">{{ $step['date'] }}</span>
                                        @endif
                                    </div>
                                    @if(!$loop->last)
                                        <div class="timeline-line {{ $step['completed'] ? 'completed' : '' }}"></div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-4">
            <i class="fas fa-list text-gold me-2"></i>Order Items
        </h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th>Product</th>
                        <th class="text-center">Size</th>
                        <th class="text-center">Color</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-end">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    @php
                                        $product = \App\Models\Product::find($item->product_id);
                                    @endphp
                                    @if($product && $product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                             alt="{{ $item->product_name }}"
                                             class="product-thumb">
                                    @else
                                        <div class="product-thumb bg-light d-flex align-items-center justify-content-center">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <h6 class="mb-0 fw-semibold">{{ $item->product_name }}</h6>
                                        @if($product && $product->sku)
                                            <small class="text-muted">SKU: {{ $product->sku }}</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                @if($item->size)
                                    <span class="badge bg-secondary">{{ $item->size }}</span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($item->color)
                                    <span class="badge" style="background:{{ $item->color }}; color:{{ $item->color == '#000000' ? '#fff' : '#000' }};">
                                        {{ $item->color }}
                                    </span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td class="text-center">${{ number_format($item->price, 2) }}</td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-end fw-bold">${{ number_format($item->total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

            <!-- Order Summary & Addresses -->
            <div class="row g-4">
                <!-- Order Summary -->
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">
                                <i class="fas fa-file-invoice text-gold me-2"></i>Order Summary
                            </h5>
                            <div class="summary-row">
                                <span>Subtotal</span>
                                <span>${{ number_format($order->subtotal, 2) }}</span>
                            </div>
                            <div class="summary-row">
                                <span>Tax (10%)</span>
                                <span>${{ number_format($order->tax ?? 0, 2) }}</span>
                            </div>
                            <div class="summary-row">
                                <span>Shipping</span>
                                <span>${{ number_format($order->shipping_cost ?? 0, 2) }}</span>
                            </div>
                            @if($order->discount > 0)
                                <div class="summary-row">
                                    <span>Discount</span>
                                    <span class="text-danger">-${{ number_format($order->discount, 2) }}</span>
                                </div>
                            @endif
                            <div class="summary-total">
                                <span class="fw-bold h5 mb-0">Total</span>
                                <span class="fw-bold h5 mb-0 text-gold">${{ number_format($order->total, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Addresses -->
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="fw-bold mb-3">
                                        <i class="fas fa-home text-gold me-2"></i>Shipping Address
                                    </h5>
                                    <address class="mb-0">
                                        <strong>{{ $order->customer_name }}</strong><br>
                                        {{ $order->shipping_address }}<br>
                                        @if($order->customer_phone)
                                            <i class="fas fa-phone me-1"></i> {{ $order->customer_phone }}
                                        @endif
                                    </address>
                                </div>
                                <div class="col-md-6 mt-3 mt-md-0">
                                    <h5 class="fw-bold mb-3">
                                        <i class="fas fa-file-invoice text-gold me-2"></i>Billing Address
                                    </h5>
                                    <address class="mb-0">
                                        <strong>{{ $order->customer_name }}</strong><br>
                                        {{ $order->billing_address ?? $order->shipping_address }}<br>
                                        @if($order->customer_email)
                                            <i class="fas fa-envelope me-1"></i> {{ $order->customer_email }}
                                        @endif
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-bolt text-gold me-2"></i>Quick Actions
                    </h5>
                    <div class="d-flex flex-wrap gap-3">
                        <button wire:click="reorder" class="btn btn-dark">
                            <i class="fas fa-redo me-2"></i> Reorder
                        </button>

                        <button wire:click="downloadInvoice" class="btn btn-outline-dark">
                            <i class="fas fa-download me-2"></i> Download Invoice
                        </button>

                        @if($canCancel)
                            <button wire:click="cancelOrder"
                                    wire:confirm="Are you sure you want to cancel this order?"
                                    class="btn btn-outline-danger">
                                <i class="fas fa-times me-2"></i> Cancel Order
                            </button>
                        @endif

                        <a href="#" class="btn btn-outline-secondary">
                            <i class="fas fa-headset me-2"></i> Contact Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
    .order-detail-wrapper {
        display: flex;
        min-height: calc(100vh - 36px);
        background: #f5f6fa;
    }

    .order-detail-wrapper .main-sidebar {
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
    .order-detail-wrapper .main-sidebar::-webkit-scrollbar {
        width: 4px;
    }
    .order-detail-wrapper .main-sidebar::-webkit-scrollbar-track {
        background: #0a0a0a;
    }
    .order-detail-wrapper .main-sidebar::-webkit-scrollbar-thumb {
        background: rgba(201,162,39,0.3);
        border-radius: 4px;
    }

    .order-detail-wrapper .user-panel {
        padding: 24px 20px 20px;
        border-bottom: 1px solid rgba(255,255,255,0.04);
        display: flex;
        align-items: center;
        gap: 14px;
        flex-shrink: 0;
    }
    .order-detail-wrapper .user-avatar {
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
    .order-detail-wrapper .avatar-text {
        color: #0a0a0a;
        font-size: 18px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    .order-detail-wrapper .user-name {
        color: #fff;
        font-size: 0.95rem;
        font-weight: 600;
        margin: 0;
        line-height: 1.2;
        font-family: 'Poppins', sans-serif;
    }
    .order-detail-wrapper .user-email {
        color: rgba(255,255,255,0.5);
        font-size: 0.7rem;
        display: block;
        margin-top: 1px;
    }
    .order-detail-wrapper .user-status {
        display: flex;
        align-items: center;
        gap: 6px;
        color: rgba(255,255,255,0.4);
        font-size: 0.6rem;
        margin-top: 2px;
    }
    .order-detail-wrapper .status-dot {
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

    .order-detail-wrapper .sidebar-menu {
        flex: 1;
        padding: 12px 0 20px;
        overflow-y: auto;
    }
    .order-detail-wrapper .nav-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .order-detail-wrapper .nav-item {
        margin: 2px 0;
    }
    .order-detail-wrapper .nav-link {
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
    .order-detail-wrapper .nav-link:hover {
        color: #fff;
        background: rgba(255,255,255,0.04);
        border-left-color: rgba(201,162,39,0.4);
    }
    .order-detail-wrapper .nav-item.active .nav-link {
        color: #fff;
        background: rgba(201,162,39,0.08);
        border-left-color: #C9A227;
    }
    .order-detail-wrapper .nav-item.active .nav-link .nav-icon {
        color: #C9A227;
    }
    .order-detail-wrapper .nav-icon {
        font-size: 1.1rem;
        width: 24px;
        text-align: center;
        flex-shrink: 0;
        color: rgba(255,255,255,0.35);
        transition: color 0.25s ease;
    }
    .order-detail-wrapper .nav-item.active .nav-icon {
        color: #C9A227;
    }
    .order-detail-wrapper .nav-link:hover .nav-icon {
        color: #C9A227;
    }
    .order-detail-wrapper .nav-badge {
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
    .order-detail-wrapper .nav-indicator {
        margin-left: auto;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #C9A227;
        animation: pulse-dot 2s ease-in-out infinite;
    }
    .order-detail-wrapper .nav-divider {
        height: 1px;
        background: rgba(255,255,255,0.04);
        margin: 12px 20px;
    }
    .order-detail-wrapper .logout-link {
        color: rgba(255,255,255,0.4) !important;
        margin-top: 4px;
    }
    .order-detail-wrapper .logout-link:hover {
        color: #dc3545 !important;
    }
    .order-detail-wrapper .logout-link:hover .nav-icon {
        color: #dc3545 !important;
    }

    .order-detail-wrapper .sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5);
        z-index: 1040;
    }
    .order-detail-wrapper .sidebar-overlay.active {
        display: block;
    }

    @media (max-width: 992px) {
        .order-detail-wrapper .main-sidebar {
            position: fixed;
            left: -100%;
            width: 280px;
            height: 100vh;
            transition: left 0.3s ease;
            box-shadow: 0 0 40px rgba(0,0,0,0.3);
            z-index: 1050;
        }
        .order-detail-wrapper .main-sidebar.open {
            left: 0;
        }
    }

    .order-detail-main {
        flex: 1;
        display: flex;
        flex-direction: column;
        min-width: 0;
        background: #f5f6fa;
    }

    .order-detail-header {
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
        display: none;
    }
    .order-detail-header .header-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .order-detail-header .sidebar-toggle {
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
    .order-detail-header .sidebar-toggle:hover {
        background: #f0f0f0;
    }
    .order-detail-header .header-right {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    @media (max-width: 991.98px) {
        .order-detail-header {
            display: flex;
        }
        .order-detail-header .sidebar-toggle {
            display: block;
        }
    }

    .order-detail-content {
        flex: 1;
        padding: 24px;
        overflow-y: auto;
    }

    .page-title {
        font-family: 'Playfair Display', serif;
        font-weight: 600;
        color: #0a0a0a;
        margin-bottom: 0;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 6px 16px;
        border-radius: 30px;
        font-size: 0.8rem;
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

    .summary-card {
        background: #fff;
        border-radius: 12px;
        padding: 16px 18px;
        border: 1px solid rgba(0,0,0,0.04);
        display: flex;
        align-items: center;
        gap: 14px;
        transition: all 0.3s ease;
        height: 100%;
    }
    .summary-card:hover {
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        transform: translateY(-2px);
    }
    .summary-card-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: #6c757d;
        flex-shrink: 0;
    }
    .summary-card-icon.gold {
        background: rgba(201,162,39,0.1);
        color: #C9A227;
    }
    .summary-card-body {
        flex: 1;
    }
    .summary-label {
        font-size: 0.7rem;
        color: #6c757d;
        margin: 0;
        font-weight: 500;
        letter-spacing: 0.03em;
        text-transform: uppercase;
    }
    .summary-value {
        font-size: 1.2rem;
        font-weight: 700;
        margin: 0;
        color: #0a0a0a;
    }
    .summary-value.gold {
        color: #C9A227;
    }

    .timeline-wrapper {
        padding: 10px 0;
    }
    .timeline-steps {
        display: flex;
        justify-content: space-between;
        position: relative;
        gap: 10px;
    }
    .timeline-step {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;
        position: relative;
        text-align: center;
        min-width: 0;
    }
    .timeline-icon {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #e9ecef;
        color: #adb5bd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        border: 3px solid #e9ecef;
        transition: all 0.3s ease;
        z-index: 2;
        position: relative;
        flex-shrink: 0;
    }
    .timeline-icon.completed {
        background: #28a745;
        color: #fff;
        border-color: #28a745;
    }
    .timeline-content {
        margin-top: 8px;
        width: 100%;
    }
    .timeline-label {
        font-size: 0.75rem;
        font-weight: 600;
        margin: 0;
        color: #6c757d;
    }
    .timeline-step.completed .timeline-label {
        color: #0a0a0a;
    }
    .timeline-date {
        font-size: 0.6rem;
        color: #adb5bd;
        display: block;
    }
    .timeline-line {
        position: absolute;
        top: 22px;
        left: calc(50% + 22px);
        right: calc(-50% + 22px);
        height: 3px;
        background: #e9ecef;
        z-index: 1;
    }
    .timeline-line.completed {
        background: #28a745;
    }

    .product-thumb {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        object-fit: cover;
        flex-shrink: 0;
        background: #f8f9fa;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid rgba(0,0,0,0.04);
        font-size: 0.9rem;
        color: #495057;
    }
    .summary-row:last-of-type {
        border-bottom: none;
    }
    .summary-total {
        display: flex;
        justify-content: space-between;
        padding-top: 12px;
        border-top: 2px solid #0a0a0a;
        margin-top: 4px;
    }
    .text-gold {
        color: #C9A227;
    }

    @media (max-width: 768px) {
        .timeline-steps {
            flex-direction: column;
            gap: 16px;
        }
        .timeline-step {
            flex-direction: row;
            align-items: center;
            gap: 14px;
            text-align: left;
        }
        .timeline-line {
            display: none;
        }
        .timeline-content {
            margin-top: 0;
        }
        .timeline-icon {
            width: 38px;
            height: 38px;
            font-size: 0.8rem;
        }
        .summary-card {
            padding: 12px 14px;
        }
        .summary-value {
            font-size: 1rem;
        }
        .d-flex.flex-wrap.gap-3 {
            flex-direction: column;
        }
        .d-flex.flex-wrap.gap-3 .btn {
            width: 100%;
            justify-content: center;
        }
        .order-detail-content {
            padding: 16px;
        }
    }

    @media (max-width: 576px) {
        .order-detail-content {
            padding: 12px;
        }
        .product-thumb {
            width: 48px;
            height: 48px;
        }
        .table-responsive td {
            font-size: 0.85rem;
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
        const sidebar = document.querySelector('.order-detail-wrapper .main-sidebar');
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