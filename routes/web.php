<?php

use App\Models\Barangay;
use App\Models\City;
use App\Models\Province;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Web\UploadController;
use App\Http\Controllers\Web\Merchant\RoomController;
use App\Http\Controllers\Web\Merchant\AddonController;
use App\Http\Controllers\Web\Merchant\ResortController;
use App\Http\Controllers\Web\Merchant\AmenityController;
use App\Http\Controllers\Web\Merchant\SubhostController;

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

        Route::get('transaction', function () {
            return view('admin.transaction.index');
        });

    });

    Route::middleware('role:merchant')->group(function () {


        // RESOURCES
        Route::resource('amenity', AmenityController::class);
        Route::resource('addon', AddonController::class);
        Route::resource('resort', ResortController::class);
        Route::resource('subhost', SubhostController::class)
            ->parameters(['subhost' => 'user'])
            ->only('index', 'store', 'show', 'update', 'destroy');

        // Users
        Route::resource('user', UserController::class)->only('destroy');

        //Room
        Route::get('room/{room}/destroy', [RoomController::class, 'destroy'])->name('room.destroy');
        Route::get('room/create/{id}', [RoomController::class, 'create'])->name('room.create');
        Route::post('room/{resort}', [RoomController::class, 'store'])->name('room.store');
        Route::get('room/{resort}', [RoomController::class, 'edit'])->name('room.edit');
        Route::post('room/{resort}/update', [RoomController::class, 'update'])->name('room.update');

        Route::get('bookings', function () {
            return view('merchant.booking.index');
        });




        // Location Filtering
        Route::get('regions/{region}', function($region) {
            $province = Province::where('region_id', $region)->get();
            return response()->json($province);
        });
        Route::get('provinces/{province}', function($province) {
            $city = City::where('province_id', $province)->get();
            return response()->json($city);
        });
        Route::get('cities/{city}', function($city) {
            $barangay = Barangay::where('city_id', $city)->get();
            return response()->json($barangay);
        });

    });

    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/upload', UploadController::class);
});
