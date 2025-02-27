<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
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
    
// Admin Routes with Middleware
Route::group(['middleware' => ['auth:web', \App\Http\Middleware\PreventBackHistoryMiddleware::class]], function () {
        Route::get('/dashboard', function () {
            return view('backend.dashboard'); 
        })->name('admin.dashboard');
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



// ==== Manage Add SEO Tags in SEO
Route::resource('seo-tags', SEOController::class);

// ==== Manage Stock Management
Route::resource('stock-details', StockDetailsController::class);


// ======================= Frontend

Route::group(['prefix'=> '', 'middleware'=>[\App\Http\Middleware\PreventBackHistoryMiddleware::class]],function(){

    // ==== Home
    Route::get('/', [HomeController::class, 'home'])->name('frontend.index');

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


    //===== Category Page
    Route::get('/category/{slug}', [CategoryDetailsController::class, 'category_details'])->name('product.category');

    //===== Collection Page
    Route::get('/collection/{slug}', [CollectionController::class, 'collection_details'])->name('collection.view');

    //===== Detailed Product Page
    Route::get('/product-detail/{slug}', [ProductController::class, 'show'])->name('product.show');

    //==== Wishlist Functionality
    Route::get('/wishlist/add/{id}', [WishlistController::class, 'add'])->name('wishlist.add');

    //==== Cart Functionality    
    Route::get('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');

    //==== Remove Item Cart Functionality
    Route::post('/delete-cart-item', [CartController::class, 'deleteCartItem'])->name('delete.cart.item');

    //====== Update Cart Count Dynamically
    Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');


});

