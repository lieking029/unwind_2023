<?php

use App\Enums\UserTypeEnum;
use App\Models\Addon;
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
        Schema::create('addons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        // $merchants = User::role(UserTypeEnum::Merchant)->with('roles')->get();

        Addon::insert([
            ['name' => 'Breakfast or Meal Packages'],
            ['name' => 'Spa Services'],
            ['name' => 'Airport Shuttle Services'],
            ['name' => 'Bike Rental'],
            ['name' => 'Car Rental'],
            ['name' => 'Tour Guides'],
            ['name' => 'Childcare Services'],
        ]);


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addons');
    }
};
