<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Point;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Paginator::useBootstrap();

        /*View::composer([
                'points.points_create', 'sellers.sellers_create', 'sellers.sellers_content',
                'promocodes.promocodes_content',
            ], function ($view) {
                $view->with('userId', auth()->user()->id)
                    ->with('points', Point::get(['id', 'name']));
        });*/

        View::composer(['points.points_create',],
            function ($view) {$view->with('userId', auth()->user()->id); });
        View::composer(['sellers.sellers_create', 'sellers.sellers_content', 'promocodes.promocodes_content',],
            function ($view) {$view->with('points', Point::get(['id', 'name']));});
    }
}
