<?php
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', function () {
            return view("auth.admin-login");
        })->name('admin.login');

        Route::post('login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin.login.post');
    });

    Route::prefix('dashboard')->middleware('auth:admin')->group(function () {
        Route::get('home', [App\Http\Controllers\AdminController::class, 'home'])->name('admin.home');

        Route::get('my-admins', [App\Http\Controllers\AdminController::class, 'getAdmins'])->name('admins');
        Route::get('my-admin/create', [App\Http\Controllers\AdminController::class, 'createOrUpdateView'])->name('admin.create');
        Route::post('my-admin/create', [App\Http\Controllers\AdminController::class, 'createOrUpdate'])->name('admin.create.post');
        Route::get('my-admin/deactivate', [App\Http\Controllers\AdminController::class, 'deactivate'])->name('admin.deactivate');
        Route::get('my-admin/reactivate', [App\Http\Controllers\AdminController::class, 'reactivate'])->name('admin.reactivate');
        Route::get('my-admin/delete', [App\Http\Controllers\AdminController::class, 'delete'])->name('admin.delete');
      
        
        Route::get('logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');
    });
});