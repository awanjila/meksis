<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MpesaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DemoPlanController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
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
//     return view('client.landing');
// });

Route::get('test-vue',function (){
   dd("test route");
});
Route::get('/', [ClientController::class, 'index'])->name('index');

Route::get('dashboard',[AdminController::class, 'index'])->name('admin.dashboard');
Route::get('about', [ClientController::class, 'about'])->name('about');
Route::get('services', [ClientController::class, 'services'])->name('services');
Route::get('contact', [ClientController::class, 'contact'])->name('contact');
Route::post('contact-us', [ContactController::class, 'store'])->name('sendmail');
Route::get('services/web_design_in_kenya', [ClientController::class, 'web_design'])->name('web_design');
Route::get('services/custom_software_development_in_kenya', [ClientController::class, 'custom_software'])->name('custom_software');
Route::get('services/digital_branding_in_kenya', [ClientController::class, 'branding_digital'])->name('branding_digital');
Route::get('services/e_commerce_development_in_kenya', [ClientController::class, 'e_commerce'])->name('e_commerce');
Route::get('services/mpesa_integration_in_kenya', [ClientController::class, 'mpesa_integration'])->name('mpesa_integration');
Route::get('services/time_attendance_system_in_kenya', [ClientController::class, 'time_attendance'])->name('time_attendance');
Route::get('mpesa_transactions', [MpesaController::class, 'index'])->name('mpesa_transactions');

Route::get('create_demo_plans',[DemoPlanController::class, 'create'])->name('create_demo_plans');
Route::get('demo_plans',[DemoPlanController::class, 'index'])->name('demo_plans');
Route::post('store_demo', [DemoPlanController::class, 'store'])->name('store_demo');

Route::get('stk/push/simulation/{id}', [MpesaController::class, 'stkSimulation'])->name('stkpush.simulation')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Route::get('dashboard', [CustomAuthController::class, 'dashboard']);
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');


Route::resource('blogs', BlogController::class);

Route::resource('blogcats', BlogCategoryController::class);
Route::get('/blog', [App\Http\Controllers\BlogController::class, 'index2'])->name('blog.index2');

Route::get('/redirects', function(){
    return redirect(Redirect::intended()->getTargetUrl());
    // You can replace above line with the following to return to previous page
    return back();	// or return redirect()->back();
});

//products
Route::get('/index_product',[ProductController::class, 'index'])->name('index.product');
Route::get('/product_index',[ProductController::class, 'product_index'])->name('product.index');
Route::get('/create_product',[ProductController::class, 'create'])->name('create.product');
Route::get('/product/{product}/edit',[ProductController::class, 'edit'])->name('edit.product');
Route::post('/post_product',[ProductController::class, 'store'])->name('store.product');
Route::put('update_product/{id}',[ProductController::class, 'update'])->name('update.product');
Route::get('/product/{product}/delete',[ProductController::class, 'destroy'])->name('destroy.product');
Route::get('/show_product/{slug}',[ProductController::class, 'show'])->name('show.product');
Route::delete('/delete_product_cover_image/{id}',[ProductController::class, 'deleteCoverImage'])->name('destroy.product_cover_image');
Route::delete('/delete_product_image/{id}',[ProductController::class, 'deleteDestinationImage'])->name('destroy.images');

//services
Route::get('/index_service',[ServiceController::class, 'index'])->name('index.service');
Route::get('/service_index',[ServiceController::class, 'service_index'])->name('service.index');
Route::get('/create_service',[ServiceController::class, 'create'])->name('create.service');
Route::get('/service/{service}/edit',[ServiceController::class, 'edit'])->name('edit.service');
Route::post('/post_service',[ServiceController::class, 'store'])->name('store.service');
Route::put('update_service/{id}',[ServiceController::class, 'update'])->name('update.service');
Route::get('/service/{service}/delete',[ServiceController::class, 'destroy'])->name('destroy.service');
Route::get('/show_service/{slug}',[ServiceController::class, 'show'])->name('show.service');
Route::delete('/delete_service_cover_image/{id}',[ServiceController::class, 'deleteCoverImage'])->name('destroy.service_cover_image');
Route::delete('/delete_service_image/{id}',[ServiceController::class, 'deleteImage'])->name('destroy.services.images');
