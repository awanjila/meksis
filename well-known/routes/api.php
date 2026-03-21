<?php

use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MpesaController;

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

Route::post('stk/push/callback/url',[MpesaController::class, 'mpesaResponse'])->name('mpesa_response');
Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.store');
Route::get('getComments/{blog}', [CommentController::class, 'getComments'])->name('comment.get');
Route::get('test',function (){
    return "test";
});

