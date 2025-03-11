<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

use App\Models\ProductDetails;
use Illuminate\Http\Request;

use App\Http\Controllers\Backend\UserDetailsController;
use App\Http\Controllers\Backend\UserPermissionsController;
use App\Http\Controllers\Backend\CollectionsController;
use App\Http\Controllers\Backend\ProductCategoryController;
use App\Http\Controllers\Backend\ProductFabricsController;
use App\Http\Controllers\Backend\FabricCompositionController;
use App\Http\Controllers\Backend\ProductSizesController;
use App\Http\Controllers\Backend\ProductPrintsController;
use App\Http\Controllers\Backend\ProductDetailsController;
use App\Http\Controllers\Backend\SEOController;
use App\Http\Controllers\Backend\StockDetailsController;
use App\Http\Controllers\Backend\OrderTrackingController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ReportsController;
use App\Http\Controllers\Backend\Home\BannerDetailsController;
use App\Http\Controllers\Backend\Home\NewArrivalsController;
use App\Http\Controllers\Backend\Home\CollectionDetailsController;
use App\Http\Controllers\Backend\Home\ShopByCategoryController;
use App\Http\Controllers\Backend\Home\ProductPoliciesController;
use App\Http\Controllers\Backend\Home\TestimonialsController;
use App\Http\Controllers\Backend\Home\SocialMediaController;
use App\Http\Controllers\Backend\Home\FooterController;
use App\Http\Controllers\Backend\Category\DressesController;
use App\Http\Controllers\Backend\Category\TopsController;
use App\Http\Controllers\Backend\Category\BottomsController;
use App\Http\Controllers\Backend\Category\CoordsController;
use App\Http\Controllers\Backend\Category\JacketsController;
use App\Http\Controllers\Backend\Policy\TermsController;
use App\Http\Controllers\Backend\Policy\ShippingController;
use App\Http\Controllers\Backend\Policy\ReturnController;
use App\Http\Controllers\Backend\Policy\PrivacyController;


use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CategoryDetailsController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CollectionController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\RegistrationController;
use App\Http\Controllers\Frontend\ForgotPasswordController;
use App\Http\Controllers\Frontend\PoliciesController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\AccountController;

// =========================================================================== Backend Routes

// Route::get('/', function () {
//     return view('frontend.index');
// });
  
// Authentication Routes
Route::get('/login', [LoginController::class, 'login'])->name('admin.login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('admin.authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::get('/change-password', [LoginController::class, 'change_password'])->name('admin.changepassword');
Route::post('/update-password', [LoginController::class, 'updatePassword'])->name('admin.updatepassword');

Route::get('/register', [LoginController::class, 'register'])->name('admin.register');
Route::post('/register', [LoginController::class, 'authenticate_register'])->name('admin.register.authenticate');
    
// // Admin Routes with Middleware
// Route::group(['middleware' => ['auth:web', \App\Http\Middleware\PreventBackHistoryMiddleware::class]], function () {
//         Route::get('/dashboard', function () {
//             return view('backend.dashboard'); 
//         })->name('admin.dashboard');
// });


Route::group(['middleware' => ['auth:web', \App\Http\Middleware\PreventBackHistoryMiddleware::class]], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
});

// ==== Manage User List in User Management
Route::resource('user-list', UserDetailsController::class);
Route::post('/update-status', [UserDetailsController::class, 'updateStatus'])->name('update.status');

// ==== Manage User Permissions in User Management
Route::resource('user-permissions', UserPermissionsController::class);

// ==== Manage Collections in Store Management
Route::resource('collections', CollectionsController::class);

// ==== Manage category in Store Management
Route::resource('product-category', ProductCategoryController::class);

// ==== Manage fabrics in Store Management
Route::resource('product-fabrics', ProductFabricsController::class);

// ==== Manage composition in Store Management
Route::resource('fabric-composition', FabricCompositionController::class);

// ==== Manage Sizes in Store Management
Route::resource('product-sizes', ProductSizesController::class);

// ==== Manage prints in Store Management
Route::resource('product-prints', ProductPrintsController::class);

// ==== Manage product details in Store Management
Route::resource('product-details', ProductDetailsController::class);



// ==== Manage Banner Details in Home
Route::resource('banner-details', BannerDetailsController::class);

// ==== Manage New Arrival in Home
Route::resource('new-arrivals', NewArrivalsController::class);

// ==== Manage Collection Details in Home
Route::resource('collection-details', CollectionDetailsController::class);

// ==== Manage Shop By Category in Home
Route::resource('shop-category', ShopByCategoryController::class);

// ==== Manage Product Policies in Home
Route::resource('product-policies', ProductPoliciesController::class);

// ==== Manage Testimonials in Home
Route::resource('testimonials', TestimonialsController::class);

// ==== Manage Social Media Details in Home
Route::resource('social-media', SocialMediaController::class);

// ==== Manage Footer in Home
Route::resource('footer', FooterController::class);



// ==== Manage Dresses in Category Page
Route::resource('dresses', DressesController::class);

// ==== Manage  Tops in Category Page
Route::resource('tops', TopsController::class);

// ==== Manage  Bottoms in Category Page
Route::resource('bottoms', BottomsController::class);

// ==== Manage  Co-ords in Category Page
Route::resource('co-ords', CoordsController::class);

// ==== Manage Blazers/Jackets in Category Page
Route::resource('jackets', JacketsController::class);

// ==== Manage Terms of Use
Route::resource('terms', TermsController::class);

// ==== Manage Shipping
Route::resource('shipping', ShippingController::class);

// ==== Manage Return
Route::resource('return', ReturnController::class);

// ==== Manage Privacy Policy
Route::resource('privacy', PrivacyController::class);

// ==== Manage Add SEO Tags in SEO
Route::resource('seo-tags', SEOController::class);

// ==== Manage Stock Management
Route::resource('stock-details', StockDetailsController::class);

// ==== Manage Order Tracking
Route::get('/order-tracking/user/{id}', [OrderTrackingController::class, 'userOrders'])->name('order-tracking.user');
Route::post('/order/update', [OrderTrackingController::class, 'update'])->name('order.update');
Route::get('/users', [OrderTrackingController::class, 'user_list'])->name('users.list');
Route::get('/user/view/{id}', [OrderTrackingController::class, 'view'])->name('user.view');
Route::get('/order-tracking-details/{order_id}', [OrderTrackingController::class, 'orderDetails'])->name('orders-tracking.details');

// ==== Manage Report Generation
Route::get('/reports', [ReportsController::class, 'reports'])->name('reports.list');
Route::get('/reports/{reportType}', [ReportsController::class, 'getReportData'])->name('getReportData');

// ======================= Frontend

Route::group(['prefix'=> '', 'middleware'=>[\App\Http\Middleware\PreventBackHistoryMiddleware::class]],function(){

    // ==== Home
    Route::get('/home', [HomeController::class, 'home'])->name('frontend.index');
    
    //===== Thankyou Page
    Route::get('/thank-you', [HomeController::class, 'thankyou'])->name('thank.you');

    //===== customize request form
    Route::post('/contact-submission', [ProductController::class, 'send_contact'])->name('contact.send');

    //===== Checkout Page
    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout.details');

    //===== Registration Page
    Route::get('/registration', [RegistrationController::class, 'register'])->name('user.registration');
    Route::post('/registration', [RegistrationController::class, 'authenticate_register'])->name('registration.store');

    //===== Login Page
    Route::get('/user-login', [RegistrationController::class, 'login'])->name('user.login');
    Route::post('/user-login', [RegistrationController::class, 'authenticate_login'])->name('login.store');

    //===== Logout Page
    Route::get('/user-logout', [RegistrationController::class, 'logout'])->name('user.logout');

    //===== Checkout Page Login Functionality
    Route::post('/checkout-register', [RegistrationController::class, 'authenticate_checkout_register'])->name('login.authenticate');

   //======Forgot Password: Show form & handle email submission
    Route::get('/forgot-password', [ForgotPasswordController::class, 'forgot_password'])->name('user.forgotpassword');
    Route::post('/update-forgot-password', [ForgotPasswordController::class, 'update_password'])->name('user.updatepassword');

    //====== Reset Password: Show form & handle password reset
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'reset_password'])->name('user.resetpassword');
    Route::post('/update-reset-password', [ForgotPasswordController::class, 'update_reset_password'])->name('user.updatepassword.reset');

    //===== Terms & Condition
    Route::get('/terms-and-conditions', [PoliciesController::class, 'terms'])->name('terms.condition');

    //===== Shipping & Delivery
    Route::get('/shipping-and-delivery', [PoliciesController::class, 'shipping'])->name('shipping.delivery');

    //===== Return & Exchange
    Route::get('/return-and-refunds', [PoliciesController::class, 'return'])->name('return.refunds');

    //===== Privacy Policy
    Route::get('/privacy-policy', [PoliciesController::class, 'privacy'])->name('privacy.policy');

    //========== Payment Integration URL
    Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::post('/verify-payment', [PaymentController::class, 'verifyPayment'])->name('payment.verify');

    //===== My account
    Route::get('/my-account', [AccountController::class, 'account'])->name('my.account');
    Route::post('/my-account/update', [AccountController::class, 'updateAccount'])->name('user.account.update');

    //===== My account orders
    Route::get('/my-account-orders', [AccountController::class, 'account_orders'])->name('my.account.orders');

    //===== My account orders details
    Route::get('/my-account-order-details/{order_id}', [AccountController::class, 'account_orders_details'])->name('my.account.order.details');

    //===== Wishlist Page
    Route::get('/wish-list', [ProductController::class, 'wish_list'])->name('wish.list');

    //===== Category Page
    Route::get('/category/{slug}', [CategoryDetailsController::class, 'category_details'])->name('product.category');

    //===== Collection Page
    Route::get('/collection/{slug}', [CollectionController::class, 'collection_details'])->name('collection.view');

    //===== Detailed Product Page
    Route::get('/product-detail/{slug}', [ProductController::class, 'show'])->name('product.show');

    //==== Wishlist Functionality
    Route::post('/wishlist/add/{id}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::post('/wishlist/delete', [WishlistController::class, 'delete'])->name('wishlist.delete');

    //==== Cart Functionality    
    Route::get('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');

    //==== Remove Item Cart Functionality
    Route::post('/delete-cart-item', [CartController::class, 'deleteCartItem'])->name('delete.cart.item');

    //====== Update Cart Count Dynamically
    Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');

    //====== For Search Functionality
    Route::get('/search', function (Request $request) {
        $query = $request->query('q');
    
        $results = ProductDetails::where('product_name', 'LIKE', "%{$query}%")
                        ->orWhere('description', 'LIKE', "%{$query}%")
                        ->limit(10)
                        ->get(['id', 'product_name','slug']);
    
        return response()->json($results);
    });

    //===== For Category Page Filter
    Route::get('/products/filter', [CategoryDetailsController::class, 'filterProducts'])->name('products.filter');

    //===== For Collection Page Filter
    Route::get('/collection-changes/filters', [CollectionController::class, 'filter_collection_Products'])->name('changes.filter');



});

