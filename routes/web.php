<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ChekoutController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SslCommerzPaymentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rules\Password;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/team', [FrontendController::class, 'team'])->name('team');
Route::get('/shop', [FrontendController::class, 'about'])->name('about');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::get('product/details/{slug}', [FrontendController::class, 'productdetails'])->name('productdetails');
Route::post('get/sizes', [FrontendController::class, 'getsizes'])->name('get.sizes');
Route::post('get/inventory', [FrontendController::class, 'getinventory'])->name('get.inventory');

Auth::routes(['login' => false]);
Route::get('admin/login', [LoginController::class, 'showloginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('adminlogin');

Route::get('login', [CustomerController::class, 'customerlogin'])->name('customerlogin');
Route::post('Customer/register', [CustomerController::class, 'customerregister'])->name('customer.register');
Route::get('customer/dashboard', [CustomerController::class, 'customerdashboard'])->name('customer.dashboard');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
Route::post('/change/name', [HomeController::class, 'changename'])->name('change.name');
Route::post('/change/password', [HomeController::class, 'changepassword'])->name('change.password');

Route::get('/add/team/member', [HomeController::class, 'addmember'])->name('piyes');
Route::post('/team/member/insert', [HomeController::class, 'addmemberinsert']);
Route::get('/team/member/delete/{team_member_id}', [HomeController::class, 'addmemberdelete']);
Route::get('/team/member/edite/{team_member_id}', [HomeController::class, 'addmemberedite']);

Route::post('/team/member/update/{team_member_id}', [HomeController::class, 'addmemberupdate']);

Route::get('/variation', [HomeController::class, 'variation'])->name('variation');
Route::post('/add/color', [HomeController::class, 'addcolor'])->name('add.color');
Route::post('/add/size', [HomeController::class, 'addsize'])->name('add.size');

Route::resource('Category', CategoryController::class);
Route::get('/restore/category/{id}', [CategoryController::class, 'restore'])->name('categoryrestore');
Route::get('/force/delete/category/{id}', [CategoryController::class, 'forcedelete'])->name('category.forcedelete');

Route::resource('subcategory', SubCategoryController::class);

Route::resource('slider', SliderController::class);
Route::get('/restore/{id}', [SliderController::class, 'restore'])->name('slider.restore');
Route::get('/force/delete/{id}', [SliderController::class, 'forcedelete'])->name('slider.forcedelete');

Route::resource('feature', FeatureController::class);

Route::resource('product', ProductController::class);
Route::get('/add/feature/{id}', [ProductController::class, 'addfeature'])->name('product.addfeature');
Route::post('/add/feature/{id}', [ProductController::class, 'addfeaturepost'])->name('product.addfeature.post');
Route::get('/add/feature/delete/', [ProductController::class, 'addfeaturedelete'])->name('product.featuredelete');
Route::post('/get/subcategory', [ProductController::class, 'getsubcategory'])->name('get.subcategory');
Route::get('/add/inventory/{id}', [ProductController::class, 'addinventory'])->name('add.inventory');
Route::post('/add/inventory/post/{id}', [ProductController::class, 'addinventorypost'])->name('add.inventory.post');

Route::get('/product/restore/{id}', [ProductController::class, 'productrestore'])->name('product.restore');
Route::get('/product/forcedelete/{id}', [ProductController::class, 'productforcedelete'])->name('product.forcedelete');

Route::post('/insert/cart', [CartController::class, 'insertcart'])->name('insert.cart');
Route::get('cart', [CartController::class, 'cart'])->name('cart');
Route::POST('cart/remove/', [CartController::class, 'cartremove'])->name('cart.remove');
Route::POST('cart/inc', [CartController::class, 'cartinc'])->name('cart.inc');
Route::POST('cart/dec', [CartController::class, 'cartdec'])->name('cart.dec');

Route::get('/shipping', [CartController::class, 'shipping'])->name('shipping');
Route::post('/add/shipping', [CartController::class, 'addshipping'])->name('add.shipping');

Route::get('/shipping/destroy', [CartController::class, 'shippingdestroy'])->name('shipping.destroy');

Route::post('/get/city/list', [CartController::class, 'getcitylist'])->name('get.city.list');


Route::get('/coupon', [CouponController::class, 'coupon'])->name('coupon');
Route::post('/add/coupon', [CouponController::class, 'addcoupon'])->name('add.coupon');
Route::post('/chek/coupon', [CouponController::class, 'chekcoupon'])->name('chek.coupon');

Route::get('/chek/out', [ChekoutController::class, 'chekout'])->name('chekout');
Route::post('/set/country/city', [ChekoutController::class, 'setcountrycity'])->name('set.country.city');
Route::post('/chekout/post', [ChekoutController::class, 'chekoutpost'])->name('chekout.post');

Route::get('/view/invoice/{order_summery}', [ChekoutController::class, 'viewinvoice'])->name('view.invoice');
Route::get('/download/invoice/{order_summery}', [ChekoutController::class, 'downloadinvoice'])->name('download.invoice');

Route::get('/orders', [OrdersController::class, 'orders'])->name('orders');
Route::post('/change/order/status/{order_summery}', [OrdersController::class, 'changeorderstatus'])->name('change.order.status');
Route::get('/later/pay/{grand_total}/{order_summery_id}', [OrdersController::class, 'laterpay']);

Route::get('/review/{order_summery}', [ReviewController::class, 'review']);
Route::post('/add/review/{order_details_id}', [ReviewController::class, 'addreview'])->name('add.review');


// SSLCOMMERZ Start

Route::get('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);

//SSLCOMMERZ END

