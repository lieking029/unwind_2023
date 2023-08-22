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


        $now = now();

        $merchants = User::role(UserTypeEnum::Merchant)->with('roles')->get();

        $amenities = [
            ['name' => 'Swimming Pool'],
            ['name' => 'Fitness Center'],
            ['name' => 'Spa'],
            ['name' => 'Restaurant'],
            ['name' => 'Kitchen'],
            ['name' => 'Park'],
            ['name' => 'Room Service'],
            ['name' => 'Wi-Fi'],
            ['name' => 'Play Area'],
        ];

        foreach($amenities as $amenity) {
            foreach($merchants as $merchant) {
                $merchant->amenities()->create($amenity);
            }
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amenities');
    }
};
