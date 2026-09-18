<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\FlashSaleController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\PaymentMethodController;
use App\Http\Controllers\Api\ShippingZoneController;
use App\Http\Controllers\Api\ShippingMethodController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\ActivityLogController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\BlogPostController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\SettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

use Illuminate\Http\Request;
use App\Models\Carts;

Route::get('/cart-count', function () {
    if (auth()->check()) {
        $count = Carts::where('user_id', auth()->id())->sum('quantity');
    } else {
        $count = collect(session('cart', []))->sum('quantity');
    }
    return response()->json(['count' => $count]);
})->name('api.cart-count');

// ─── Auth ────────────────────────────────────────────────────────────
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login',    [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/logout',         [AuthController::class, 'logout']);
        Route::get('/me',              [AuthController::class, 'me']);
        Route::put('/profile',         [AuthController::class, 'updateProfile']);
        Route::put('/change-password', [AuthController::class, 'changePassword']);
    });
});

// ─── Customers ───────────────────────────────────────────────────────
Route::get('customers/stats',       [CustomerController::class, 'stats']);
Route::get('customers/{id}/orders', [CustomerController::class, 'orders']);
Route::apiResource('customers',     CustomerController::class);

// ─── Products ────────────────────────────────────────────────────────
Route::apiResource('products', ProductController::class);

// ─── Orders ──────────────────────────────────────────────────────────
Route::apiResource('orders', OrderController::class);
Route::patch('orders/{order}/status',         [OrderController::class, 'updateStatus']);
Route::patch('orders/{order}/payment-status', [OrderController::class, 'updatePaymentStatus']);

// ─── Coupons ─────────────────────────────────────────────────────────
Route::post('coupons/validate',  [CouponController::class, 'validateCoupon']);
Route::post('coupons/apply',     [CouponController::class, 'apply']);
Route::apiResource('coupons',    CouponController::class);

// ─── Flash Sales ─────────────────────────────────────────────────────
Route::get('flash-sales/active',               [FlashSaleController::class, 'active']);
Route::patch('flash-sales/{flashSale}/toggle', [FlashSaleController::class, 'toggle']);
Route::apiResource('flash-sales',              FlashSaleController::class);

// ─── Transactions ────────────────────────────────────────────────────
Route::get('transactions/stats',                  [TransactionController::class, 'stats']);
Route::patch('transactions/{transaction}/status',  [TransactionController::class, 'updateStatus']);
Route::apiResource('transactions',                 TransactionController::class);

// ─── Payment Methods ─────────────────────────────────────────────────
Route::patch('payment-methods/{paymentMethod}/toggle', [PaymentMethodController::class, 'toggle']);
Route::apiResource('payment-methods',                  PaymentMethodController::class);

// ─── Shipping ────────────────────────────────────────────────────────
Route::get('shipping-zones/calculate',               [ShippingZoneController::class, 'calculate']);
Route::patch('shipping-zones/{shippingZone}/toggle', [ShippingZoneController::class, 'toggle']);
Route::apiResource('shipping-zones',                 ShippingZoneController::class);

Route::patch('shipping-methods/{shippingMethod}/toggle', [ShippingMethodController::class, 'toggle']);
Route::apiResource('shipping-methods',                   ShippingMethodController::class);

// ─── Reports ─────────────────────────────────────────────────────────
Route::prefix('reports')->group(function () {
    Route::get('dashboard',    [ReportController::class, 'dashboard']);
    Route::get('sales',        [ReportController::class, 'sales']);
    Route::get('orders',       [ReportController::class, 'orders']);
    Route::get('customers',    [ReportController::class, 'customers']);
    Route::get('products',     [ReportController::class, 'products']);
    Route::get('transactions', [ReportController::class, 'transactions']);
});

// ─── User Management ─────────────────────────────────────────────────
Route::apiResource('users', UserController::class);
Route::patch('users/{user}/roles',       [UserController::class, 'assignRoles']);

Route::get('permissions',                [RoleController::class, 'allPermissions']);
Route::get('roles/{role}/permissions',   [RoleController::class, 'permissions']);
Route::patch('roles/{role}/permissions', [RoleController::class, 'assignPermissions']);
Route::apiResource('roles',              RoleController::class);

Route::delete('activity-logs/clear',    [ActivityLogController::class, 'clear']);
Route::apiResource('activity-logs',     ActivityLogController::class)->only(['index', 'show', 'destroy']);

// ─── Website Content ─────────────────────────────────────────────────
Route::get('banners/positions',          [BannerController::class, 'positions']);
Route::patch('banners/{banner}/toggle',  [BannerController::class, 'toggle']);
Route::apiResource('banners',            BannerController::class);

Route::patch('blog-posts/{blogPost}/toggle', [BlogPostController::class, 'toggle']);
Route::apiResource('blog-posts',             BlogPostController::class);

Route::patch('pages/{page}/toggle', [PageController::class, 'toggle']);
Route::apiResource('pages',         PageController::class);

Route::patch('sliders/{slider}/toggle', [SliderController::class, 'toggle']);
Route::apiResource('sliders',           SliderController::class);

Route::get('menus/locations',                        [MenuController::class, 'locations']);
Route::post('menus/{menu}/items',                    [MenuController::class, 'addItem']);
Route::delete('menus/{menu}/items/{menuItem}',       [MenuController::class, 'removeItem']);
Route::apiResource('menus',                          MenuController::class);

// ─── Settings ────────────────────────────────────────────────────────
Route::prefix('settings')->group(function () {
    // General
    Route::get('general',           [SettingController::class, 'generalShow']);
    Route::put('general',           [SettingController::class, 'generalUpdate']);

    // SEO
    Route::get('seo',               [SettingController::class, 'seoIndex']);
    Route::get('seo/pages',         [SettingController::class, 'seoPages']);
    Route::get('seo/{page}',        [SettingController::class, 'seoShow']);
    Route::put('seo/{page}',        [SettingController::class, 'seoUpdate']);

    // Footer
    Route::get('footer',            [SettingController::class, 'footerShow']);
    Route::put('footer',            [SettingController::class, 'footerUpdate']);
    Route::get('footer/columns',    [SettingController::class, 'footerColumns']);
    Route::post('footer/columns',   [SettingController::class, 'storeFooterColumn']);
    Route::put('footer/columns/{footerColumn}',    [SettingController::class, 'updateFooterColumn']);
    Route::delete('footer/columns/{footerColumn}', [SettingController::class, 'destroyFooterColumn']);
    Route::post('footer/columns/{footerColumn}/links',         [SettingController::class, 'storeFooterLink']);
    Route::delete('footer/links/{footerLink}',                 [SettingController::class, 'destroyFooterLink']);
    Route::get('settings/social-links', [SettingController::class, 'socialLinks']);
});
