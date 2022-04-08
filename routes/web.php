<?php

use App\Http\Controllers\AnnouncementsController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\Social\LoginController as SocialLogin;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('lang/{locale}', [HomeController::class, "lang"]);

Route::get('services/{service}', [WebsiteController::class, 'service'])->name('service');

Route::get('about-us', [WebsiteController::class, 'aboutUs'])->name('about-us');
Route::get('contact-us', [WebsiteController::class, 'contactUsPage'])->name('contact-us-page');
Route::post('contact-us', [WebsiteController::class, 'contact'])->name('contact-us');
Route::get('terms-of-use', [WebsiteController::class, 'termsOfUse'])->name('terms-of-use');

Route::group(['middleware' => 'auth:web'], function () {
    Route::prefix('announcement')->group(function (){
        Route::get('create',[AnnouncementsController::class,'create'])->name('announcement.create');
        Route::get('edit/{slug}',[AnnouncementsController::class,'edit'])->name('announcement.edit');
        Route::get('/{slug}',[AnnouncementsController::class,'details'])->name('announcement.details');
        Route::put('update/{id}',[AnnouncementsController::class,'update'])->name('announcement.update');
        Route::delete('delete/{id}',[AnnouncementsController::class,'delete'])->name('announcement.delete');
        Route::get('list',[AnnouncementsController::class,'list'])->name('announcement.list');
        Route::post('store',[AnnouncementsController::class,'store'])->name('announcement.store');
        Route::get('cities-villages', [AnnouncementsController::class, 'cities_villages'])->name('announcement.cities_villages');
        Route::get('streets-by-district/{district_id?}', [AnnouncementsController::class, 'district_streets'])->name('announcement.district_streets');
    });

    Route::post("upload_tmp/{name}", [WebsiteController::class, "upload_tmp"])->name('file.upload_tmp');
    Route::post("delete_tmp", [WebsiteController::class, "delete_tmp"])->name('file.delete_tmp');

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [ProfileController::class, 'view'])->name('profile.view');

        Route::group(['prefix' => 'edit'], function () {
            Route::get('', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::put('', [ProfileController::class, 'update'])->name('profile.update');
        });

        Route::group(['prefix' => 'contact-us'], function () {
            Route::get('', [ProfileController::class, 'contactUsPage'])->name('profile.contact-us.page');
            Route::post('', [WebsiteController::class, 'contact'])->name('profile.contact-us');
        });

        Route::get('wallet', [ProfileController::class, 'walletPage'])->name('profile.wallet.page');

        Route::get('favorites', [ProfileController::class, 'favoritesPage'])->name('profile.favorites');
        Route::post('add-remove', [ProfileController::class, 'addAndRemoveFavorites'])->name('profile.add-remove-favorites');
        Route::get('announcements', [ProfileController::class, 'announcements'])->name('profile.announcements');
    });
});

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['guest']], function () {
    Route::post('send-code', [RegisterController::class, 'sendStatusCode'])->name('send-code');
    Route::post('check-code', [RegisterController::class, 'checkStatusCode'])->name('check-code');

    Route::group(['prefix' => 'auth'], function () {
        Route::get('{provider}', [SocialLogin::class, 'redirectToProvider'])->name('social.auth');
        Route::get('{provider}/callback', [SocialLogin::class, 'handleProviderCallback'])->name('social.callback');
    });
});

Route::get('message-modal', [WebsiteController::class, 'showMessageModal'])->name('show.message.modal');


