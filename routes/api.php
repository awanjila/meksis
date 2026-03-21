<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MpesaController;
use App\Http\Controllers\BackOffice\CategoryController;
use App\Http\Controllers\BackOffice\PortfolioController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\Api\CustomerController;
use App\Models\BackOffice\Blog;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/categories', [CategoryController::class, 'index']);

Route::middleware('auth:customer')->group(function () {
    Route::post('/paypal/create-order', [PayPalController::class, 'createOrder']);
    Route::post('/paypal/capture-order', [PayPalController::class, 'captureOrder']);
});

Route::post('/mpesa/stk-push', [MpesaController::class, 'initiateSTKPush']);
Route::post('/mpesa/callback', [MpesaController::class, 'callback']);

Route::post('stk/push/callback/url',[MpesaController::class, 'mpesaResponse'])->name('mpesa_response');
Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.store');
Route::get('getComments/{blog}', [CommentController::class, 'getComments'])->name('comment.get');
Route::get('test',function (){
    return "test";
});

Route::get('/customer/check', [CustomerController::class, 'checkAuth']);

// Portfolio API routes
Route::get('/portfolio-categories', [PortfolioController::class, 'getPortfolioCategories']);
Route::get('/portfolios/category/{categorySlug}', [PortfolioController::class, 'getPortfoliosByCategory']);

// Contact API route
Route::post('/contact', [ContactController::class, 'store']);

// Services API routes
Route::get('/services', function() {
    return \App\Models\Service::select('id', 'name', 'slug', 'description', 'image')->get();
});

Route::get('/service/{slug}', function($slug) {
    $service = \App\Models\Service::where('slug', $slug)->first();
    if (!$service) {
        return response()->json(['error' => 'Service not found'], 404);
    }
    return response()->json($service);
});



Route::get('/blogs', function () {
    return Blog::select(
        'id',
        'blog_category_id',
        'author',
        'name',
        'slug',
        'meta_title',
        'meta_description',
        'image',
        'created_at'
    )
    ->with('category:id,name,slug')
    ->latest()
    ->get();
});

Route::get('/blog-categories', function () {
    return \App\Models\BackOffice\BlogCategory::select('id', 'name', 'slug')->get();
});

Route::get('/blog/{slug}', function ($slug) {
    $blog = Blog::with('category')
        ->where('slug', $slug)
        ->first();

    if (!$blog) {
        return response()->json([
            'error' => 'Blog not found'
        ], 404);
    }

    return response()->json($blog);
});

