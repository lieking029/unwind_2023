<?php

use App\Enums\TokenAbilityEnum;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Client\Auth\MeController;
use App\Http\Controllers\Api\V1\Client\TripController;
use App\Http\Controllers\Api\V1\Client\Auth\SignInController;
use App\Http\Controllers\Api\V1\Client\Auth\SignUpController;
use App\Http\Controllers\Api\V1\Client\RateTripController;
use App\Http\Controllers\Api\V1\Client\CancelTripController;
use App\Http\Controllers\Api\V1\Client\TransactionsController;
use App\Http\Controllers\Api\V1\Client\Auth\ResendOtpController;
use App\Http\Controllers\Api\V1\Client\Auth\VerifyOtpController;
use App\Http\Controllers\Api\V1\Client\FeaturedResortsController;
use App\Http\Controllers\Api\V1\Client\Settings\UploadProfileController;
use App\Http\Controllers\Api\V1\Client\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\V1\Client\Settings\ChangePasswordController;
use App\Http\Controllers\Api\V1\Client\Settings\PersonalInformationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('user')->group(function () {
    Route::middleware(['guest'])->group(function () {
        Route::post('/signIn', SignInController::class);
        Route::post('/signUp', SignUpController::class);

        Route::post('/forgot', ForgotPasswordController::class);
    });
    
    
    Route::middleware(['auth:api'])->group(function () {
        Route::middleware(['can:'. TokenAbilityEnum::OtpVerify])->group(function () {
            Route::post('/verify', VerifyOtpController::class);
            Route::post('/resend-otp', ResendOtpController::class);
        });

        Route::get('/me', MeController::class);

        // Resorts
        Route::get('/resort/featured', FeaturedResortsController::class);


        // Trips
        Route::get('/trip', [TripController::class, 'index']);
        Route::get('/trip/{trip}', [TripController::class, 'show']);

        Route::patch('/trip/{trip}/cancel', CancelTripController::class);
        Route::put('/trip/{trip}/rate', RateTripController::class);


        // Transactions
        Route::get('/transactions', TransactionsController::class);

        // Password / Info / Profile
        Route::patch('change-password', ChangePasswordController::class);
        Route::put('/personal-information', PersonalInformationController::class);
        Route::patch('/profile', UploadProfileController::class);

    });
});