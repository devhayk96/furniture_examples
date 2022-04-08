<?php

namespace App\Providers;

use App\Enums\MenuItemsEnum;
use App\Enums\ServicesEnums;
use App\Models\UserRole;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admin.*', function($view) {
            $view->with([
                'admin' => auth()->guard('admin')->check() ? auth()->guard('admin')->user() : null,
                'menu_items' => MenuItemsEnum::all(),
                'translations' => translations()->toJson()
            ]);
        });

        View::composer('website.*', function($view) {
            $view->with([
                'user' => auth()->guard('web')->check() ? auth()->guard('web')->user() : null,
                'roles' => UserRole::all(),
                'services' => ServicesEnums::all(),
                'translations' => collect(translations()->get('main'))->toJson()
            ]);
        });
    }
}
