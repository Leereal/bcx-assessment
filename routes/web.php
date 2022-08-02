<?php

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
});

Route::get('/manual', function () {
    return view('manual');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//All routes inside this middleware are accessed only if the user have permission
Route::group(['middleware' => ['permission','auth']], function () {
    //User Controller | Routes for users
    Route::resource('users', App\Http\Controllers\UserController::class);

    //Permission Controller | Routes for permission
    Route::get('permission/{user_id?}', [App\Http\Controllers\PermissionController::class, 'index'])->name('permission.index');
    Route::post('permission/store', [App\Http\Controllers\PermissionController::class, 'store'])->name('permission.store');

    //Profile Controller | Routes for profile
    Route::match(['get', 'patch'], 'profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('profile/view', [App\Http\Controllers\ProfileController::class, 'view'])->name('profile.view');

});
