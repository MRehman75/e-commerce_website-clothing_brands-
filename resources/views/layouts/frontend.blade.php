<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Ecommerce Store')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    @livewireStyles

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: #f0f2f5; font-size: 0.88rem; }

        .frontend-navbar {
            background: #1a252f;
            padding: 12px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }
        .frontend-navbar .brand {
            color: white; font-size: 1.3rem; font-weight: 700; text-decoration: none;
        }
        .frontend-navbar .brand i { color: #0d6efd; }
        .frontend-navbar .nav-link {
            color: #cbd5e0 !important; font-size: 0.85rem;
            padding: 6px 12px !important; transition: color 0.2s;
        }
        .frontend-navbar .nav-link:hover { color: white !important; }
        .frontend-navbar .nav-link.active { color: #0d6efd !important; }

        /* ── Dynamic Menu ── */
        .frontend-navbar .dropdown-menu {
            background: #243342;
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            min-width: 180px;
        }
        .frontend-navbar .dropdown-item {
            color: #cbd5e0;
            font-size: 0.82rem;
            padding: 8px 16px;
        }
        .frontend-navbar .dropdown-item:hover {
            background: #2d3e4f;
            color: white;
        }

        .cart-btn {
            position: relative; color: white; background: #0d6efd;
            border: none; padding: 8px 16px; border-radius: 8px;
            font-size: 0.85rem; text-decoration: none; transition: background 0.2s;
        }
        .cart-btn:hover { background: #0b5ed7; color: white; }
        .cart-badge {
            position: absolute; top: -6px; right: -6px;
            background: #dc3545; color: white; border-radius: 50%;
            width: 18px; height: 18px; font-size: 0.65rem;
            display: flex; align-items: center; justify-content: center; font-weight: bold;
        }
        .search-bar input {
            border: none; border-radius: 8px 0 0 8px;
            font-size: 0.85rem; padding: 8px 14px;
        }
        .search-bar button {
            border-radius: 0 8px 8px 0; background: #0d6efd;
            border: none; color: white; padding: 8px 14px;
        }
        .announcement-bar {
            background: #0d6efd; color: white;
            text-align: center; padding: 6px; font-size: 0.78rem;
        }
        .product-card {
            transition: transform 0.2s, box-shadow 0.2s;
            border-radius: 12px !important; overflow: hidden;
        }
        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.12) !important;
        }
        .product-card img { transition: transform 0.3s; }
        .product-card:hover img { transform: scale(1.05); }
        .frontend-footer {
            background: #1a252f; color: #cbd5e0;
            padding: 40px 0 20px; margin-top: 60px;
        }
        .frontend-footer h6 { color: white; font-weight: 600; margin-bottom: 15px; }
        .frontend-footer a {
            color: #a0b3c4; text-decoration: none; font-size: 0.82rem;
            display: block; margin-bottom: 6px; transition: color 0.2s;
        }
        .frontend-footer a:hover { color: white; }
        .frontend-footer .footer-bottom {
            border-top: 1px solid #2d3e4f; padding-top: 15px;
            margin-top: 30px; font-size: 0.78rem; color: #6b8096;
        }
        .toast-container {
            position: fixed; bottom: 20px; right: 20px; z-index: 9999;
        }
    </style>

    @stack('styles')
</head>
<body>

{{-- Announcement Bar --}}
<div class="announcement-bar">
    <i class="fas fa-truck me-2"></i>
    PKR 2000 se upar orders pe <strong>Free Shipping!</strong> &nbsp;|&nbsp;
    <i class="fas fa-phone me-2"></i>Support: 0300-1234567
</div>

{{-- Navbar --}}
@php
    $headerMenu = \App\Models\Menu::where('location', 'header')
        ->with(['items' => function($q) {
            $q->where('is_active', true)
              ->whereNull('parent_id')
              ->orderBy('sort_order')
              ->with(['children' => function($q) {
                  $q->where('is_active', true)->orderBy('sort_order');
              }]);
        }])
        ->first();
@endphp

<nav class="frontend-navbar">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between gap-3">

            {{-- Brand --}}
            <a href="{{ route('products') }}" class="brand">
                <i class="fas fa-store me-2"></i>MyShop
            </a>

            {{-- Search --}}
            <div class="search-bar d-none d-md-flex flex-grow-1" style="max-width:400px;">
                <input type="text" placeholder="Product dhundho..." class="form-control">
                <button type="button"><i class="fas fa-search"></i></button>
            </div>

            {{-- Nav Links --}}
            <div class="d-none d-md-flex align-items-center gap-1">

                {{-- Dynamic Menu Items --}}
                @if($headerMenu && $headerMenu->items->count() > 0)
                    @foreach($headerMenu->items as $item)
                        @if($item->children->count() > 0)
                        {{-- Dropdown --}}
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="{{ $item->url ?? '#' }}"
                               data-bs-toggle="dropdown">
                                @if($item->icon)
                                <i class="{{ $item->icon }} me-1"></i>
                                @endif
                                {{ $item->label }}
                            </a>
                            <ul class="dropdown-menu">
                                @foreach($item->children as $child)
                                <li>
                                    <a class="dropdown-item" href="{{ $child->url ?? '#' }}"
                                       {{ $child->open_in_new_tab ? 'target=_blank' : '' }}>
                                        @if($child->icon)
                                        <i class="{{ $child->icon }} me-1"></i>
                                        @endif
                                        {{ $child->label }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @else
                        {{-- Simple Link --}}
                        <a href="{{ $item->url ?? '#' }}"
                           class="nav-link {{ request()->url() === url($item->url) ? 'active' : '' }}"
                           {{ $item->open_in_new_tab ? 'target=_blank' : '' }}>
                            @if($item->icon)
                            <i class="{{ $item->icon }} me-1"></i>
                            @endif
                            {{ $item->label }}
                        </a>
                        @endif
                    @endforeach
                @else
                {{-- Default Link --}}
                <a href="{{ route('products') }}"
                   class="nav-link {{ request()->routeIs('products') ? 'active' : '' }}">
                    <i class="fas fa-shopping-bag me-1"></i>Products
                </a>
                @endif

                @auth
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-light dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fas fa-user me-1"></i>{{ auth()->user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item small" href="{{ route('dashboard.index') }}">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item small text-danger" href="#"
                               onclick="document.getElementById('frontend-logout').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </div>
                <form id="frontend-logout" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                @else
                <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light">
                    <i class="fas fa-sign-in-alt me-1"></i>Login
                </a>
                @endauth

                {{-- Cart --}}
                @php $cartCount = array_sum(array_column(session()->get('cart', []), 'quantity')); @endphp
                <a href="{{ route('cart') }}" class="cart-btn ms-1">
                    <i class="fas fa-shopping-cart"></i> Cart
                    <span class="cart-badge {{ $cartCount == 0 ? 'd-none' : '' }}" id="cart-count">
                        {{ $cartCount }}
                    </span>
                </a>
            </div>

            {{-- Mobile Cart --}}
            <a href="{{ route('cart') }}" class="cart-btn d-md-none">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-badge" id="cart-count-mobile">{{ $cartCount ?? 0 }}</span>
            </a>
        </div>

        {{-- Mobile Search --}}
        <div class="search-bar d-flex d-md-none mt-2">
            <input type="text" placeholder="Product dhundho..." class="form-control">
            <button type="button"><i class="fas fa-search"></i></button>
        </div>
    </div>
</nav>

{{-- Main Content --}}
<main>
    {{ $slot ?? '' }}
    @yield('content')
</main>

{{-- Footer --}}
@php
    $footer = \App\Models\FooterSetting::instance();
    $footerColumns = \App\Models\FooterColumn::where('is_active', true)
        ->orderBy('sort_order')
        ->with(['links' => function($q) {
            $q->where('is_active', true)->orderBy('sort_order');
        }])
        ->get();
@endphp

<footer class="frontend-footer">
    <div class="container">

        {{-- Newsletter Section --}}
        @if($footer->show_newsletter)
        <div class="row mb-4 pb-4" style="border-bottom:1px solid #2d3e4f;">
            <div class="col-md-6">
                <h6 class="mb-1">{{ $footer->newsletter_title ?: 'Subscribe to our Newsletter' }}</h6>
                <p class="small mb-0" style="color:#a0b3c4;">{{ $footer->newsletter_subtitle ?: 'Get the latest deals and offers.' }}</p>
            </div>
            <div class="col-md-6">
                <form class="d-flex gap-2">
                    <input type="email" class="form-control" placeholder="Aap ka email address..." required>
                    <button type="submit" class="btn btn-primary px-4">Subscribe</button>
                </form>
            </div>
        </div>
        @endif

        <div class="row g-4">
            {{-- Company Info Column --}}
            <div class="col-md-4">
                <h6>
                    @if($footer->logo)
                        <img src="{{ asset('storage/' . $footer->logo) }}" alt="{{ $footer->company_name }}" style="height:28px;object-fit:contain" class="me-2">
                    @else
                        <i class="fas fa-store me-2"></i>
                    @endif
                    {{ $footer->company_name }}
                </h6>
                @if($footer->about_text)
                <div class="small" style="color:#a0b3c4;">
                    {!! $footer->about_text !!}
                </div>
                @endif

                {{-- Social Links --}}
                <div class="d-flex gap-3 mt-3">
                    @if($footer->facebook)
                        <a href="{{ $footer->facebook }}" target="_blank"><i class="fab fa-facebook fa-lg"></i></a>
                    @endif
                    @if($footer->instagram)
                        <a href="{{ $footer->instagram }}" target="_blank"><i class="fab fa-instagram fa-lg"></i></a>
                    @endif
                    @if($footer->twitter)
                        <a href="{{ $footer->twitter }}" target="_blank"><i class="fab fa-twitter fa-lg"></i></a>
                    @endif
                    @if($footer->youtube)
                        <a href="{{ $footer->youtube }}" target="_blank"><i class="fab fa-youtube fa-lg"></i></a>
                    @endif
                    @if($footer->tiktok)
                        <a href="{{ $footer->tiktok }}" target="_blank"><i class="fab fa-tiktok fa-lg"></i></a>
                    @endif
                    @if($footer->whatsapp)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $footer->whatsapp) }}" target="_blank"><i class="fab fa-whatsapp fa-lg"></i></a>
                    @endif
                </div>
            </div>

            {{-- Dynamic Columns (from admin "Columns & Links") --}}
            @foreach($footerColumns as $col)
            <div class="col-md-2">
                <h6>{{ $col->title }}</h6>
                @foreach($col->links as $link)
                    <a href="{{ $link->url }}" {{ $link->open_in_new_tab ? 'target=_blank' : '' }}>
                        {{ $link->label }}
                    </a>
                @endforeach
            </div>
            @endforeach

            {{-- Contact Column --}}
            @if($footer->email || $footer->phone || $footer->address)
            <div class="col-md-3">
                <h6>Contact</h6>
                @if($footer->phone)
                <p class="small mb-1"><i class="fas fa-phone me-2"></i>{{ $footer->phone }}</p>
                @endif
                @if($footer->email)
                <p class="small mb-1"><i class="fas fa-envelope me-2"></i>{{ $footer->email }}</p>
                @endif
                @if($footer->address)
                <p class="small"><i class="fas fa-map-marker-alt me-2"></i>{{ $footer->address }}</p>
                @endif
            </div>
            @endif
        </div>

        {{-- App Links + Payment Methods --}}
        @if($footer->playstore_link || $footer->appstore_link || !empty($footer->payment_methods))
        <div class="row align-items-center pt-4 mt-2" style="border-top:1px solid #2d3e4f;">
            {{-- App Store Links --}}
            @if($footer->playstore_link || $footer->appstore_link)
            <div class="col-md-6 mb-3 mb-md-0">
                <h6 class="mb-2" style="font-size:0.85rem;">Hamari App Download Karein</h6>
                <div class="d-flex gap-2">
                    @if($footer->playstore_link)
                    <a href="{{ $footer->playstore_link }}" target="_blank" class="btn btn-sm btn-outline-light">
                        <i class="fab fa-google-play me-1"></i> Google Play
                    </a>
                    @endif
                    @if($footer->appstore_link)
                    <a href="{{ $footer->appstore_link }}" target="_blank" class="btn btn-sm btn-outline-light">
                        <i class="fab fa-apple me-1"></i> App Store
                    </a>
                    @endif
                </div>
            </div>
            @endif

            {{-- Payment Method Icons --}}
            @if(!empty($footer->payment_methods))
            <div class="col-md-6 text-md-end">
                <h6 class="mb-2" style="font-size:0.85rem;">We Accept</h6>
                <div class="d-flex gap-3 justify-content-md-end">
                    @foreach($footer->payment_methods as $method)
                        @if($method === 'visa')
                            <i class="fab fa-cc-visa fa-2x" style="color:#1a1f71;"></i>
                        @elseif($method === 'mastercard')
                            <i class="fab fa-cc-mastercard fa-2x" style="color:#eb001b;"></i>
                        @elseif($method === 'easypaisa')
                            <i class="fas fa-mobile-alt fa-2x text-success" title="EasyPaisa"></i>
                        @elseif($method === 'jazzcash')
                            <i class="fas fa-wallet fa-2x text-warning" title="JazzCash"></i>
                        @elseif($method === 'cod')
                            <i class="fas fa-money-bill fa-2x text-success" title="Cash on Delivery"></i>
                        @elseif($method === 'bank')
                            <i class="fas fa-university fa-2x text-info" title="Bank Transfer"></i>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        @endif

        {{-- Bottom Bar --}}
        @if($footer->show_bottom_bar)
        <div class="footer-bottom text-center">
            {{ $footer->copyright_text }}
        </div>
        @endif
    </div>
</footer>

{{-- Toast --}}
<div class="toast-container">
    <div id="liveToast" class="toast align-items-center text-white border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body" id="toastMsg">Message here</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('cartUpdated', (event) => {
            const count = event.count;
            const badge  = document.getElementById('cart-count');
            const badge2 = document.getElementById('cart-count-mobile');
            if (badge) { badge.textContent = count; badge.classList.toggle('d-none', count === 0); }
            if (badge2) badge2.textContent = count;
        });
        Livewire.on('notify', (event) => {
            const toast    = document.getElementById('liveToast');
            const toastMsg = document.getElementById('toastMsg');
            toastMsg.textContent = event.message;
            toast.classList.remove('bg-success', 'bg-danger', 'bg-warning', 'bg-info');
            const colorMap = { success: 'bg-success', error: 'bg-danger', warning: 'bg-warning', info: 'bg-info' };
            toast.classList.add(colorMap[event.type] || 'bg-primary');
            new bootstrap.Toast(toast, { delay: 3000 }).show();
        });
    });
</script>

@livewireScripts
@stack('scripts')
</body>
</html>