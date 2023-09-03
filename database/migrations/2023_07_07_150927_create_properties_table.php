<?php

use App\Enums\ResortVisibilityEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('price', 15, 2);
            $table->string('featured_media')->nullable();
            $table->foreignId('property_type_id')->constrained()->cascadeOnDelete();
            $table->integer('visibility')->default(ResortVisibilityEnum::Private);
            $table->boolean('has_12_hours_cancellation_policy')->default(false);
            $table->longText('description');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
