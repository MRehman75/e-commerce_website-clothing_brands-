<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - @yield('title', 'Ecommerce')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    @livewireStyles
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f0f2f5;
            font-size: 0.85rem;
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            background: #1a252f;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            color: white;
            width: 260px;
            z-index: 100;
            transition: width 0.3s ease;
            overflow-y: auto;
            overflow-x: hidden;

        }

        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #1a252f;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #4a627a;
            border-radius: 4px;
        }

        .sidebar.mini {
            width: 70px;
        }

        .sidebar.mini .logo h5,
        .sidebar.mini .logo small,
        .sidebar.mini .nav-link span,
        .sidebar.mini .dropdown-icon,
        .sidebar.mini .nested-menu,
        .sidebar.mini hr .text-white-50 {
            display: none;
        }

        .sidebar.mini .nav-link {
            justify-content: center;
            padding: 12px 0;
        }

        .sidebar.mini .nav-link .link-content {
            justify-content: center;
        }

        .sidebar.mini .nav-link i:first-child {
            width: auto;
            font-size: 1.2rem;
        }

        .sidebar.mini .logo {
            padding: 15px 0;
        }

        .sidebar.mini .logo i {
            font-size: 1.5rem;
        }

        .sidebar.mini .nav-item {
            position: relative;
        }

        .sidebar.mini .nav-link:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            left: 70px;
            background: #1a252f;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.75rem;
            white-space: nowrap;
            z-index: 1000;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            width: calc(100% - 260px);
            transition: margin-left 0.3s ease, width 0.3s ease;
            min-height: 100vh;
        }

        .sidebar.mini + .main-content {
            margin-left: 70px;
            width: calc(100% - 70px);
        }

        /* Sidebar Nav Links */
        .sidebar .nav-item {
            width: 100%;
        }

        .sidebar .nav-link {
            color: #cbd5e0;
            padding: 10px 12px;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            transition: all 0.2s;
            border-radius: 0;
            margin: 0;
            text-decoration: none;
        }

        .sidebar .nav-link:hover {
            background: #2d3e4f;
            color: white;
        }

        .sidebar .nav-link.active {
            background: #0d6efd;
            color: white;
        }

        .sidebar .nav-link .link-content {
            display: flex;
            align-items: center;
            gap: 0;
        }

        .sidebar .nav-link i:first-child {
            width: 30px;
            font-size: 0.9rem;
            text-align: left;
        }

        /* Nested Menu */
        .nested-menu {
            padding-left: 30px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            background: #0f1a22;
        }

        .nested-menu.show {
            max-height: 500px;
        }

        .nested-menu .nav-link {
            padding: 8px 12px;
            font-size: 0.8rem;
            color: #a0b3c4;
            justify-content: flex-start;
        }

        .nested-menu .nav-link i {
            width: 28px;
            font-size: 0.75rem;
            text-align: left;
        }

        .nested-menu .nav-link:hover {
            background: #1e2e3a;
            color: white;
        }

        .dropdown-icon {
            transition: transform 0.2s;
            font-size: 0.7rem;
        }

        .dropdown-icon.rotated {
            transform: rotate(90deg);
        }

        /* Top Bar */
        .top-bar {
            background: white;
            padding: 10px 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 99;
        }

        /* Toggle Button */
        .toggle-sidebar-btn {
            background: none;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 5px;
            transition: all 0.2s;
        }

        .toggle-sidebar-btn:hover {
            background: #e9ecef;
        }

        /* Cards */
        .stat-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            transition: all 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .stat-card h3 {
            font-size: 1.4rem;
            margin-bottom: 0;
        }

        .stat-card h6 {
            font-size: 0.7rem;
        }

        .table-compact td,
        .table-compact th {
            padding: 0.6rem;
            font-size: 0.8rem;
            vertical-align: middle;
        }

        .badge {
            padding: 0.25rem 0.6rem;
            font-size: 0.7rem;
        }

        .card-header {
            padding: 0.7rem 1rem;
            background: white;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .logo {
            padding: 15px;
            border-bottom: 1px solid #2d3e4f;
            margin-bottom: 10px;
            text-align: center;
            transition: all 0.3s;
        }

        .logo h5 {
            font-size: 1rem;
            margin: 0;
        }

        hr {
            margin: 8px 0;
        }

        /* Content Sections */
        .content-section {
            display: none;
        }

        .content-section.active {
            display: block;
        }

        /* Slider Preview */
        .slider-item {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .slider-image {
            width: 100px;
            height: 60px;
            background: #dee2e6;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .sidebar {
                left: -260px;
                width: 260px;
            }

            .sidebar.show {
                left: 0;
            }

            .sidebar.mini {
                left: -70px;
            }

            .sidebar.mini.show {
                left: 0;
                width: 260px;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
  
    
    @stack('styles')
</head>
<body>

<div class="sidebar" id="sidebar">
    <div class="logo">
        <i class="fas fa-store fa-lg"></i>
        <h5 class="fw-bold mt-1">AdminPanel</h5>
        <small class="text-white-50">E-commerce Dashboard</small>
    </div>

    <div>
        <!-- Dashboard -->
        <div class="nav-item">
            <a href="{{ route('admin.dashboard') }}" wire:navigate class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" data-tooltip="Dashboard">
                <div class="link-content">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </div>
            </a>
        </div>

        <!-- Orders Dropdown -->
        <div class="nav-item">
            <div class="nav-link" onclick="toggleDropdown(this)" data-tooltip="Orders">
                <div class="link-content">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Orders</span>
                </div>
                <i class="fas fa-chevron-right dropdown-icon"></i>
            </div>
            <div class="nested-menu">
                <a href="{{ route('admin.orders.all') }}" wire:navigate class="nav-link"><i class="fas fa-list"></i><span>All Orders</span></a>
               <a href="{{ route('admin.orders.pending') }}" wire:navigate class="nav-link"><i class="fas fa-clock"></i><span>Pending Orders</span></a>
                <a href="{{ route('admin.orders.processing') }}" wire:navigate class="nav-link"><i class="fas fa-spinner"></i><span>Processing</span></a>
                <a href="{{ route('admin.orders.shipped') }}" wire:navigate class="nav-link"><i class="fas fa-truck"></i><span>Shipped</span></a>
                <a href="{{ route('admin.orders.delivered') }}" wire:navigate class="nav-link"><i class="fas fa-check-circle"></i><span>Delivered</span></a>
            </div>
        </div>

<!-- Customers Dropdown -->
<div class="nav-item">
    <div class="nav-link" onclick="toggleDropdown(this)" data-tooltip="Customers">
        <div class="link-content">
            <i class="fas fa-users"></i>
            <span>Customers</span>
        </div>
        <i class="fas fa-chevron-right dropdown-icon"></i>
    </div>
    <div class="nested-menu">
        <a href="{{ route('admin.customers.all') }}" wire:navigate class="nav-link"><i class="fas fa-users"></i><span>All Customers</span></a>
        <!-- <a href="{{ route('admin.customers.groups') }}" wire:navigate class="nav-link"><i class="fas fa-layer-group"></i><span>Customer Groups</span></a> -->
    </div>
</div>

<!-- Sales Dropdown -->
<div class="nav-item">
    <div class="nav-link" onclick="toggleDropdown(this)" data-tooltip="Sales & Promotions">
        <div class="link-content">
            <i class="fas fa-tag"></i>
            <span>Sales & Promotions</span>
        </div>
        <i class="fas fa-chevron-right dropdown-icon"></i>
    </div>
    <div class="nested-menu">
        <a href="{{ route('admin.sales.coupons-discounts') }}" wire:navigate class="nav-link"><i class="fas fa-ticket-alt"></i><span>Coupons/Discounts</span></a>
        <a href="{{ route('admin.sales.flash-sales') }}" wire:navigate class="nav-link"><i class="fas fa-bolt"></i><span>Flash Sales</span></a>
    </div>
</div>


        <!-- Products Dropdown -->
        <div class="nav-item">
            <div class="nav-link" onclick="toggleDropdown(this)" data-tooltip="Products">
                <div class="link-content">
                    <i class="fas fa-box"></i>
                    <span>Products</span>
                </div>
                <i class="fas fa-chevron-right dropdown-icon"></i>
            </div>
            <div class="nested-menu">
               <a href="{{ route('admin.products.all') }}" wire:navigate class="nav-link"><i class="fas fa-database"></i><span>All Products</span></a>
                <a href="{{ route('admin.products.create') }}" wire:navigate class="nav-link"><i class="fas fa-plus"></i><span>Add New Product</span></a>
                <a href="{{ route('admin.products.categories') }}" wire:navigate class="nav-link"><i class="fas fa-tags"></i><span>Categories</span></a>
                <a href="{{ route('admin.products.brands') }}" wire:navigate class="nav-link"><i class="fas fa-trademark"></i><span>Brands</span></a>
                <a href="{{ route('admin.products.inventory') }}" wire:navigate class="nav-link"><i class="fas fa-boxes"></i><span>Inventory</span></a>
            </div>
        </div>

        <!-- Payments Dropdown -->
<div class="nav-item">
    <div class="nav-link" onclick="toggleDropdown(this)" data-tooltip="Payments">
        <div class="link-content">
            <i class="fas fa-credit-card"></i>
            <span>Payments</span>
        </div>
        <i class="fas fa-chevron-right dropdown-icon"></i>
    </div>
    <div class="nested-menu">
        <a href="{{ route('admin.payments.transactions') }}" wire:navigate class="nav-link"><i class="fas fa-history"></i><span>Transactions</span></a>
        <a href="{{ route('admin.payments.methods') }}" wire:navigate class="nav-link"><i class="fas fa-wallet"></i><span>Payment Methods</span></a>
    </div>
</div>

<!-- Shipping Dropdown -->
<div class="nav-item">
    <div class="nav-link" onclick="toggleDropdown(this)" data-tooltip="Shipping">
        <div class="link-content">
            <i class="fas fa-truck"></i>
            <span>Shipping</span>
        </div>
        <i class="fas fa-chevron-right dropdown-icon"></i>
    </div>
    <div class="nested-menu">
        <a href="{{ route('admin.shipping.zones') }}" wire:navigate class="nav-link"><i class="fas fa-globe"></i><span>Shipping Zones</span></a>
        <a href="{{ route('admin.shipping.methods') }}" wire:navigate class="nav-link"><i class="fas fa-ship"></i><span>Shipping Methods</span></a>
    </div>
</div>

<!-- Reports Dropdown -->
<div class="nav-item">
    <div class="nav-link" onclick="toggleDropdown(this)" data-tooltip="Reports">
        <div class="link-content">
            <i class="fas fa-file-alt"></i>
            <span>Reports</span>
        </div>
        <i class="fas fa-chevron-right dropdown-icon"></i>
    </div>
    <div class="nested-menu">
        <a href="{{ route('admin.reports.sales') }}" wire:navigate class="nav-link"><i class="fas fa-chart-bar"></i><span>Sales Report</span></a>
        <a href="{{ route('admin.reports.products') }}" wire:navigate class="nav-link"><i class="fas fa-box-open"></i><span>Product Report</span></a>
    </div>
</div>

<!-- User Management Dropdown -->
<div class="nav-item">
    <div class="nav-link" onclick="toggleDropdown(this)" data-tooltip="User Management">
        <div class="link-content">
            <i class="fas fa-user-shield"></i>
            <span>User Management</span>
        </div>
        <i class="fas fa-chevron-right dropdown-icon"></i>
    </div>
    <div class="nested-menu">
        <a href="{{ route('admin.users.all') }}" wire:navigate class="nav-link"><i class="fas fa-users"></i><span>All Users</span></a>
        <a href="{{ route('admin.users.add') }}" wire:navigate class="nav-link"><i class="fas fa-user-plus"></i><span>Add New User</span></a>
        <a href="{{ route('admin.users.roles-permissions') }}" wire:navigate class="nav-link"><i class="fas fa-tag"></i><span>Roles & Permissions</span></a>
        <a href="{{ route('admin.users.activity-log') }}" wire:navigate class="nav-link"><i class="fas fa-history"></i><span>User Activity Log</span></a>
    </div>
</div>

        <!-- Website Content Dropdown -->
        <div class="nav-item">
            <div class="nav-link" onclick="toggleDropdown(this)" data-tooltip="Website Content">
                <div class="link-content">
                    <i class="fas fa-globe"></i>
                    <span>Website Content</span>
                </div>
                <i class="fas fa-chevron-right dropdown-icon"></i>
            </div>
            <div class="nested-menu">
                <a href="{{ route('admin.website.home-slider') }}" wire:navigate class="nav-link"><i class="fas fa-images"></i><span>Home Slider</span></a>
                <a href="{{ route('admin.website.pages-content') }}" wire:navigate class="nav-link"><i class="fas fa-file-alt"></i><span>Pages Content</span></a>
                <a href="{{ route('admin.website.banners') }}" wire:navigate class="nav-link"><i class="fas fa-rectangle-ad"></i><span>Banners</span></a>
                <a href="{{ route('admin.website.footer-settings') }}" wire:navigate class="nav-link"><i class="fas fa-copyright"></i><span>Footer Settings</span></a>
                <a href="{{ route('admin.website.menu-manager') }}" wire:navigate class="nav-link"><i class="fas fa-bars"></i><span>Menu Manager</span></a>
                <a href="{{ route('admin.website.blog-posts') }}" wire:navigate class="nav-link"><i class="fas fa-blog"></i><span>Blog/Posts</span></a>
                <a href="{{ route('admin.website.seo-settings') }}" wire:navigate class="nav-link"><i class="fas fa-chart-line"></i><span>SEO Settings</span></a>
            </div>
        </div>

        <!-- Settings Dropdown -->
        <div class="nav-item">
            <div class="nav-link" onclick="toggleDropdown(this)" data-tooltip="Settings">
                <div class="link-content">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </div>
                <i class="fas fa-chevron-right dropdown-icon"></i>
            </div>
            <div class="nested-menu">
                <a href="{{ route('admin.settings.general') }}" wire:navigate class="nav-link"><i class="fas fa-sliders-h"></i><span>General Settings</span></a>
                <a href="{{ route('admin.settings.payment-gateways') }}" wire:navigate class="nav-link"><i class="fas fa-credit-card"></i><span>Payment Gateways</span></a>
            </div>
        </div>

       <!-- Logout -->
<div class="nav-item">
    <hr class="text-white-50 mx-2">
    <a class="nav-link text-danger" href="#" 
       onclick="document.getElementById('logout-form').submit();" 
       data-tooltip="Logout">
        <div class="link-content">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </div>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>

    </div>  {{-- ← inner div closing --}}
</div>  {{-- ← sidebar closing --}}

<!-- Main Content -->
<div class="main-content" id="mainContent">
    <!-- Top Bar -->
    <div class="top-bar d-flex justify-content-between align-items-center">
        <div>
            <button class="toggle-sidebar-btn" id="toggleSidebarBtn">
                <i class="fas fa-bars"></i>
            </button>
            <button class="toggle-sidebar-btn ms-1" id="toggleMiniSidebarBtn" title="Mini Sidebar">
                <i class="fas fa-compress-alt"></i>
            </button>
        </div>
        <div class="d-flex align-items-center gap-3">
            <span class="text-muted small"><i class="fas fa-calendar-alt me-1"></i>{{ now()->format('D, d M Y') }}</span>
            <div class="dropdown">
                <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name ?? 'Admin' }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item small" href="{{ route('admin.settings.general') }}"><i class="fas fa-user me-2"></i>Profile</a></li>
                    <li><a class="dropdown-item small" href="{{ route('admin.settings.payment-gateways') }}"><i class="fas fa-cog me-2"></i>Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item small text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="p-3">
       {{ $slot ?? '' }}    
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Toggle Dropdown
    function toggleDropdown(element) {
        const nestedMenu = element.nextElementSibling;
        const icon = element.querySelector('.dropdown-icon');

        document.querySelectorAll('.nested-menu').forEach(menu => {
            if (menu !== nestedMenu) {
                menu.classList.remove('show');
                const prevIcon = menu.previousElementSibling.querySelector('.dropdown-icon');
                if (prevIcon) prevIcon.classList.remove('rotated');
            }
        });

        nestedMenu.classList.toggle('show');
        icon.classList.toggle('rotated');
    }

    // Sidebar Toggle
    const toggleBtn = document.getElementById('toggleSidebarBtn');
    const toggleMiniBtn = document.getElementById('toggleMiniSidebarBtn');
    const sidebar = document.getElementById('sidebar');

    toggleBtn.addEventListener('click', function () {
        if (window.innerWidth > 768) {
            sidebar.classList.toggle('closed');
        } else {
            sidebar.classList.toggle('show');
        }
    });

    let isMini = false;
    toggleMiniBtn.addEventListener('click', function () {
        if (window.innerWidth > 768) {
            sidebar.classList.toggle('mini');
            isMini = sidebar.classList.contains('mini');

            if (isMini) {
                toggleMiniBtn.innerHTML = '<i class="fas fa-expand-alt"></i>';
            } else {
                toggleMiniBtn.innerHTML = '<i class="fas fa-compress-alt"></i>';
            }
        }
    });

    document.addEventListener('click', function (event) {
        if (window.innerWidth < 768) {
            if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                sidebar.classList.remove('show');
            }
        }
    });

    // Keep dropdown states on page load
    document.addEventListener('DOMContentLoaded', function() {
        const currentUrl = window.location.href;
        document.querySelectorAll('.nested-menu .nav-link').forEach(link => {
            if (link.href === currentUrl) {
                link.classList.add('active');
                let parentMenu = link.closest('.nested-menu');
                if (parentMenu) {
                    parentMenu.classList.add('show');
                    let parentDropdown = parentMenu.previousElementSibling;
                    if (parentDropdown) {
                        let icon = parentDropdown.querySelector('.dropdown-icon');
                        if (icon) icon.classList.add('rotated');
                    }
                }
            }
        });
    });


</script>

@livewireScripts
@stack('scripts')
</body>
</html>