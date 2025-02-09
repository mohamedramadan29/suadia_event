<?php

use App\Models\dashboard\CheckText;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\AdminController;
use App\Http\Controllers\dashboard\RolesController;
use App\Http\Controllers\dashboard\InvoiceController;
use App\Http\Controllers\dashboard\WelcomeController;
use App\Http\Controllers\dashboard\auth\AuthController;
use App\Http\Controllers\dashboard\CheckTextController;
use App\Http\Controllers\dashboard\TechInvoicesController;
use App\Http\Controllers\dashboard\PublicInvoiceController;
use App\Http\Controllers\dashboard\ProblemCategoryController;
use App\Http\Controllers\dashboard\auth\ResetPasswordController;
use App\Http\Controllers\dashboard\auth\ForgetPasswordController;
use App\Http\Controllers\dashboard\CollageController;
use App\Http\Controllers\dashboard\EventController;
use App\Http\Controllers\dashboard\EventTypeController;

Route::group([
    'prefix' => '/dashboard',
    'as' => 'dashboard.',
], function () {

    ##################### Auth Login Controller  ########################
    Route::controller(AuthController::class)->group(function () {
        Route::get('login', 'show_login')->name('login.show');
        Route::post('register_login', 'register_login');
        Route::post('logout', 'logout')->name('logout');
    });

    ############################### End Auth Login Controller ###############

    ################### Reset Password #############
    Route::controller(ForgetPasswordController::class)->group(function () {
        Route::get('password/email', 'showemailform')->name('password.email');
        Route::post('password/email', 'sendotp')->name('password.email.post');
        Route::get('password/verify/{email}', 'showotpform')->name('password.otp.show');
        Route::get('password/verify', 'otpverify')->name('password.otp.post');
        Route::match(['post', 'get'], 'forget-password', 'forget_password')->name('forget_password');
        Route::match(['post', 'get'], 'change-forget-password/{code}', 'change_forget_password');
        Route::post('user/update_forget_password', 'update_forget_password')->name('update_forget_password');
    });
    Route::controller(ResetPasswordController::class)->group(function () {
        Route::get('password/reset/{email}', 'ShowResetForm')->name('password.reset');
        Route::post('password/reset', 'resetpassword')->name('password.reset.post');

    });

    ############################### Start Admin Auth Route  ###############
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::controller(AuthController::class)->group(function () {
            Route::match(['post', 'get'], 'update_profile', 'update_profile')->name('update_profile');
            Route::match(['post', 'get'], 'update_password', 'update_password')->name('update_password');
        });

        ############################### Start Welcome  Controller ###############

        Route::controller(WelcomeController::class)->group(function () {
            Route::get('welcome', 'index')->name('welcome');
        });

        ############################### End  Welcome  Controller ###############
        ##################### Start Role Permissions ####################
        Route::group(['middleware' => 'can:roles', 'prefix' => 'role', 'as' => 'roles.'], function () {
            Route::controller(RolesController::class)->group(function () {
                Route::get('index', 'index')->name('index');
                Route::match(['get', 'post'], 'create', 'create')->name('create');
                // Route::post('store', 'store')->name('store')->middleware('can:roles');
                Route::match(['get', 'post'], 'update/{id}', 'update')->name('update');
                Route::post('destroy/{id}', 'destroy')->name('destroy');
            });
        });

        ##################### End Role Permissions #########################

        ##################### Start Admins Routes #########################
        Route::group(['middleware' => 'can:admins', 'prefix' => 'admins', 'as' => 'admins.'], function () {
            Route::controller(AdminController::class)->group(function () {
                Route::get('index', 'index')->name('index');
                Route::get('tech', 'tech')->name('tech');
                Route::post('update_tech/{id}', 'update_tech')->name('update_tech');
                Route::match(['get', 'post'], 'create', 'create')->name('create');
                Route::match(['post', 'get'], 'update/{id}', 'update')->name('update');
                Route::post('destroy/{id}', 'destroy')->name('destroy');
                ######################### Show Tech Invoices  Admins ############################
                Route::match(['post', 'get'], 'tech_invoices/{id}', 'tech_invoices')->name('tech_invoices');
            });
        });
        ################### End Admins Routes ###########################

        ##################### Start Collages Routes #########################

        Route::group(['middleware' => 'can:admins', 'prefix' => 'collages', 'as' => 'collages.'], function () {
            Route::controller(CollageController::class)->group(function () {
                Route::get('index', 'index')->name('index');
                Route::match(['get', 'post'], 'create', 'create')->name('create');
                Route::match(['post', 'get'], 'update/{id}', 'update')->name('update');
                Route::post('destroy/{id}', 'destroy')->name('destroy');
            });
        });
        #################### End Collages Routes ###########################

        ##################### Start Event Types  Routes #########################

        Route::group(['middleware' => 'can:admins', 'prefix' => 'events_types', 'as' => 'events_types.'], routes: function () {
            Route::controller(EventTypeController::class)->group(function () {
                Route::get('index', 'index')->name('index');
                Route::match(['get', 'post'], 'create', 'create')->name('create');
                Route::match(['post', 'get'], 'update/{id}', 'update')->name('update');
                Route::post('destroy/{id}', 'destroy')->name('destroy');
            });
        });
        #################### End Event Types  Routes ###########################

        ##################### Start Events  Routes #########################

        Route::group(['middleware' => 'can:admins', 'prefix' => 'events', 'as' => 'events.'], routes: function () {
            Route::controller(EventController::class)->group(function () {
                Route::get('index', 'index')->name('index');
                Route::match(['get', 'post'], 'create', 'create')->name('create');
                Route::match(['post', 'get'], 'update/{id}', 'update')->name('update');
                Route::post('destroy/{id}', 'destroy')->name('destroy');
            });
        });
        #################### End Events Routes ###########################


    });


});
