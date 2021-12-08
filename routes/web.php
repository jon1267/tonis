<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Points\Core\Http\Controllers\Admin\PointController;
use App\Modules\Points\Core\Http\Controllers\Admin\PointCabinetController;
use App\Modules\Sellers\Core\Http\Controllers\Admin\SellerController;
use App\Modules\Admins\Core\Http\Controllers\Admin\AdminController;
use App\Modules\Promocodes\Core\Http\Controllers\Admin\PromocodeController;

Route::get('/', function () {
    return view('welcome');
});


Auth::routes(['register' => false]);//Auth::routes();
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/cabinet', [PointCabinetController::class, 'cabinet'])->name('cabinet');
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('point', PointController::class)->except(['show']);
    Route::resource('seller', SellerController::class)->except(['show']);
    Route::resource('user', AdminController::class)->except(['show']); //user === admin
    Route::resource('promocode', PromocodeController::class)->except(['show','create','store']);

    Route::post('filter', [SellerController::class, 'filter'])->name('seller.filter');
});
