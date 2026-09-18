<div class="dashboard-wrapper">
    <!-- Sidebar -->
    @include('livewire.user.partials.sidebar')

    <!-- Main Content -->
    <div class="dashboard-main">

    <header class="dashboard-header">
    <div class="header-left">
        <button class="sidebar-toggle" id="sidebarToggleBtn" aria-label="Toggle Sidebar">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    <div class="header-right">
        <!-- Empty -->
    </div>
</header>
       
        <!-- ============================================================
        DASHBOARD CONTENT
        ============================================================ -->
        <div class="dashboard-content">
            <!-- Welcome Banner -->
            <div class="welcome-banner mb-4">
                <div class="welcome-banner-content">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="d-flex align-items-center gap-3">
                                <div class="welcome-avatar">
                                    <span class="avatar-text">
                                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
                                    </span>
                                </div>
                                <div>
                                    <h2 class="welcome-title mb-1">
                                        {{ $greeting }}, {{ auth()->user()->name }}! 👋
                                    </h2>
                                    <p class="welcome-subtitle mb-0">
                                        Here's what's happening with your account today.
                                    </p>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        Member since {{ $memberSince }}
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                            <div class="d-flex flex-wrap gap-2 justify-content-lg-end">
                                <a href="{{ route('customer.orders') }}" class="btn btn-gold btn-sm">
                                    <i class="fas fa-shopping-bag me-1"></i> Orders
                                </a>
                                <a href="{{ route('products') }}" class="btn btn-outline-dark btn-sm">
                                    <i class="fas fa-shopping-cart me-1"></i> Shop
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row g-3 mb-4">
                <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                    <div class="stat-card">
                        <div class="stat-card-icon bg-primary-soft">
                            <i class="fas fa-shopping-bag text-primary"></i>
                        </div>
                        <div class="stat-card-body">
                            <h3 class="stat-number">{{ $stats['total_orders'] }}</h3>
                            <p class="stat-label">Total Orders</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                    <div class="stat-card">
                        <div class="stat-card-icon bg-warning-soft">
                            <i class="fas fa-clock text-warning"></i>
                        </div>
                        <div class="stat-card-body">
                            <h3 class="stat-number">{{ $stats['pending_orders'] }}</h3>
                            <p class="stat-label">Pending</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                    <div class="stat-card">
                        <div class="stat-card-icon bg-success-soft">
                            <i class="fas fa-check-circle text-success"></i>
                        </div>
                        <div class="stat-card-body">
                            <h3 class="stat-number">{{ $stats['delivered_orders'] }}</h3>
                            <p class="stat-label">Delivered</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                    <div class="stat-card">
                        <div class="stat-card-icon bg-danger-soft">
                            <i class="fas fa-times-circle text-danger"></i>
                        </div>
                        <div class="stat-card-body">
                            <h3 class="stat-number">{{ $stats['cancelled_orders'] }}</h3>
                            <p class="stat-label">Cancelled</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                    <div class="stat-card stat-card-gold">
                        <div class="stat-card-icon bg-gold-soft">
                            <i class="fas fa-dollar-sign text-gold"></i>
                        </div>
                        <div class="stat-card-body">
                            <h3 class="stat-number text-gold">${{ number_format($stats['total_spent'], 0) }}</h3>
                            <p class="stat-label">Total Spent</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                    <div class="stat-card">
                        <div class="stat-card-icon bg-info-soft">
                            <i class="fas fa-shopping-cart text-info"></i>
                        </div>
                        <div class="stat-card-body">
                            <h3 class="stat-number">{{ $stats['cart_items'] }}</h3>
                            <p class="stat-label">Cart Items</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders & Quick Actions -->
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center pt-3 px-4">
                            <h5 class="fw-bold mb-0">
                                <i class="fas fa-clock-rotate-left text-gold me-2"></i>
                                Recent Orders
                            </h5>
                            <a href="{{ route('customer.orders') }}" class="btn btn-sm btn-outline-dark">
                                View All <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                        <div class="card-body px-4 pb-4">
                            @if($recentOrders->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Order #</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th class="text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recentOrders as $order)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('customer.orders.show', $order->id) }}" 
                                                           class="text-decoration-none fw-semibold text-dark">
                                                            #{{ $order->order_number }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                                    <td>
                                                        <span class="badge bg-{{ $order->status_color }}">
                                                            {{ ucfirst($order->status) }}
                                                        </span>
                                                    </td>
                                                    <td class="fw-bold">${{ number_format($order->total, 2) }}</td>
                                                    <td class="text-end">
                                                        <a href="{{ route('customer.orders.show', $order->id) }}" 
                                                           class="btn btn-sm btn-outline-gold">
                                                            View
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                                    <p class="text-muted mb-0">No orders yet.</p>
                                    <a href="{{ route('products') }}" class="btn btn-gold mt-3">
                                        Start Shopping
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-transparent border-0 pt-3 px-4">
                            <h5 class="fw-bold mb-0">
                                <i class="fas fa-bolt text-gold me-2"></i>
                                Quick Actions
                            </h5>
                        </div>
                        <div class="card-body px-4 pb-4">
                            <div class="d-grid gap-2">
                                <a href="{{ route('customer.orders') }}" class="quick-action-btn">
                                    <i class="fas fa-shopping-bag"></i>
                                    <span>View All Orders</span>
                                    <i class="fas fa-chevron-right ms-auto"></i>
                                </a>
                                <a href="{{ route('products') }}" class="quick-action-btn">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span>Continue Shopping</span>
                                    <i class="fas fa-chevron-right ms-auto"></i>
                                </a>
                                <a href="{{ route('customer.wishlist') }}" class="quick-action-btn">
                                    <i class="fas fa-heart"></i>
                                    <span>View Wishlist</span>
                                    <i class="fas fa-chevron-right ms-auto"></i>
                                </a>
                                <a href="{{ route('customer.profile') }}" class="quick-action-btn">
                                    <i class="fas fa-user"></i>
                                    <span>Edit Profile</span>
                                    <i class="fas fa-chevron-right ms-auto"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Monthly Spending Chart -->
            @if(array_sum($monthlySpending) > 0)
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center pt-3 px-4">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-chart-bar text-gold me-2"></i>
                            Monthly Spending
                        </h5>
                        <span class="badge bg-gold-soft text-gold">
                            {{ date('Y') }}
                        </span>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="chart-container">
                            <div class="d-flex align-items-end justify-content-between gap-1" style="height: 130px;">
                                @foreach($monthlySpending as $month => $amount)
                                    @php
                                        $max = max($monthlySpending) ?: 1;
                                        $percentage = ($amount / $max) * 100;
                                        $hasSpending = $amount > 0;
                                    @endphp
                                    <div class="flex-fill d-flex flex-column align-items-center">
                                        <div class="w-100 rounded-top chart-bar {{ $hasSpending ? 'has-spending' : 'no-spending' }}"
                                             style="height: {{ max($percentage, 4) }}%; max-height: 130px;">
                                            @if($hasSpending)
                                                <span class="chart-tooltip">${{ number_format($amount, 0) }}</span>
                                            @endif
                                        </div>
                                        <span class="chart-label mt-1">{{ $month }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- ============================================================
DASHBOARD STYLES
============================================================ -->
<style>
    /* ============================================================
    DASHBOARD WRAPPER
    ============================================================ */
    .dashboard-wrapper {
        display: flex;
        min-height: calc(100vh - 36px);
        background: #f5f6fa;
    }

    /* ============================================================
    DASHBOARD MAIN
    ============================================================ */
    .dashboard-main {
        flex: 1;
        display: flex;
        flex-direction: column;
        min-width: 0;
        background: #f5f6fa;
    }

   
    /* ============================================================
    DASHBOARD CONTENT
    ============================================================ */
    .dashboard-content {
        flex: 1;
        padding: 24px;
        overflow-y: auto;
    }

    /* ============================================================
    WELCOME BANNER
    ============================================================ */
    .welcome-banner {
        background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
        border-radius: 16px;
        padding: 24px 30px;
        position: relative;
        overflow: hidden;
    }
    .welcome-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(201, 162, 39, 0.08) 0%, transparent 70%);
        border-radius: 50%;
    }
    .welcome-banner-content {
        position: relative;
        z-index: 1;
    }
    .welcome-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #C9A227, #f9d76a);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 4px 20px rgba(201, 162, 39, 0.3);
    }
    .welcome-avatar .avatar-text {
        color: #0a0a0a;
        font-size: 20px;
        font-weight: 700;
        letter-spacing: 1px;
    }
    .welcome-title {
        color: #fff;
        font-family: 'Playfair Display', serif;
        font-weight: 600;
        font-size: 1.6rem;
    }
    .welcome-subtitle {
        color: rgba(255,255,255,0.7);
        font-size: 0.95rem;
    }

    /* ============================================================
    STATS CARDS
    ============================================================ */
    .stat-card {
        background: #fff;
        border-radius: 12px;
        padding: 18px 16px;
        box-shadow: 0 2px 16px rgba(0,0,0,0.04);
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.02);
        height: 100%;
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        border-color: rgba(201, 162, 39, 0.15);
    }
    .stat-card-gold {
        border-color: rgba(201, 162, 39, 0.15);
    }
    .stat-card-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 20px;
    }
    .bg-primary-soft { background: rgba(13, 110, 253, 0.1); }
    .bg-warning-soft { background: rgba(255, 193, 7, 0.1); }
    .bg-success-soft { background: rgba(40, 167, 69, 0.1); }
    .bg-danger-soft { background: rgba(220, 53, 69, 0.1); }
    .bg-gold-soft { background: rgba(201, 162, 39, 0.1); }
    .bg-info-soft { background: rgba(23, 162, 184, 0.1); }

    .stat-card-body {
        flex: 1;
    }
    .stat-number {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
        line-height: 1.2;
        color: #0a0a0a;
    }
    .stat-label {
        font-size: 0.7rem;
        color: #6c757d;
        margin: 0;
        font-weight: 500;
        letter-spacing: 0.03em;
        text-transform: uppercase;
    }
    .text-gold { color: #C9A227; }

    /* ============================================================
    QUICK ACTIONS
    ============================================================ */
    .quick-action-btn {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 16px;
        background: #f8f9fa;
        border-radius: 10px;
        text-decoration: none;
        color: #1a1a1a;
        transition: all 0.25s ease;
        border: 1px solid transparent;
    }
    .quick-action-btn:hover {
        background: #fff;
        border-color: #C9A227;
        color: #0a0a0a;
        transform: translateX(4px);
        box-shadow: 0 4px 16px rgba(201, 162, 39, 0.08);
    }
    .quick-action-btn i:first-child {
        color: #C9A227;
        font-size: 16px;
        width: 20px;
        text-align: center;
    }
    .quick-action-btn i:last-child {
        color: #adb5bd;
        font-size: 12px;
        transition: all 0.25s ease;
    }
    .quick-action-btn:hover i:last-child {
        color: #C9A227;
        transform: translateX(2px);
    }
    .quick-action-btn span {
        flex: 1;
        font-size: 0.85rem;
        font-weight: 500;
    }

    /* ============================================================
    CHART
    ============================================================ */
    .chart-container {
        position: relative;
        padding-top: 10px;
    }
    .chart-bar {
        background: #e9ecef;
        border-radius: 4px 4px 0 0;
        position: relative;
        transition: all 0.6s cubic-bezier(0.22, 1, 0.36, 1);
        cursor: pointer;
        min-width: 16px;
    }
    .chart-bar.has-spending {
        background: linear-gradient(180deg, #C9A227, #f9d76a);
    }
    .chart-bar.no-spending {
        background: #e9ecef;
        opacity: 0.3;
    }
    .chart-bar:hover {
        opacity: 0.85;
        transform: scaleY(1.02);
        transform-origin: bottom;
    }
    .chart-tooltip {
        position: absolute;
        top: -22px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 9px;
        background: #0a0a0a;
        color: #fff;
        padding: 2px 8px;
        border-radius: 4px;
        white-space: nowrap;
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }
    .chart-bar:hover .chart-tooltip {
        opacity: 1;
    }
    .chart-label {
        font-size: 9px;
        color: #adb5bd;
        font-weight: 500;
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
        box-shadow: 0 6px 24px rgba(201, 162, 39, 0.25);
    }
    .btn-outline-gold {
        color: #C9A227;
        border: 1px solid #C9A227;
        background: transparent;
        transition: all 0.3s ease;
    }
    .btn-outline-gold:hover {
        background: #C9A227;
        color: #fff;
    }

    /* ============================================================
    RESPONSIVE
    ============================================================ */
    @media (max-width: 992px) {
        .sidebar-toggle {
            display: block;
        }
        .dashboard-header {
            padding: 10px 16px;
        }
        .dashboard-content {
            padding: 16px;
        }
        .welcome-banner {
            padding: 20px;
        }
    }

    @media (max-width: 768px) {
        .welcome-title {
            font-size: 1.3rem;
        }
        .welcome-avatar {
            width: 48px;
            height: 48px;
        }
        .welcome-avatar .avatar-text {
            font-size: 16px;
        }
        .stat-card {
            padding: 14px 12px;
        }
        .stat-number {
            font-size: 1.2rem;
        }
        .stat-card-icon {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }
        .chart-bar {
            min-width: 12px;
        }
    }

    @media (max-width: 576px) {
        .dashboard-content {
            padding: 12px;
        }
        .welcome-title {
            font-size: 1.1rem;
        }
        .stat-number {
            font-size: 1rem;
        }
        .stat-label {
            font-size: 0.6rem;
        }
        .stat-card-icon {
            width: 34px;
            height: 34px;
            font-size: 14px;
        }
        .welcome-avatar {
            width: 40px;
            height: 40px;
        }
        .welcome-avatar .avatar-text {
            font-size: 14px;
        }
        .header-avatar {
            width: 30px;
            height: 30px;
            font-size: 10px;
        }
        .quick-action-btn {
            padding: 8px 12px;
            font-size: 0.8rem;
        }
        .quick-action-btn i:first-child {
            font-size: 14px;
        }
        .chart-bar {
            min-width: 10px;
        }
        .header-title {
            font-size: 1rem;
        }
    }
    /* Mobile Sidebar - Hidden by default */
@media (max-width: 992px) {
    .sidebar-toggle {
        display: block !important;
    }
    .main-sidebar {
        position: fixed !important;
        left: -100% !important;
        width: 280px !important;
        height: 100vh !important;
        transition: left 0.3s ease !important;
        box-shadow: 0 0 40px rgba(0,0,0,0.3) !important;
        z-index: 1050 !important;
    }
    .main-sidebar.open {
        left: 0 !important;
    }
    .sidebar-overlay {
        display: none !important;
        position: fixed !important;
        inset: 0 !important;
        background: rgba(0,0,0,0.5) !important;
        z-index: 1040 !important;
    }
    .sidebar-overlay.active {
        display: block !important;
    }
}

/* Hide sidebar toggle on desktop */
@media (min-width: 993px) {
    .sidebar-toggle {
        display: none !important;
    }
}
</style>

<!-- Sidebar Toggle Script -->
<!-- Sidebar Toggle Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarToggle = document.getElementById('sidebarToggleBtn');
        const sidebar = document.querySelector('.main-sidebar');
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

        // Close sidebar on window resize to desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth > 992) {
                if (sidebar) sidebar.classList.remove('open');
                if (overlay) overlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    });

    // Handle Livewire navigation
    document.addEventListener('livewire:init', function() {
        Livewire.on('sidebarClose', function() {
            const sidebar = document.querySelector('.main-sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            if (sidebar) sidebar.classList.remove('open');
            if (overlay) overlay.classList.remove('active');
            document.body.style.overflow = '';
        });
    });
</script>