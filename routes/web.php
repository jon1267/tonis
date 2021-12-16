<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Points\Core\Http\Controllers\Admin\PointController;
use App\Modules\Points\Core\Http\Controllers\Admin\PointCabinetController;
use App\Modules\Sellers\Core\Http\Controllers\Admin\SellerController;
use App\Modules\Admins\Core\Http\Controllers\Admin\AdminController;
use App\Modules\Promocodes\Core\Http\Controllers\Admin\PromocodeController;
use App\Modules\Settings\Core\Http\Controllers\Admin\SettingController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);//Auth::routes();
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/p/{hash}', [App\Http\Controllers\ClientController::class, 'index'])->middleware('point.hash');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/cabinet', [PointCabinetController::class, 'cabinet'])->name('cabinet');
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('point', PointController::class)->except(['show']);
    Route::resource('seller', SellerController::class)->except(['show']);
    Route::resource('user', AdminController::class)->except(['show']); //user === admin
    Route::resource('promocode', PromocodeController::class)->only(['show','index']);
    Route::resource('setting', SettingController::class)->only(['edit','update']);

    Route::post('filter-sellers', [SellerController::class, 'filterSellers'])->name('seller.filter');
    Route::post('filter-promocodes', [PromocodeController::class, 'filterPromocodes'])->name('promocode.filter');
});
