<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\DashboardController;


// ─── Frontend Routes ──────────────────────────────────────────────────────────
Route::get('/products', \App\Livewire\Frontend\ProductList::class)->name('products');
Route::get('/cart',     \App\Livewire\Frontend\CartPage::class)->name('cart');
Route::get('/checkout', \App\Livewire\Frontend\Checkout::class)->name('checkout');
 
// Order Success Page
Route::get('/order/success/{orderNumber}', function ($orderNumber) {
    $order = \App\Models\Order::where('order_number', $orderNumber)->firstOrFail();
    return view('frontend.order-success', compact('order'));
})->name('order.success');

 // Dashboard
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

   
   // Dashboard
Route::get('/', \App\Livewire\Dashboard::class)->name('dashboard');
Route::get('/dashboard', \App\Livewire\Dashboard::class)->name('dashboard');

    // Orders
  Route::prefix('orders')->name('orders.')->group(function () {
    Route::get('/all',        \App\Livewire\Orders\AllOrders::class)->name('all');
    Route::get('/pending',    \App\Livewire\Orders\PendingOrders::class)->name('pending');
    Route::get('/processing', \App\Livewire\Orders\Processing::class)->name('processing');
    Route::get('/shipped',    \App\Livewire\Orders\Shipped::class)->name('shipped');
    Route::get('/delivered',  \App\Livewire\Orders\Delivered::class)->name('delivered');
    Route::get('/{id}',       \App\Livewire\Orders\OrderDetail::class)->name('detail'); // ✅
});


// Products
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/all',        \App\Livewire\Products\AllProducts::class)->name('all');
    Route::get('/create',     \App\Livewire\Products\ProductForm::class)->name('create');
    Route::get('/{productId}/edit',  \App\Livewire\Products\ProductForm::class)->name('edit');
    Route::get('/categories', \App\Livewire\Products\Categories::class)->name('categories');
    Route::get('/brands',     \App\Livewire\Products\Brands::class)->name('brands');
    Route::get('/inventory',  \App\Livewire\Products\Inventory::class)->name('inventory');
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

// Logout
Route::post('/logout', function (Request $request) {
    Auth::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');
//login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('admin.dashboard');
    }

    return back()->withErrors([
        'email' => 'Invalid credentials',
    ]);
});

// Register  ← yahan add karo
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
    ]);

    $user = \App\Models\User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    Auth::login($user);

    return redirect()->route('admin.dashboard');
});




// Customer Auth Routes
Route::get('/customer/login',    \App\Livewire\Frontend\CustomerLogin::class)->name('customer.login');
Route::get('/customer/register', \App\Livewire\Frontend\CustomerRegister::class)->name('customer.register');

Route::post('/customer/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect()->route('products');
})->name('customer.logout');



