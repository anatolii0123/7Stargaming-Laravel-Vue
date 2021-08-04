<?php

use App\Http\Controllers\Coupons\CouponSettingsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Settings\CurrencyController;
use App\Http\Controllers\Settings\CustomCssController;
use App\Http\Controllers\Settings\CustomJsController;
use App\Http\Controllers\Settings\GameProviderController;
use App\Http\Controllers\Settings\GeneralSettingsController;
use App\Http\Controllers\Settings\PaymentMethodsController;
use App\Http\Controllers\Settings\SocialMediaController;
use App\Http\Controllers\UserManagement\CustomerGroupsController;
use App\Http\Controllers\UserManagement\CustomerNotesController;
use App\Http\Controllers\UserManagement\IpBanController;
use App\Http\Controllers\UserManagement\Profile\InfoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\FilterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

# Login
Route::post('jwt/login', [AuthController::class,'login']);

# Language Controller
Route::get('/translates', [LanguageController::class, 'translate']);
Route::get('/languages', [LanguageController::class, 'languages']);

Route::group([
    'middleware' => 'auth.jwt',
    'prefix' => 'jwt'
], function ($router) {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh',  [AuthController::class, 'refresh']);
    Route::get('user', [AuthController::class, 'me']);
});

/**
 * menü test
 */
Route::group([
    'middleware' => 'auth.jwt'
], function (){
    Route::get('system/navbar', [TestController::class, 'menu']);
});

## User ##
Route::group([
    'middleware' => 'auth.jwt',
    'prefix' => 'user'
], function (){
    Route::get('my_sites', [AuthController::class, 'mySites']);
});

## Site ##
Route::group([
    'middleware' => 'auth.jwt',
    'prefix' => 'site'
], function (){
    Route::get('limits', [SiteController::class, 'getLimits']);
});

## Filter ##
Route::group([
    'middleware' => 'jwt.verify',
    'prefix' => 'filter'
], function (){
    Route::get('affiliates', [FilterController::class, 'affiliates']);
    Route::get('customer_groups', [FilterController::class, 'customerGroups']);
    Route::get('customer_logs_type', [FilterController::class, 'customerLogsType']);
});

## User Management ##
Route::prefix('user_management')->middleware(['jwt.verify'])->group(function () {
    Route::get('/users', [UserManagementController::class, 'getUsers']);
    Route::get('/multi_ips', [UserManagementController::class, 'getMultiIps']);
    Route::get('/online_customers', [UserManagementController::class, 'onlineCustomers']);

    Route::prefix('customer_groups')->group(function () {
        Route::get('/', [CustomerGroupsController::class, 'customerGroups']);
        Route::post('/', [CustomerGroupsController::class, 'storeCustomerGroup']);
        Route::get('/{id}', [CustomerGroupsController::class, 'getCustomerGroup']);
        Route::put('/update/{id}', [CustomerGroupsController::class, 'updateCustomerGroup']);
        Route::delete('/delete/{id}', [CustomerGroupsController::class, 'deleteCustomerGroup']);
    });

    Route::prefix('ipban')->group(function () {
        Route::get('/', [IpBanController::class, 'getIpBans']);
        Route::get('/{id}', [IpBanController::class, 'getIpBan']);
        Route::post('/', [IpBanController::class, 'storeIpBan']);
        Route::put('/update/{id}', [IpBanController::class, 'updateIpBan']);
        Route::delete('/delete/{id}', [IpBanController::class, 'deleteIpBan']);
    });

    Route::prefix('notes')->group(function () {
        Route::get('/', [CustomerNotesController::class, 'index']);
        Route::get('/{id}', [CustomerNotesController::class, 'detail']);
        Route::post('/', [CustomerNotesController::class, 'store']);
        Route::put('/update/{id}', [CustomerNotesController::class, 'update']);
        Route::delete('/delete/{id}', [CustomerNotesController::class, 'delete']);
    });

    Route::prefix('profile')->group(function () {
        Route::prefix('info')->group(function () {
            Route::get('/{id}', [InfoController::class, 'index']);
            Route::get('/information/{id}', [InfoController::class, 'information']);
        });

        Route::prefix('chart')->group(function () {
            Route::get('/financial/{id}', [InfoController::class, 'financial']);
            Route::get('/earnings/{id}', [InfoController::class, 'earnings']);
            Route::get('/games/{id}', [InfoController::class, 'games']);
        });
    });
});

## Direct ##
Route::group([
    'middleware' => 'jwt.verify'
], function () {
    Route::get('dashboard', [DashBoardController::class, 'getStatistics']);
    Route::put('/dashboard/currency', [DashBoardController::class, 'changeUserCurrency']);
    Route::get('search', [SearchController::class, 'index']);
});

## General Settings ##
Route::group([
    'middleware' => 'jwt.verify',
    'prefix' => 'settings'
], function (){
    Route::prefix('custom_css')->group(function () {
        Route::get('/', [CustomCssController::class, 'index']);
        Route::put('/', [CustomCssController::class, 'update']);
    });

    Route::prefix('custom_js')->group(function () {
        Route::get('/', [CustomJsController::class, 'index']);
        Route::put('/', [CustomJsController::class, 'update']);
    });

    Route::prefix('social_media')->group(function () {
        Route::get('/', [SocialMediaController::class, 'index']);
        Route::put('/', [SocialMediaController::class, 'update']);
    });

    Route::prefix('payment_methods')->group(function () {
        Route::get('/', [PaymentMethodsController::class, 'index']);
        Route::get('/groups', [PaymentMethodsController::class, 'groups']);
        Route::post('/', [PaymentMethodsController::class, 'store']);
        Route::get('/{id}', [PaymentMethodsController::class, 'detail']);
        Route::put('/update_status/{id}', [PaymentMethodsController::class, 'updateStatus']);
        Route::put('/update/{id}', [PaymentMethodsController::class, 'update']);
    });

    Route::prefix('general_settings')->group(function () {
        Route::get('/', [GeneralSettingsController::class, 'index']);
        Route::put('/', [GeneralSettingsController::class, 'update']);
    });

    Route::prefix('currencies')->group(function () {
        Route::get('/', [CurrencyController::class, 'index']);
        Route::post('/', [CurrencyController::class, 'store']);
        Route::get('/available_currencies', [CurrencyController::class, 'availableCurrencies']);
        Route::put('/update/{id}', [CurrencyController::class, 'update']);
    });

    Route::prefix('game_providers')->group(function () {
        Route::get('/', [GameProviderController::class, 'index']);
        Route::put('/update', [GameProviderController::class, 'update']);
    });
});

## Coupons ##
Route::group([
    'middleware' => 'jwt.verify',
    'prefix' => 'coupons'
], function (){
    Route::prefix('coupon_settings')->group(function () {
        Route::get('/', [CouponSettingsController::class, 'index']);
        Route::put('/', [CouponSettingsController::class, 'update']);
    });
});
