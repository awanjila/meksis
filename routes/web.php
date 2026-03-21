<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BackOffice\AdminController;
use App\Http\Controllers\BackOffice\AboutController;
use App\Http\Controllers\BackOffice\ServiceController;
use App\Http\Controllers\BackOffice\ProductController;
use App\Http\Controllers\BackOffice\PortfolioController;
use App\Http\Controllers\BackOffice\CategoryController;
use App\Http\Controllers\BackOffice\BlogController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\CustomerAuthController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('client.landing');
})->name('home');

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


//Contact Controller
Route::controller(ContactController::class)->group(function(){
    Route::get('contact/view/{id}', 'contactView')->name('contact.view');
    Route::get('contact.inbox', 'contactInbox')->name('contact.inbox');

    /// Frontend///
    Route::get('/contact', function () {
        return view('client.contact'); // Use your existing contact blade template
    })->name('contact');
    Route::post('/contact', [ContactController::class, 'store']);
    
 });

// })->middleware(['auth', 'verified']);




Route::get('home/slider', [AdminController::class, 'HomeSlider'])->name('home.slider');
Route::get('index/slider', [AdminController::class, 'IndexOfHomeSlider'])->name('index.slider');
Route::post('store/slider', [AdminController::class, 'StoreSlider'])->name('store.slider');
Route::post('update/slider', [AdminController::class, 'UpdateSlider'])->name('update.slider');
Route::get('edit/slider/{id}', [AdminController::class, 'EditSlider'])->name('edit.homeslider');
Route::get('delete/slider/{id}', [AdminController::class, 'DeleteSlider'])->name('delete.homeslider');
Route::get('admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');


// })->middleware(['auth', 'verified']);



Route::controller(AboutController::class)->group(function(){
Route::post('update/about/page', 'UpdateAbout')->name('update.about');
Route::get('edit/about/page', 'AboutPage')->name('edit.about.page');

   //frontend
Route::get('about', 'About')->name('about');
Route::get('pricing_and_packages', 'Pricing')->name('pricing');
    
 });

// })->middleware(['auth', 'verified']);

//services
Route::controller(ServiceController::class)->group(function(){
Route::get('add/service', 'AddService')->name('add.service');
Route::get('index/service', 'IndexOfServices')->name('index.service');
Route::post('store/service', 'StoreService')->name('store.service');
Route::get('edit/service/{id}', 'EditService')->name('edit.service');
Route::get('delete/service/{id}', 'DeleteService')->name('delete.service');
Route::post('update/service', 'UpdateService')->name('update.service');


//frontend

Route::get('show/product/{slug}', 'showService')->name('show.service'); 

Route::get('products', 'Services')->name('services');
 });


 Route::controller(PortfolioController::class)->group(function(){
    Route::get('add/portfolio/category', 'AddPortfolioCategory')->name('add.portfolio.category');
    Route::post('store/portfolio/category', 'StorePortfolioCategory')->name('store.portfolio.category');
    Route::get('index/portfolio/category', 'IndexOfPortfolioCategories')->name('portfolio.category');
    Route::get('delete/portfolio/category/{id}', 'DeletePortfolioCategory')->name('delete.portfolio.category');
    Route::get('edit/portfolio/category/{id}', 'EditPortfolioCategory')->name('edit.portfolio.category');
    Route::post('update/portfolio/category', 'UpdatePortfolioCategory')->name('update.portfolio.category');

    Route::post('store/portfolio', 'StorePortfolio')->name('store.portfolio');
    Route::get('index/portfolio', 'IndexOfPortfolios')->name('portfolio');
    Route::get('delete/portfolio/{id}', 'DeletePortfolio')->name('delete.portfolio');
    Route::get('edit/portfolio/{id}', 'EditPortfolio')->name('edit.portfolio');
    Route::post('update/portfolio', 'UpdatePortfolio')->name('update.portfolio');


 });
 

// })->middleware(['auth', 'verified']);


Route::controller(BlogController::class)->group(function(){
   
    Route::get('index/blog', 'IndexOfBlogs')->name('index.blog');
    Route::post('store/blog', 'StoreBlog')->name('store.blog');
    Route::get('delete/blog/{id}', 'DeleteBlog')->name('delete.blog');
    Route::get('edit/blog/{id}', 'EditBlog')->name('edit.blog');
    Route::post('update/blog', 'UpdateBlog')->name('update.blog');
    Route::get('add/blog/category', 'AddBlogCategory')->name('add.blog.category');
    Route::get('add/blog', 'AddBlog')->name('add.blog');
    Route::get('index/blog/category', 'IndexOfBlogCategories')->name('index.blog.category');
    Route::post('store/blog/category', 'StoreBlogCategory')->name('store.blog.category');
    Route::get('delete/blog/category/{id}', 'DeleteBlogCategory')->name('delete.blog.category');


    ///frontend///

    Route::get('show/blog/{slug}', 'ShowBlog')->name('show.blog');
    Route::get('blogs', 'IndexOfClientBlogs')->name('blogs.index');   

 });

// })->middleware(['auth', 'verified']);


Route::controller(PricingController::class)->group(function(){
   
    Route::get('index/pricing', 'IndexOfPricings')->name('index.pricing');
    Route::post('store/pricing', 'StorePricing')->name('store.pricing');
    Route::get('delete/pricing/{id}', 'DeletePricing')->name('delete.pricing');
     Route::get('edit/pricing/{id}', 'EditPricing')->name('edit.pricing');
     Route::get('edit/pricing/package/{id}', 'EditPricingPackage')->name('edit.pricing.package');
    Route::post('update/pricing', 'UpdatePricing')->name('update.pricing');
    Route::post('update/pricing/package', 'UpdatePricingPackage')->name('update.pricing.package');

     Route::get('add/pricing/package', 'AddPricingPackage')->name('add.pricing.package');
    Route::get('add/pricing', 'AddPricing')->name('add.pricing');
    Route::get('index/pricing/package', 'IndexOfPricingPackages')->name('index.pricing.package');
    Route::post('store/pricing/package', 'StorePricingPackage')->name('store.pricing.package');
    Route::get('delete/pricing/package/{id}', 'DeletePricingPackage')->name('delete.pricing.package');


    ///frontend///

    Route::get('show/pricing/{slug}', 'ShowPricing')->name('show.pricing');
    Route::get('pricings', 'IndexOfClientPricings')->name('pricings.index');   

 });


 
//Customer Controller
Route::controller(CatalogController::class)->group(function(){
    Route::get('/store', 'Index')->name('catalog.index');
    Route::get('/category/{slug}', 'showProducts')->name('category.products');
    Route::get('/brand/{slug}', 'showBrandProducts')->name('brand.products');
    Route::get('show/product-1/{slug}', 'show')->name('show.product');
    Route::get('show/cart', 'showCart')->name('show.cart');
    Route::get('checkout', 'checkout')->name('show.checkout');
    Route::get('search', 'searchProducts')->name('search');
    Route::post('/checkout/invoice', 'CheckoutInvoice')->name('checkout.invoice');

    Route::get('/products/{slug}', 'showByCategory')->name('products.byCategory');


    Route::get('/delivery', 'Delivery')->name('delivery');
   
    Route::get('/terms', 'Terms')->name('terms');
 
    Route::get('/faqs', 'faq')->name('faqs');
    Route::post('/check-coupon',  'checkCoupon')->name('check_coupon');

    Route::get('/distributor-application-form', 'BDistributor')->name('bdistributor');
    Route::post('/become-a-distributor',  'ADistributor')->name('adistributor');
});


//All Product Route
Route::controller(ProductController::class)->group(function(){
    Route::get('all/product', 'AllProduct')->name('all.product');
    Route::get('add/product', 'AddProduct')->name('product.add');
    Route::post('store/product', 'StoreProduct')->name('product.store');
    Route::post('update/product', 'UpdateProduct')->name('product.update');
    Route::get('edit/product/{id}', 'EditProduct')->name('edit.product');
    Route::get('delete/product/{id}', 'DeleteProduct')->name('delete.product');
    Route::get('import/product', 'ImportProduct')->name('import.product');
    Route::get('barcode/product/{id}', 'BarCodeProduct')->name('barcode.product');
    Route::get('export/product', 'ExportProduct')->name('export.product');
    Route::get('out/of/stock', 'OutofStock')->name('out_of_stock');
    Route::get('expired/products', 'ExpiredProducts')->name('expired_products');
    Route::get('hot/products', 'GetHotProducts')->name('hot.products');
    Route::post('import', 'Import')->name('import');


})->middleware(['auth', 'verified']);

//All Category Route
Route::controller(CategoryController::class)->group(function(){
    Route::get('all/category', 'AllCategory')->name('all.category');
    Route::get('add/category', 'AddCategory')->name('category.add');
    Route::post('store/category', 'StoreCategory')->name('category.store');
    Route::post('update/category', 'UpdateCategory')->name('category.update');
    Route::get('edit/category/{id}', 'EditCategory')->name('edit.category');
    Route::get('delete/category/{id}', 'DeleteCategory')->name('delete.category');

    //frontend
    Route::get('show/category/{slug}', 'showCategory')->name('show.category'); 
    Route::get('wabe_digital_agency/categories', 'Categories')->name('categories');

})->middleware(['auth', 'verified']);

// routes/web.php
Route::get('/payment/success', [PayPalController::class, 'success'])->name('paypal.success');
Route::get('/payment/cancel', [PayPalController::class, 'cancel'])->name('paypal.cancel');

// Google OAuth Routes
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

// Customer Authentication Routes
Route::post('/customer/login', [CustomerAuthController::class, 'login'])->name('customer.login');
Route::post('/customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');


Route::post('/sendmail', [ContactController::class, 'sendMail'])->name('sendmail');
Route::get('/our-works', function () {
    return view('client.ourwork.portfolio');
})->name('ourworks');

Route::get('/portfolio/category/{slug}', [PortfolioController::class, 'ShowCategoryPortfolios'])->name('portfolio.category.show');






