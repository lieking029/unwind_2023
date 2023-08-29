<?php

use App\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('amenities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });


        // $now = now();

        // $merchants = User::role(UserTypeEnum::Merchant)->with('roles')->get();

        // $amenities = [
        //     ['name' => 'Swimming Pool', 'icons' => 'fas fa-swimming-pool', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Fitness Center', 'icons' => 'fas fa-dumbbell', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Spa', 'icons' => 'fas fa-spa', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Restaurant', 'icons' => 'fas fa-utensils', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Parking slot', 'icons' => 'fas fa-parking', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Room Service', 'icons' => 'fas fa-person-booth', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Wi-Fi', 'icons' => 'fas fa-wifi', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Play Area', 'icons' => 'fas fa-gamepad', 'created_at' => $now, 'updated_at' => $now],
        // ];

        // foreach($amenities as $amenity) {
        //     foreach($merchants as $merchant) {
        //         $merchant->amenities()->create($amenity);
        //     }
        // }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amenities');
    }
};
