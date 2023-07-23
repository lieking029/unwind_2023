<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResortController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::middleware('role:admin')->group(function () {

    // Users
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('merchants', [UserController::class, 'merchant'])->name('users.merchant');

    Route::get('transaction', function() {
        return view('admin.transaction.index');
    });

    });

    Route::middleware('role:merchant')->group(function () {


        // SubHost
        Route::get('sub-host', [UserController::class, 'subHost'])->name('users.subHost');
        Route::post('sub-host', [UserController::class, 'storeSubHost'])->name('users.storeSubHost');
        Route::get('sub-host/{id}', [UserController::class, 'showSubHost'])->name('users.showSubHost');

        Route::get('bookings', function() {
            return view('merchant.booking.index');
        });

        Route::resource('resorts', ResortController::class)
                ->only('index', 'create', 'store');

    });

    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
});
