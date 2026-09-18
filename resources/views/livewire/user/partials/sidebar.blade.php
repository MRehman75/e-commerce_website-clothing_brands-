<!-- ============================================================
SIDEBAR - AdminLTE Style with Velenza Theme (No Logo)
============================================================ -->
<aside class="main-sidebar">
    <!-- Brand Logo - REMOVED -->

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
            <!-- Dashboard -->
            <li class="nav-item {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
                <a href="{{ route('customer.dashboard') }}" class="nav-link">
                    <i class="fas fa-th-large nav-icon"></i>
                    <span>Dashboard</span>
                    @if(request()->routeIs('customer.dashboard'))
                        <span class="nav-indicator"></span>
                    @endif
                </a>
            </li>

            <!-- Orders -->
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

            <!-- Wishlist -->
            <li class="nav-item {{ request()->routeIs('customer.wishlist*') ? 'active' : '' }}">
                <a href="{{ route('customer.wishlist') }}" class="nav-link">
                    <i class="fas fa-heart nav-icon"></i>
                    <span>Wishlist</span>
                    @php
                        $wishlistCount = \App\Models\Wishlist::where('user_id', auth()->id())->count();
                    @endphp
                    @if($wishlistCount > 0)
                        <span class="nav-badge">{{ $wishlistCount }}</span>
                    @endif
                    @if(request()->routeIs('customer.wishlist*'))
                        <span class="nav-indicator"></span>
                    @endif
                </a>
            </li>

            <!-- Profile -->
            <li class="nav-item {{ request()->routeIs('customer.profile*') ? 'active' : '' }}">
                <a href="{{ route('customer.profile') }}" class="nav-link">
                    <i class="fas fa-user nav-icon"></i>
                    <span>Profile</span>
                    @if(request()->routeIs('customer.profile*'))
                        <span class="nav-indicator"></span>
                    @endif
                </a>
            </li>

            <!-- Divider -->
            <li class="nav-divider"></li>

            <!-- Logout -->
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

<!-- Sidebar Overlay (for mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<style>
    /* ============================================================
    SIDEBAR - No Logo Version
    ============================================================ */
    .main-sidebar {
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
    .main-sidebar::-webkit-scrollbar {
        width: 4px;
    }
    .main-sidebar::-webkit-scrollbar-track {
        background: #0a0a0a;
    }
    .main-sidebar::-webkit-scrollbar-thumb {
        background: rgba(201, 162, 39, 0.3);
        border-radius: 4px;
    }
    .main-sidebar::-webkit-scrollbar-thumb:hover {
        background: rgba(201, 162, 39, 0.5);
    }

    /* User Panel - Now directly at top (no logo) */
    .user-panel {
        padding: 24px 20px 20px;
        border-bottom: 1px solid rgba(255,255,255,0.04);
        display: flex;
        align-items: center;
        gap: 14px;
        flex-shrink: 0;
    }
    .user-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: linear-gradient(135deg, #C9A227, #f9d76a);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 4px 16px rgba(201, 162, 39, 0.25);
    }
    .avatar-text {
        color: #0a0a0a;
        font-size: 18px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    .user-info {
        flex: 1;
        min-width: 0;
    }
    .user-name {
        color: #fff;
        font-size: 0.95rem;
        font-weight: 600;
        margin: 0;
        line-height: 1.2;
        font-family: 'Poppins', sans-serif;
    }
    .user-email {
        color: rgba(255,255,255,0.5);
        font-size: 0.7rem;
        display: block;
        margin-top: 1px;
    }
    .user-status {
        display: flex;
        align-items: center;
        gap: 6px;
        color: rgba(255,255,255,0.4);
        font-size: 0.6rem;
        margin-top: 2px;
    }
    .status-dot {
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

    /* Sidebar Menu */
    .sidebar-menu {
        flex: 1;
        padding: 12px 0 20px;
        overflow-y: auto;
    }
    .nav-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .nav-item {
        margin: 2px 0;
    }
    .nav-link {
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
    .nav-link:hover {
        color: #fff;
        background: rgba(255,255,255,0.04);
        border-left-color: rgba(201, 162, 39, 0.4);
    }
    .nav-item.active .nav-link {
        color: #fff;
        background: rgba(201, 162, 39, 0.08);
        border-left-color: #C9A227;
    }
    .nav-item.active .nav-link .nav-icon {
        color: #C9A227;
    }
    .nav-icon {
        font-size: 1.1rem;
        width: 24px;
        text-align: center;
        flex-shrink: 0;
        color: rgba(255,255,255,0.35);
        transition: color 0.25s ease;
    }
    .nav-item.active .nav-icon {
        color: #C9A227;
    }
    .nav-link:hover .nav-icon {
        color: #C9A227;
    }
    .nav-badge {
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
    .nav-indicator {
        margin-left: auto;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #C9A227;
        animation: pulse-dot 2s ease-in-out infinite;
    }
    .nav-divider {
        height: 1px;
        background: rgba(255,255,255,0.04);
        margin: 12px 20px;
    }
    .logout-link {
        color: rgba(255,255,255,0.4) !important;
        margin-top: 4px;
    }
    .logout-link:hover {
        color: #dc3545 !important;
    }
    .logout-link:hover .nav-icon {
        color: #dc3545 !important;
    }

    /* Sidebar Overlay */
    .sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5);
        z-index: 1040;
    }
    .sidebar-overlay.active {
        display: block;
    }

    /* Sidebar Responsive */
    @media (max-width: 992px) {
        .main-sidebar {
            position: fixed;
            left: -100%;
            width: 280px;
            height: 100vh;
            transition: left 0.3s ease;
            box-shadow: 0 0 40px rgba(0,0,0,0.3);
            z-index: 1050;
        }
        .main-sidebar.open {
            left: 0;
        }
    }

    @media (max-width: 576px) {
        .main-sidebar {
            width: 260px;
        }
        .user-avatar {
            width: 40px;
            height: 40px;
        }
        .avatar-text {
            font-size: 14px;
        }
        .user-name {
            font-size: 0.85rem;
        }
        .user-panel {
            padding: 16px 16px 14px;
        }
        .nav-link {
            padding: 8px 16px;
            font-size: 0.8rem;
        }
    }
</style>