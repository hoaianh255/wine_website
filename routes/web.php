<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\checkoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\admin\MngUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\admin\MngBannerController;
use App\Http\Controllers\admin\MngBlogController;
use App\Http\Controllers\admin\MngCateLogBlogController;
use App\Http\Controllers\admin\MngCateLogProDuctController;
use App\Http\Controllers\admin\MngCommentController;
use App\Http\Controllers\admin\MngCouponController;
use App\Http\Controllers\admin\MngLanguageController;
use App\Http\Controllers\admin\MngOrderController;
use App\Http\Controllers\admin\MngOrderDetailController;
use App\Http\Controllers\admin\MngProductController;
use App\Http\Controllers\admin\MngTagsController;
use App\Http\Controllers\ProfileController;

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
Route::redirect('/','langugage/vn');
  Route::get('language/{language}', function ($language){
    session()->put('language',$language);
  return redirect()->back();
  })->name('setLanguage');
  Route::get('/', [HomePageController::class,'index'])->name('home');
//  shop
  Route::middleware('passDataForShopPage')->group(function () {
    Route::get('/shop',[ShopController::class,'index'])->name('shop');
    Route::get('shop/tag/{tag:slug}',[ShopController::class,'searchWithTag'])->name('shop.search.tag');
    Route::get('/shop/product/{product:slug}',[ShopController::class,'show'])->name('shop.show')->middleware('checkLocaleProduct');
    Route::get('/shop/category/{slug:slug}',[ShopController::class,'getProByCat'])->name('getProByCat');
    Route::get('/shop/nation/{slug:slug}',[ShopController::class,'getProByNat'])->name('getProByNat');
    Route::get('/shop/searchByName',[ShopController::class,'searchByName'])->name('shop.searchByName');
    Route::get('/shop/search',[ShopController::class,'filterProducts'])->name('shop.filters');
  });
//  cart
  Route::get('/cart',[CartController::class,'index'])->name('cart.index');
  Route::post('/cart',[CartController::class,'store'])->name('cart.store');
  Route::delete('cart/{product}',[CartController::class,'destroy'])->name('cart.destroy');
//  CHECKOUTS
  Route::middleware('CheckoutHasProducts')->group(function(){
  Route::get('/checkout',[checkoutController::class,'index'])->name('checkout.index');
  Route::post('/checkout/create',[checkoutController::class,'create'])->name('checkout.create');
  Route::get('/checkout/return',[checkoutController::class,'return'])->name('checkout.return');
  });
//blog
  Route::middleware('passDataForBLogPage')->group(function (){
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{blog:slug}', [BlogController::class, 'show'])->name('blog.show');

    Route::post('blog/search', [BlogController::class, 'search'])->name('blog.search');
    Route::get('blog/tag/{tag:slug}',[BlogController::class,'searchWithTag'])->name('blog.search.tag');
    Route::get('blog/category/{slug:slug}',[BlogController::class,'getBlogByCat'])->name('blog.search.categories');
  });
//coupon
  Route::post('/coupon',[CouponController::class,'store'])->name('coupon.store');
  Route::delete('/coupon/destroy',[CouponController::class,'destroy'])->name('coupon.destroy');

//Logout
  Route::get('/Logout', [LoginController::class,'Logout'])->name('Logout');


//Profile
//Route::get('/profile/{name:name}', [ProfileController::class,'show'])->name('profile.show')->middleware('CheckLogin');
Route::middleware('auth')->group(function(){
  Route::get('/profile', [ProfileController::class,'edit'])->name('profile.edit');
  Route::post('/profile/{id}', [ProfileController::class,'update'])->name('profile.update');
});


Route::middleware('CheckAdminLogin')->group(function(){

  Route::get('/admin/dashboard', [DashboardController::class,'index'])->name('dashboard.index');

  //ADMIN - CATELOG_PRODUCTS
  Route::get('/dashboard/categories', [MngCateLogProDuctController::class,'index'])->name('MngCateLog.index');
//ADMIN - CATELOG_PRODUCTS
  Route::get('/dashboard/categories_products', [MngCateLogProDuctController::class,'index'])->name('MngCateLogProDuct.index');
  Route::get('/dashboard/categories_products/search', [MngCateLogProDuctController::class,'search'])->name('MngCateLogProDuct.search');
  Route::get('/dashboard/categories_products/order={order}', [MngCateLogProDuctController::class,'orderPro'])->name('MngCateLogProDuct.order');
//ADMIN - CATELOG_PRODUCTS - CREATES
  Route::get('/dashboard/categories_products/create', [MngCateLogProDuctController::class,'create'])->name('MngCateLogProDuct.create');
  Route::post('/dashboard/categories_products/store', [MngCateLogProDuctController::class,'store'])->name('MngCateLogProDuct.store');
//ADMIN - CATELOG_PRODUCTS - EIDTS
  Route::get('/dashboard/categories_products/edit/{id}', [MngCateLogProDuctController::class,'edit'])->name('MngCateLogProDuct.edit');
  Route::patch('/dashboard/categories_products/update/{id}', [MngCateLogProDuctController::class,'update'])->name('MngCateLogProDuct.update');
//ADMIN - CATELOG_PRODUCTS - DELETE
  Route::delete('/dashboard/categories_products/delete/{id}',[MngCateLogProDuctController::class,'destroy'])->name('MngCateLogProDuct.destroy');
  Route::delete('/dashboard/categories_products/DeleteAll', [MngCateLogProDuctController::class,'deleteAll'])->name('MngCateLogProDuct.deleteAll');
//ADMIN - CATELOG_BLOGS
  Route::get('/dashboard/categories_blogs', [MngCateLogBlogController::class,'index'])->name('MngCateLogBlog.index');
  Route::get('/dashboard/categories_blogs/search', [MngCateLogBlogController::class,'search'])->name('MngCateLogBlog.search');
  Route::get('/dashboard/categories_blogs/order={order}', [MngCateLogBlogController::class,'orderPro'])->name('MngCateLogBlog.order');
//ADMIN - CATELOG_BLOGS - CREATES
  Route::get('/dashboard/categories_blogs/create', [MngCateLogBlogController::class,'create'])->name('MngCateLogBlog.create');
  Route::post('/dashboard/categories_blogs/store', [MngCateLogBlogController::class,'store'])->name('MngCateLogBlog.store');
//ADMIN - CATELOG_BLOGS - EIDTS
  Route::get('/dashboard/categories_blogs/edit/{id}', [MngCateLogBlogController::class,'edit'])->name('MngCateLogBlog.edit');
  Route::patch('/dashboard/categories_blogs/update/{id}', [MngCateLogBlogController::class,'update'])->name('MngCateLogBlog.update');
//ADMIN - CATELOG_BLOGS - DELETE
  Route::delete('/dashboard/categories_blogs/delete/{id}',[MngCateLogBlogController::class,'destroy'])->name('MngCateLogBlog.destroy');
  Route::delete('/dashboard/categories_blogs/DeleteAll', [MngCateLogBlogController::class,'deleteAll'])->name('MngCateLogBlog.deleteAll');

// //ADMIN - TAGS
//   Route::get('/dashboard/tags', [MngTagsController::class,'index'])->name('MngTags.index');
//   Route::get('/dashboard/tags/search', [MngTagsController::class,'search'])->name('MngTags.search');
//   Route::get('/dashboard/tags/order={order}', [MngTagsController::class,'orderPro'])->name('MngTags.order');
// //ADMIN - TAGS - CREATES
//   Route::get('/dashboard/tags/create', [MngTagsController::class,'create'])->name('MngTags.create');
//   Route::post('/dashboard/tags/store', [MngTagsController::class,'store'])->name('MngTags.store');
// //ADMIN - TAGS - EIDTS
//   Route::get('/dashboard/tags/edit/{id}', [MngTagsController::class,'edit'])->name('MngTags.edit');
//   Route::patch('/dashboard/tags/update/{id}', [MngTagsController::class,'update'])->name('MngTags.update');
// //ADMIN - TAGS - DELETE
//   Route::delete('/dashboard/tags/delete/{id}',[MngTagsController::class,'destroy'])->name('MngTags.destroy');
//   Route::delete('/dashboard/tags/DeleteAll', [MngTagsController::class,'deleteAll'])->name('MngTags.deleteAll');


//ADMIN - PRODUCTS
  Route::get('/dashboard/product', [MngProductController::class,'index'])->name('MngProduct.index');
  Route::get('/dashboard/product/search', [MngProductController::class,'search'])->name('MngProduct.search');
  Route::get('/dashboard/product/order={order}', [MngProductController::class,'orderPro'])->name('MngProduct.order');
//ADMIN - PRODUCTS - CREATES
  Route::get('/dashboard/product/create', [MngProductController::class,'create'])->name('MngProduct.create');
  Route::post('/dashboard/product/store', [MngProductController::class,'store'])->name('MngProduct.store');
//ADMIN - PRODUCTS - EIDTS
  Route::get('/dashboard/product/edit/{id}', [MngProductController::class,'edit'])->name('MngProduct.edit');
  Route::patch('/dashboard/product/update/{id}', [MngProductController::class,'update'])->name('MngProduct.update');
//ADMIN - PRODUCTS - DELETE
  Route::delete('/dashboard/product/delete/{id}',[MngProductController::class,'destroy'])->name('MngProduct.destroy');
  Route::delete('/dashboard/product/DeleteAll', [MngProductController::class,'deleteAll'])->name('MngProduct.deleteAll');


//ADMIN - BLOGS
  Route::get('/dashboard/blog', [MngBlogController::class,'index'])->name('MngBlog.index');
  Route::get('/dashboard/blog/search', [MngBlogController::class,'search'])->name('MngBlog.search');
  Route::get('/dashboard/blog/order={order}', [MngBlogController::class,'orderPro'])->name('MngBlog.order');
//ADMIN - BLOGS - CREATES
  Route::get('/dashboard/blog/create', [MngBlogController::class,'create'])->name('MngBlog.create');
  Route::post('/dashboard/blog/store', [MngBlogController::class,'store'])->name('MngBlog.store');
//ADMIN - BLOGS - EIDTS
  Route::get('/dashboard/blog/edit/{id}', [MngBlogController::class,'edit'])->name('MngBlog.edit');
  Route::patch('/dashboard/blog/update/{id}', [MngBlogController::class,'update'])->name('MngBlog.update');
//ADMIN - BLOGS - DELETE
  Route::delete('/dashboard/blog/delete/{id}',[MngBlogController::class,'destroy'])->name('MngBlog.destroy');
  Route::delete('/dashboard/blog/DeleteAll', [MngBlogController::class,'deleteAll'])->name('MngBlog.deleteAll');

  
//ADMIN - COUPONS
  Route::get('/dashboard/coupon', [MngCouponController::class,'index'])->name('MngCoupon.index');
//ADMIN - COUPONS - EDIT
  Route::get('/dashboard/coupon/{id}/edit', [MngCouponController::class,'edit'])->name('MngCoupon.edit');
//ADMIN - COUPONS - CREATE
  Route::get('/dashboard/coupon/create', [MngCouponController::class,'create'])->name('MngCoupon.create');
  //ADMIN - COUPONS - STORE
  Route::post('/dashboard/coupon/store', [MngCouponController::class,'store'])->name('MngCoupon.store');
//ADMIN - COUPONS - UPDATE
  Route::patch('/dashboard/coupon/{id}/update', [MngCouponController::class,'update'])->name('MngCoupon.update');
//ADMIN - COUPONS - DELETE
  Route::delete('/dashboard/coupon/{id}/destroy', [MngCouponController::class,'destroy'])->name('MngCoupon.destroy');
//ADMIN - COUPONS -DELETEALL
  Route::delete('/dashboard/coupon/deleteAll', [MngCouponController::class,'deleteAll'])->name('MngCoupon.deleteAll');



//ADMIN - COMMENTS
  Route::get('/dashboard/comment', [MngCommentController::class,'index'])->name('MngComment.index');
// ADMIN - APPROVE -COMMENT
  Route::patch('/dashboard/comment/{id}/approved', [MngCommentController::class,'approvedComment'])->name('MngComment.approved');
//  ADMIN - DELETE - COMMENT
  Route::delete('/dashboard/comment/{comment}/delete', [MngCommentController::class,'destroy'])->name('MngComment.delete');
  //  ADMIN - DELETEAll - COMMENT
  Route::delete('/dashboard/comment/deleteAll', [MngCommentController::class,'deleteAll'])->name('MngComment.deleteAll');
//ADMIN - BANNERS
  Route::get('/dashboard/banner', [MngBannerController::class,'index'])->name('MngBanner.index');
  Route::get('/dashboard/banner/search', [MngBannerController::class,'search'])->name('MngBanner.search');
  Route::get('/dashboard/banner/order={order}', [MngBannerController::class,'orderPro'])->name('MngBanner.order');
//ADMIN - BANNERS - CREATES
  Route::get('/dashboard/banner/create', [MngBannerController::class,'create'])->name('MngBanner.create');
  Route::post('/dashboard/banner/store', [MngBannerController::class,'store'])->name('MngBanner.store');
//ADMIN - BANNERS - EIDTS
  Route::get('/dashboard/banner/edit/{id}', [MngBannerController::class,'edit'])->name('MngBanner.edit');
  Route::patch('/dashboard/banner/update/{id}', [MngBannerController::class,'update'])->name('MngBanner.update');
//ADMIN - BANNERS - DELETE
  Route::delete('/dashboard/banner/delete/{id}',[MngBannerController::class,'destroy'])->name('MngBanner.destroy');
  Route::delete('/dashboard/banner/DeleteAll', [MngBannerController::class,'deleteAll'])->name('MngBanner.deleteAll');
//ADMIN - LANGUAGES
  Route::get('/dashboard/language', [MngLanguageController::class,'index'])->name('MngLanguage.index');
//ADMIN - USERS
  Route::get('/dashboard/user', [MngUserController::class,'index'])->name('MngUser.index');
  Route::get('/dashboard/user/search', [MngUserController::class,'search'])->name('MngUser.search');
  Route::get('/dashboard/user/order={order}', [MngUserController::class,'orderPro'])->name('MngUser.order');
//ADMIN - USERS - CREATES
  Route::get('/dashboard/user/create', [MngUserController::class,'create'])->name('MngUser.create');
  Route::post('/dashboard/user/store', [MngUserController::class,'store'])->name('MngUser.store');
//ADMIN - USERS - EIDTS
  Route::get('/dashboard/user/edit/{id}', [MngUserController::class,'edit'])->name('MngUser.edit');
  Route::patch('/dashboard/user/update/{id}', [MngUserController::class,'update'])->name('MngUser.update');
//ADMIN - USERS - DELETE
  Route::delete('/dashboard/user/delete/{id}',[MngUserController::class,'destroy'])->name('MngUser.destroy');
  Route::delete('/dashboard/user/DeleteAll', [MngUserController::class,'deleteAll'])->name('MngUser.deleteAll');
//ADMIN - ORDERS
  Route::get('/dashboard/order', [MngOrderController::class,'index'])->name('MngOrder.index');
  Route::get('/dashboard/order/search', [MngOrderController::class,'search'])->name('MngOrder.search');
  Route::get('/dashboard/order/order={order}', [MngOrderController::class,'orderPro'])->name('MngOrder.order');
//ADMIN - ORDERS - EIDTS
  Route::patch('/dashboard/order/update/{id}', [MngOrderController::class,'update'])->name('MngOrder.update');
  Route::patch('/dashboard/order/UNupdate/{id}', [MngOrderController::class,'UNupdate'])->name('MngOrder.UNupdate');
//ADMIN - ORDERS - DELETE
  Route::delete('/dashboard/order/delete/{id}',[MngOrderController::class,'destroy'])->name('MngOrder.destroy');
  Route::delete('/dashboard/order/DeleteAll', [MngOrderController::class,'deleteAll'])->name('MngOrder.deleteAll');
//ADMIN - ORDERS_DETAILS
  Route::get('/dashboard/orderDetail', [MngOrderDetailController::class,'index'])->name('MngOrderDetail.index');
  Route::get('/dashboard/orderDetail/search', [MngOrderDetailController::class,'search'])->name('MngOrderDetail.search');
  Route::get('/dashboard/orderDetail/order={order}', [MngOrderDetailController::class,'orderPro'])->name('MngOrderDetail.order');

});

//contact
  Route::get('/contact', [ContactController::class,'index'])->name('contact');
  Route::post('/contact',[ContactController::class,'sendMail'])->name('contact.sendMail');
  Route::get('manager-admin', );

  Auth::routes();
