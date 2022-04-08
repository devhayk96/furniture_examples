<?php

namespace App\Providers;

use App\Policies\AdditionalInfoPolicy;
use App\Policies\AdminPolicy;
use App\Policies\AnnouncementPolicy;
use App\Policies\BuildingFloorPolicy;
use App\Policies\BuildingTypePolicy;
use App\Policies\CategoryPolicy;
use App\Policies\DealTypePolicy;
use App\Policies\PagePolicy;
use App\Policies\RepairingTypePolicy;
use App\Policies\RolePolicy;
use App\Policies\ServicePolicy;
use App\Policies\SellerStatusPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\AdditionalInfo'  => AdditionalInfoPolicy::class,
        'App\Models\Admin'           => AdminPolicy::class,
        'App\Models\Announcement'    => AnnouncementPolicy::class,
        'App\Models\BuildingFloor'   => BuildingFloorPolicy::class,
        'App\Models\BuildingType'    => BuildingTypePolicy::class,
        'App\Models\Category'        => CategoryPolicy::class,
        'App\Models\DealType'        => DealTypePolicy::class,
        'App\Models\Page'            => PagePolicy::class,
        'App\Models\RepairingType'   => RepairingTypePolicy::class,
        'App\Models\Role'            => RolePolicy::class,
        'App\Models\Service'         => ServicePolicy::class,
        'App\Models\SellerStatus'    => SellerStatusPolicy::class,
        'App\Models\User'            => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function () {
            if (is_super_admin()) {
                return true;
            }
        });
    }
}
