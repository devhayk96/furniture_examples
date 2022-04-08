<?php

use App\Http\Controllers\Admin\ActivityLogsController;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\AnnouncementsController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\BuildingFloorsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\BuildingTypesController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\DealTypesController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RepairingTypesController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SellerStatusesController;
use App\Http\Controllers\Admin\UserRolesController;
use App\Http\Controllers\Admin\StreetsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\WebsiteInfoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdditionalInfoController;
use App\Http\Controllers\Admin\ServicesController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your dashboard. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::prefix('admin')->group(function () {
    Route::get('login', [LoginController::class, "showAdminLoginForm"])->name('adminLogin');
    Route::post('login', [LoginController::class, "login"]);
    Route::post('password/email', [ForgotPasswordController::class, "sendResetLinkEmail"])->name('admin.password.email');
    Route::post('logout', [LoginController::class, "logout"])->name('admin.logout');

    Route::get('lang/{locale}', [DashboardController::class, "lang"]);


    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get("", function () { return redirect()->route('dashboard.index'); })->name('admin.home');
        Route::get("dashboard", [DashboardController::class, "index"])->name('dashboard.index');
        Route::post("load_delete_modal", [DashboardController::class, "load_delete_modal"])->name('load_delete_modal');

        Route::resource('services', ServicesController::class);
        Route::resource('announcements', AnnouncementsController::class);
        Route::resource('categories', CategoriesController::class);
        Route::resource('building-types', BuildingTypesController::class);
        Route::resource('building-floors', BuildingFloorsController::class);
        Route::resource('repairing-types', RepairingTypesController::class);
        Route::resource('deal-types', DealTypesController::class);
        Route::resource('additional-infos', AdditionalInfoController::class);
        Route::resource('pages',  PagesController::class)->only(['index','edit','update']);
        Route::resource('activity-logs', ActivityLogsController::class);

        Route::resource('admins', AdminsController::class);
        Route::resource('roles', RolesController::class);
        Route::resource('users', UsersController::class);
        Route::resource('user-roles', UserRolesController::class);

        Route::resource('contact-us', ContactUsController::class);
//        Route::resource('seller-statuses', SellerStatusesController::class);
        Route::resource('streets', StreetsController::class);
        Route::get('filter', [AdminsController::class, "filter"])->name('admins.filter');
        Route::resource('website-info', WebsiteInfoController::class);

        Route::prefix('profile')->group(function (){
            Route::get('/', [ProfileController::class, "index"])->name('admin.profile');
            Route::get('show', [ProfileController::class, "show"])->name('admin.profile.show');
            Route::get('edit', [ProfileController::class, "edit"])->name('admin.profile.edit');
            Route::get('password', [ProfileController::class, "password"])->name('admin.profile.password');
            Route::put('update',[ProfileController::class, "update"])->name('admin.profile.update');
            Route::put('change-password',[ProfileController::class, "changePassword"])->name('admin.profile.password.change');
        });

        Route::post("upload_tmp/{name}", [DashboardController::class, "upload_tmp"])->name('admin.upload_tmp');
        Route::post("delete_tmp", [DashboardController::class, "delete_tmp"])->name('admin.delete_tmp');

        Route::get('cities-villages', [AnnouncementsController::class, 'cities_villages'])->name('cities_villages');
        Route::get('streets-by-district', [AnnouncementsController::class, 'district_streets'])->name('district_streets');

    });

});


/* Redirect to login if url not found */
Route::get('/{any}', function ($any) {
    return redirect()->route('login');
})->where('any', '.*');
