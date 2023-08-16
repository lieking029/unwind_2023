<?php

namespace Database\Seeders;

use App\Models\Addon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AddonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Addon::factory(30)->create();
    }
}
