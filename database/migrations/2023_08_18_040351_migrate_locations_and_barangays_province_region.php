<?php

use App\Models\Barangay;
use App\Models\City;
use App\Models\Region;
use App\Models\Province;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!DB::table('regions')->count()) {
            DB::unprepared(file_get_contents(dirname(__DIR__) . '/seeders/sql/philippines_regions.sql'));
        }


        if (!DB::table('provinces')->count()) {
            DB::unprepared(file_get_contents(dirname(__DIR__) . '/seeders/sql/philippines_provinces.sql'));
        }

        Schema::table('provinces', function (Blueprint $table) {
            $table->foreignId('region_id')->nullable()->constrained()->cascadeOnDelete();
        });

        Province::query()
            ->chunk(20, function ($provinces) {
                foreach ($provinces as $province) {
                    $region = Region::where('code', $province->region_code)->first(['id']);
                    if (!$region) {
                        throw new \Exception('no region found with ' . $province->region_code);
                    }

                    $province->update(['region_id' => $region->id]);
                }
            });

        Schema::table('provinces', fn (Blueprint $table) => $table->dropColumn('region_code'));



        if (!DB::table('cities')->count()) {
            DB::unprepared(file_get_contents(dirname(__DIR__) . '/seeders/sql/philippines_cities.sql'));
        }

        Schema::table('cities', function (Blueprint $table) {
            $table->foreignId('province_id')->nullable()->constrained()->cascadeOnDelete();
        });

        City::query()
            ->chunk(20, function ($cities) {
                foreach ($cities as $city) {
                    $province = Province::where('code', $city->province_code)->first(['id']);
                    if (!$province) {
                        throw new \Exception('no region found with ' . $province->region_code);
                    }

                    $city->update(['province_id' => $province->id]);
                }
            });

        Schema::table('cities', fn (Blueprint $table) => $table->dropColumn(['province_code', 'region_description']));


        if (!DB::table('barangays')->count()) {
            DB::unprepared(file_get_contents(dirname(__DIR__) . '/seeders/sql/philippines_barangays.sql'));
        }

        Schema::table('barangays', function (Blueprint $table) {
            $table->foreignId('city_id')->nullable()->constrained()->cascadeOnDelete();
        });

        Barangay::query()
            ->chunk(20, function ($barangays) {
                foreach ($barangays as $barangay) {
                    $city = City::where('code', $barangay->city_municipality_code)->first(['id']);
                    if (!$city) {
                        throw new \Exception('no region found with ' . $barangay->city_municipality_code);
                    }

                    $barangay->update(['city_id' => $city->id]);
                }
            });

        Schema::table('barangays', function (Blueprint $table) {
            $table->dropColumn(['city_municipality_code', 'province_code', 'region_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
