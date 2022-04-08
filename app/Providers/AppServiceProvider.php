<?php

namespace App\Providers;

use App\Enums\MenuItemsEnum;
use App\Enums\ServicesEnums;
use App\Models\Announcement;
use App\Models\AnnouncementDetail;
use App\Models\UserRole;
use App\Observers\AnnouncementDetailObserver;
use App\Observers\AnnouncementObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrap();


        Announcement::observe(AnnouncementObserver::class);
        AnnouncementDetail::observe(AnnouncementDetailObserver::class);
    }
}
