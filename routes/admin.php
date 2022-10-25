<?php
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', function () {
            return view("admin.login");
        })->name('admin.login');

        Route::post('login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin.login.post');
    });

    Route::prefix('dashboard')->middleware('auth:admin')->group(function () {
        Route::get('home', [App\Http\Controllers\AdminController::class, 'home'])->name('admin.home');

        Route::get('users', [App\Http\Controllers\Admin\UserController::class, 'getUsers'])->name('admin.users');
        Route::get('deactivated-users', [App\Http\Controllers\Admin\UserController::class, 'deactivatedUsers'])->name('admin.users.deactivated');
        Route::get('deactivate-user', [App\Http\Controllers\Admin\UserController::class, 'deactivationForm'])->name('admin.user.deactivate');
        Route::post('deactivate-user', [App\Http\Controllers\Admin\UserController::class, 'deactivate'])->name('admin.user.deactivate.post');
        Route::get('reactivate-user', [App\Http\Controllers\Admin\UserController::class, 'reactivate'])->name('admin.user.reactivate');
       
        Route::get('reviews', [App\Http\Controllers\Admin\ReviewController::class, 'reviews'])->name('admin.reviews');
        Route::get('reviews/download', [App\Http\Controllers\Admin\ReviewController::class, 'exportAsPdf'])->name('admin.reviews.download');

        Route::get('my-admins', [App\Http\Controllers\Admin\AdminController::class, 'getAdmins'])->name('admins');
        Route::get('my-admin/create', [App\Http\Controllers\Admin\AdminController::class, 'createOrUpdateView'])->name('admin.create');
        Route::post('my-admin/create', [App\Http\Controllers\Admin\AdminController::class, 'createOrUpdate'])->name('admin.create.post');
        Route::get('my-admin/deactivate', [App\Http\Controllers\Admin\AdminController::class, 'deactivate'])->name('admin.deactivate');
        Route::get('my-admin/reactivate', [App\Http\Controllers\Admin\AdminController::class, 'reactivate'])->name('admin.reactivate');
        Route::get('my-admin/delete', [App\Http\Controllers\Admin\AdminController::class, 'delete'])->name('admin.delete');
      
        
        
        Route::get('logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');
    });
});