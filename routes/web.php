<?php


use App\Livewire\Page as PageComponent;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\DashboardController;
use App\Livewire\Welcome;
use App\Livewire\About;
use App\Livewire\Cart;
use App\Livewire\Products;
use App\Livewire\VisionMission;
use App\Livewire\FAQ;
use App\Livewire\SingalProduct;
use App\Livewire\Checkout;
use App\Livewire\Collections;
use App\Livewire\Category;
use App\Livewire\Contact;
use App\Livewire\Men;
use App\Livewire\Women;
use App\Livewire\Sale;
use App\Livewire\NewArrivals;
use App\Livewire\Privacy;
use App\Livewire\Thankyou;
use App\Livewire\Termsandcondition;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\RegisteredAdminController;

// ============================================================
// PUBLIC ROUTES
// ============================================================

Route::get('/', Welcome::class)->name('home');

Route::get('/about', function () {
    return view('livewire.about');
})->name('about');

Route::get('/contact', function () {
    return view('livewire.contact');
})->name('contact');

Route::get('/terms', function () {
    return view('livewire.termsandcondition');
})->name('terms');

Route::get('/privacy', function () {
    return view('livewire.privacy');
})->name('privacy');


Route::get('/vision-mission', VisionMission::class);
Route::get('/f-a-q', FAQ::class);

Route::get('/cart', Cart::class)->name('cart');

// Products Routes
Route::get('/products', Products::class)->name('products');
Route::get('/category/{categorySlug}', Products::class)->name('category.show');
Route::get('/product/{slug}', SingalProduct::class)->name('product.show');

// Cart Count API
Route::get('/cart-count', function () {
    if (auth()->check()) {
        $count = \App\Models\Carts::where('user_id', auth()->id())->sum('quantity');
    } else {
        $count = collect(session('cart', []))->sum('quantity');
    }
    return response()->json(['count' => $count]);
})->name('api.cart-count');

// Checkout & Thank You
Route::get('/cart/checkout', Checkout::class)->name('checkout');
Route::get('/thankyou/{orderId}', Thankyou::class)->name('thankyou');

// Static Pages
Route::get('/collections', function () {
    return view('collections');
})->name('collections');


Route::get('/men', function () {
    return view('men');
})->name('men');

Route::get('/women', Women::class)->name('women');
Route::get('/sale', function () {
    return view('sale');
})->name('sale');

Route::get('/new-arrivals', NewArrivals::class)->name('new-arrivals');



Route::get('/category', Category::class)->name('category');

// ============================================================
// ADMIN ROUTES
// ============================================================

Route::prefix('admin')->name('admin.')->group(function () {

    // Admin Login (Guest)
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
        Route::get('/register', [RegisteredAdminController::class, 'create'])->name('register');
        Route::post('/register', [RegisteredAdminController::class, 'store'])->name('register.store');
    });

    // Admin Protected Area
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', \App\Livewire\Dashboard::class)->name('dashboard');
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

        // Slider
        Route::get('/slider', [SliderController::class, 'index'])->name('slider.index');
        Route::post('/slider', [SliderController::class, 'store'])->name('slider.store');
        Route::put('/slider/{slider}', [SliderController::class, 'update'])->name('slider.update');
        Route::delete('/slider/{slider}', [SliderController::class, 'destroy'])->name('slider.destroy');
        Route::patch('/slider/{slider}/toggle', [SliderController::class, 'toggleStatus'])->name('slider.toggle');

        // Dashboard
        Route::get('/dashboard', \App\Livewire\Dashboard::class)->name('dashboard');

        // Orders
        Route::prefix('orders')->name('orders.')->group(function () {
            Route::get('/all', \App\Livewire\Orders\AllOrders::class)->name('all');
            Route::get('/pending', \App\Livewire\Orders\PendingOrders::class)->name('pending');
            Route::get('/processing', \App\Livewire\Orders\Processing::class)->name('processing');
            Route::get('/shipped', \App\Livewire\Orders\Shipped::class)->name('shipped');
            Route::get('/delivered', \App\Livewire\Orders\Delivered::class)->name('delivered');
            Route::get('/{id}', \App\Livewire\Orders\OrderDetail::class)->name('detail');
        });

        // Products Management
        Route::prefix('products')->name('products.')->group(function () {
            Route::get('/all', \App\Livewire\Products\AllProducts::class)->name('all');
            Route::get('/create', \App\Livewire\Products\ProductForm::class)->name('create');
            Route::get('/{productId}/edit', \App\Livewire\Products\ProductForm::class)->name('edit');
            Route::get('/categories', \App\Livewire\Products\Categories::class)->name('categories');
            Route::get('/brands', \App\Livewire\Products\Brands::class)->name('brands');
            Route::get('/inventory', \App\Livewire\Products\Inventory::class)->name('inventory');
        });

        // Website Content
        Route::prefix('website')->name('website.')->group(function () {
            Route::get('/home-slider', \App\Livewire\WebsiteContent\HomeSlider::class)->name('home-slider');
            Route::get('/pages-content', \App\Livewire\WebsiteContent\PagesContent::class)->name('pages-content');
            Route::get('/banners', \App\Livewire\WebsiteContent\Banners::class)->name('banners');
            Route::get('/footer-settings', \App\Livewire\WebsiteContent\FooterSettings::class)->name('footer-settings');
            Route::get('/menu-manager', \App\Livewire\WebsiteContent\MenuManager::class)->name('menu-manager');
            Route::get('/blog-posts', \App\Livewire\WebsiteContent\BlogPosts::class)->name('blog-posts');
            Route::get('/seo-settings', \App\Livewire\WebsiteContent\SeoSettings::class)->name('seo-settings');
        });

        // Customers
        Route::prefix('customers')->name('customers.')->group(function () {
            Route::get('/all', \App\Livewire\Customers\AllCustomers::class)->name('all');
            Route::get('/groups', \App\Livewire\Customers\CustomerGroups::class)->name('groups');
        });

        // Sales
        Route::prefix('sales')->name('sales.')->group(function () {
            Route::get('/coupons-discounts', \App\Livewire\Sales\CouponsDiscounts::class)->name('coupons-discounts');
            Route::get('/flash-sales', \App\Livewire\Sales\FlashSales::class)->name('flash-sales');
        });

        // Payments
        Route::prefix('payments')->name('payments.')->group(function () {
            Route::get('/transactions', \App\Livewire\Payments\Transactions::class)->name('transactions');
            Route::get('/methods', \App\Livewire\Payments\PaymentMethods::class)->name('methods');
        });

        // Shipping
        Route::prefix('shipping')->name('shipping.')->group(function () {
            Route::get('/zones', \App\Livewire\Shipping\ShippingZones::class)->name('zones');
            Route::get('/methods', \App\Livewire\Shipping\ShippingMethods::class)->name('methods');
        });

        // Reports
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/sales', \App\Livewire\Reports\SalesReport::class)->name('sales');
            Route::get('/products', \App\Livewire\Reports\ProductReport::class)->name('products');
        });

        // Settings
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/general', \App\Livewire\Settings\GeneralSettings::class)->name('general');
            Route::get('/payment-gateways', \App\Livewire\Settings\PaymentGateways::class)->name('payment-gateways');
        });

        // User Management
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/all', \App\Livewire\UserManagement\AllUsers::class)->name('all');
            Route::get('/add', \App\Livewire\UserManagement\AddNewUser::class)->name('add');
            Route::get('/roles-permissions', \App\Livewire\UserManagement\RolesPermissions::class)->name('roles-permissions');
            Route::get('/activity-log', \App\Livewire\UserManagement\UserActivityLog::class)->name('activity-log');
        });
    });
});

// ============================================================
// CUSTOMER AUTH ROUTES
// ============================================================

Route::post('/logout', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('customer.login');
})->name('logout');

Route::get('/login', \App\Livewire\Frontend\CustomerLogin::class)->name('login');
Route::get('/register', \App\Livewire\Frontend\CustomerRegister::class)->name('register');

Route::get('/customer/login', \App\Livewire\Frontend\CustomerLogin::class)->name('customer.login');
Route::get('/customer/register', \App\Livewire\Frontend\CustomerRegister::class)->name('customer.register');

Route::post('/customer/logout', function () {
    Auth::guard('web')->logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect()->route('home');
})->name('customer.logout');

// ============================================================
// CUSTOMER DASHBOARD ROUTES
// ============================================================

Route::middleware('auth')
    ->prefix('customer')
    ->name('customer.')
    ->group(function () {
        Route::get('/dashboard', \App\Livewire\User\Dashboard::class)->name('dashboard');
        Route::get('/orders', \App\Livewire\User\Orders::class)->name('orders');
        Route::get('/orders/{order}', \App\Livewire\User\OrderDetail::class)->name('orders.show');
        Route::get('/cart', \App\Livewire\User\Cart::class)->name('cart');
        Route::get('/profile', \App\Livewire\User\Profile::class)->name('profile');
        Route::get('/addresses', \App\Livewire\User\Addresses::class)->name('addresses');
        Route::get('/security', \App\Livewire\User\Security::class)->name('security');
        Route::get('/wishlist', \App\Livewire\User\Wishlist::class)->name('wishlist');
        Route::get('/notifications', \App\Livewire\User\Notifications::class)->name('notifications');
        Route::get('/payment-methods', \App\Livewire\User\PaymentMethods::class)->name('payment-methods');
        Route::get('/login-history', \App\Livewire\User\LoginHistory::class)->name('login-history');
        Route::get('/orders/{order}/tracking', \App\Livewire\User\OrderTracking::class)->name('orders.tracking');
        Route::get('/reviews', \App\Livewire\User\Reviews::class)->name('reviews');
        Route::get('/analytics', \App\Livewire\User\Analytics::class)->name('analytics');
    });

// ============================================================
// CATCH-ALL ROUTE (Must be at the end)
// ============================================================

Route::get('/{slug}', function ($slug) {
    $page = \App\Models\Page::where('slug', $slug)
        ->where('is_active', true)
        ->firstOrFail();
    return view('frontend.page', compact('page'));
});

// ============================================================
// SITEMAP ROUTES
// ============================================================
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.index');
Route::get('/sitemap-products.xml', [SitemapController::class, 'products'])->name('sitemap.products');
Route::get('/sitemap-categories.xml', [SitemapController::class, 'categories'])->name('sitemap.categories');
Route::get('/sitemap-pages.xml', [SitemapController::class, 'pages'])->name('sitemap.pages');
Route::get('/sitemap-all.xml', [SitemapController::class, 'all'])->name('sitemap.all');
Route::get('/sitemap-clear-cache', [SitemapController::class, 'clearCache'])->name('sitemap.clear-cache');
