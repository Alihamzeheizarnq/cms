<?php

use App\Http\Controllers\productController;
use App\Http\Controllers\Profile\TokenVerifyController;
use App\Http\Controllers\Profile\TowFactorController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [productController::class, 'index']);

Route::get('/dashboard', function () {
    return view('profile.dashboard');
})->middleware(['auth'])->name('dashboard');
require_once __DIR__ . "./../auth.php";


Route::get('tow-factor-setting', [TowFactorController::class, 'index'])->name('tow-factor');
Route::post('tow-factor-setting', [TowFactorController::class, 'store'])->name('tow-factor');
Route::get('verify-token', [TowFactorController::class, 'get_verify_phone'])->name('verify-token');
Route::post('verify-token', [TowFactorController::class, 'post_verify_phone']);
Route::get('verify-tow-factor-type', [TokenVerifyController::class, 'verify_tow_refactor'])->name('verify-tow-refactor');
Route::post('verify-tow-factor-type', [TokenVerifyController::class, 'post_verify_tow_refactor']);

Route::get('/products' , [productController::class , 'index'])->name('products');
Route::get('/products/{product}' , [productController::class , 'single'])->name('products.single');
Route::post('/comment' , [\App\Http\Controllers\HomeController::class , 'comment'])->name('send.comment');



Route::get('/category/{category}' , function ($category){

   if (! $products = \App\Models\Category::whereName($category)->get()){
       abort(404);
   }
   return $products[0]->products;

});
