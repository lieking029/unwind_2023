<?php

use App\Models\PropertyType;
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
        Schema::create('property_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
        });
        $now = now();
        PropertyType::insert([
            ['name' => 'Resort - Destination Resort', 'created_at' => $now, 'updated_at' => $now ],
            ['name' => 'Resort - Commercial Resort', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Resort - Time Shared Resort', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Beaches', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Amenities', 'created_at' => $now, 'updated_at' => $now],
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_types');
    }
};
