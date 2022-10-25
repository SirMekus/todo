<?php

require_once('admin.php');

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('auth:admin')->prefix('dashboard')->group(function () {
    Route::get('create-activity', [App\Http\Controllers\ActivityController::class, 'createActivityForm'])->name('activity.form');
    Route::post('create-activity', [App\Http\Controllers\ActivityController::class, 'createActivityFormSubmit'])->name('activity.form.post');
    Route::get('activities', [App\Http\Controllers\ActivityController::class, 'activities'])->name('activities');
});
