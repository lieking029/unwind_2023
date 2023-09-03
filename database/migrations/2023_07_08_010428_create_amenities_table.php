<?php

use App\Enums\UserTypeEnum;
use App\Models\Amenity;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('amenities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icons');
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });


        $now = now();

        $merchants = User::role(UserTypeEnum::Merchant)->with('roles')->get();

        Amenity::insert([
            ['name' => 'Swimming Pool', 'icons' => 'fas fa-swimming-pool'],
            ['name' => 'Fitness Center', 'icons' => 'fas fa-dumbbell'],
            ['name' => 'Spa', 'icons' => 'fas fa-spa'],
            ['name' => 'Restaurant', 'icons' => 'fas fa-utensils'],
            ['name' => 'Parking slot', 'icons' => 'fas fa-parking'],
            ['name' => 'Room Service', 'icons' => 'fas fa-person-booth'],
            ['name' => 'Wi-Fi', 'icons' => 'fas fa-wifi'],
            ['name' => 'Play Area', 'icons' => 'fas fa-gamepad'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amenities');
    }
};
