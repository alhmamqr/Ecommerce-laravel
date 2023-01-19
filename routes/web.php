<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ForntEnd\CheckoutController;
use App\Http\Controllers\FrontEnd\CartController;
use App\Http\Controllers\FrontEnd\FrontendController;
use App\Http\Controllers\FrontEnd\OrderController;
use App\Http\Controllers\FrontEnd\WishlistController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SliderController;
use App\Http\Livewire\Admin\Brand\Index;
use App\Models\Category;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use League\CommonMark\Extension\FrontMatter\FrontMatterParser;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

 

Route::controller(FrontendController::class)->group(function(){ 
Route::get('/','index');
Route::get('/categories' , 'showCategories' )->name('front.category');
Route::get('collection/{category_slug}','showProductWithSlug')->name('collection');
Route::get('collection/{category_slug}/{product_slug}','showProductViewSlug')->name('collection.view');
 Route::get('/thankyou','thankyou')->name('thankyou');
 Route::get('/arrivals','arrivals')->name('arrivals');
 Route::get('/search','searchProduct')->name('search');



 });



Route::controller(WishlistController::class)->middleware('auth')->group(function(){ 
Route::get('/wishlist','index')->name('wishlist'); 
    
});

Route::controller(CartController::class)->middleware('auth')->group(function(){ 
Route::get('/carts','index')->name('carts'); 
    
});

Route::controller(CheckoutController::class)->middleware('auth')->group(function(){ 
Route::get('/checkout','index')->name('checkout'); 
    
});
Route::controller(OrderController::class)->middleware('auth')->group(function(){ 
Route::get('/orders','index')->name('orders'); 
Route::get('/order/{orderId}','view')->name('order.view'); 
    
});




Route::controller(FrontendController::class)->group(function(){ 
Route::get('/','index');
Route::get('/categories' , 'showCategories' )->name('front.category');
Route::get('collection/{category_slug}','showProductWithSlug')->name('collection');
Route::get('collection/{category_slug}/{product_slug}','showProductViewSlug')->name('collection.view');

 
 });


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
    Route::controller(AdminDashboardController::class)->group(function(){
        Route::get('dashboard','index')->name('admin.dashboard');

    });
    Route::controller(CategoryController::class)->group(function(){ 
        Route::get('categories', 'index')->name('categories');
        Route::get('categories/create', 'create')->name('categories.create');
        Route::post('categories', 'store')->name('categories.insert');
        Route::get('categories/edit/{category}', 'edit')->name('categories.edit');
        Route::put('categories/edit/{category}', 'update')->name('categories.update');

    });
    
    
    Route::controller(ProductController::class)->group(function(){ 
        Route::get('products', 'index')->name('products');
        Route::get('products/create', 'create')->name('products.create');
        Route::get('products/edit/{id}', 'edit')->name('products.edit');
        Route::put('products/update/{id}', 'update')->name('products.update');
        Route::get('products/delete/{id}', 'delete')->name('products.delete');
        Route::post('products/store', 'store')->name('products.store'); 
        Route::post('/product-color/{p_color_id}', 'updateProductColorQun');       
        Route::get('/product-color-delete/{p_color_id}', 'deleteProductColorQun');    
    });

    Route::controller(ColorController::class)->group(function(){ 
        Route::get('colors', 'index')->name('colors');
        Route::get('colors/create', 'create')->name('colors.create'); 
        Route::get('colors/edit/{id}', 'edit')->name('colors.edit');
        Route::put('colors/update/{id}', 'update')->name('colors.update');
        Route::get('colors/delete/{id}', 'delete')->name('colors.delete');
        Route::post('colors/store', 'store')->name('colors.store');  
    });
    Route::controller(AdminOrderController::class)->group(function(){ 
        Route::get('orders', 'index')->name('orders'); 
        Route::get('orders/{orderId}', 'show')->name('orders.show'); 
        Route::put('orders/{orderId}', 'updateOrderStatus')->name('orders.status'); 
        
        
        
        Route::get('invoice/{orderId}', 'viewInvoice') ; 
        Route::get('invoice/{orderId}/generate', 'generateInvoice') ; 
        Route::get('invoice/{orderId}/sendemail', 'sendEmail') ; 
        
    
    });

    Route::resource('slider',SliderController::class);
    Route::get('slider/delete/{slider}',[SliderController::class,'delete'])->name('slider.delete');


Route::get('/brands',Index::class)->name('brands');

});