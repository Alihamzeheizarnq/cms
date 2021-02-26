<?php


use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\PermissionUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
//    auth()->loginUsingId(10);
    return view('admin.index');
});
Route::resource('users', UserController::class);
Route::get('user/{user}/permission', [PermissionUserController::class, 'create'])->name('user.permissions');
Route::post('user/{user}/permission', [PermissionUserController::class, 'store'])->name('user.permissions.store');

Route::resource('permissions', PermissionController::class);
Route::resource('products', ProductController::class);

Route::resource('comments', CommentController::class);
Route::get('comments/{user}/user', [CommentController::class, 'all'])->name('user.comment');
Route::get('comments/{comment}/approved', [CommentController::class, 'approved'])->name('comments.approved');
Route::post('comments/replay/{comment}', [CommentController::class, 'replay'])->name('comments.replay');


Route::resource('roles', RoleController::class);

Route::resource('categories', CategoryController::class);


Route::post('attributes/values' , [AttributeController::class , 'getValueAttr']);


   